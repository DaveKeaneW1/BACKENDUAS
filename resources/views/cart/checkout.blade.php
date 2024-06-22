@extends('layouts.template')

@section('title')
    Checkout
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('cart.checkout') }}">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->

    <form action="{{ route('cart.checkout_process') }}" method="POST" enctype="multipart/form-data">
      @csrf
        <section class="checkout_area section_gap">
            <div class="container">
                <div class="billing_details">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3>Data Pengguna</h3>
                            <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                                <div class="col-md-12 form-group p_star">
                                    <span>Nama</span>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $order->customer->nama }}" disabled>
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <span>No. HP</span>
                                    <input type="text" class="form-control" id="noHP" name="noHP"
                                        value="{{ $order->customer->noHp }}" disabled>
                                </div>
                                <div class="col-md-12 form-group">
                                    <span>Alamat</span>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Alamat" value="{{ $order->customer->alamat }}">
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <div class="order_box">
                                <h2>Pesanan Kamu #{{ $order->no_order }}</h2>
                                @php
                                    $subtotal = 0;
                                @endphp
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <td colspan="2" style="padding: 5px 0; color: #222222;">PRODUK</td>
                                            <td style="text-align: right; width: 100px; padding: 5px 0; color: #222222;">
                                                TOTAL
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $orderItem)
                                            <tr>
                                                <td style="padding: 5px 0;">{{ $orderItem->product->nama }}</td>
                                                <td style="padding: 5px 0;">X{{ $orderItem->jumlah }}</td>
                                                <td style="padding: 5px 0; text-align: right; width: 150px;">Rp.
                                                    {{ number_format($orderItem->jumlah * $orderItem->harga, 0, '.', '.') }}
                                                </td>
                                            </tr>
                                            @php
                                                $subtotal += $orderItem->jumlah * $orderItem->harga;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                                <ul class="list list_2">
                                    <li><a href="#">Total <span>Rp. {{ number_format($subtotal) }}</span></a></li>
                                    <li>
                                        <a href="#" style="margin-bottom: 10px">Pengiriman
                                            @if ($order->jenis_pengiriman == 2)
                                                <span>Antar ke Rumah</span>
                                            @else
                                                <span>Ambil di Toko</span>
                                            @endif
                                        </a>

                                        @if ($order->jenis_pengiriman == 2)
                                            <div style="margin-bottom: 10px; text-align: center">Admin akan menghubungi anda
                                                untuk pengantaran produk ke rumah</div>
                                        @endif
                                    </li>
                                </ul>

                                <button type="submit" class="primary-btn" style="border: none; width: 100%">Bayar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
    <!--================End Checkout Area =================-->
@endsection
