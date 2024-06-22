@extends('layouts.template')

@section('title')
    Product
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb admin">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('admin') }}">Data<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.product') }}">Product</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Sample Area -->
    <section class="sample-text-area" style="padding-top: 60px">
        <div class="container">
            <h3 class="text-heading">Daftar Produk</h3>
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary mb-3" style="float: right">Tambah Data</a>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th style="width: 150px;">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($product as $prod)
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td style="text-align: center">
                                @if ($prod->image)
                                    <img src="data:image/jpeg;base64,{{ stream_get_contents($prod->image) }}"
                                        alt="Product Image" style="max-width: 150px">
                                @endif
                            </td>
                            <td>{{ $prod->nama }}</td>
                            <td>{{ $prod->category_nama }}</td>
                            <td>{{ $prod->deskripsi }}</td>
                            <td>Rp. {{ number_format($prod->harga, 0, '.', '.') }}</td>
                            <td>{{ $prod->stok }}</td>
                            <td>
                                <div style="display: flex">
                                    <a href="{{ route('admin.product.edit', $prod->id) }}"
                                        class="btn btn-warning mr-3">Edit</a>
                                    <form action="{{ route('admin.product.destroy', $prod->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <!-- End Sample Area -->
@endsection
