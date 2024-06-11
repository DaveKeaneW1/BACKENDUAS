@extends('layouts.template')

@section('title')
    Detail Produk
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Detail Produk</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('products') }}">Produk</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Single Product Area =================-->
    <div class="product_image_area" style="margin-bottom: 100px">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="">
                        <div class="single-prd-item"
                            style="background: #e1e7f0;
                        width: 540px;
                        height: 580px;
                        margin: auto;
                        margin-top: auto;
                        display: flex;">
                            @if ($product->image)
                                <img class="img-fluid"
                                    src="data:image/jpeg;base64,{{ stream_get_contents($product->image) }}"
                                    alt="Product Image"
                                    style="padding: 80px;
                                    margin: auto;
                                    object-fit: contain;">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <form method="POST" action="{{ route('product.add_to_cart') }}">
                        @csrf
                        <div class="s_product_text">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <h3>{{ $product->nama }}</h3>
                            <h2>Rp. {{ number_format($product->harga, 0, '.', '.') }}</h2>
                            <ul class="list">
                                <li><a class="active" href="#"><span>Category</span> :
                                        {{ $product->category_nama }}</a>
                                </li>
                                <li><a href="#"><span>Stok</span> : {{ $product->stok }}</a></li>
                            </ul>
                            <p>{{ $product->deskripsi }}</p>
                            <div class="product_count">
                                <label for="qty">Quantity:</label>
                                <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                    title="Quantity:" class="input-text qty">
                                <button
                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                    class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                                <button
                                    onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                    class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                            </div>
                            <div class="card_area d-flex align-items-center">
                                <button type="submit" class="primary-btn" style="border: none">
                                    Add to Cart</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
@endsection
