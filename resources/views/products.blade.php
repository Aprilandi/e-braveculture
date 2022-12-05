@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
@endpush

@section('pageContent')

<!-- Page Content -->
<div class="page-heading products-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>new arrivals</h4>
                    <h2>Euro edition</h2>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- using pagination laravel for products to produce pages. --}}
<div class="products">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="left-sidebar">
                    <div class="filters">
                        <ul>
                            <li class="active">Category</li>
                        </ul>
                    </div>
                    <div class="panel-group category-products" id="accordian">
                        <!--category-productsr-->
                        {{-- <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                        Sportswear
                                    </a>
                                </h4>
                            </div>
                            <div id="sportswear" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul>
                                        <li><a href="#">Nike </a></li>
                                        <li><a href="#">Under Armour </a></li>
                                        <li><a href="#">Adidas </a></li>
                                        <li><a href="#">Puma</a></li>
                                        <li><a href="#">ASICS </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div> --}}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{ route('products', ['sex' => $sex]) }}">Semua</a></h4>
                            </div>
                        </div>
                        @foreach($type as $row)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{ route('products', ['sex' => $sex, 'id_tipe' => $row->id_product_type]) }}">{{ $row->product_type_name }}</a></h4>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--/category-products-->

                    {{-- <div class="brands_products">
                        <!--brands_products-->
                        <h2>Brands</h2>
                        <div class="brands-name">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                                <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                                <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                                <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                                <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                                <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                                <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                            </ul>
                        </div>
                    </div> --}}
                    <!--/brands_products-->

                    {{-- <div class="price-range">
                        <!--price-range-->
                        <h2>Price Range</h2>
                        <div class="well text-center">
                            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600"
                                data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
                            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                        </div>
                    </div>
                    <!--/price-range--> --}}

                    {{-- <div class="shipping text-center">
                        <!--shipping-->
                        <img src="images/home/shipping.jpg" alt="" />
                    </div>
                    <!--/shipping--> --}}

                </div>
            </div>
            <div class="col-md-9">

                <div class="row">
                    <div class="col-md-12">
                        <div class="filters">
                            <ul>
                                <li class="active" data-filter="*">All Products</li>
                                <li data-filter=".des">Featured</li>
                                <li data-filter=".dev">Flash Deals</li>
                                <li data-filter=".gra">Limited</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="filters-content">
                            <div class="row grid">
                                <!-- TEMPLATE ITEM -->
                                @foreach ($products as $p)
                                <div class="col-lg-4 col-md-4 all dev">
                                    <div class="product-item">
                                        <div class="thumb-container">
                                            @if($p->images->first())<a
                                                href="{{ route('product.detail', ['id' => $p->id_product]) }}"><img
                                                    src="{{ asset('images/products/'.$p->Images->first()->image ) }}"
                                                    alt=""></a>@endif
                                        </div>
                                        <div class="row down-content justify-content-start product-name">
                                            <div class="row">
                                                <div class="col col-md-10 order-last product-name">
                                                    <a href="{{ route('product.detail', ['id' => $p->id_product]) }}">
                                                        <h4>{{ $p->product_name }}</h4>
                                                    </a>
                                                </div>
                                                <div class="col order-last product-price">
                                                    <h6>Rp {{ number_format($p->product_price, 2, ",", ".") }}</h6>
                                                </div>
                                            </div>
                                            <p>{{ $p->product_desc }}</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-4 col-md-4 all {{ !empty($p->product_edition) ? "gra ":"des " }}">
                                <div class="product-item">
                                    @if($p->images->first())
                                    <a href="#"><img src="{{ asset('images/products/'.$p->Images->first()->image ) }}"
                                            alt=""></a>
                                    @endif
                                    <div class="row justify-content-start product-name">
                                        <div class="col-7">
                                            <a href="#">
                                                <h4>{{ $p->product_name }}</h4>
                                            </a>
                                        </div>
                                        <div class="col-5 product-price">
                                            <h6>Rp {{ number_format($p->product_price, 2, ",", ".") }}</h6>
                                        </div>
                                        <p>{{ $p->product_desc }}</p>
                                    </div>
                                </div> --}}
                                @endforeach
                                <!-- END TEMPLATE ITEM -->
                            </div>
                            {{-- <div class="col-lg-4 col-md-4 all dev">
                            <div class="product-item">
                                <a href="#"><img src="{{ asset('images/products/product_02.jpg') }}" alt=""></a>
                            <div class="down-content">
                                <a href="#">
                                    <h4>Tittle goes here</h4>
                                </a>
                                <h6>$16.75</h6>
                                <p>Lorem ipsume dolor sit amet, adipisicing elite. Itaque, corporis nulla
                                    aspernatur.</p>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <span>Reviews (24)</span>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{ $products->onEachSide(1)->links() }}
                        {{-- <ul class="pages">
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                            </ul> --}}
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
