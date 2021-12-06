@extends('layouts.dashboard.layout')

@section('content')
<div class="container">
    <div class="pull-right">
        <a href="{{ route('product.index') }}" class="btn btn-warning btn-xs mb-4"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
    </div>

    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->nama }}" height="400" width="500"/></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $product->nama }}</h1>
                    <div class="fs-5 mb-5">
                        <span>Rp {{ number_format($product->harga,2) }}</span>
                        <br>
                        <span>Stok {{ number_format($product->stok,2) }}</span>
                    </div>
                    <p class="lead">{{ $product->description }}</p>
                    <div class="d-flex">
                        <a href="http://wa.me/{{ $product->telfon }}" target="_blank">
                            <button class="btn btn-outline-danger flex-shrink-0" type="button">
                                <i class="bi bi-whatsapp me-1"></i>
                                Order Now
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
