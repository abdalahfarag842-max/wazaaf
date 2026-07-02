<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminJobController extends Controller
{
    /**
     * Display a listing of jobs with filters.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $companies = Company::all();
        $query = Job::with(['category', 'company']);
        // Search by title or location
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('location', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by company
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        $jobs = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::all();

        // Stats for the top cards
        $stats = [
            'total' => Job::count(),
            'open' => Job::where('status', 'open')->count(),
            'closed' => Job::where('status', 'closed')->count(),
            'draft' => Job::where('status', 'draft')->count(),
        ];

        return view('admin.jobs.index', compact(
            'jobs',
            'categories',
            'companies',
            'stats'
        ));
    }

    /**
     * Show the form for creating a new job.
     */
    public function create()
    {
        $categories = Category::all();
        $companies = Company::all();

        return view('admin.jobs.create', compact('categories', 'companies'));
    }
    /**
     * Store a newly created job.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:open,closed,draft',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',
        ]);


        Job::create([
            ...$validated,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('jobs.index')
            ->with('success', 'Job created successfully.');
    }

    /**
     * Display the specified job.
     */
    public function show(Job $job)
    {
        $job->load('category', 'company', 'applications.candidate.user');
        return view('admin.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified job.
     */
    public function edit(Job $job)
    {
        $categories = Category::all();
        $companies = Company::all();

        return view('admin.jobs.edit', compact('job', 'categories', 'companies'));
    }
    /**
     * Update the specified job.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'status' => 'required|in:open,closed,draft',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required|exists:companies,id',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job updated successfully.');
    }

    /**
     * Remove the specified job.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job deleted successfully.');
    }
}