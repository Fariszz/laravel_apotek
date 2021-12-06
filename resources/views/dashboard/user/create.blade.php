@extends('layouts.dashboard.layout')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Karyawan</h1>
    </div>
    <div class="pull-right">
        <a href="{{ route('users.index') }}" class="btn btn-warning btn-xs mb-4"><i class="glyphicon glyphicon-chevron-left"> Kembali</i></a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama User</label>
                    <input type="text" name="name" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Email User</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required autofocus>
                </div>
                <div class="form-group pull-right mt-2">
                    <input type="submit" name="add" value="Tambah" class="btn btn-success">
                </div>

            </form>
        </div>
</div>


</div>
@endsection
