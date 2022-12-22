<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/company/logo-white.png') }}">
    <title>Brave Culture</title>

    {{-- Bootstrap core CSS --}}
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    {{-- TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing --}}
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    {{-- Additional CSS Files --}}
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-sixteen.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.15.3-web/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('dropdown/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('dropdown/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('dropdown/css/style.css') }}">

    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    {{-- <link rel="stylesheet" href="{{ asset('cart/style.css') }}"> --}}

    <link href="{{ asset('eshopper/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('eshopper/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('eshopper/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('eshopper/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    @stack('style')
</head>

<body>

    {{-- ***** Preloader Start ***** --}}
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    {{-- ***** Preloader End ***** --}}

    {{-- Header --}}

    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <h2 style="font-size:20px;"><img src="{{ asset('images/company/logo-white.png') }}" width="53px" height="43px">
                    Brave <em>Culture</em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item @if (!empty($dashboard)) {{ 'active' }} @endif">
                            <a class="nav-link" href="{{ route('dashboard') }}">Home
                                @if (!empty($dashboard))
                                    <span class="sr-only">(current)</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown @if (!empty($products)) {{ 'active' }} @endif">
                            <a class="nav-link dropdown-toggle" id="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Our Products
                                @if (!empty($products))
                                <span class="sr-only">(current)</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('customize') }}">Customize</a></li>
                                <li><a class="dropdown-item" href="{{ route('products', ['sex' => 'Laki-laki']) }}">Male</a></li>
                                <li><a class="dropdown-item" href="{{ route('products', ['sex' => 'Perempuan']) }}">Female</a></li>
                            </ul>
                        </li>
                        {{--  <li class="nav-item @if (!empty($products)) {{ 'active' }} @endif">
                            <a class="nav-link" href="{{ route('products') }}">Our Products
                                @if (!empty($products))
                                    <span class="sr-only">(current)</span>
                                @endif
                            </a>
                        </li>  --}}
                        <li class="nav-item @if (!empty($company)) {{ 'active' }} @endif">
                            <a class="nav-link" href="{{ route('company') }}">About Us
                                @if (!empty($company))
                                    <span class="sr-only">(current)</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item @if (!empty($contact)) {{ 'active' }} @endif">
                            <a class="nav-link" href="{{ route('contact') }}">Contact Us
                                @if (!empty($contact))
                                    <span class="sr-only">(current)</span>
                                @endif
                            </a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <div class="dropdown custom-dropdown">
                                        <a href="#" data-toggle="dropdown" class="d-flex align-items-center dropdown-link text-left"
                                            aria-haspopup="true" aria-expanded="false" data-offset="0, 20">
                                            <div class="profile-pic mr-3">
                                                <img style="position: absolute; top:18px; left:10px; width:32px;height:33px" src="{{ asset('images/avatar/'.Auth::user()->avatar) }}" id="img_fp" alt="Image">
                                                <img style="width:52px;height:55px" src="{{ asset('images/avatar/badge/' . $badge = !empty(Auth::user()->userstatus) ? Auth::user()->userstatus->levels->badge:'Diamond.png' ) }}" id="img_bg" alt="Image">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item">
                                                <div class="row row-cols-2">
                                                    @php($levels = App\Models\Levels::get())
                                                    @if(Auth::user()->id_role == 4 )
                                                    @php($lvl = Auth::user()->userstatus->id_level)
                                                    @php($min_xp = Auth::user()->userstatus->experience_points)
                                                    @foreach($levels as $key => $value)
                                                        @if($value->id_level == $lvl)
                                                            @php($max_lvl = $levels->max('tier_level'))
                                                            @if(Auth::user()->userstatus->levels->tier_level == $max_lvl)
                                                                @php($max_xp = App\Models\Levels::where('id_level', '=', $levels[$key]->id_level)->get()->first()->minimal)
                                                            @else
                                                                @php($max_xp = App\Models\Levels::where('id_level', '=', $levels[( $key + 1 )]->id_level)->get()->first()->minimal)
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    @if($min_xp == 0)
                                                    @php($persentase = 0)
                                                    @else
                                                    @php($persentase = ($min_xp/$max_xp)*100)
                                                    @endif
                                                    {{-- {{ !empty(Auth::user()->userstatus->id_level) ? Auth::user()->userstatus->id_level:'' }} --}}
                                                        <div class="col">Tier : {{ Auth::user()->userstatus->levels->tier_level }}</div>
                                                        @if(Auth::user()->userstatus->levels->tier_level == $max_lvl)
                                                            <div class="col">{{ $min_xp }}</div>
                                                        @else
                                                            <div class="col">{{ $min_xp }} / {{ $max_xp }}</div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="w3-light-grey w3-round-xlarge">
                                                    @if(Auth::user()->id_role == 4 )
                                                        <div class="w3-container w3-blue w3-round-xlarge" style="height:5px;width:{{$persentase}}%"></div>
                                                    @endif
                                                </div>
                                            </a>
                                            <a class="dropdown-item" href="{{ route('quiz', ['user' => Auth::user()->username]) }}"><span class="icon icon-dashboard"></span> Quiz</a>
                                            <a class="dropdown-item" href="{{ route('rewards', [Auth::user()->username]) }}"><span class="icon icon-mail_outline"></span>Rewards</a>
                                            {{-- <a class="dropdown-item" href="#"><span class="icon icon-mail_outline"></span>Inbox <span
                                                class="number">3</span></a> --}}
                                            <a class="dropdown-item" href="{{ route('history.index', ['user' => Auth::user()->username]) }}"><span class="icon icon-people"></span>History</a>
                                            <a class="dropdown-item" href="#"><span class="icon icon-cog"></span>Setting</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('formLogout').submit();"><span class="icon icon-sign-out"></span>Log out</a>
                                        </div>
                                    </div>


                                    {{-- <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                        <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                            <div class=""><img src="{{ asset('images/avatar/'.Auth::user()->avatar) }}" alt="user" class="rounded" width="80"></div>
                                            <div class="ml-2">

                                                <h4 class="mb-0">{{Auth::user()->name}}</h4>

                                                <p class=" mb-0 text-muted">{{Auth::user()->email}}</p>
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{ route('profil/index') }}"><i class="ti-user mr-1 ml-1"></i> My Profile</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet mr-1 ml-1"></i> My Points</a>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email mr-1 ml-1"></i> Inbox</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)"><i class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('formLogout').submit();">
                                            <i class="fa fa-power-off mr-1 ml-1"></i> Logout
                                        </a>
                                    </div> --}}
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown custom-dropdown">
                                        <a class="nav-link" href="{{ route('cart.view', [Auth::user()->username]) }}">
                                        <div class="profile-pic mr-3">
                                            <i class="fas fa-shopping-cart"></i> Cart @if(count((array) session('cart')) > 0)<span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }} </span>@endif
                                        </div>
                                        </a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item @if (!empty($contact)) {{ 'active' }} @endif">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- Page Content --}}
    @yield('pageContent')
    {{-- End of Page --}}

    <!-- Cart Modal -->
    {{-- <div id="Cart" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="CartLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
		        <div class="container"> --}}

                    {{-- <div class="cart-container">
                        <div class="heading cart-heading">
                            <h1 class="cart-h1">
                                <span class="shopper">s</span>hopping Cart
                            </h1>
                            <a href="#" class="visibility-cart transition is-open">X</a>
                        </div>
                        <div class="cart transition is-open">
                            <a href="#" class="btn cart-btn cart-btn-update">Update cart</a>
                            <div class="table table-cart">
                                <div class="layout-inline row cart-row th cart-th products-inline">
                                    <div class="col cart-col cart-col-pro">Product</div>
                                    <div class="col cart-col col-price align-center ">
                                        Price
                                    </div>
                                    <div class="col cart-col cart-col-qty align-center-quantity">QTY</div>
                                    <div class="col cart-col vat-col">VAT</div>
                                    <div class="col cart-col vat-tol">Total</div>
                                    <div class="cart-trash"></div>
                                </div>
                                <div class="layout-inline row cart-row">
                                    <div class="col cart-col cart-col-pro layout-inline">
                                        <img class="cart-img" src="https://43d897265kne3ed0qv2ecjw2-wpengine.netdna-ssl.com/wp-content/uploads/2020/05/21591430_web1_KittenRescue-ADW-200520-kitten_2.jpg" alt="kitten" />
                                        <p class="cart-p">Happy Little Critter</p>
                                    </div>
                                    <div class="col cart-col col-price cart-col-numeric align-center ">
                                        <p class="cart-p">£59.99</p>
                                    </div>
                                    <div class="col cart-col cart-col-qty layout-inline">
                                        <a href="#" class="cart-qty qty-minus">-</a>
                                        <input class="cart-input" type="numeric" value="3" />
                                        <a href="#" class="cart-qty qty-plus">+</a>
                                    </div>
                                    <div class="col cart-col cart-col-vat cart-col-numeric">
                                        <p class="cart-p">£2.95</p>
                                    </div>
                                    <div class="col cart-col cart-col-total cart-col-numeric">
                                        <p class="cart-p"> £182.95</p>
                                    </div>
                                    <div class="cart-trash">
                                        <i class="fas fa-trash-alt"></i>
                                    </div>
                                </div>
                                <div class="tf cart-tf">
                                    <div class="row cart-row layout-inline">
                                        <div class="col cart-col ">
                                            <p class="cart-p">VAT</p>
                                        </div>
                                        <div class="col cart-col col-vat cart-col-numeric"><p class="cart-p">50000</p></div>
                                    </div>
                                    <div class="row cart-row layout-inline">
                                        <div class="col cart-col ">
                                            <p class="cart-p">Shipping</p>
                                        </div>
                                        <div class="col cart-col cart-price cart-col-numeric"><p class="cart-p">50000</p></div>
                                    </div>
                                    <div class="row cart-row layout-inline">
                                        <div class="col cart-col ">
                                            <p class="cart-p">Total</p>
                                        </div>
                                        <div class="col cart-col cart-col-total cart-col-numeric"><p class="cart-p">50000</p></div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn cart-btn cart-btn-update">Update cart</a>
                        </div>
                    </div> --}}
    <!-- End Cart Modal -->



    <footer class="footer__wrapper" style="padding-top:20em; position:sticky">
        <div class="container my-10">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content">
                        <p>Copyright &copy; 2021 Brave Culture

                            - Design: <a rel="nofollow noopener" href="https://templatemo.com"
                                target="_blank">TemplateMo</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- Bootstrap core JavaScript --}}
    <script src="{{ asset('css/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('css/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Additional Scripts --}}
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/owl.js') }}"></script>
    <script src="{{ asset('js/slick.js') }}"></script>
    <script src="{{ asset('js/isotope.js') }}"></script>
    <script src="{{ asset('js/accordions.js') }}"></script>
    <script src="{{ asset('dropdown/js/popper.min.js') }}"></script>
    <script src="{{ asset('dropdown/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dropdown/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('dropdown/js/main.js') }}"></script>
    <script src="{{ asset('cart/script.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweet_alert')

    <form id="formLogout" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
            function clearField(t){                   //declaring the array outside of the
            if(! cleared[t.id]){                      // function makes it static and global
                cleared[t.id] = 1;  // you could use true and false, but that's more typing
                t.value='';         // with more chance of typos
                t.style.color='#fff';
                }
            }
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        });

    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')

</body>

</html>
