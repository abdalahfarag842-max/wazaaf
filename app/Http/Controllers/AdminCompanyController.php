<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;


class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Company::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $companies = $query
            ->withCount([
                'jobs',
                'jobs as open_jobs_count' => function ($q) {
                    $q->where('status', 'open');
                },
                'jobs as closed_jobs_count' => function ($q) {
                    $q->where('status', 'closed');
                },
                'jobs as draft_jobs_count' => function ($q) {
                    $q->where('status', 'draft');
                },
            ])
            ->orderByDesc('open_jobs_count')
            ->paginate(9)
            ->withQueryString();

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'website' => 'nullable|url|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Company::create($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'website' => 'nullable|url|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $company->update($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
