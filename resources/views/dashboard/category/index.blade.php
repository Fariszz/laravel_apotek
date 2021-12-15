@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
    </div>
    <div class="pull-right ">
        <a href="{{ route('category.create') }}" class="btn btn-success btn-xs"><i>Tambah Category</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->nama }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            {{-- <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a> --}}
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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
{{ $categories->links() }}
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
