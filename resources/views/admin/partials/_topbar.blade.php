<nav>
    <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">{{ $page }}</span>
    </div>
    {{-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search'></i>
    </div> --}}
    <div class="profile-details">
        <!--<img src="images/profile.jpg" alt="">-->
        <span class="admin_name">{{ Auth::user()->name }}</span>
    </div>
</nav>
