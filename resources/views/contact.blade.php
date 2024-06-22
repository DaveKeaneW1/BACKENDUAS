@extends('layouts.template')

@section('title')
    Contact
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Contact</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('home') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('contact') }}">Contact</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!--================Contact Area =================-->
    <section class="contact_area section_gap_bottom">
        <div class="container">
            <div id="mapBox" class="mapBox" data-lat="-6.164461986509661" data-lon="106.77279495275668" data-zoom="50"
                data-info="PT. Sentra Grafindo Utam" data-mlat="-6.164461986509661"
                data-mlon="106.77279495275668">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>PT. Sentra Grafindo Utama</h6>
                            <p>Jl. Daan Mogot II Gg. Macan No. Kav. 4-5, ShopHouse Centro City Blok CS/03d</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6><a href="#">1162730</a></h6>
                            <p>Senin-Jumat 08:00-16:00</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6><a href="#">sentra.grafindo.utama@gmail.com</a></h6>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
@endsection
