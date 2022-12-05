@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
@endpush

@section('pageContent')
<!-- Page Content -->
<div class="page-heading customize-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>inside</h4>
                    <h2>your cart</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="post" action="{{ route('cart.add', ['id' => $products->id_product]) }}">
    {{ csrf_field() }}
    <div class="prize-list">
        <div class="main">
            <section class="module">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 mb-sm-40"><a class="gallery" id="thumb_link"
                                href="{{ asset('images/products/' . $image->first()->image ) }}"><img id="thumb_img"
                                    style="width: 640px; height:640px"
                                    src="{{ asset('images/products/' . $image->first()->image ) }}"
                                    alt="Single Product Image" /></a>
                            <ul class="product-gallery">
                                @foreach($image as $row)
                                <li><a class="gallery" href="{{ asset('images/products/' . $row->image ) }}"></a><img
                                        onclick="changeThumb(this)" style="width:60px; height:60px"
                                        src="{{ asset('images/products/' . $row->image ) }}" alt="Single Product" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="product-title font-alt">{{ $products->product_name }}</h1>
                                </div>
                            </div>
                            <div class="row mb-20">
                                <div class="col-sm-12">
                                    <div class="price font-alt"><span class="amount">Rp
                                            {{ number_format($products->product_price, '2', ',', '.') }}</span></div>
                                </div>
                            </div>
                            <div class="row mb-20">
                                <div class="col-sm-12">
                                    <div class="description">
                                        <p>{{ $products->product_desc }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-20">
                                <div class="col-sm-6">
                                    @foreach($detail as $size)
                                    <input type="radio" required="required" id="{{ $size->sizes->product_size }}"
                                        name="product_size" data-id="{{ $size->sizes->id_product_size }}" value="{{ $size->sizes->product_size }}" @if($size->product_stock
                                    == 0) disabled @endif>
                                    <label for="{{ $size->sizes->product_size }}" style="margin-right:10px">{{ $size->sizes->product_size }}</label>
                                    @endforeach
                                    <input type="hidden" id="id_product_size" name="id_product_size" value="tes">
                                </div>
                                <div class="col-sm-6">
                                    <div id="stock">
                                        Available Stock : {{ $stock }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-20">
                                <div class="col-sm-4 mb-sm-20">
                                    <input type="number" id="txtQty" name="txtQty" class="form-control input-lg"
                                        value="1" max="40" min="1" required="required" />
                                </div>
                                <div class="col-sm-8"><button type="submit" class="btn btn-lg btn-block btn-round btn-b"
                                        @auth @else href="{{ route('login') }}" @endauth>Add To Cart</a>
                                </div>
                            </div>
                            {{-- <div class="row mb-20">
                            <div class="col-sm-12">
                                <div class="product_meta">Categories:<a href="#"> Man, </a><a href="#">Clothing, </a><a
                                        href="#">T-shirts</a>
                                </div>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</form>
@endsection

@push('scripts')
{{-- if there is a new scripts for this specific page --}}
<script>
    function changeThumb(id){
    document.getElementById("thumb_link").href = id.src;
    document.getElementById("thumb_img").src = id.src;
}

$(document).ready(function(){
    $('input[type=radio]').click(function(){
        // alert(this.value);
        @foreach($detail as $row)
            if(this.value == '{{ $row->sizes->product_size }}'){
                document.getElementById('stock').innerHTML = "Available Stock : " + {{ $size_stock[$row->id_product_size] }};
                document.getElementById('txtQty').max = {{ $size_stock[$row->id_product_size] }};
                if(document.getElementById('txtQty').value >= {{ $size_stock[$row->id_product_size] }}){
                    document.getElementById('txtQty').value = {{ $size_stock[$row->id_product_size] }};
                }
            }
        @endforeach
        $('input[type="hidden"]#id_product_size').val($(this).data('id'));
        // alert($('#id_product_size').val());
    });
});
</script>
@endpush
