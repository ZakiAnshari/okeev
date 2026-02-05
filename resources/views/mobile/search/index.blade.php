@extends('layout.mobile.app')
@section('title', 'Search Results')
@section('content')
    <style>
        body {
            padding-top: 25px !important;
        }
    </style>

    <div class="mobile-header">
        <div class="container header-container">
            <a href="{{ route('mobile.home') }}" class="back-btn-img">
                <img src="{{ asset('front_end/assets/images/logo/mobile/Vector.png') }}" alt="Back" class="back-icon">
            </a>
            <div class="mobile-header-title">Search Results</div>
        </div>
    </div>

    <br>

    <div class="container py-3">
        <!-- Search Box -->
        <form action="{{ route('search.index') }}" method="GET" class="mb-4">
            <div class="search-wrapper mb-3">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="q" class="search-bar" placeholder="Search Vehicle / Electronic" value="{{ $query }}">
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <button type="button" class="filter-toggle-btn" data-bs-toggle="collapse" data-bs-target="#filterPanel">
                    <i class="bi bi-funnel"></i> Filter
                </button>

                <div class="collapse" id="filterPanel">
                    <div class="filter-panel p-3 mt-3 border rounded">
                        <!-- Category Filter -->
                        <div class="filter-group mb-3">
                            <label class="fw-bold mb-2">Category</label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="">All Categories</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $category == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name_category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="filter-group mb-3">
                            <label class="fw-bold mb-2">Price Range (IDR)</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" name="price_min" class="form-control form-control-sm" placeholder="Min" value="{{ $priceMin }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="price_max" class="form-control form-control-sm" placeholder="Max" value="{{ $priceMax }}">
                                </div>
                            </div>
                        </div>

                        <!-- Sort -->
                        <div class="filter-group mb-3">
                            <label class="fw-bold mb-2">Sort By</label>
                            <select name="sort" class="form-select form-select-sm">
                                <option value="latest" {{ $sortBy === 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="price_low" {{ $sortBy === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high" {{ $sortBy === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-sm">Apply Filter</button>
                        <a href="{{ route('search.index') }}" class="btn btn-outline-secondary w-100 btn-sm mt-2">Clear Filter</a>
                    </div>
                </div>
            </div>
        </form>

        <!-- Results Info -->
        <div class="results-info mb-3">
            <p class="text-muted small">
                @if ($results->count() > 0)
                    Found <strong>{{ $results->total() }}</strong> results
                    @if (!empty($query))
                        for "<strong>{{ $query }}</strong>"
                    @endif
                @else
                    No results found
                    @if (!empty($query))
                        for "<strong>{{ $query }}</strong>"
                    @endif
                @endif
            </p>
        </div>

        <!-- Results Grid -->
        @if ($results->count() > 0)
            <div class="row g-3">
                @foreach ($results as $product)
                    <div class="col-12">
                        <a href="{{ route('vehiclecard.product', $product->slug) }}" class="vehicle-card h-100" style="text-decoration: none; color: inherit;">
                            <div class="vehicle-img" style="height: 210px; overflow: hidden; border-radius: 8px;">
                                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="w-100 h-100" alt="{{ $product->model_name }}" style="object-fit: cover;">
                            </div>

                            <div class="vehicle-info p-2">
                                <h6 class="mb-1 fw-bold small">{{ $product->brand->name_brand ?? 'Unknown' }}</h6>
                                <p class="text-truncate small mb-2">{{ $product->model_name }}</p>

                                <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
                                    <span class="vehicle-price fw-bold text-danger">
                                        IDR {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($results->hasPages())
                <div class="pagination-wrapper mt-5 mb-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-center">
                            @if ($results->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $results->previousPageUrl() }}">Previous</a>
                                </li>
                            @endif

                            @foreach ($results->getUrlRange(1, $results->lastPage()) as $page => $url)
                                @if ($page == $results->currentPage())
                                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach

                            @if ($results->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $results->nextPageUrl() }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div style="font-size: 64px; margin-bottom: 16px; color: #ddd;">
                    <i class="bi bi-search"></i>
                </div>
                <h5 class="text-muted">No Products Found</h5>
                <p class="text-muted small">Try adjusting your search or filter criteria</p>
                <a href="{{ route('mobile.home') }}" class="btn btn-primary btn-sm mt-3">Back to Home</a>
            </div>
        @endif
    </div>

    <style>
        .filter-toggle-btn {
            background: #f0f0f0;
            border: 1px solid #ddd;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            width: 100%;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .filter-toggle-btn:hover {
            background: #e8e8e8;
        }

        .filter-panel {
            background: #f9f9f9;
        }

        .filter-group label {
            font-size: 12px;
            color: #333;
        }

        .vehicle-card {
            transition: transform 0.2s;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }

        .vehicle-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .search-wrapper-form {
            margin: 0;
        }

        /* Custom Gradient Button */
        .btn-primary {
            background: linear-gradient(135deg, #00DAD7 0%, #006BE5 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #00b8b5 0%, #0052b8 100%);
            border: none;
        }

        .btn-primary:focus,
        .btn-primary:active {
            background: linear-gradient(135deg, #00b8b5 0%, #0052b8 100%) !important;
            border: none;
            box-shadow: none;
        }
    </style>

    @include('sweetalert::alert')
@endsection
