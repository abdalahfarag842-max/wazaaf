<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $categories = Category::withCount('jobs')
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $categories->getCollection()->transform(function ($category) {
        $category->companies_count = $category->jobs()
            ->whereNotNull('company_id')
            ->distinct('company_id')
            ->count('company_id');

        return $category;
    });

    if ($request->ajax()) {
        return view('categories.table', compact('categories'));
    }

    return view('categories.index', compact('categories'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load([
            'jobs' => function ($query) {
                $query->latest();
            }
        ])->loadCount('jobs');

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(Category $category)
    {
        if ($category->jobs()->exists()) {

            return back()->with(
                'error',
                'This category contains jobs and cannot be deleted.'
            );

        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
