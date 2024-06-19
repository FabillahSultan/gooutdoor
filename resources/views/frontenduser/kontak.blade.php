@extends('layouts.user')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Kontak</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active text-white">Kontak</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="text-center mx-auto" style="max-width: 700px;">
                            <h1 class="text-primary">Alamat Gooutdoor</h1>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="h-100 rounded">
                            <iframe class="rounded w-100" style="height: 400px;"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3681.162329218474!2d109.10243232634853!3d-6.938651198094358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb950452d89c1%3A0xa91f6d00975d85c2!2sPagiyanten%2C%20Kec.%20Adiwerna%2C%20Kabupaten%20Tegal%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1718542462531!5m2!1sid!2sid"
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <input type="text" name="name" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Your Name" required>
                            <input type="email" name="email" class="w-100 form-control border-0 py-3 mb-4"
                                placeholder="Enter Your Email" required>
                            <textarea name="message" class="w-100 form-control border-0 mb-4" rows="5" cols="10"
                                placeholder="Your Message" required></textarea>
                            <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary"
                                type="submit">Submit</button>
                        </form>
                    </div>
                    <div class="col-lg-5">
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Alamat</h4>
                                <p class="mb-2">Jalan raya Pagiyanten no.30</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded mb-4 bg-white">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Email</h4>
                                <p class="mb-2">Gooutdoor@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex p-4 rounded bg-white">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4>Telepon</h4>
                                <p class="mb-2">(+62) 859 7161 1505</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
