@extends('layouts.user_type.auth')

@section('content')
<section class="py-2 bg-gray-100"> 
    <div class="page-header align-items-end min-vh-25 pt-5 pb-4 mx-3 border-radius-lg" 
         style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}'); background-size: cover; background-position: center;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      
      <div class="container z-index-1"> 
        <div class="row">
            <div class="col-lg-6 col-md-8 text-start">
                <h3 class="text-white fw-bold mb-1">{{ $category->name }} Items</h3>
                <p class="text-white opacity-8 text-sm">Discover the best facilities to support your needs</p>
            </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-12">
                
                <div class="bootstrap-tabs product-tabs">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-all" role="tabpanel">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                                
                                @foreach($datas as $data)
                                    <div class="col">
                                        <div class="product-card">
                                            
                                            <a href="#" class="btn-wishlist">
                                                <i class="far fa-heart"></i>
                                            </a>

                                            <div class="product-image-wrapper">
                                                <a href="#">
                                                    <img src="{{ asset($data->image) }}" class="product-image" alt="{{ $data->name }}">
                                                </a>
                                            </div>

                                            <a href="#" class="product-title">{{ $data->name }}</a>
                                            
                                            <div class="product-meta">
                                                <span class="d-block"> Available at</span>
                                                <span class="text-info fw-bold">
                                                    {{ $data->opening_time . ' - ' . $data->closing_time }}
                                                </span>
                                            </div>

                                            <div class="product-footer mt-3">
                                                <a href="#" class="btn-booking">
                                                    Booking Now
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('dashboard')
<script>
    
</script>
@endpush