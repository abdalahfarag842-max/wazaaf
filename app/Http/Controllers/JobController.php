<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Notifications\NewJobNotification;

class JobController extends Controller
{
  public function index(Request $request)
{
    $query = Job::with('category');

    // Single keyword search: matches title OR location OR description, case-insensitive
   
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->filled('job_type')) {
        $query->where('job_type', $request->job_type);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $jobs = $query->latest()->paginate(12);
    $categories = Category::all();

    return view('jobs.index', compact('jobs', 'categories'));
}

    public function show(Job $job)
    {
        $job->load('category');
        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary'      => 'nullable|numeric',
            'location'    => 'required|string|max:255',
            'job_type'    => 'required|in:full_time,part_time,remote,internship',
            'deadline'    => 'nullable|date',
        ]);

        $job = Job::create($validated);

        User::where('id', '!=', auth()->id())
            ->get()
            ->each(fn($user) => $user->notify(new NewJobNotification($job)));

        return redirect()->route('jobs.index')->with('success', 'Job posted successfully.');
    }

    public function edit(Job $job)
    {
        $categories = Category::all();
        return view('jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'salary'      => 'nullable|numeric',
            'location'    => 'required|string|max:255',
            'job_type'    => 'required|in:full_time,part_time,remote,internship',
            'status'      => 'required|in:open,closed',
            'deadline'    => 'nullable|date',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
}