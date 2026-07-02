<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $applications = Application::with([
        'candidate.user',
        'job.category',
    ])

    ->when($request->filled('search'), function ($query) use ($request) {

        $search = $request->search;

        $query->where('status', 'like', "%{$search}%")

            ->orWhereHas('candidate.user', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");

            })

            ->orWhereHas('job', function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%");

            });

    })

    ->latest()

    ->paginate(10)

    ->withQueryString();

    if ($request->ajax()) {

    return view('admin.applications.table', compact('applications'));

}

return view('admin.applications.index', compact('applications'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application->load([
            'candidate.user',
            'job.category',
        ]);

        return view('admin.applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        $application->load([
            'candidate.user',
            'job.category',
        ]);

        return view('admin.applications.edit', compact('application'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected',
        ]);

        $application->update($validated);

        return redirect()
            ->route('applications.index')
            ->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Application $application)
    {
        $application->delete();

        return redirect()
            ->route('applications.index')
            ->with('success', 'Application deleted successfully.');
    }
}
