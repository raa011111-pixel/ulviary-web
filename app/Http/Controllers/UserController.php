<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(): View
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $users = User::where('id', '!=', auth()->id())
            ->orderBy('name')
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'role' => ['required', Rule::in(['admin', 'blogger'])],
        ]);

        $user->update([
            'role' => $request->input('role')
        ]);

        return redirect()->route('users.index')->with('success', 'Peran pengguna berhasil diperbarui! 👥');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_if(auth()->user()->role !== 'admin', 403);
        abort_if($user->id === auth()->id(), 403);

        // Delete avatar if exists
        if ($user->avatar && \Illuminate\Support\Facades\File::exists(public_path($user->avatar))) {
            \Illuminate\Support\Facades\File::delete(public_path($user->avatar));
        }

        // Delete article thumbnail & gallery files
        foreach ($user->articles as $article) {
            if ($article->thumbnail && \Illuminate\Support\Facades\File::exists(public_path($article->thumbnail))) {
                \Illuminate\Support\Facades\File::delete(public_path($article->thumbnail));
            }
            foreach ($article->gallery as $img) {
                if (\Illuminate\Support\Facades\File::exists(public_path($img->image_path))) {
                    \Illuminate\Support\Facades\File::delete(public_path($img->image_path));
                }
            }
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Akun pengguna berhasil dihapus secara permanen!');
    }
}
