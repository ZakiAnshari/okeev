@extends('layout.user')
@section('title', 'detail')
@section('content')
<br><br>
<section class="py-4 mt-5">
    <div class="container">

        <!-- Back Button -->
        <a href="/wuling" class="text-decoration-none mb-3 d-inline-flex align-items-center">
            <i class="bx bx-arrow-back me-2"></i> Detail Kendaraan
        </a>

        <div class="row g-4 mt-2 align-items-start">

            <!-- Gambar Utama -->
            <div class="col-12 col-lg-8">
                <div class="main-img-box p-3 rounded">
                    <img src="{{ asset('storage/' . $product->image) }}"
                    class="main-img" alt="Car">
                </div>
            </div>

            <!-- Thumbnail -->
            <div class="col-12 col-lg-4">
                <div class="thumb-container">

                    <img src="{{ asset('storage/' . $product->image_detail_1) }}"
                         class="thumbnail-img" alt="Thumb 1">

                    <img src="{{ asset('storage/' . $product->image_detail_2) }}"
                         class="thumbnail-img" alt="Thumb 2">

                    <img src="{{ asset('storage/' . $product->image_detail_3) }}"
                         class="thumbnail-img" alt="Thumb 3">

                </div>
            </div>

        </div>

        <!-- Detail Kendaraan -->
        <div class="mt-4">
            <h5 class="mb-1">{{ $product->model_name }}</h5>
            <h4 class="text-danger fw-bold">
                IDR {{ number_format($product->regular_price, 0, ',', '.') }}
            </h4>

        </div>

        <!-- Tombol -->
        <div class="row mt-4 g-3">

            <div class="col-md-6">
                <a href="/testdrive" class="btn btn-outline-info w-100 py-2 d-flex justify-content-center align-items-center">
                    <i class="bx bx-car me-2"></i>
                    Test Drive
                </a>
            </div>

            <div class="col-md-6">
                <a href="/cart" class="btn btn-outline-success w-100 py-2 d-flex justify-content-center align-items-center">
                    <i class="bx bx-cart me-2"></i>
                    Add to Cart
                </a>

            </div>

            <div class="col-12">
                <button class="btn text-white w-100 py-2 order-btn">
                    Order Now
                </button>
            </div>
        </div>
    </div>
</section>


<style>
        .line-tech {
            height: 2px;
            background: #DADADA;
        }
        .tech-nav {
            gap: 50px; /* boleh disesuaikan */
        }
/* ============================================================
   MAIN IMAGE WRAPPER
============================================================= */
.main-img-box {
    background: #F5F5F5;
    border-radius: 12px;
    height: 392px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.main-img {
    max-height: 100%;
    width: 100%;
    object-fit: contain;
}

/* ============================================================
   THUMBNAILS
============================================================= */
.thumb-container {
    display: grid;
    gap: 15px;
    grid-template-columns: 1fr;
}

.thumbnail-img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.25s ease;
}

.thumbnail-img:hover {
    transform: scale(1.03);
    opacity: 0.9;
}

/* ============================================================
   BUTTON GRADIENT
============================================================= */
.order-btn {
    background: linear-gradient(90deg, #00C6FF 0%, #00E676 100%);
    border-radius: 8px;
}

/* ============================================================
   RESPONSIVE OPTIMIZATION
============================================================= */
@media (max-width: 991px) {
    .main-img-box {
        height: auto;
        padding: 0;
    }
}

/* Tablet */
@media (min-width: 768px) and (max-width: 991px) {
    .thumb-container {
        display: grid;
        grid-template-columns: repeat(2, 1fr);  /* 2 kolom thumbnail */
        gap: 12px;
    }

    .thumbnail-img {
        height: 140px;  /* proporsional dan tidak pecah */
        object-fit: cover;
    }

    /* Biar gambar utama & thumbnail tetap sejajar */
    .main-image-col {
        margin-bottom: 0;
    }
}


/* Mobile */
@media (max-width: 576px) {
    .thumb-container {
        grid-template-columns: repeat(3, 1fr);
    }

    .thumbnail-img {
        height: 95px;
    }
}
</style>

{{-- ////////////////////////////////////////////////////////////////////////////////// --}}


<section class="py-5">
    <div class="container">

        <!-- Top Navigation -->
        <ul class="nav justify-content-center border-bottom pb-2 mb-4 tech-nav">
            <li class="nav-item"><span class="nav-link">Technology</span></li>
            <li class="nav-item"><span class="nav-link">Feature</span></li>
            <li class="nav-item"><span class="nav-link">Color</span></li>
            <li class="nav-item"><span class="nav-link">Specification</span></li>
            <li class="nav-item"><span class="nav-link">Credit Calculator</span></li>
            <li class="nav-item"><span class="nav-link">Other</span></li>
        </ul>


        <br><br>
        <!-- Title -->
        <div class="d-flex align-items-center mb-5">
            <h4 class="fw-bold me-3 mb-0">{{ $product->brand }} Technology</h4>
            <div class="flex-grow-1 line-tech"></div>
        </div>

        <div class="row align-items-center g-4 mt-1">

            <!-- Left Text -->
            <div class="col-lg-6 col-md-12">
                @forelse($product->technologies as $index => $tech)
                    <div class="tab-content {{ $index === 0 ? 'active' : '' }}" id="tech-{{ $index }}">
                        <h5 class="fw-bold" style="color:#00C092;">{{ $tech->name }}</h5>
                        <p class="text-secondary" style="line-height: 1.7;">
                            {!! $tech->description !!}
                        </p>
                    </div>
                @empty
                    <p class="text-muted">No technology information available for this product.</p>
                @endforelse
            </div>

            <!-- Right Image -->
            <div class="col-lg-6 col-md-12">
                @forelse($product->technologies as $index => $tech)
                    @if(!empty($tech->image) && file_exists(public_path('storage/' . $tech->image)))
                        <img 
                            src="{{ asset('storage/' . $tech->image) }}" 
                            class="img-fluid rounded shadow-sm tech-image {{ $index === 0 ? 'active' : '' }}" 
                            alt="{{ $tech->name }}" 
                            id="tech-image-{{ $index }}"
                            style="display: {{ $index === 0 ? 'block' : 'none' }};">
                    @endif
                @empty
                    <p class="text-muted">No technology images available for this product.</p>
                @endforelse
            </div>

        </div>


        <!-- Bottom Nav Tabs -->
        <div class="d-flex gap-4 mt-4 tech-tabs">
            @foreach($product->technologies as $index => $tech)
                <span 
                    class="tab-item {{ $index === 0 ? 'active' : '' }}" 
                    data-target="tech-{{ $index }}"
                    data-image="tech-image-{{ $index }}">
                    {{ $tech->name }}
                </span>
            @endforeach
        </div>

        {{-- JS untuk switch tab dan gambar --}}
        <script>
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.addEventListener('click', function() {
                const targetId = this.dataset.target;
                const imageId = this.dataset.image;

                // Hapus active dari semua tab dan konten teks
                document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                // Tambahkan active ke tab dan konten teks yang dipilih
                this.classList.add('active');
                document.getElementById(targetId).classList.add('active');

                // Sembunyikan semua gambar
                document.querySelectorAll('.tech-image').forEach(img => img.style.display = 'none');

                // Tampilkan gambar yang sesuai
                document.getElementById(imageId).style.display = 'block';
            });
        });
        </script>
    </div>
</section>



<style>
    .tab-content {
    font-size: 1rem;        /* ukuran default, bisa diganti 1.1rem atau 1.2rem */
    line-height: 1.8;       /* jarak antar baris lebih nyaman dibaca */
    color: #495057;         /* teks utama lebih kontras */
}

.tab-content h5 {
    font-size: 1.25rem;     /* judul lebih menonjol */
    margin-bottom: 0.75rem;
}

.tab-content p {
    font-size: 1.05rem;     /* paragraf lebih besar dari default */
}

    .tech-image {
    width: 100%;          /* memenuhi kolom */
    height: 300px;        /* tinggi tetap, sesuaikan kebutuhan */
    object-fit: cover;    /* memotong atau menyesuaikan gambar agar proporsional */
    border-radius: 0.5rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
}

    .tab-content {
    display: none; /* sembunyikan semua konten awal */
}
.tab-content.active {
    display: block; /* tampilkan konten aktif */
}
.tab-item {
    cursor: pointer;
}
.tab-item.active {
    font-weight: 700;
    border-bottom: 2px solid #00C092; /* highlight tab aktif */
}

    /* Desktop – rapikan jarak item */
.tech-nav {
    gap: 28px;
}

/* HP – jadikan scroll horizontal */
@media (max-width: 768px) {
    .tech-nav {
        overflow-x: auto;
        white-space: nowrap;
        flex-wrap: nowrap;
        gap: 20px;
        padding-bottom: 6px;
    }

    .tech-nav::-webkit-scrollbar {
        height: 5px;
    }

    .tech-nav::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 10px;
    }
}

    /* Top Nav */
    .tech-nav .nav-link {
        color: #7A7A7A;
        font-size: 15px;
        padding: 8px 14px;
    }
    .tech-nav .nav-link.active {
        color: #00A8FF;
        font-weight: 600;
        border-bottom: 2px solid #00A8FF;
    }

    /* Bottom Tabs */
    .tab-item {
        font-size: 15px;
        padding-bottom: 5px;
        cursor: pointer;
        color: #8A8A8A;
    }
    .tab-item.active {
        color: #00C092;
        font-weight: 700;
        border-bottom: 2px solid #00C092;
    }

    /* Responsive tweak */
    @media (max-width: 992px) {
        .tech-tabs {
            justify-content: center;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 768px) {
        .tech-image {
            margin-top: 20px;
        }
        .tech-nav {
            flex-wrap: wrap;
        }
    }
</style>

{{-- ????????????????????????????????????????????????????? --}}
<section class="py-5">
    <div class="container">
        <!-- Title -->
        <div class="d-flex align-items-center mb-5">
            <h4 class="fw-bold me-3 mb-0">{{ $product->brand }} Feature</h4>
            <div class="flex-grow-1 line-tech"></div>
        </div>
        <style>
            .line-tech {
            height: 2px;
            background: #DADADA;
        }
        .tech-nav {
            gap: 50px; /* boleh disesuaikan */
        }
        </style>

        <div class="row align-items-center g-4 mt-1">

    <!-- Left Text -->
  <div class="col-lg-6 col-md-12">
    <h4 class="mb-5" id="feature-description">
        @if($product->features->isNotEmpty())
            {!! $product->features->first()->description !!}
        @else
            No feature description available.
        @endif
    </h4>

    @forelse($product->features as $index => $feature)
        <h5  
            class="feature-item {{ $index === 0 ? 'active' : '' }}" 
            data-index="{{ $index }}">
            {{ $feature->name }}
        </h5>
    @empty
        <p class="text-muted">No features available for this product.</p>
    @endforelse
</div>
<style>
    .feature-item {
              /* warna default */
    cursor: pointer;
    margin-bottom: 0.5rem;
    transition: all 0.3s ease;
}

.feature-item:hover {
    color: #00C092;             /* efek hover */
}

.feature-item.active {
    color: #00C092;             /* warna hijau saat active */
}

</style>

    <!-- Right Image -->
    <div class="col-lg-6 col-md-12">
        @forelse($product->features as $index => $feature)
            @if(!empty($feature->image) && file_exists(public_path('storage/' . $feature->image)))
                <img 
                    src="{{ asset('storage/' . $feature->image) }}" 
                    class="img-fluid rounded shadow-sm feature-image {{ $index === 0 ? 'active' : '' }}" 
                    alt="{{ $feature->name }}" 
                    id="feature-image-{{ $index }}"
                    style="display: {{ $index === 0 ? 'block' : 'none' }};">
            @endif
        @empty
            <p class="text-muted">No feature images available for this product.</p>
        @endforelse
    </div>
</div>

<script>
    const descriptionH4 = document.getElementById('feature-description');
    const featureImages = document.querySelectorAll('.feature-image');

    document.querySelectorAll('.feature-item').forEach(item => {
        item.addEventListener('click', function() {
            const index = this.dataset.index;
            
            // Update H4 dengan description feature sesuai index
            const feature = @json($product->features);
            descriptionH4.innerHTML = feature[index].description;

            // Hapus active dari semua H5
            document.querySelectorAll('.feature-item').forEach(f => f.classList.remove('active'));
            this.classList.add('active');

            // Sembunyikan semua gambar dan tampilkan sesuai index
            featureImages.forEach(img => img.style.display = 'none');
            const img = document.getElementById(`feature-image-${index}`);
            if(img) img.style.display = 'block';
        });
    });
</script>


    </div>
</section>


<style>
    .feature-image {
    width: 100%;         /* memenuhi lebar kolom */
    height: 300px;       /* tinggi tetap agar semua gambar seragam */
    object-fit: cover;   /* menyesuaikan gambar, tetap proporsional */
    border-radius: 0.5rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
    transition: opacity 0.3s ease;
}

    .tech-item {
        cursor: pointer;
        margin-bottom: 0.5rem;
    }
    .tech-item.active {
        color: #00C092;
        font-weight: bold;
    }
</style>


{{-- ----------------------------------------------------------------------------- --}}

<section class="py-5">
    <div class="container">

        <!-- Title -->
        <div class="d-flex align-items-center mb-5">
            <h4 class="fw-bold me-3 mb-0">{{ $product->brand }} Color</h4>
            <div class="flex-grow-1 line-tech"></div>
        </div>

       <div class="row align-items-center g-4">
    <!-- Color Picker -->
    <div class="col-lg-5">
        <div class="p-4 border rounded-4 shadow-sm text-center">

            <!-- Warna -->
         <div class="d-flex flex-column align-items-center">
    <div class="d-flex flex-wrap justify-content-center gap-4 mb-3 color-container">
        @forelse($product->colors as $index => $color)
            <div 
                class="color-circle {{ $index === 0 ? 'active' : '' }}"
                data-index="{{ $index }}"
                data-name="{{ $color->name }}"
                data-image="{{ asset('storage/' . $color->image) }}"
                style="background: linear-gradient(to bottom, #000 50%, {{ $color->hex }} 50%);">
            </div>
        @empty
            <p class="text-muted">No colors available.</p>
        @endforelse
    </div>

    <p class="fw-semibold fs-6 mt-2" id="color-name">
        @if($product->colors->isNotEmpty())
            {{ $product->colors->first()->name }}
        @else
            -
        @endif
    </p>
</div>



        </div>

        <!-- Buttons -->
        <div class="row mt-4">
            <div class="col-6 pe-1">
                <button class="btn btn-outline-primary w-100 py-2 rounded-3">
                    Test Drive
                </button>
            </div>
            <div class="col-6 ps-1">
                <button class="btn btn-primary w-100 py-2 rounded-3"
                    style="background: linear-gradient(to right, #0094ff, #00e6a8); border: none;">
                    Order Now
                </button>
            </div>
        </div>
    </div>

    <!-- Gambar Mobil -->
  <div class="col-lg-7 text-center">
    <img 
        src="@if($product->colors->isNotEmpty()) {{ asset('storage/' . $product->colors->first()->image) }} @endif"
        class="img-fluid car-preview"
        id="car-preview"
        alt="Car">
</div>

</div>
<script>
    // Ambil semua lingkaran warna
    const colorCircles = document.querySelectorAll('.color-circle');
    const carPreview = document.getElementById('car-preview'); // Gambar mobil
    const colorName = document.getElementById('color-name');    // Nama warna

    colorCircles.forEach(circle => {
        circle.addEventListener('click', function() {
            // Hapus active dari semua lingkaran
            colorCircles.forEach(c => c.classList.remove('active'));

            // Tambahkan active ke yang diklik
            this.classList.add('active');

            // Update nama warna
            colorName.textContent = this.dataset.name;

            // Update gambar mobil
            carPreview.src = this.dataset.image;
        });
    });
</script>

    </div>
</section>

<style>
    .color-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    max-width: 240px;
}

.color-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #ccc;
    cursor: pointer;
    transition: all 0.3s ease;
}

.color-circle:hover {
    transform: scale(1.1);
    border-color: #00C092;
}

.color-circle.active {
    border-color: #00C092;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

    .color-container {
    display: flex;
    flex-wrap: wrap;          /* otomatis pindah ke baris baru jika penuh */
    justify-content: center;  /* rata tengah */
    gap: 12px;                /* jarak antar lingkaran */
    max-width: 240px;         /* atur lebar maksimal satu “baris” */
}

.color-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #ccc;
    cursor: pointer;
    transition: all 0.3s ease;
}

.color-circle:hover {
    transform: scale(1.1);
    border-color: #00C092;
}

.color-circle.active {
    border-color: #00C092;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Kotak warna */
.car-preview {
    width: 100%;        /* memenuhi lebar kolom */
    max-width: 400px;   /* bisa disesuaikan */
    height: 400px;      /* tinggi tetap sama untuk semua gambar */
    object-fit: cover;  /* memotong gambar agar menyesuaikan kontainer */
    border-radius: 8px; /* opsional agar rapi */
    transition: all 0.3s ease; /* smooth saat berubah */
}


.color-box {
    border: 1px solid #E6E6E6;
}

/* Bulatan warna */
.color-circle {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    border: 2px solid #ddd;
    cursor: pointer;
    transition: 0.2s;
}

.color-circle:hover {
    transform: scale(1.12);
    border-color: #999;
}

/* Responsif Mobil */
.car-preview {
    max-width: 480px;
}

/* Responsif lebih kecil */
@media (max-width: 768px) {
    .color-circle {
        width: 45px;
        height: 45px;
    }

    .car-preview {
        max-width: 100%;
    }
}
</style>

{{-- ----------------------------------------------------------------- --}}
<section class="py-5 container">
    <div class="d-flex align-items-center mb-5">
        <h4 class="fw-bold me-3 mb-0">{{ $product->brand }} Specification</h4>
        <div class="flex-grow-1 line-tech"></div>
    </div>
    <div class="container spec-box">
        <!-- Tabs -->
        @php
            $specSections = $product->specifications->pluck('section')->unique();
        @endphp

        <ul class="nav justify-content-center pb-2 mb-4 tech-nav" id="spec-tabs">
            @foreach($specSections as $index => $section)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" href="#" data-index="{{ $index }}">
                        {{ $section }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="gradient-line my-4 mx-auto"></div>

        <!-- Specification Content -->
        <div class="spec-content">
            @foreach($specSections as $index => $section)
                <div class="spec-list {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                    @foreach($product->specifications->where('section', $section) as $spec)
                        <div class="spec-item">
                            <span class="spec-title">{{ $spec->title }}</span>
                            <span class="spec-value">{{ $spec->value }}</span>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    
<script>
document.addEventListener("DOMContentLoaded", () => {
    const tabs = document.querySelectorAll("#spec-tabs .nav-link");
    const contents = document.querySelectorAll(".spec-list");

    tabs.forEach(tab => {
        tab.addEventListener("click", function(e) {
            e.preventDefault();

            const index = this.getAttribute("data-index");

            // Hapus active dari semua tab
            tabs.forEach(t => t.classList.remove("active"));

            // Hapus active dari semua konten
            contents.forEach(c => c.classList.remove("active"));

            // Tambahkan active hanya ke tab yang diklik
            this.classList.add("active");

            // Tampilkan konten sesuai index tab
            document.querySelector(`.spec-list[data-index="${index}"]`)
                .classList.add("active");
        });
    });
});
</script>


<script>
    const specTabs = document.querySelectorAll('#spec-tabs .nav-link');
const specContents = document.querySelectorAll('.spec-list');

specTabs.forEach(tab => {
    tab.addEventListener('click', function(e) {
        e.preventDefault();

        // Hapus active semua tab
        specTabs.forEach(t => t.classList.remove('active'));
        this.classList.add('active');

        // Tampilkan konten sesuai tab
        const index = this.dataset.index;
        specContents.forEach(content => content.classList.remove('active'));
        document.querySelector(`.spec-list[data-index='${index}']`).classList.add('active');
    });
});

</script>
</section>

<style>
    .spec-list {
    display: none;
}

.spec-list.active {
    display: block;
}

.nav-link.active {
    color: #00C092;
    font-weight: bold;
    border-bottom: 2px solid #00C092;
}

    .spec-box {
    border: 1px solid #E5E5E5;
    border-radius: 16px;
    padding: 35px 40px;
    background: #fff;
}

/* Nav style */
.tech-nav .nav-link {
    color: #444;
    font-weight: 500;
  
}

.tech-nav .nav-link.active {
    color: #007bff;
    font-weight: 600;
}

/* Responsif */
@media (max-width: 768px) {
    .spec-box {
        padding: 20px;
        border-radius: 12px;
    }

    .tech-nav .nav-link {
        padding: 6px 12px;
        font-size: 14px;
    }
}

.spec-list {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.spec-item {
    display: flex;
    justify-content: space-between;
    border-bottom: 1px solid #e9e9e9;
    padding: 10px 0;
}

.spec-title {
    font-weight: 500;
    color: #444;
    font-size: 15px;
}

.spec-value {
    font-weight: 600;
    color: #000;
    text-align: right;
    font-size: 15px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .spec-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .spec-value {
        text-align: left;
        margin-top: 4px;
    }
}

</style>


{{-- 
------------------------------------------------------------------------------------------------ --}}

<section class="credit-section">
    <div class="container text-center py-5">
        <h5 class="credit-title">CREDIT CALCULATOR</h5>
        <p class="powered">Powered by <span>OKKEV FINANCE</span></p>
        <p class="sub-text">
            Our internal loans guarantee flexible financing options at competitive rates.
        </p>
    </div>

    <div class="credit-box">
        <div class="container py-5">
            <h5 class="text-center credit-subtitle">Monthly Installment Budget</h5>
            <h3 class="text-center credit-amount">Rp 3.886.600 / Months</h3>

            <p class="text-center desc-text mt-3">
                Calculate monthly installments that fit your budget by setting the down
                payment and loan period.
            </p>

            <div class="row g-4 mt-4">

                <div class="col-md-6">
                    <label class="credit-label">Car Price</label>
                    <input type="text" class="form-control credit-input" value="Rp 149.000.000">
                </div>

                <div class="col-md-6">
                    <label class="credit-label">Interest Rate</label>
                    <input type="text" class="form-control credit-input" value="10.96 %">
                </div>

                <div class="col-md-6">
                    <label class="credit-label">Loan Amount</label>
                    <input type="text" class="form-control credit-input" value="Rp 160.000.000">
                </div>

                <div class="col-md-6">
                    <label class="credit-label">Loan Period</label>
                    <select class="form-control credit-input">
                        <option>1 Tahun</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="credit-label">First Payment</label>
                    <input type="text" class="form-control credit-input" value="Rp 55.000.000">
                </div>

            </div>

            <div class="mt-4 note-box">
                <p><strong>Important note:</strong> Requirements may vary from bank to bank. This calculation is purely a simulation.</p>
                <p>For cars outside Jakarta, the above calculation is not binding. Additional shipping costs are not included.</p>
                <p>The above calculation applies to a minimum down payment of IDR 10,000,000.</p>
            </div>

        </div>
    </div>
</section>

<style>
    .credit-section {
    background: #ffffff;
}

.credit-title {
    font-weight: 600;
    letter-spacing: 1px;
    margin-bottom: 5px;
}

.powered span {
    color: #37d99e;
    font-weight: 600;
}

.sub-text {
    font-size: 14px;
    color: #777;
    margin-top: 10px;
}

/* BOX BIRU TUA */
.credit-box {
    background: #1b2c47;
    color: white;
}

/* Judul Tengah */
.credit-subtitle {
    font-size: 15px;
    color: #cfd9ea;
    letter-spacing: 0.5px;
}

.credit-amount {
    color: #32e081;
    font-weight: 700;
    margin-top: 5px;
}

.desc-text {
    color: #cbd4e6;
    font-size: 14px;
}

/* Input */
.credit-label {
    font-size: 14px;
    font-weight: 500;
    color: #cfd9ea;
    margin-bottom: 5px;
}

.credit-input {
    height: 45px;
    border-radius: 4px;
    border: none;
    padding-left: 12px;
    font-size: 14px;
}

/* Catatan */
.note-box {
    font-size: 13px;
    color: #cfd4e6;
    margin-top: 20px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .credit-input {
        height: 42px;
        font-size: 13px;
    }

    .credit-amount {
        font-size: 22px;
    }
}

</style>


{{-- ------------------------------------------------------------ --}}

  <section>
        <div class="container mt-5">
            <h4>There are still other options</h4>
            <h6 class="mb-5">if you are not satisfied with the above vehicles.</h6>
            <div class="row">
              @forelse($products as $product)
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="vehicle-card rounded shadow-sm h-100" 
                                style="border: 1px solid #F1F1F1 !important;">

                            <!-- Image -->
                            <div class="vehicle-img-wrapper"
                                style="background: radial-gradient(50% 50% at 50% 50%, #658FC2 0%, #30445C 100%);
                                        border-radius: 4px 4px 0 0;">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                        class="vehicle-img w-100 p-3" 
                                        alt="Vehicle">
                            </div>

                            <!-- Detail -->
                            <div class="card-body p-3 bg-white rounded-bottom">
                                <h6 class="fw-semibold text-dark mb-0">{{ $product->brand }}</h6>
                                <p class="fw-bold text-secondary small mb-1">{{ $product->brand }}</p>

                                <hr class="my-2">

                                <!-- Icons -->
                                <div class="d-flex justify-content-between text-center mb-2">


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/3.png') }}" 
                                             width="22" 
                                             class="mb-1">
                                        <p class="small text-black mb-0">{{ $product->miles }} Miles</p>
                                    </div>
                                    

                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/2.png') }}" 
                                             width="22" 
                                             class="mb-1">
                                        <p class="small text-black mb-0">{{ $product->type }}</p>
                                    </div>


                                    <div class="icon-box flex-fill">
                                        <img src="{{ asset('front_end/assets/images/1.png') }}" 
                                             width="22" 
                                             class="mb-1">
                                        <p class="small text-black mb-0">2 seat</p>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <!-- Price & Detail Link -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <p class="fw-bold text-danger mb-0">
                                        IDR {{ number_format($product->regular_price, 0, ',', '.') }}
                                    </p>


                                    <a href="{{ route('landing.product', ['brandSlug' => Str::slug($product->brand), 'productSlug' => $product->slug]) }}" 
                                       class="text-decoration-none fw-semibold d-flex align-items-center"
                                       style="color:#30445C !important">
                                        Detail
                                        <img src="{{ asset('front_end/assets/images/icon.png') }}" 
                                             width="10" 
                                             class="mb-1 mx-2">
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada produk untuk brand ini.</p>
                @endforelse
            </div>

        </div>
    </section>
@endsection
