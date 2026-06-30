<?php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('category');

        if ($request->filled('search')) {
            $words = preg_split('/\s+/', trim($request->search));

            $query->where(function ($q) use ($words) {
                foreach ($words as $word) {
                    $word = mb_strtolower($word);
                    $q->where(function ($sub) use ($word) {
                        $sub->whereRaw('LOWER(title) LIKE ?', ["%{$word}%"])
                            ->orWhereRaw('LOWER(location) LIKE ?', ["%{$word}%"])
                            ->orWhereRaw('LOWER(description) LIKE ?', ["%{$word}%"])
                            ->orWhereHas('category', function ($c) use ($word) {
                                $c->whereRaw('LOWER(name) LIKE ?', ["%{$word}%"]);
                            });
                    });
                }
            });
        }

        // Separate location field (from the hero search box), case-insensitive
        if ($request->filled('location')) {
            $location = mb_strtolower($request->location);
            $query->whereRaw('LOWER(location) LIKE ?', ["%{$location}%"]);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $jobs = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('home', compact('jobs', 'categories'));
    }
}