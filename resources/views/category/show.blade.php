@extends('layouts.landing')

@section('content')
<header class="bg-dark hero-image py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-3 fw-bolder">Supraun Product</h1>
            <p class="lead fw-normal text-white-50 mb-0 mt-3">Menyediakan Segala Macam Produk Kesehatan</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
<div class="container px-4 px-lg-5 mt-5">
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        @foreach ($products as $product)
        <div class="col mb-5">
            <div class="card h-100">
                <!-- Product image-->
                <img class="card-img-top" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" />
                <!-- Product details-->
                <div class="card-body p-4">
                    <div class="text-center">
                        <!-- Product name-->
                        <h5 class="fw-bolder">{{ $product->nama }}</h5>
                        <!-- Product price-->
                        Rp {{ number_format($product->harga,2) }}
                    </div>
                </div>
                <!-- Product actions-->
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center"><a class="btn btn-outline-danger mt-auto" href="{{ route('produk.show', $product->id) }}">View Product</a></div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $products->links() }}
</div>
</section>
@endsection
