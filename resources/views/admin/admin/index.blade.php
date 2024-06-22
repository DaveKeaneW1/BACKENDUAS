@extends('layouts.template')

@section('title')
    Admin
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
                        <a href="{{ route('admin.admin') }}">Admin</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!-- Start Sample Area -->
    <section class="sample-text-area" style="padding-top: 60px">
        <div class="container">
            <h3 class="text-heading">Daftar Admin</h3>
            <a href="{{ route('admin.admin.create') }}" class="btn btn-primary mb-3" style="float: right">Tambah Data</a>

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div style="display: flex">
                                    <a href="{{ route('admin.admin.edit', $user->id) }}"
                                        class="btn btn-warning mr-3">Edit</a>
                                    <form action="{{ route('admin.admin.destroy', $user->id) }}" method="POST">
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
