<?php
namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class AdminCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $candidates = Candidate::with('user')

        ->when($request->search, function ($query) use ($request) {

            $query->where('phone', 'like', "%{$request->search}%")

                ->orWhereHas('user', function ($user) use ($request) {

                    $user->where('name', 'like', "%{$request->search}%")
                         ->orWhere('email', 'like', "%{$request->search}%");

                });

        })

        ->latest()

        ->paginate(10)

        ->withQueryString();

    if ($request->ajax()) {

        return view('admin.candidates.table', compact('candidates'));

    }

    return view('admin.candidates.index', compact('candidates'));
}

    /**
     * Show the form for creating a new resource.
     */


    public function create()
    {
        return view('admin.candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|confirmed|min:8',

            'phone' => 'required|string|max:20',

            'address' => 'required|string|max:255',

            'experience_years' => 'required|integer|min:0',

            'bio' => 'nullable|string',

            'cv' => 'nullable|mimes:pdf|max:2048'

        ]);

        DB::transaction(function () use ($request, $validated) {

            $user = User::create([

                'name' => $validated['name'],

                'email' => $validated['email'],

                'password' => Hash::make($validated['password']),

                'role' => 'user',

            ]);

            $cv = null;

            if ($request->hasFile('cv')) {

                $cv = $request->file('cv')->store('cvs', 'public');

            }

            Candidate::create([

                'user_id' => $user->id,

                'phone' => $validated['phone'],

                'address' => $validated['address'],

                'experience_years' => $validated['experience_years'],

                'bio' => $validated['bio'],

                'cv' => $cv,

            ]);

        });

        return redirect()
            ->route('candidates.index')
            ->with('success', 'Candidate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
{
    $candidate->load([
        'user',
        'applications.job',
    ]);

    return view('admin.candidates.show', compact('candidate'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        $candidate->load('user');

        return view('admin.candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, Candidate $candidate)
    {
        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($candidate->user_id),
            ],

            'phone' => 'required|string|max:20',

            'address' => 'required|string|max:255',

            'experience_years' => 'required|integer|min:0',

            'bio' => 'nullable|string',

            'cv' => 'nullable|file|mimes:pdf|max:2048',

        ]);

        DB::transaction(function () use ($request, $validated, $candidate) {

            $candidate->user->update([

                'name' => $validated['name'],

                'email' => $validated['email'],

            ]);

            if ($request->hasFile('cv')) {

                if ($candidate->cv) {

                    Storage::disk('public')->delete($candidate->cv);

                }

                $candidate->cv = $request
                    ->file('cv')
                    ->store('cvs', 'public');
            }

            $candidate->update([

                'phone' => $validated['phone'],

                'address' => $validated['address'],

                'experience_years' => $validated['experience_years'],

                'bio' => $validated['bio'],

                'cv' => $candidate->cv,

            ]);

        });

        return redirect()
            ->route('candidates.index')
            ->with('success', 'Candidate updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
{
    if ($candidate->cv) {

        Storage::disk('public')->delete($candidate->cv);

    }

    $candidate->user->delete();

    return redirect()
        ->route('candidates.index')
        ->with('success', 'Candidate deleted successfully.');
}
}
