@extends('layouts.dashboard.layout')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Barang</h1>
    </div>
    <div class="pull-right">
        <a href="{{ route('product.index') }}" class="btn btn-warning btn-xs mb-4"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form method="post" enctype="multipart/form-data" action="{{ route('product.update', $product->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Barang</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old( 'nama', $product->nama) }}" required autofocus>
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="custom-select mr-sm-2  @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                        @foreach ($categories as $category)
                            @if(old('categori_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->nama }}</option>
                            @endif
                                <option value="{{ $category->id }}" selected>{{ $category->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old( 'harga', $product->harga) }}" required >
                    @error('harga')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="text" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old( 'stok', $product->stok) }}" required >
                    @error('stok')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="telfon">Telephone</label>
                    <input type="number" name="telfon" class="form-control @error('telfon') is-invalid @enderror" placeholder="gunakan 62 tanpa +" value="{{ old( 'telfon', $product->telfon) }}" required >
                    @error('telfon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi Barang</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description"" required>{{ $product->description }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="KTP">Foto Barang</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ $product->image }}">
                    <img src="{{ asset('storage/'.$product->image) }}" height="150px" width="150px">
                    @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group pull-right mt-2">
                    <input type="submit" name="add" value="Update" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
