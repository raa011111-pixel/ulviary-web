<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        if (auth()->user()->role === 'admin') {
            $articles = Article::with(['category', 'user'])->orderByDesc('created_at')->paginate(10);
        } else {
            $articles = auth()->user()->articles()->with('category')->orderByDesc('created_at')->paginate(10);
        }
        return view('articles.index', compact('articles'));
    }

    public function create(): View
    {
        if (auth()->user()->role === 'admin') {
            $categories = Category::orderBy('name')->get();
        } else {
            $categories = auth()->user()->categories()->orderBy('name')->get();
        }
        return view('articles.create', compact('categories'));
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $targetDir = public_path('uploads/thumbnails');
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true, true);
            }
            
            $file->move($targetDir, $filename);
            $data['thumbnail'] = 'uploads/thumbnails/' . $filename;
        }

        $article = auth()->user()->articles()->create($data);

        // Upload gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $imageFile) {
                $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $targetDir = public_path('uploads/galleries');
                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true, true);
                }
                $imageFile->move($targetDir, $filename);
                $article->gallery()->create([
                    'image_path' => 'uploads/galleries/' . $filename,
                ]);
            }
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Article $article): View
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($article->user_id !== auth()->id(), 403);
            $categories = auth()->user()->categories()->orderBy('name')->get();
        } else {
            $categories = Category::orderBy('name')->get();
        }
        return view('articles.edit', compact('article', 'categories'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($article->user_id !== auth()->id(), 403);
        }
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail && File::exists(public_path($article->thumbnail))) {
                File::delete(public_path($article->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            $targetDir = public_path('uploads/thumbnails');
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0755, true, true);
            }

            $file->move($targetDir, $filename);
            $data['thumbnail'] = 'uploads/thumbnails/' . $filename;
        }

        $article->update($data);

        // Delete selected gallery images
        if ($request->has('delete_gallery_ids')) {
            $deleteIds = $request->input('delete_gallery_ids');
            $imagesToDelete = $article->gallery()->whereIn('id', $deleteIds)->get();
            foreach ($imagesToDelete as $img) {
                if (File::exists(public_path($img->image_path))) {
                    File::delete(public_path($img->image_path));
                }
                $img->delete();
            }
        }

        // Upload new gallery images
        if ($request->hasFile('gallery')) {
            $currentCount = $article->gallery()->count();
            $newFiles = $request->file('gallery');
            if ($currentCount + count($newFiles) > 5) {
                return redirect()->back()->withErrors(['gallery' => 'Jumlah foto di galeri tidak boleh melebihi 5 gambar.'])->withInput();
            }

            foreach ($newFiles as $imageFile) {
                $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $targetDir = public_path('uploads/galleries');
                if (!File::isDirectory($targetDir)) {
                    File::makeDirectory($targetDir, 0755, true, true);
                }
                $imageFile->move($targetDir, $filename);
                $article->gallery()->create([
                    'image_path' => 'uploads/galleries/' . $filename,
                ]);
            }
        }

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if (auth()->user()->role !== 'admin') {
            abort_if($article->user_id !== auth()->id(), 403);
        }

        if ($article->thumbnail && File::exists(public_path($article->thumbnail))) {
            File::delete(public_path($article->thumbnail));
        }

        // Delete all gallery images first
        foreach ($article->gallery as $img) {
            if (File::exists(public_path($img->image_path))) {
                File::delete(public_path($img->image_path));
            }
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
