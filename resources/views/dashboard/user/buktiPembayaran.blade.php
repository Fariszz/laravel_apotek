@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Bukti Pembayaran</h1>
    </div>
    <div class="pull-right">
        <a href="{{ route('payment.history') }}" class="btn btn-warning btn-xs mb-4"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="{{ route('payment.uploadpayment') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="orderdetail_id", value="{{ $orderdetail->id }}">
                <div class="form-group">
                    <label for="nama">Nama Pengirim</label>
                    <input type="text" name="nama" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="bankasal">Bank Asal</label>
                    <input type="text" name="bankasal" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="banktujuan">Bank Tujuan</label>
                    <input type="Text" name="banktujuan" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="image">Bukti Struk</label>
                    <input type="file" name="image" class="form-control" required autofocus>
                </div>
                <div class="form-group pull-right mt-2">
                    <input type="submit" name="add" value="Tambah" class="btn btn-success">
                </div>

            </form>
        </div>
</div>


</div>
@endsection
