@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">History Pembelian</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Total</th>
                    <th>Upload Pembayaran</th>
                    </tr>
                </thead>
            <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->user->name }}</td>
                            <td>Rp. {{ number_format($user->total,2)  }}</td>
                            <td>
                                @if ($user->status == 1)
                                <span class="badge bg-success text-white">Terbayar</span>
                                @else
                                <a href="{{ route('payment.createpayment', $user->id) }}" class="btn btn-success btn-xs"><i>Upload Bukti Pembayaran</i></a></td>
                                
                                @endif
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
