@extends('layouts.template')

@section('title')
    Login Admin
@endsection

@section('content')
    <section class="login_box_area section_gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6" style="margin-left: auto; margin-right: auto">
                    <div class="login_form_inner" style="padding-top: 70px;">
                        <h3>Login Admin</h3>
                        <form class="row login_form" action="{{ route('admin.authenticate') }}" method="POST" id="contactForm"
                            novalidate="novalidate">
                            @csrf
                            <div class="col-md-12 form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" onfocus="this.placeholder = ''"
                                    onblur="this.placeholder = 'Password'">
                            </div>
                            <div class="col-md-12 form-group" style="margin-bottom: 30px">
                                @if ($errors->any())
                                    <div class="alert alert-danger mb-4 mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <button type="submit" value="submit" class="primary-btn">Log In</button>
                            </div>
                        </form>
                        <div class="col-md-12"
                            style="text-align: left; max-width: 385px; margin: auto; margin-bottom: 70px">
                            <a href="{{ route('home') }}">Kembali ke halaman customer</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
