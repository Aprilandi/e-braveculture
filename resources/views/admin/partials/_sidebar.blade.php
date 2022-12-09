<div class="sidebar">
    <div class="logo-details">
        <a href="{{ route('dashboard') }}">
            <i class='bx'><img src="{{ asset('images/company/logo-white.png') }}" width="53px" height="43px"></i>
            <span class="logo_name">Brave Culture</span>
        </a>
    </div>
    <ul class="nav-links">
        {{-- dashboard --}}
        <li>
            <a href="{{ route('admin') }}"
            @if(!empty($dashboard))
            class="active"
            @endif>
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
        </li>
        {{-- gamification --}}
        @if(Auth::user()->role->role == "Admin")
        <li>
            <a href="#">
                <i class='bx bx-dice-4' ></i>
                <span class="links_name">Gamification</span>
            </a>
        </li>
        {{-- <li class="has-submenu">
            <a href="#">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Gamification</span>
            </a>
            <ul class="submenu collapse"> --}}
                <li style="margin-left: 10px">
                    <a href="{{ route('level.index') }}"
                    @if(!empty($levels))
                    class="active"
                    @endif>
                        <i class='bx bx-medal'></i>
                        <span class="links_name">Badge & Level</span>
                    </a>
                </li>
                <li style="margin-left: 10px">
                    <a href="{{ route('reward.index') }}"
                    @if(!empty($rewards))
                    class="active"
                    @endif>
                        <i class='bx bxs-gift' ></i>
                        <span class="links_name">Rewards</span>
                    </a>
                </li>
                <li style="margin-left: 10px">
                    <a href="{{ route('point.index') }}"
                    @if(!empty($points))
                    class="active"
                    @endif>
                        <i class='bx bxs-badge-dollar'></i>
                        <span class="links_name">Points</span>
                    </a>
                </li>
                <li style="margin-left: 10px">
                    <a href="{{ route('quiz.index') }}"
                    @if(!empty($quiz))
                    class="active"
                    @endif>
                        <i class='bx bx-question-mark'></i>
                        <span class="links_name">Quiz</span>
                    </a>
                </li>
            {{-- </ul>
        </ul> --}}
        @endif
        {{-- produk --}}
        @if(Auth::user()->role->role == "Toko" || Auth::user()->role->role == "Admin")
        <li>
            <a href="#">
                <i class='bx bx-store'></i>
                <span class="links_name">Produk</span>
            </a>
        </li>
        @endif
        {{-- <li class="has-submenu">
            <a href="#">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Gamification</span>
            </a>
            <ul class="submenu collapse"> --}}
                @if(Auth::user()->role->role == "Toko")
                <li style="margin-left: 10px">
                    <a href="{{ route('produk.index') }}"
                    @if(!empty($produk))
                    class="active"
                    @endif>
                        <i class='bx bx-closet' ></i>
                        <span class="links_name">List Produk Jual</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role->role == "Admin")
                <li style="margin-left: 10px">
                    <a href="{{ route('sablon.index') }}"
                    @if(!empty($sablon))
                    class="active"
                    @endif>
                        <i class='bx bxs-t-shirt'></i>
                        <span class="links_name">List Bahan Sablon</span>
                    </a>
                </li>
                @endif
            {{-- </ul>
        </ul> --}}
        {{-- transaksi --}}
        <li>
            <a href="#">
                <i class='bx bx-cart'></i>
                <span class="links_name">Transaksi</span>
            </a>
        </li>
        {{-- <li class="has-submenu">
            <a href="#">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Gamification</span>
            </a>
            <ul class="submenu collapse"> --}}
                @if(Auth::user()->role->role == "Toko" || Auth::user()->role->role == "Owner")
                <li style="margin-left: 10px">
                    <a href="{{ route('penjualan.index') }}"
                    @if(!empty($penjualan))
                    class="active"
                    @endif>
                        <i class='bx bx-purchase-tag-alt'></i>
                        <span class="links_name">Penjualan</span>
                    </a>
                </li>
                @endif
                @if(Auth::user()->role->role == "Admin" || Auth::user()->role->role == "Owner")
                <li style="margin-left: 10px">
                    <a href="{{ route('pemesanan.index') }}"
                    @if(!empty($pemesanan))
                    class="active"
                    @endif>
                        <i class='bx bxs-purchase-tag-alt' ></i>
                        <span class="links_name">Pemesanan</span>
                    </a>
                </li>
                @endif
            {{-- </ul>
        </ul> --}}
        <div class="lout_out__wrapper">
            @if(Auth::user()->role->role == "Admin")
            <li class="user__logout log_out">
                <a href="{{ route('user.index') }}"
                @if(!empty($users))
                    class="active"
                @endif>
                <i class='bx bx-log-out'></i>
                    <span class="links_name">Account</span>
                </a>
            </li>
            @endif
            <li class="log_out">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('formLogout').submit();">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </div>
    </ul>
</div>
