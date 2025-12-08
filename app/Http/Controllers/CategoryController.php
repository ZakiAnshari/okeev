<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryPosition;
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
        $positions = CategoryPosition::all();
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
        return view('admin.category.index', compact('user', 'categorys', 'positions'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category',
            'category_position_id' => 'required|exists:category_positions,id',
        ]);

        // Simpan ke database
        Category::create([
            'name_category' => $validated['name_category'],
            'category_position_id' => $validated['category_position_id'],
            'slug' => Str::slug($validated['name_category'])
        ]);

        Alert::success('Success', 'Category berhasil ditambahkan');
        return back();
    }


    public function edit($slug)
    {
        // Ambil category berdasarkan slug
        $categorys = Category::where('slug', $slug)->first();

        // If not found
        if (!$categorys) {
            return redirect()->route('category.index')
                ->with('error', 'Data category tidak ditemukan.');
        }

        // Ambil posisi kategori dari table category_positions
        $positions = CategoryPosition::all();

        // Kirim ke view
        return view('admin.category.edit', [
            'categorys' => $categorys,
            'positions' => $positions
        ]);
    }


    public function update(Request $request, $slug)
    {
        // Ambil kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Validasi (name_category harus unique kecuali untuk id ini)
        $validated = $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category,' . $category->id,
            'category_position'        => 'required|string|max:255',
        ]);

        // Update data
        $category->name_category = $validated['name_category'];
        $category->category_position        = $validated['category_position']; // tambahkan posisi

        // Slug otomatis diperbarui di model jika kamu gunakan mutator
        $category->save();

        Alert::success('Success', 'Category berhasil diperbarui.');
        return redirect()->route('category.index');
    }


    public function destroy($slug)
    {
        // Cari kategori berdasarkan slug
        $category = Category::where('slug', $slug)->firstOrFail();

        // Cek kategori yang dilindungi (category_position_id 1 dan 2)
        if (in_array($category->category_position_id, [1, 2])) {
            Alert::error('Error', 'Kategori ini tidak bisa dihapus karena termasuk kategori penting.');
            return redirect()->route('category.index');
        }

        // Hapus kategori
        $category->delete();

        Alert::success('Success', 'Kategori berhasil dihapus.');
        return redirect()->route('category.index');
    }
}
