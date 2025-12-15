<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Brand;
use App\Models\Roles;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class HomeUserController extends Controller
{
    public function index()
    {
        // Ambil semua product beserta relasi category
        $products = Product::with('category')->get();

        // Ambil kategori dengan category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori dengan category_position_id = 2 (misal untuk Electric Motorcycles)
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();
        // Ambil kategori khusus category_position_id = 3 beserta brand-nya
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();


        // Ambil semua brand (optional, jika ingin menampilkan di grid lain)
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        return view('home.index', compact(
            'products',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
            'brands'
        ));
    }

    public function showProfile($slug)
    {
        // User login
        $authUser = Auth::user();

        // User yang sedang dilihat berdasarkan slug
        $user = User::where('slug', $slug)->firstOrFail();

        // Roles
        $roles = Roles::all();

        // Ambil brand
        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'category_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Chunk brand (4 per kolom)
        $brandChunks = $brands->chunk(4);

        // Kategori posisi 1
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Kategori posisi 2
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();

        // Kategori posisi 3 & 4
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();

        return view('home.profil', compact(
            'authUser',
            'user',
            'roles',
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3'
        ));
    }


    public function profilestore(Request $request)
    {
        $user = Auth::user();

        try {
            $request->validate(
                [
                    'image_provile' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                ],
                [
                    'image_provile.required' => 'Silakan pilih gambar terlebih dahulu.',
                    'image_provile.image'    => 'File yang diunggah harus berupa gambar.',
                    'image_provile.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
                    'image_provile.max'      => 'Ukuran gambar maksimal 2MB.',
                ]
            );
        } catch (ValidationException $e) {
            Alert::error('Upload Gagal', $e->validator->errors()->first());
            return back();
        }

        // Hapus foto lama jika ada
        if ($user->image_provile && Storage::disk('public')->exists($user->image_provile)) {
            Storage::disk('public')->delete($user->image_provile);
        }

        // Upload foto baru
        $path = $request->file('image_provile')->store('profile', 'public');

        // Simpan ke database
        $user->image_provile = $path;
        $user->save();

        // Notifikasi sukses
        Alert::success('Berhasil', 'Foto profil berhasil diperbarui');

        return back();
    }



    public function cart()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // Ambil semua brand dari tabel brands
        $brands = Brand::select('id', 'name_brand', 'slug', 'image')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Pecah menjadi chunks untuk grid, misal 4 per kolom
        $brandChunks = $brands->chunk(4);

        // Ambil kategori dengan category_position_id = 1 beserta brand-nya
        $categoriesPosition1 = Category::with('brands')
            ->where('category_position_id', 1)
            ->orderBy('name_category', 'asc')
            ->get();

        // Ambil kategori dengan category_position_id = 2 (misal untuk Electric Motorcycles)
        $categoriesPosition2 = Category::with('brands')
            ->where('category_position_id', 2)
            ->orderBy('name_category', 'asc')
            ->get();
        $products = Product::orderBy('created_at', 'desc')->get();

        // Ambil kategori khusus category_position_id = 3 beserta brand-nya
        $categoriesPosition3 = Category::with('brands')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('name_category', 'asc')
            ->get();


        return view('home.cart', compact(
            'brands',
            'brandChunks',
            'categoriesPosition1',
            'categoriesPosition2',
            'categoriesPosition3',
            'products',
            'cartItems'
        ));
    }

    // HomeUserController.php
    public function addToCart(Request $request)
    {
        $cart = Cart::firstOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id
            ],
            [
                'quantity' => 0
            ]
        );

        $cart->increment('quantity');

        return response()->json([
            'success' => true
        ]);
    }

    public function increaseQty(Request $request)
    {
        $cart = Cart::where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cart->increment('quantity');

        return response()->json([
            'qty'   => $cart->quantity,
            'count' => Cart::where('user_id', auth()->id())->sum('quantity')
        ]);
    }

    public function decreaseQty(Request $request)
    {
        $cart = Cart::where('id', $request->id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        }

        return response()->json([
            'qty'   => $cart->quantity,
            'count' => Cart::where('user_id', auth()->id())->sum('quantity')
        ]);
    }

    public function removeItem($id)
    {
        Cart::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json([
            'count' => Cart::where('user_id', auth()->id())->sum('quantity')
        ]);
    }
}
