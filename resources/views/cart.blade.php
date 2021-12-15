@extends('layouts.landing')

@section('content')

<div class="container vh-100">
    <div class="mt-5 ">
        <div class="d-flex justify-content-between">
            <div class="h3">Total : Rp. {{ number_format($wishlists->sum('harga'), 2) }}</div>
            <form action="{{ route('cart.addToOrder') }}" method="get">
                @csrf
                    <button class="btn btn-warning btn-flat text-dark show_confirm_checkout" type="submit">Checkout</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Quantity</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($wishlists as $wishlist)
                    <tr>
                        <td class="hidden pb-4 md:table-cell">
                            <a href="#">
                                <img src="{{ asset('storage/'. $wishlist->image) }}" class="w-20 rounded" alt="Thumbnail">
                            </a>
                        </td>
                        <td> <p class="mb-2 md:ml-4">{{ $wishlist->nama }}</p></td>
                        <td>
                            <div class="h-10 w-28">
                                <div class="relative flex flex-row w-full h-8">
                                    <form action="{{ route('cart.updateQuantity',$wishlist->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" id="quantity" value="{{ $wishlist->quantity }}" min="0">
                                        <button type="submit"
                                            class="btn btn-success px-2 pb-2 ml-2 bg-blue-500 show_confirm_update">update</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="hidden text-right md:table-cell">
                            <span class="text-sm font-medium lg:text-base">
                                Rp. {{ number_format($wishlist->harga,2) }}
                            </span>
                        </td>
                        <td>
                            <!-- Button trigger modal -->

                            <form action="{{ route('cart.delete', $wishlist->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input name="_method" type="hidden" value="DELETE">
                                {{-- <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button> --}}
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
                                {{-- <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to Delete?');">Delete</button> --}}
                            </form>
                            {{-- <a href="#" class="btn btn-sm btn-danger">Delete</a></td> --}}
                        </td>
                    </tr>
                @endforeach
                    <br>
            </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    $('.show_confirm').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Apakah Anda akan menghapus Product ini? `,
                text: "Apabila anda menghapus product ini,product ini akan hilang dari wihslist.",
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

    $('.show_confirm_checkout').click(function(event) {
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `Apakah Anda akan melakukan Checkout ? `,
                text: "Apabila anda menghapus product ini,product ini akan hilang dari wihslist.",
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

    $('.show_confirm_update').click(function(event) {
            swal({
                title: `Apakah anda akan melakukan Checkout ? `,
                icon: "success",
                showConfirmButton: false,
                timer: 3000
            })
        });
</script>
@endsection
