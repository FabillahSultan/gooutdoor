@extends('layouts.admin')

@section('contents')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Profile edit nihh</h1>
        <hr class="mb-6">
        <form method="POST" enctype="multipart/form-data" action="{{ route('adminprofile.update') }}">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <label for="name" class="text-base font-semibold">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
                    class="form-control @error('name')
                is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="alamat" class="text-base font-semibold">Alamat</label>
                <input id="alamat" name="alamat" type="text" value="{{ old('alamat', auth()->user()->alamat) }}"
                    class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="text-base font-semibold">Email</label>
                <input id="email" name="email" type="text" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="foto" class="text-base font-semibold">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control" placeholder="Url Gambar">
            </div>
            <div class="mt-8">
                <button type="submit"
                    class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
@endsection
