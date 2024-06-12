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
                                <form method="POST" enctype="multipart/form-data" action="{{ route('adminprofile.update') }}">
                                    @csrf
                                    @method('patch')
                                    <div class="mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text"
                                            class="form-control form-control-solid @error('name')
                                        is-invalid @enderror"
                                            name="name" id="name"
                                            value="{{ old('name', auth()->user()->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga">Alamat</label>
                                        <input type="text"
                                            class="form-control form-control-solid  @error('alamat')
                                        is-invalid @enderror"
                                            name="alamat" id="alamat"
                                            value="{{ old('alamat', auth()->user()->alamat) }}">
                                        @error('alamat')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga">Email</label>
                                        <input type="text"
                                            class="form-control form-control-solid  @error('email')
                                        is-invalid @enderror"
                                            name="email" id="email"
                                            value="{{ old('email', auth()->user()->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback"> {{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <div class="input-group">
                                            <input type="file"
                                                class="form-control form-control-solid  @error('foto')
                                            is-invalid @enderror"
                                                name="foto" id="foto" placeholder="Url Image"
                                                value="{{ old('img') }}">
                                            @error('img')
                                                <div class="invalid-feedback"> {{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-icon-split mt-3">
                                        <span class="text">Simpan</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
