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
    <form action="{{ route('products') }}" method="GET">
        <div class="container" style="margin-top: 40px; margin-bottom: 80px;">
            <div class="row">

                <div class="col-xl-3 col-lg-4 col-md-5">
                    <div class="sidebar-categories">
                        <div class="head">Daftar Kategori</div>
                        <ul class="main-categories">
                            <li class="main-nav-list {{ !request()->has('kategori_id') ? 'active' : '' }}">
                                <a href="{{ route('products', array_merge(request()->except(['kategori_id', 'page']), ['kategori_id' => null])) }}"
                                    aria-expanded="false" aria-controls="semuaKategori">
                                    <span class="lnr lnr-arrow-right"></span> Semua Kategori
                                    <span class="number">({{ $product_total }})</span>
                                </a>
                            </li>
                            @foreach ($category as $cat)
                                <li class="main-nav-list {{ request()->has('kategori_id') && request()->kategori_id == $cat->category_id ? 'active' : '' }}">
                                    <a href="{{ route('products', array_merge(request()->except(['kategori_id', 'page']), ['kategori_id' => $cat->category_id])) }}"
                                        aria-expanded="false" aria-controls="kategori{{ $cat->category_id }}">
                                        <span class="lnr lnr-arrow-right"></span> {{ $cat->category_nama }}
                                        <span class="number">({{ $cat->count }})</span>
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
                                <option value="name_asc" {{ request()->input('sort_by') == 'name_asc' ? 'selected' : '' }}>
                                    A-Z</option>
                                <option value="name_desc"
                                    {{ request()->input('sort_by') == 'name_desc' ? 'selected' : '' }}>Z-A</option>
                                <option value="price_asc"
                                    {{ request()->input('sort_by') == 'price_asc' ? 'selected' : '' }}>Harga Terendah
                                </option>
                                <option value="price_desc"
                                    {{ request()->input('sort_by') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi
                                </option>
                            </select>
                        </div>

                        <div class="sorting mr-auto">
                            <select name="items_per_page" class="form-control" onchange="this.form.submit()">
                                <option value="12" {{ request()->input('items_per_page') == '12' ? 'selected' : '' }}>
                                    Tampil 12</option>
                                <option value="36" {{ request()->input('items_per_page') == '36' ? 'selected' : '' }}>
                                    Tampil 36</option>
                                <option value="54" {{ request()->input('items_per_page') == '54' ? 'selected' : '' }}>
                                    Tampil 54</option>
                            </select>
                        </div>

                        <!-- Custom Pagination -->
                        <div class="pagination">
                            @if ($product->onFirstPage())
                                <a href="#" class="prev-arrow disabled"><i class="fa fa-long-arrow-left"
                                        aria-hidden="true"></i></a>
                            @else
                                <a href="{{ $product->appends(request()->query())->previousPageUrl() }}"
                                    class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                            @endif

                            @foreach ($product->getUrlRange(1, $product->lastPage()) as $page => $url)
                                @if ($page == $product->currentPage())
                                    <a href="{{ $product->appends(request()->query())->url($page) }}"
                                        class="active">{{ $page }}</a>
                                @else
                                    <a
                                        href="{{ $product->appends(request()->query())->url($page) }}">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($product->hasMorePages())
                                <a href="{{ $product->appends(request()->query())->nextPageUrl() }}" class="next-arrow"><i
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
                                            <div class="prd-bottom" style="display: flex; align-items: center;">
                                                @if ($prod->stok > 0)
                                                    <a href="{{ route('product.add_to_cart_single', $prod->id) }}"
                                                        class="social-info">
                                                        <span class="ti-bag"></span>
                                                        <p class="hover-text">Add to Cart</p>
                                                    </a>
                                                @else
                                                    <span style="color: red; font-weight: 500; margin-right: 10px">Stok
                                                        Habis</span>
                                                @endif
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
                </div>
            </div>
        </div>
    </form>
@endsection
