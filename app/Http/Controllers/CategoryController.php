<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil input pencarian & jumlah item per halaman
        $search = $request->input('search');
        $paginate = $request->input('itemsPerPage', 5); // default 5

        // Query awal: sort terbaru di atas
        $query = Category::orderBy('created_at', 'desc');

        // Pencarian berdasarkan name_category dan slug
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name_category', 'LIKE', '%' . $search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $search . '%');
            });
        }

        // Eksekusi query + paginasi
        $categorys = $query->paginate($paginate)->withQueryString();

        return view('admin.category.index', compact('user', 'categorys'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category',
        ]);

        // Simpan ke database
        Category::create([
            'name_category' => $validated['name_category'],
            // slug otomatis dibuat di model
        ]);

        Alert::success('Success', 'Category berhasil ditambahkan');
        return back();
    }

    public function edit($slug)
    {
        // Ambil category berdasarkan slug
        $categorys = Category::where('slug', $slug)->first();

        // Jika data tidak ditemukan
        if (!$categorys) {
            return redirect()->route('category.index')
                ->with('error', 'Data category tidak ditemukan.');
        }

        // Kirim ke view
        return view('admin.category.edit', [
            'categorys' => $categorys
        ]);
    }

    public function update(Request $request, $slug)
    {
        // Ambil kategori berdasarkan slug
        $categorys = Category::where('slug', $slug)->firstOrFail();

        // Validasi name_category tidak boleh sama dengan kategori lain
        $validated = $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category,' . $categorys->id,
        ]);

        // Update name_category
        $categorys->name_category = $validated['name_category'];

        // Slug otomatis diperbarui oleh model (jika kamu buat rule updating di model)
        $categorys->save();

        Alert::success('Success', 'Category berhasil diperbarui.');
        return redirect()->route('category.index');
    }

    public function destroy($slug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Hapus data
        $category->delete();

        Alert::success('Success', 'Category berhasil dihapus.');
        return redirect()->route('category.index');
    }
}
