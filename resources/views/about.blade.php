@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
@endpush

@section('pageContent')

<!-- Page Content -->
<div class="page-heading about-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>about us</h4>
                    <h2>our company</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="best-features about-features">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Our Background</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="right-image">
                    <img src="{{ asset('images/company/toko.png') }}" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="left-content">
                    <h4>Who we are &amp; What we do?</h4>
                    <p>Kami merupakan perusahaan yang bergerak dalam bidang busana, kami menjual baju yang tidak hanya sekedar baju tapi sesuatu yang dapat meningkatkan rasa kepercayaan diri anda sehingga anda dapat tampil secara penuh kepercayaan diri dan lebih berani.
                        <br><br>Kami juga menerima pemesanan persablonan sesuai permintaan anda.
                    </p>
                    <ul class="social-icons">
                        <li><a href="https://www.instagram.com/braveculture_id/"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="http://wa.me/+6287773678883"><i class="fa fa-whatsapp"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="team-members">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Visi Misi</h2>
                </div>
            </div>
            <div class="col-md-12">
                <h3>
                    Visi
                </h3>
                <h4 class="section-heading">
                    Memberikan busana yang meningkatkan rasa kepercayaan diri.
                </h4>
                <h3>
                    Misi
                </h3>
                <h4>
                    Membuat dan mendesain pakaian yang memungkinkan Anda menjadi diri Anda, tanpa malu-malu, tanpa hambatan, dan tidak dapat disangkal.
                </h4>
                <h4 class="section-heading">
                    Memberikan produk berkualitas dengan harga kompetitif
                </h4>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{-- if there is a new scripts for this specific page --}}
@endpush
