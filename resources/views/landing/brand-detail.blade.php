@extends('layout.user')
@section('title', 'Home')
@section('content')


<h2>{{ $brand->name_brand }}</h2>

<div class="row mt-4">
    @foreach($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top">
                <div class="card-body">
                    <h5>{{ $product->model_name }}</h5>
                    <p>Rp {{ number_format($product->regular_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
