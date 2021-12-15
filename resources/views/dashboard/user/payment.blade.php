@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data User Checkout</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Check</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
            <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->user->name }}</td>
                            <td>{{ $user->user->email }}</td>
                            <td>Rp. {{ number_format($user->total,2)  }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                {{-- <a href="#" class="btn btn-sm btn-danger">Delete</a></td> --}}
                                @if ($user->status == 1)
                                    <span class="badge bg-success text-white">Terbayar</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Terbayar</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('payment.showUser',$user->id) }}" class="btn btn-primary">Lihat</a>
                            </td>
                            <td>
                                @if ($user->status != 1)
                                    <form action="{{ route('payment.change',$user->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-warning text-dark">Change</button>
                                    </form>
                                @endif()
                            </td>
                        </tr>
                    @endforeach
                    <br>
            </tbody>
            </table>
        </div>
    </div>
{{ $users->links() }}
</div>

@endsection
