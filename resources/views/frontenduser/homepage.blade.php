@extends('layouts.user')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h1 class="mb-3 display-3 text-primary">Aplikasi Gooutdoor Gear talk</h1>
                    <h4 class="mb-3 text-secondary">Temukan Alat Outdoor Sesuai Seleramu</h4>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('user/img/hero-img-1.png') }}"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('user/img/hero-img-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-shopping-bag fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Booking Praktis</h5>
                            <p class="mb-0">Booking Tanpa Datang ke Toko</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Keamanan</h5>
                            <p class="mb-0">Keamanan Sistem Aman</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fas fa-exchange-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Pembayaran</h5>
                            <p class="mb-0">Pembayaran fleksibel metode</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7</h5>
                            <p class="mb-0">mendukung transaksi setiap saat</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->


    <!-- Fruits Shop Start-->
    <div class="container-fluid fruite">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start mb-5">
                        <h1>Daftar Toko</h1>
                    </div>

                </div>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">

                                    <div class="row">
                                        @foreach ($users as $user)
                                            @if ($user->type === 'admin')
                                                <div class="col-md-6 col-lg-4 col-xl-4">
                                                    <div class="rounded position-relative fruite-item">
                                                        <div class="fruite-img">
                                                            <img src="{{ $user->foto }}"
                                                                class="img-fluid w-100 rounded-top" alt="">
                                                        </div>
                                                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                                            style="top: 10px; left: 10px;">Tersedia</div>
                                                        <div
                                                            class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                            <h4>{{ $user->name }}</h4>
                                                            <p>{{ $user->alamat }}</p>
                                                            <a href="{{ route('user.produk', ['user_id' => $user->id]) }}"
                                                                class="btn border border-secondary rounded-pill px-3 text-primary">
                                                                <i class="fa fa-shopping-bag me-2 text-primary"></i>Pergi
                                                                Ke Toko
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fruits Shop End-->

    <!-- Banner Section Start-->
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Barang bervariasi dan berkualitas</h1>
                        <p class="fw-normal display-3 text-dark mb-4">ada di Gooutdor</p>
                        <p class="mb-4 text-dark">Pilih Barang Kebutuhan sesuai selera untuk memenuhi aktivitas anda
                            di Outdoor.</p>
                        <a href="#"
                            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">Beli</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="{{ asset('user/img/baner-1.png') }}" class="img-fluid w-100 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                            style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">for</span>
                                <span class="h4 text-muted mb-0"> all</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->


    <!-- Fact Start -->
    <div class="container-fluid py-5  pb-5 mb-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Pelanggan</h4>
                            <h1>63</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-handshake text-secondary"></i>
                            <h4>Mitra Toko</h4>
                            <h1>10</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-shopping-cart text-secondary"></i>
                            <h4>Total Transaksi</h4>
                            <h1>73</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-briefcase text-secondary"></i>
                            <h4>Produk Tersedia</h4>
                            <h1>136</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->
@endsection
