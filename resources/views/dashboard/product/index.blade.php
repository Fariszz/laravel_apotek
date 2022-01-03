@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
    </div>
    <div class="pull-right ">
        <a href="{{ route('product.create') }}" class="btn btn-success btn-xs"><i>Tambah Barang</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Pemilik</th>
                    <th>Stok</th>
                    <th>Harga Diskon</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->nama }}</td>
                        <td>Rp {{ $product->harga }}</td>
                        <td>
                            {{ $product->user->name }}
                        </td>
                        <td>{{ $product->stok }}</td>
                        <td>{{ $product->diskon }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-info mb-1">Show</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                {{-- <button type="submit" class="btn btn-sm btn-danger">Delete</button> --}}
                            </form>
                        </td>
                    </tr>
                @endforeach
                    <br>
            </tbody>
            </table>
        </div>
</div>
{{ $products->links() }}
</div>

<script type="text/javascript">

    $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Are you sure you want to delete this record? `,
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
            });
        });
</script>
@endsection
