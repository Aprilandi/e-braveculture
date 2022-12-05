@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
@endpush

@section('pageContent')
<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="banner header-text">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <h4>Best Offer</h4>
                <h2>New Arrivals On Sale</h2>
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">
                <h4>Flash Deals</h4>
                <h2>Get your best products</h2>
            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>Last Minute</h4>
                <h2>Grab last minute deals</h2>
            </div>
        </div>
    </div>
</div>
<!-- Banner Ends Here -->

<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="{{ route('products', ['sex' => 'all']) }}">view all products <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            @for($i = 0; $i < 6; $i++)
            <div class="col-md-4">
                <div class="product-item">
                    @if($product[$i]->images->first())<a href="{{ route('product.detail', ['id' => $product[$i]->id_product]) }}"><img src="{{ asset('images/products/'.$product[$i]->Images->first()->image ) }}" alt=""></a>@endif
                    <div class="down-content">
                        <a href="{{ route('product.detail', ['id' => $product[$i]->id_product]) }}">
                            <h4>{{ $product[$i]->product_name }}</h4>
                        </a>
                        <h6>Rp {{ number_format(is_int($product[$i]->product_price) ? $product[$i]->product_price:0, '2', ',', '.') }}</h6>
                        {{-- <h6>Rp {{ type($product[$i]->product_price) }}</h6> --}}
                        <p>{{ $product[$i]->product_desc }}</p>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>



<div class="call-to-action">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="inner-content">
                    <div class="row">
                        <div class="col-md-8">
                            <h4>Create Your <em>Own</em> Products</h4>
                            <p>Kami juga menerima pemesanan persablonan</p>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ route('customize') }}" class="filled-button">Customize Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- if there is a new scripts for this specific page --}}
@endpush
