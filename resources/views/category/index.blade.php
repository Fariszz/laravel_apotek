@extends('layouts.landing')

@section('content')
<section class="container-fluid py-5 vh-100">
    <div class="container py-3">
        <div class="d-flex flex-wrap justify-content-around">
            @foreach ($categories as $category)
                <div class="card border-danger mb-3 " style="width: 15rem;">
                    <div class="card-header text-center"><h5 class="fw-bold">{{ $category->nama }}</h5></div>
                    <div class="card-body">
                        <a class="d-flex justify-content-center" href="{{ route('categories.show', $category->slug) }}">
                            <button type="button" class="btn btn-read btn-info">Show Categories</button>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
