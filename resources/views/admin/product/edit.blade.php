@extends('layouts.template')

@section('title')
    Edit Produk
@endsection

@section('content')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('admin') }}">Data<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('admin.product') }}">Product <span class="lnr lnr-arrow-right"></span></a>
                        <a href="">Ubah</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <script>
        function fileValidation() {
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Please upload files with extensions .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
            } else {
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = '<div>Foto Produk Baru</div><img src="' + e
                            .target.result +
                            '" style="width: 200px; height: 200px; max-width: 200px; max-height: 200px; object-fit: cover;" />';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>

    <!-- Start Sample Area -->
    <section class="sample-text-area">
        <div class="container">
            <div class="col-lg-6" style="margin-left: auto; margin-right: auto;">
                <h3 class="text-heading">Edit Produk</h3>
                <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div style="text-align: center">
                        <div id='imagePreview' width='100%'></div>
                        <input type="file" name="file" id="file" accept='image/*'
                            onchange='return fileValidation()'>
                    </div>
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required
                            value="{{ $product->nama }}">
                    </div>
                    <div class="mt-2">
                        <label for="kategori">Kategori</label>
                        <div>
                            <select name="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $product->kategori == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $product->deskripsi }}</textarea>
                    </div>
                    <div class="mt-2">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required
                            value="{{ $product->harga }}">
                    </div>
                    <div class="mt-2">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok"
                            value="{{ $product->stok }}">
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
