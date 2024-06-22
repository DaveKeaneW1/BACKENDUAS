@extends('layouts.template')

@section('title')
    Edit Customer
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb admin">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Customer</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('admin') }}">Data<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.customer') }}">Customer <span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Ubah</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Sample Area -->
    <section class="sample-text-area">
        <div class="container">
            <div class="col-lg-6" style="margin-left: auto; margin-right: auto;">
                <h3 class="text-heading">Edit Customer</h3>
                <form action="{{ route('admin.customer.update', $customer->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $customer->nama }}"
                            required>
                    </div>
                    <div class="mt-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}"
                            required>
                    </div>
                    <div class="mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                    <div class="mt-2">
                        <label for="noHp">No. HP</label>
                        <input type="text" class="form-control" id="noHp" name="noHp" value="{{ $customer->noHp }}"
                            required>
                    </div>
                    <div class="mt-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $customer->alamat }}"
                            required>
                    </div>
                    <div class="mt-5">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4" style="margin-top: -20px">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Sample Area -->
@endsection
