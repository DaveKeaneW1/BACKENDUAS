@extends('layouts.template')

@section('title')
    Home
@endsection

@section('content')
    <!-- start banner Area -->
    <section class="banner-area">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-start">
                <div class="col-lg-12" style="margin-top: 20px;">
                    <div class="active-banner-slider owl-carousel">
                        <!-- single-slide -->
                        <div class="row single-slide align-items-center d-flex">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Selamat <br>Datang!</h1>
                                    <p>PT. Sentra Grafindo Utama adalah perusahaan yg menyediakan bahan baku percetakan yang
                                        terletak di Jakarta Barat. <br /> Ingin membeli bahan baku percetakan dengan
                                        pelayanan yang baik dan harga yang terjangkau? Silahkan beli di online store kami.
                                    </p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cart"
                                                style="transform: none; font-size: 25px; margin-top: 12px"></span></a>
                                        <span class="add-text text-uppercase">Ayo Belanja</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="img/image1.png" alt=""
                                        style="width: 70%; object-fit: contain; margin-left: auto;">
                                </div>
                            </div>
                        </div>
                        <!-- single-slide -->
                        <div class="row single-slide">
                            <div class="col-lg-5 col-md-6">
                                <div class="banner-content">
                                    <h1>Selamat <br>Datang!</h1>
                                    <p>PT. Sentra Grafindo Utama adalah perusahaan yg menyediakan bahan baku percetakan yang
                                        terletak di Jakarta Barat. <br /> Ingin membeli bahan baku percetakan dengan
                                        pelayanan yang baik dan harga yang terjangkau? Silahkan beli di online store kami.
                                    </p>
                                    <div class="add-bag d-flex align-items-center">
                                        <a class="add-btn" href=""><span class="lnr lnr-cart"
                                                style="transform: none; font-size: 25px; margin-top: 12px"></span></a>
                                        <span class="add-text text-uppercase">Ayo Belanja</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="banner-img">
                                    <img class="img-fluid" src="img/image1.png" alt=""
                                        style="width: 70%; object-fit: contain; margin-left: auto;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->

    <!-- start features Area -->
    <section class="features-area section_gap">
        <div class="container">
            <div class="row features-inner">
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon2.png" alt="">
                        </div>
                        <h6>Produk Beragam</h6>
                        <p>Menyediakan produk-produk dengan ukuran, bahan yang beragam</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon1.png" alt="">
                        </div>
                        <h6>Pengantaran</h6>
                        <p>Diantar ke rumah atau ambil ke toko</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon3.png" alt="">
                        </div>
                        <h6>Customer Service</h6>
                        <p>Melayani customer melalui chat langsung, email atau telepon</p>
                    </div>
                </div>
                <!-- single features -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-features">
                        <div class="f-icon">
                            <img src="img/features/f-icon4.png" alt="">
                        </div>
                        <h6>Pembayaran</h6>
                        <p>Pembayaran yang aman dan nyaman melalui sistem pembayaran online.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end features Area -->


    <!-- start product Area -->
    <section class="owl-carousel active-product-area section_gap">
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Produk Terbaru</h1>
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: center">
                    @foreach ($product_terbaru as $prod)
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                @if ($prod->image)
                                    <img class="img-fluid"
                                        src="data:image/jpeg;base64,{{ stream_get_contents($prod->image) }}"
                                        alt="Product Image"
                                        style="width: 210px; height: 240px; object-fit: contain; padding: 0 10px; background: #e1e7f0">
                                @endif

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
            </div>
        </div>
        <!-- single product slide -->
        <div class="single-product-slider">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <div class="section-title">
                            <h1>Produk Terlaku</h1>
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: center">
                    @foreach ($product_terlaku as $prod)
                        <!-- single product -->
                        <div class="col-lg-3 col-md-6">
                            <div class="single-product">
                                @if ($prod->image)
                                    <img class="img-fluid"
                                        src="data:image/jpeg;base64,{{ stream_get_contents($prod->image) }}"
                                        alt="Product Image"
                                        style="width: 210px; height: 240px; object-fit: contain; padding: 0 10px; background: #e1e7f0">
                                @endif

                                <div class="product-details">
                                    <h6>{{ $prod->nama }}</h6>
                                    <div class="price">
                                        <h6>Rp. {{ number_format($prod->harga, 0, '.', '.') }}</h6>
                                    </div>
                                    <div class="prd-bottom">

                                        <a href="{{ route('product.add_to_cart_single') }}" class="social-info">
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
            </div>
        </div>
    </section>
    <!-- end product Area -->
@endsection
