@extends('layouts.landing')

@section('content')

<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jenis User</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                @foreach ($cartItems as $items)
                <tr>
                                <td class="hidden pb-4 md:table-cell">
                                    <a href="#">
                                        <img src="{{ $items->attributes->image }}" class="w-20 rounded" alt="Thumbnail">
                                    </a>
                                </td>
                                <td> <p class="mb-2 md:ml-4">{{ $items->nama }}</p></td>
                                <td>
                                    <div class="h-10 w-28">
                                        <div class="relative flex flex-row w-full h-8">
                                            <form action="{{ route('cart.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $items->id}}">
                                                <input type="number" name="stok" value="{{ $items->stok }}"
                                                    class="w-6 text-center bg-gray-300" />
                                                <button type="submit"
                                                    class="px-2 pb-2 ml-2 text-white bg-blue-500">update</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden text-right md:table-cell">
                                    <span class="text-sm font-medium lg:text-base">

                                        ${{ $items->harga }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->

                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $items->id }}" name="id">
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
@endsection
