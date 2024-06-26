@extends('layouts.template')

@section('title')
    Edit Kategori
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb admin">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Category</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('admin') }}">Data<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.category') }}">Category <span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Ubah</a>
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
                <h3 class="text-heading">Edit Kategori</h3>
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            value="{{ $category->nama }}" required>
                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- End Sample Area -->
@endsection
