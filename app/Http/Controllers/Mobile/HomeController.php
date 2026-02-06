<?php

namespace App\Http\Controllers\Mobile;

use App\Models\News;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Feature;
use App\Models\Product;
use App\Models\HomeAbout;
use App\Models\Order;
use App\Models\Technology;
use App\Models\HomeContact;
use App\Models\HomeContent;
use App\Models\Testdrive;
use Illuminate\Http\Request;
use App\Models\HomeHeroSlider;
use App\Models\HomeTestimonial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('brand')
            ->where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        $brands = Brand::select('id', 'name_brand', 'slug', 'image', 'wallpaper', 'category_id', 'category_position_id')
            ->orderBy('name_brand', 'asc')
            ->get();

        // Ambil home contents, order by `position` jika ada
        if (Schema::hasColumn('home_contents', 'position')) {
            $homeContents = HomeContent::orderBy('position', 'asc')->get();
        } else {
            $homeContents = HomeContent::orderBy('id', 'asc')->get();
        }

        // Ambil hero sliders yang aktif
        $sliders = HomeHeroSlider::where('is_active', 1)
            ->orderBy('position', 'asc')
            ->get();

        // Ambil testimonial yang aktif
        $testimonials = HomeTestimonial::where('status', true)->latest()->get();

        // kirim flag biasa
        return view('mobile.home', [
            'brands' => $brands,
            'products' => $products,
            'homeContents' => $homeContents,
            'sliders' => $sliders,
            'testimonials' => $testimonials,
        ]);
    }

    // ______________________________________________________________________
    // MOBIL
    public function showcard()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_id', 1)
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_id', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.show', compact('vehicleBrands', 'products'));
    }
    // MOTOR
    public function showmotorcycles()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_id', 2)
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_id', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.showmotor', compact('vehicleBrands', 'products'));
    }
    // ELECTRIC
    public function showelectric()
    {
        // Brand Vehicle
        $vehicleBrands = Brand::where('category_position_id', 2)
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Vehicle
        $products = Product::with('brand')
            ->where('category_position_id', 2)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.showelectric', compact('vehicleBrands', 'products'));
    }

    //ACCESSORIES
    public function showaccessories()
    {
        // Brand Accessories (category_position_id = 3 & 4)
        $vehicleBrands = Brand::whereIn('category_position_id', [3, 4])
            ->orderBy('name_brand', 'asc')
            ->limit(100)
            ->get();

        // Product Accessories
        $products = Product::with('brand')
            ->whereIn('category_position_id', [3, 4])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('mobile.brand.showaccessories', compact('vehicleBrands', 'products'));
    }


    // ______________________________________________________________________
    // MOBIL BRAND
    public function showBrandVehicle($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detail', compact('brand', 'sameBrandProducts'));
    }
    // MOTOR BRAND
    public function showBrandmotor($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detailmotor', compact('brand', 'sameBrandProducts'));
    }
    // ELECTRIC BRAND
    public function showBrandelectric($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detailelectric', compact('brand', 'sameBrandProducts'));
    }
    // ACCESSORIES BRAND
    public function showBrandaccessories($slug)
    {
        $brand = Brand::where('slug', $slug)->firstOrFail();
        $sameBrandProducts = Product::with('brand')
            ->where('brand_id', $brand->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('mobile.brand.detailaccessories', compact('brand', 'sameBrandProducts'));
    }

    // ______________________________________________________________________

    public function showVehicleDetail($productSlug)
    {
        // Ambil product berdasarkan slug
        $product = \App\Models\Product::where('slug', $productSlug)
            ->with(['features', 'technologies', 'colors', 'specifications', 'details', 'powers', 'dimensis', 'suspensis', 'fiturs']) // load relasi langsung
            ->firstOrFail();

        // Ambil feature & technology khusus product ini
        $features = $product->features;
        $technologies = $product->technologies;
        $colors = $product->colors;
        $specifications = $product->specifications;
        $details = $product->details;
        $powers = $product->powers;
        $dimensis = $product->dimensis;
        $suspensis = $product->suspensis;
        $fiturs = $product->fiturs;

        // Kirim data ke view
        return view('mobile.vehicle.detail', compact('product', 'features', 'technologies', 'colors', 'specifications', 'details', 'powers', 'dimensis', 'suspensis', 'fiturs'));
    }







    public function transaksi()
    {
        // Kembalikan view tanpa data
        return view('mobile.transaksi.index');
    }

    public function newss()
    {
        $news = News::latest()->get();
        return view('mobile.news.index', compact('news'));
    }

    public function newssdetail($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        return view('mobile.news.detail', compact('news'));
    }

    public function profilm()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Kirim data user ke view
        return view('mobile.profil.index', compact('user'));
    }

    public function about()
    {
        $about = HomeAbout::first();
        return view('mobile.about.index', compact('about'));
    }

    public function contact()
    {
        $homeContact = HomeContact::first();
        return view('mobile.contact.index', compact('homeContact'));
    }

    public function notification()
    {
        $userId = Auth::id();
        $homeContact = HomeContact::first();
        
        $notifOrders = [];
        $notifTestdrives = [];
        $notifCount = 0;
        
        if ($userId) {
            // Get recent orders for this user
            $notifOrders = Order::where('user_id', $userId)
                ->where(function ($q) {
                    $q->whereIn('status', ['PENDING', 'Failed', 'Completed'])
                      ->orWhereIn('status_transaksi', ['PENDING', 'Failed', 'Completed']);
                })
                ->whereRaw("LOWER(COALESCE(status,'')) != 'cancelled'")
                ->whereRaw("LOWER(COALESCE(status_transaksi,'')) != 'cancelled'")
                ->with('product')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            
            // Get recent test drives (all, since no user_id in testdrive table)
            // Filter by user email or name if available
            $user = Auth::user();
            $notifTestdrives = Testdrive::with('product')
                ->where(function ($q) use ($user) {
                    if ($user) {
                        $q->where('email', $user->email)
                          ->orWhere('telp', $user->phone ?? '');
                    }
                })
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
            
            $notifCount = $notifOrders->count() + $notifTestdrives->count();
        }
        
        return view('mobile.notifikasi.index', compact('homeContact', 'notifOrders', 'notifTestdrives', 'notifCount'));
    }

    public function shoppingcart()
    {
        $cartItems = \App\Models\Cart::with(['product', 'color'])
            ->where('user_id', Auth::id())
            ->get();

        $total = 0;
        foreach ($cartItems as $c) {
            $total += ($c->product->price ?? 0) * ($c->quantity ?? 1);
        }

        return view('mobile.shoppingcart.index', compact('cartItems', 'total'));
    }

    public function contactstores(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Cek email duplicate
        if (Contact::where('email', $validated['email'])->exists()) {
            Alert::error('Gagal', 'Email ini sudah pernah digunakan!');
            return back()->withInput();
        }

        // Cek phone duplicate
        if (!empty($validated['phone']) && Contact::where('phone', $validated['phone'])->exists()) {
            Alert::error('Gagal', 'Nomor telepon ini sudah pernah digunakan!');
            return back()->withInput();
        }

        // Simpan data
        Contact::create($validated);
        Alert::success('Berhasil', 'Pesan Anda telah berhasil dikirim.');
        return back();
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $sortBy = $request->get('sort', 'latest');
        $priceMin = $request->get('price_min');
        $priceMax = $request->get('price_max');
        $category = $request->get('category');

        // Base query untuk products
        $products = Product::query()
            ->where('stock_status', 'in_stock')
            ->where(function ($q) use ($query) {
                if (!empty($query)) {
                    $q->where('model_name', 'like', '%' . $query . '%')
                      ->orWhere('description', 'like', '%' . $query . '%')
                      ->orWhereHas('brand', function ($subQ) use ($query) {
                          $subQ->where('name_brand', 'like', '%' . $query . '%');
                      });
                }
            });

        // Filter by category
        if (!empty($category)) {
            $products->where('category_id', $category);
        }

        // Filter by price range
        if (!empty($priceMin)) {
            $products->where('price', '>=', $priceMin);
        }
        if (!empty($priceMax)) {
            $products->where('price', '<=', $priceMax);
        }

        // Sort
        if ($sortBy === 'price_low') {
            $products->orderBy('price', 'asc');
        } elseif ($sortBy === 'price_high') {
            $products->orderBy('price', 'desc');
        } else {
            $products->orderBy('created_at', 'desc');
        }

        $results = $products->paginate(12);
        $categories = \App\Models\Category::all();
        $brands = Brand::all();

        return view('mobile.search.index', compact('results', 'categories', 'brands', 'query', 'sortBy', 'priceMin', 'priceMax', 'category'));
    }

    public function profilestorem(Request $request)
    {
        try {
            // Validate input
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Auth::id(),
                'contact' => 'required|string|max:255',
                'city' => 'nullable|string|max:255',
                'image_provile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = Auth::user();

            // Update user data
            $user->first_name = $validated['first_name'];
            $user->email = $validated['email'];
            $user->contact = $validated['contact'];
            $user->city = $validated['city'] ?? $user->city;

            // Handle image upload
            if ($request->hasFile('image_provile')) {
                // Delete old image if exists
                if ($user->image_provile && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image_provile)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($user->image_provile);
                }

                // Store new image
                $imagePath = $request->file('image_provile')->store('profiles', 'public');
                $user->image_provile = $imagePath;
            }

            $user->save();

            Alert::success('Success', 'Profil berhasil diperbarui');
            return redirect()->route('profilm.show');

        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui profil: ' . $e->getMessage());
            return back();
        }
    }
}
