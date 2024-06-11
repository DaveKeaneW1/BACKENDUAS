@extends('layouts.template')

@section('title')
    Product Category
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Products</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('products') }}">Produk</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <div class="container" style="margin-top: 40px; margin-bottom: 80px;">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head">Daftar Kategori</div>
                    <ul class="main-categories">
                        <li class="main-nav-list"><a data-toggle="collapse" href="{{ route('products') }}"
                                aria-expanded="false" aria-controls="meatFish"><span
                                    class="lnr lnr-arrow-right"></span>Semua Kategori<span
                                    class="number">({{ $product_total }})</span></a>
                        </li>
                        @foreach ($category as $cat)
                            <li class="main-nav-list"><a data-toggle="collapse" href="{{ route('products') }}"
                                    aria-expanded="false" aria-controls="meatFish"><span
                                        class="lnr lnr-arrow-right"></span>{{ $cat->category_nama }}<span
                                        class="number">({{ $cat->count }})</span></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting">
                        <select class="form-control">
                            <option value="1">A-Z</option>
                            <option value="1">Z-A</option>
                            <option value="1">Harga Terendah</option>
                            <option value="1">Harga Tertinggi</option>
                        </select>
                    </div>
                    <div class="sorting mr-auto">
                        <select class="form-control">
                            <option value="1">Tampil 12</option>
                            <option value="1">Tampil 36</option>
                            <option value="1">Tampil 54</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="row">
                        @foreach ($product as $prod)
                            <!-- single product -->
                            <div class="col-lg-4 col-md-6">
                                <div class="single-product">
                                    <div
                                        style="width: 254px; height: 272.5px; display: flex;  background: #828bb2; margin-bottom: 20px">
                                        @if ($prod->image)
                                            <img class="img-fluid"
                                                src="data:image/jpeg;base64,{{ stream_get_contents($prod->image) }}"
                                                alt="Product Image"
                                                style="width: 254px; height: 272.5px; object-fit: contain; padding: 0 10px;">
                                        @endif
                                    </div>
                                    <div class="product-details">
                                        <h6>{{ $prod->nama }}</h6>
                                        <div class="price">
                                            <h6>Rp. {{ number_format($prod->harga, 0, '.', '.') }}</h6>
                                        </div>
                                        <div class="prd-bottom">
                                            <a href="" class="social-info">
                                                <span class="ti-bag"></span>
                                                <p class="hover-text">Add to Cart</p>
                                            </a>
                                            <a href="{{ route('product.detail', $prod->id) }}" class="social-info">
                                                <span class="lnr lnr-move"></span>
                                                <p class="hover-text">Lihat Detail</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                <!-- End Best Seller -->
                <!-- Start Filter Bar -->
                <div class="filter-bar d-flex flex-wrap align-items-center">
                    <div class="sorting mr-auto">
                        <select class="form-control">
                            <option value="1">Tampil 12</option>
                            <option value="1">Tampil 36</option>
                            <option value="1">Tampil 54</option>
                        </select>
                    </div>
                    <div class="pagination">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        <a href="#">6</a>
                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right"
                                aria-hidden="true"></i></a>
                    </div>
                </div>
                <!-- End Filter Bar -->
            </div>
        </div>
    </div>
@endsection
