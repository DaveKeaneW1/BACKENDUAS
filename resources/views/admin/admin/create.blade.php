@extends('layouts.template')

@section('title')
    Tambah Admin
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb admin">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Admin</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('admin') }}">Data<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.admin') }}">Admin <span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.admin.create') }}">Tambah</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Sample Area -->
    <section class="sample-text-area">
        <div class="container">
            <div class="col-lg-6" style="margin-left: auto; margin-right: auto;">
                <h3 class="text-heading">Tambah Admin</h3>
                <form action="{{ route('admin.admin.store') }}" method="POST">
                    @csrf
                    <div>
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mt-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mt-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mt-5">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4" style="margin-top: -20px">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Sample Area -->
@endsection
