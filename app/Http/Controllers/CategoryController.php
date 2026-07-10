<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->role === 'admin') {
            $categories = Category::with('user')->orderBy('name')->paginate(10);
        } else {
            $categories = auth()->user()->categories()->orderBy('name')->paginate(10);
        }
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        auth()->user()->categories()->create($request->validated());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(Category $category): View
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($category->user_id !== auth()->id(), 403);
        }
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($category->user_id !== auth()->id(), 403);
        }
        $category->update($request->validated());

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($category->user_id !== auth()->id(), 403);
        }
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
