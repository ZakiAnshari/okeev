<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get(); // ambil semua data tanpa paginate
        return view('admin.news.index', compact('news'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title'        => 'required|string|max:255|unique:news,title',
            'content'      => 'required',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'author'       => 'required|string|max:100',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        // Upload thumbnail bila ada
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('images', 'public');
        }

        // Simpan ke database
        News::create([
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'thumbnail'    => $thumbnailPath,
            'author'       => $validated['author'],
            'status'       => $validated['status'],
            'published_at' => $validated['published_at'] ?? null,
        ]);

        Alert::success('Success', 'News berhasil ditambahkan');
        return back();
    }

    public function edit($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();

        return view('admin.news.edit', [
            'news' => $news
        ]);
    }

    public function update(Request $request, $slug)
    {
        // Ambil data berita berdasarkan slug
        $news = News::where('slug', $slug)->firstOrFail();

        // Validasi input (unique title kecuali dirinya sendiri)
        $validated = $request->validate([
            'title'        => 'required|string|max:255|unique:news,title,' . $news->id,
            'content'      => 'required|string',
            'author'       => 'required|string|max:100',
            'status'       => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'thumbnail'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika title berubah → update slug
        if ($news->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Upload thumbnail baru (jika ada)
        if ($request->hasFile('thumbnail')) {

            // Hapus file lama jika ada
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }

            // Upload file baru (sesuaikan dengan folder pada store ≈ "images")
            $validated['thumbnail'] = $request->file('thumbnail')->store('images', 'public');
        }

        // Update data berita
        $news->update($validated);

        Alert::success('Success', 'News berhasil diperbarui');
        return redirect()->route('news.index');
    }


    public function destroy($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $news->delete();

        Alert::success('Success', 'Data berhasil di Hapus');
        return redirect()->route('news.index');
    }
}
