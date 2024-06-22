@extends('layouts.template')

@section('title')
    Confirmation
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Confirmation</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('cart.confirmation') }}">Confirmation</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Order Details Area =================-->
    <section class="order_details section_gap">
        <div class="container">
            <h3 class="title_confirmation">Terima kasih karena telah memesan produk kami. <br>Silahkan melakukan pembayaran
                ke rekening berikut ini.</h3>

            <div class="row order_d_inner">
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Info Pesanan</h4>
                        <ul class="list">
                            <li><a href="#"><span>No. Pesanan</span> : {{ $order->no_order }}</a></li>
                            <li><a href="#"><span>Tanggal Pemesanan</span> :
                                    {{ \Carbon\Carbon::parse($order->tanggal_pemesanan)->format('d/m/Y H:i:s') }}</a></li>
                            <li><a href="#"><span>Total</span> : {{ number_format($order->total, 0, '.', '.') }}</a>
                            <li><a href="#"><span>Pengiriman</span> :
                                    @if ($order->jenis_pengiriman == 2)
                                        Antar ke Rumah
                                    @else
                                        Ambil di Toko
                                    @endif
                                </a></li>

                            @if ($order->jenis_pengiriman == 2)
                                <li><a href="#"><span>Alamat Pengiriman</span> :
                                        {{ $order->alamat_pengiriman }}</a>
                            @endif

                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Info Pengguna</h4>
                        <ul class="list">
                            <li><a href="#"><span>Nama</span> : {{ $order->customer->nama }}</a></li>
                            <li><a href="#"><span>No. HP</span> : {{ $order->customer->noHp }}</a></li>
                            <li><a href="#"><span>Alamat</span> : {{ $order->customer->alamat }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="details_item">
                        <h4>Info Pembayaran</h4>
                        <ul class="list">
                            <li><a href="#"><span>Nama Penerima</span> : PT. Sentra Grafindo Utama</a></li>
                            <li><a href="#"><span>Nama Rekening</span> : PT. Sentra Grafindo Utama</a></li>
                            <li><a href="#"><span>No. Rekening</span> : 123456789</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div style="text-align: center">Anda dapat melihat status pesanan anda di <a href="{{ route('history') }}"> sini</a></div>
            <div class="order_details_table">
                <h2>Detail Pesanan</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td>
                                        <p>{{ $orderItem->product->nama }}</p>
                                    </td>
                                    <td>
                                        <h5>x {{ $orderItem->jumlah }}</h5>
                                    </td>
                                    <td>
                                        <p>Rp. {{ number_format($orderItem->jumlah * $orderItem->harga, 0, '.', '.') }}</p>
                                    </td>
                                </tr>
                                @php
                                    $subtotal += $orderItem->jumlah * $orderItem->harga;
                                @endphp
                            @endforeach
                            <tr>
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <h5></h5>
                                </td>
                                <td>
                                    <p>Rp. {{ number_format($subtotal) }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--================End Order Details Area =================-->
@endsection
