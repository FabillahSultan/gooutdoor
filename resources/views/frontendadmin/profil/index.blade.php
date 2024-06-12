@extends('layouts.admin2')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">Edit Profil</h1>
        <p class="mb-4">Edit Profil {{ Auth::user()->name }}</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
            </div>
            <div id="solid">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="sbp-preview">
                            <div class="sbp-preview-content">
                                <form method="POST" enctype="multipart/form-data" action="">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control form-control-solid" name="name"
                                            id="nama_produk" value="{{ auth()->user()->name }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control form-control-solid" name="email"
                                            id="email" value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control form-control-solid" name="alamat"
                                            id="alamat" value="{{ auth()->user()->alamat }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <div class="input-group">
                                            <img src="{{ $user->foto }}" alt="Profile Picture" style="width: 200px; height: 200px;">
                                        </div>
                                    </div>
                                    <div class="mb-3" style="padding-right: 90%">
                                        <a href="{{ route('adminprofile.edit')}}" class="btn btn-primary btn-block">Edit</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
