@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    
    {{-- BANNER AREA --}}
    <div class="row mb-5">
        <div class="col-12">
            <div id="mainCarousel" class="carousel slide rounded-xl overflow-hidden shadow-sm" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    
                    <div class="carousel-item active">
                        <div class="main-banner" style="background-image: url('{{ asset('assets/img/slider/building.jpg') }}')"> 
                            
                            <div class="banner-content col-lg-7 col-md-9">
                                <span class="text-warning fw-bold text-uppercase ls-1 mb-2">Access Anywhere</span>
                                <h2 class="banner-title display-4 fw-bolder mb-3">Find The Perfect</h2>
                                <p class="banner-desc mb-4">From meeting rooms to event halls, browse our complete facility catalog and book from any device, anytime..</p>
                                <div>
                                    {{-- <a href="#" class="btn btn-banner btn-lg px-5 rounded-pill shadow-sm">Shop Now</a> --}}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="main-banner" style="background-image: url('{{ asset('assets/img/slider/smart_management.jpg') }}');" background-position: center bottom;">
                            
                            <div class="banner-content col-lg-7 col-md-9">
                                <span class="text-warning fw-bold text-uppercase ls-1 mb-2">Smart Management</span>
                                <h2 class="banner-title display-4 fw-bolder mb-3">Your Schedule</h2>
                                <p class="banner-desc mb-4">Manage all your reservations in one place. View history, reschedule, and get instant confirmation effortlessly.</p>
                            </div>

                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="main-banner" style="background-image: url('{{ asset('assets/img/slider/access_anywhere.jpg') }}'); background-position: center bottom;">
                            
                            <div class="banner-content col-lg-7 col-md-9">
                                <span class="text-warning fw-bold text-uppercase ls-1 mb-2">Effortless & Fast</span>
                                <h2 class="banner-title display-4 fw-bolder mb-3">Streamlined Booking</h2>
                                <p class="banner-desc mb-4">Say goodbye to complicated paperwork. Check real-time availability and secure your spot in seconds.</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- CATEGORY --}}
    <div class="row">
        <div class="col-12">
            <div class="category-header">
                <h4 class="mb-0 fw-bold">Category</h4>
                {{-- <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill">View All Categories &rarr;</a> --}}
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ url('/items?category=vegetables') }}" class="card category-card rounded-xl">
                <div class="category-icon text-success">
                    <i class="fas fa-carrot fa-lg"></i>
                </div>
                <span class="category-title">Vegetables</span>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ url('/items?category=fruits') }}" class="card category-card rounded-xl">
                <div class="category-icon text-warning">
                    <i class="fas fa-lemon fa-lg"></i>
                </div>
                <span class="category-title">Fruits</span>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ url('/items?category=bakery') }}" class="card category-card rounded-xl">
                <div class="category-icon text-primary">
                    <i class="fas fa-bread-slice fa-lg"></i>
                </div>
                <span class="category-title">Breads</span>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ url('/items?category=meat') }}" class="card category-card rounded-xl">
                <div class="category-icon text-danger">
                    <i class="fas fa-drumstick-bite fa-lg"></i>
                </div>
                <span class="category-title">Meat</span>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ url('/items?category=drinks') }}" class="card category-card rounded-xl">
                <div class="category-icon text-info">
                    <i class="fas fa-wine-bottle fa-lg"></i>
                </div>
                <span class="category-title">Drinks</span>
            </a>
        </div>

         <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ url('/items?category=seafood') }}" class="card category-card rounded-xl">
                <div class="category-icon text-dark">
                    <i class="fas fa-fish fa-lg"></i>
                </div>
                <span class="category-title">Seafood</span>
            </a>
        </div>

    </div>
</div>

@endsection

@push('dashboard')
  <script>
    
  </script>
@endpush