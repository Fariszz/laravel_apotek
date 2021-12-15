@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payment Check</h1>
    </div>

    <div class="pull-right">
        <a href="{{ route('payment.check') }}" class="btn btn-warning btn-xs mb-4"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nama Pengirim</th>
                    <th>Bank Asal</th>
                    <th>Bank Tujuan</th>
                    <th>Image</th>
                    </tr>
                </thead>
            <tbody>
                    @foreach ($paymentcheck as $check)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $check->nama }}</td>
                            <td>{{ $check->bankasal }}</td>
                            <td>{{ $check->banktujuan  }}</td>
                            <td>
                                <img src="{{ asset('/storage/'.$check->image) }}" class="w-20 rounded" width="auto" height="100px">
                            </td>
                        </tr>
                    @endforeach
                    <br>
            </tbody>
            </table>
        </div>
    </div>
{{ $paymentcheck->links() }}
</div>

@endsection
