@extends('layouts.template')

@section('title')
    Ubah Status Pesanan
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb admin">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Order #{{ $order->no_order }}</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('admin') }}">Data<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.orders') }}">Orders<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.orders.ubah_status', $order->id) }}">Ubah Status Pesanan</a>
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
                <h3 class="text-heading">Ubah Status Pesanan #{{ $order->no_order }}</h3>
                <form action="{{ route('admin.orders.ubah_status_process', $order->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="nama">Nama Customer</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer"
                            value="{{ $order->customer->nama }}" disabled>
                    </div>
                    <div class="mt-2">
                        <label for="nama">Nama Customer</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer"
                            value="{{ $order->customer->nama }}" disabled>
                    </div>
                    <div class="mt-2">
                        <label for="status">Status</label>
                        <div>
                            <select name="status" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($status_pemesanan as $key => $status)
                                    <option value="{{ $key }}"
                                        {{ $order->status == $key ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary">Ubah Status</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Sample Area -->
@endsection
