@extends('layouts.superadmin')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Daftar Toko</h1>
        <div class="d-sm-flex align-items-center justify-content-between">
            <p class="mb-4">Daftar Toko Di {{ Auth::user()->name }} </p>
            @if (Session::has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Toko</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align: middle;">No</th>
                                <th class="text-center" style="vertical-align: middle;">Nama</th>
                                <th class="text-center" style="vertical-align: middle;">Email</th>
                                <th class="text-center" style="vertical-align: middle;">Alamat</th>
                                <th class="text-center" style="vertical-align: middle;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($totaladmin as $user)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $user->name }}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $user->email }}</td>
                                    <td class="text-center" style="vertical-align: middle;">{{ $user->alamat }}</td>
                                    </td>
                                    <td style="align-content: space-around">
                                        <div style="padding: 5%">
                                            <form action="{{ route('superadmin.destroy', $user->id) }}" method="POST"
                                                onsubmit="return confirm('Delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-google btn-block">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center py-4" colspan="5">Tidak Ada Daftar Toko Toko
                                        {{ Auth::user()->name }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
