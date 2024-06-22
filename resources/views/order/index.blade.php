@extends('layouts.template')

@section('title')
    Riwayat Pemesanan
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Riwayat Pemesanan</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('history') }}">Riwayat Pemesanan</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <form action="{{ route('history') }}" method="GET">
        <div class="container" style="margin-top: 40px; margin-bottom: 80px;">
            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Daftar Pemesanan</div>
                        <ul class="main-categories">
                            @php
                                $selected_status = 0;

                                if (request()->input('status')) {
                                    $selected_status = request()->input('status');
                                }
                            @endphp

                            <li class="main-nav-list {{ !request()->has('status') ? 'active' : '' }}">
                                <a href="{{ route('history', array_merge(request()->except(['status', 'page']), ['status' => null])) }}"
                                    aria-expanded="false" aria-controls="semuaKategori">
                                    <span class="lnr lnr-arrow-right"></span> Semua Pemesanan
                                    <span class="number">({{ $orders_total }}) </span>
                                </a>
                            </li>
                            @foreach ($status_pemesanan as $key => $status)
                                <li
                                    class="main-nav-list {{ request()->has('status') && request()->status == $key ? 'active' : '' }}">
                                    <a href="{{ route('history', array_merge(request()->except(['status', 'page']), ['status' => $key])) }}"
                                        aria-expanded="false" aria-controls="status{{ $key }}">
                                        <span class="lnr lnr-arrow-right"></span> {{ $status }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7">
                    <!-- Start Filter Bar -->
                    <div class="filter-bar d-flex flex-wrap align-items-center">
                        <!-- Sorting -->
                        <div class="sorting">
                            <select name="sort_by" class="form-control" onchange="this.form.submit()">
                                <option value="tanggal_terakhir"
                                    {{ request()->input('sort_by') == 'tanggal_terakhir' ? 'selected' : '' }}>
                                    Tanggal Terakhir</option>
                                <option value="tanggal_terawal"
                                    {{ request()->input('sort_by') == 'tanggal_terawal' ? 'selected' : '' }}>Tanggal
                                    Terawal
                                </option>
                                <option value="price_asc"
                                    {{ request()->input('sort_by') == 'price_asc' ? 'selected' : '' }}>Harga Terendah
                                </option>
                                <option value="price_desc"
                                    {{ request()->input('sort_by') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi
                                </option>
                            </select>
                        </div>
                        
                        <div class="sorting">
                            <select name="items_per_page" class="form-control" onchange="this.form.submit()">
                                <option value="10" {{ request()->input('items_per_page') == '12' ? 'selected' : '' }}>
                                    Tampil 10</option>
                                <option value="25" {{ request()->input('items_per_page') == '36' ? 'selected' : '' }}>
                                    Tampil 25</option>
                                <option value="50" {{ request()->input('items_per_page') == '54' ? 'selected' : '' }}>
                                    Tampil 50</option>
                            </select>
                        </div>

                        <!-- Search (Right-aligned) -->
                        <div class="sorting mr-auto" style="width: 230px">
                            <input type="text" class="form-control" id="cari" name="cari"
                                placeholder="cari no pesanan" onblur="this.form.submit()"
                                value={{ request()->input('cari') ?? '' }}>
                        </div>

                        <!-- Custom Pagination -->
                        <div class="pagination">
                            @if ($orders->onFirstPage())
                                <a href="#" class="prev-arrow disabled"><i class="fa fa-long-arrow-left"
                                        aria-hidden="true"></i></a>
                            @else
                                <a href="{{ $orders->appends(request()->query())->previousPageUrl() }}"
                                    class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                            @endif

                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                @if ($page == $orders->currentPage())
                                    <a href="{{ $orders->appends(request()->query())->url($page) }}"
                                        class="active">{{ $page }}</a>
                                @else
                                    <a
                                        href="{{ $orders->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->appends(request()->query())->nextPageUrl() }}" class="next-arrow"><i
                                        class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            @else
                                <a href="#" class="next-arrow disabled"><i class="fa fa-long-arrow-right"
                                        aria-hidden="true"></i></a>
                            @endif
                        </div>
                        <!-- End Custom Pagination -->
                    </div>
                    <!-- End Filter Bar -->

                    <!-- Start Best Seller -->
                    <section class="lattest-product-area pb-40 category-list">
                        <div class="row">
                            <table class="table table-hover table-bordered" style="margin-top: 30px">
                                <thead>
                                    <tr>
                                        <th>No Pemesanan</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Total Pesanan</th>
                                        <th>Jenis Pengiriman</th>
                                        <th>Status</th>
                                        <th style="width: 150px;">Detail</th>
                                    </tr>
                                </thead>

                                @foreach ($orders as $order)
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->no_order }}</td>
                                            <td>{{ \Carbon\Carbon::parse($order->tanggal_pemesanan)->format('d/m/Y H:i:s') }}
                                            </td>
                                            <td>Rp. {{ number_format($order->total, 0, '.', '.') }}</td>
                                            <td>
                                                @if ($order->jenis_pengiriman == 2)
                                                    Antar ke Rumah
                                                @else
                                                    Ambil di Toko
                                                @endif
                                            </td>
                                            <td>
                                                {{ $status_pemesanan[$order->status] ?? '' }}
                                            </td>
                                            <td> <a href="{{ route('orders.detail', $order->id) }}"
                                                    class="btn btn-info mr-3">Detail</a></td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </section>
                    <!-- End Best Seller -->
                </div>
            </div>
        </div>
    </form>
@endsection
