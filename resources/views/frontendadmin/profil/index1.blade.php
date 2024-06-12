@extends('layouts.admin')

@section('contents')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Profile</h1>
        <hr class="mb-6">
        <form method="POST" enctype="multipart/form-data" action="">
            @csrf
            <div class="mb-4">
                <label for="name" class="text-base font-semibold">Name</label>
                <input id="name" name="name" type="text" value="{{ auth()->user()->name }}" readonly class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="email" class="text-base font-semibold">Email</label>
                <input id="email" name="email" type="text" value="{{ auth()->user()->email }}" readonly class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="alamat" class="text-base font-semibold">Alamat</label>
                <input id="alamat" name="alamat" type="text" value="{{ auth()->user()->alamat }}" readonly class="w-full px-3 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="foto" class="text-base font-semibold">Foto</label>
                <img src="{{ $user->foto }}" alt="Profile Picture" class="w-24 h-24 rounded-full">
            </div>
            <div class="mt-8">
                    <a href="{{ route('adminprofile.edit')}}" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600">Edit</a>
            </div>
        </form>
    </div>
@endsection
