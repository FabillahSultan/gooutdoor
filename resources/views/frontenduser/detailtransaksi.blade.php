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
        <style>
            .transaction-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                background-color: #f8f8f8;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }
            .transaction-table th, .transaction-table td {
                padding: 15px;
                text-align: center;
                border-bottom: 1px solid #ddd;
            }
            .transaction-table thead {
                background-color: #4CAF50;
                color: white;
            }
            .transaction-table th {
                background-color: #4CAF50;
                color: white;
            }
            .transaction-table tbody tr:hover {
                background-color: #f1f1f1;
            }
            .transaction-table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
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
                    <div class="col-lg-6">
                        <nav class="header__menu">
                            <ul>
                                <li class="active"><a href="./index.html">Home</a></li>
                                <li><a href="{{ route('gettransaksi') }}">Detail Pesanan</a></li>
                                <li><a href="#">Pages</a>
                                    <ul class="header__menu__dropdown">
                                        <li><a href="./shop-details.html">Shop Details</a></li>
                                        <li><a href="./shoping-cart.html">Shopping Cart</a></li>
                                        <li><a href="./checkout.html">Check Out</a></li>
                                        <li><a href="./blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="./contact.html">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-lg-3">
                        <div class="header__cart">
                            <a href="#"><i class="fa fa-user"></i> Login</a>
                        </div>
                    </div>
                </div>
                <div class="humberger__open">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
        </header>
        <!-- Header Section End -->

        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="{{ asset('user/img/breadcrumb.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>Riwayat Transaksi</h2>
                            <div class="breadcrumb__option">
                                <a href="./index.html">Home</a>
                                <span>Riwayat Transaksi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->

        <!-- Transaction History Section Begin -->
        <section class="shoping-cart spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping__cart__table">
                            <table class="transaction-table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        {{-- <th>Alamat</th> --}}
                                        <th>Tanggal</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayatTransaksi as $transaksi)
                                    <tr>
                                        <td>{{ $transaksi->nama }}</td>
                                        {{-- <td>{{ $transaksi->alamat }}</td> --}}
                                        <td>{{ $transaksi->created_at->format('d F Y H:i:s') }}</td>
                                        <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                                        <td>@if($transaksi->status == 0)
                                            <p>Belum diproses</p>
                                            @else
                                            <p>Diproses</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Transaction History Section End -->

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
