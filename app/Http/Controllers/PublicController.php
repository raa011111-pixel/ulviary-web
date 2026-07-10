<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $categorySlug = $request->input('category');

        $query = Article::where('status', 'published')
            ->with(['user', 'category'])
            ->orderByDesc('created_at');

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        $articles = $query->paginate(6)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('public.index', compact('articles', 'categories', 'search', 'categorySlug'));
    }

    public function show(string $slug): View
    {
        $article = Article::where('status', 'published')
            ->where('slug', $slug)
            ->with(['user', 'category', 'comments' => function ($q) {
                $q->orderByDesc('created_at');
            }])
            ->firstOrFail();

        return view('public.show', compact('article'));
    }

    public function about(): View
    {
        $admin = \App\Models\User::where('role', 'admin')->first();
        return view('public.about', compact('admin'));
    }

    public function contact(): View
    {
        return view('public.contact');
    }

    public function storeComment(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $article->comments()->create($validated);

        return redirect()->back()->with('success', 'Komentar Anda berhasil ditambahkan!');
    }
}
