<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Tampilkan seluruh berita yang sudah dipublikasikan di halaman utama ("/").
     */
    public function index()
{
    $posts = Post::where('published', 'yes')
                ->latest('event_date')
                ->get();

    return view('index', compact('posts'));
}

    /**
     * Form tambah berita baru (hanya untuk user yang login).
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Simpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'published'  => 'required|in:yes,no',
            'publisher'  => 'required|string|max:255',
            'event_date' => 'required|date',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);

        return redirect('/')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail satu berita (halaman publik).
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Form edit berita (hanya untuk user yang login).
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update berita di database.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'content'    => 'required|string',
            'published'  => 'required|in:yes,no',
            'publisher'  => 'required|string|max:255',
            'event_date' => 'required|date',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);

        return redirect('/')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect('/')->with('success', 'Berita berhasil dihapus.');
    }
}