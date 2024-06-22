@extends('layouts.template')

@section('title')
    Registration
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Registration</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" style="margin-left: auto; margin-right: auto">
                    <div class="login_form_inner" style="padding-top: 70px;">
                        <h3>Registration</h3>
                        <form class="row login_form" action="{{ route('authentication.create_account') }}" method="POST"
                            id="contactForm" novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="noHp" name="noHp"
                                    placeholder="No. HP" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'No. HP'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="alamat" name="alamat"
                                    placeholder="Alamat" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Alamat'">
                            </div>
                            <div class="col-md-12 form-group" style="margin-bottom: 70px">
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4 mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <button type="submit" value="submit" class="primary-btn">Create Account</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
