@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Ogani Template">
        <meta name="keywords" content="Ogani, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Ogani | Template</title>

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="{{ asset('user/css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/font-awesome.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/elegant-icons.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/nice-select.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/jquery-ui.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/owl.carousel.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/slicknav.min.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('user/css/style.css') }}" type="text/css">
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Header Section Begin -->
        <header class="header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="header__logo">
                            <a href="./index.html"><img src="{{ asset('user/img/logo.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        {{-- <div class="header__cart">
                            <a href="#"><i class="fa fa-user"></i> Login</a>
                        </div> --}}
                    </div>
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li class="active"><a href="./index.html">Home</a></li>
                                <li><a href="{{ route('gettransaksi') }}">Detail Pesanan</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="header__menu__dropdown">
                                        <li><a href="./shop-details.html">Shop Details</a></li>
                                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                        <li><a href="./checkout.html">Check Out</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    {{-- <div class="col-lg-3">
                        <div class="header__cart">
                            <a href="#"><i class="fa fa-user"></i> Login</a>
                        </div>
                    </div> --}}
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="hero__item set-bg" data-setbg="{{ asset('user/img/banner.jpg') }}">
                            <div class="hero__text">
                                <h2>Gooutdoor <br />Gear talk</h2>
                                <p>Temukan Alat Outdoor Seleramu</p>
                                <a href="#" class="primary-btn">Booking Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->

        <!-- Hero Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="hero__search">
                            <div class="hero__search__form">
                                <form action="#">
                                    <input type="text" placeholder="search">
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                        </div>
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>All departments</span>
                            </div>
                            <ul>
                                <li><a href="#">Adiwerna</a></li>
                                <li><a href="#">Slawi</a></li>
                                <li><a href="#">Pangkah</a></li>
                                <li><a href="#">talang</a></li>
                                <li><a href="#">Balapulang</a></li>
                                <li><a href="#">Dukuhturi</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-9">
                        @foreach ($users as $user)
                            @if ($user->type === 'admin')
                            <style>
                                .heroproduk__item {
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                }
                            
                                .heroproduk__item .heroes__text {
                                    flex: 1;
                                }
                            
                                .heroproduk__item img {
                                    margin-right: 100px;
                                }
                            
                                @media screen and (max-width: 768px) {
                                    .heroproduk__item {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                    }
                            
                                    .heroproduk__item img {
                                        padding-left: 35px;
                                        padding-right: 20px;
                                        margin-bottom: 4%;
                                       
                                    }
                            
                                    .heroproduk__item .heroes__text h2 {
                                        font-size: 1.5em; /* Sesuaikan ukuran font */
                                    }
                            
                                    .heroproduk__item .heroes__text p {
                                        font-size: 1em; /* Sesuaikan ukuran font */
                                    }
                            
                                    .heroproduk__item .heroes__text a {
                                        display: inline-block;
                                        margin-top: 10px;
                                        padding: 10px 20px;
                                        font-size: 1em;
                                    }
                                }
                            </style>
                            
                            <div class="heroproduk__item set-bg" style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="heroes__text">
                                    @php
                                        $nameParts = str_split($user->name, ceil(strlen($user->name) / 2));
                                    @endphp
                                    <h2>{{ $nameParts[0] }}<br>{{ $nameParts[1] }}</h2>
                                    <p>{{ $user->alamat }}</p>
                                    <a href="{{ route('user.produk', ['user_id' => $user->id]) }}" class="primary-btn">Lihat Toko</a>
                                </div>
                                <div class="heroes__text">
                                    <img src="{{ $user->foto }}" width="300" style="margin-right: 100px;" alt="User Image">
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Section End -->


        <!-- Footer Section Begin -->
        <footer class="footer spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer__about">
                            <div class="footer__about__logo">
                                <a href="./index.html"><img src="{{ asset('user/img/logo.png') }}" alt=""></a>
                            </div>
                            <ul>
                                <li>Address: 60-49 Road 11378 New York</li>
                                <li>Phone: +65 11.188.888</li>
                                <li>Email: hello@colorlib.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 offset-lg-1">
                        <div class="footer__widget">
                            <h6>Useful Links</h6>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">Innovation</a></li>
                                <li><a href="#">Testimonials</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="footer__widget">
                            <h6>Join Our Newsletter Now</h6>
                            <p>Get E-mail updates about our latest shop and special offers.</p>
                            <form action="#">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit" class="site-btn">Subscribe</button>
                            </form>
                            <div class="footer__widget__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Js Plugins -->
        <script src="{{ asset('user/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('user/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('user/js/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('user/js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('user/js/mixitup.min.js') }}"></script>
        <script src="{{ asset('user/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('user/js/main.js') }}"></script>
    </body>

    </html>
@endsection
