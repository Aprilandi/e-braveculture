@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
@endpush

@section('pageContent')

<!-- Page Content -->
<div class="page-heading contact-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>contact us</h4>
                    <h2>let’s get in touch</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="find-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Our Location on Maps</h2>
                </div>
            </div>
            <div class="col-md-8">
                <!-- How to change your own map point
                    1. Go to Google Maps
                    2. Click on your location point
                    3. Click "Share" and choose "Embed map" tab
                    4. Copy only URL and paste it within the src="" field below
                -->
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d416.90581538546746!2d106.84966741857689!3d-6.224263807557675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f38e5630feb5%3A0x98f18d3bcdaefa3a!2sJl.%20Tebet%20Dalam%201%20No.34%2C%20RT.1%2FRW.1%2C%20Tebet%20Bar.%2C%20Kec.%20Tebet%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012810!5e0!3m2!1sid!2sid!4v1622985510603!5m2!1sid!2sid"
                        width="100%" height="330px" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="left-content">
                    <h4>About our office</h4>
                    <p>Alamat perusahaan kita berada di Jl. Tebet Dalam 1 No.34, RT.1/RW.1, Tebet Bar., Kec. Tebet, Kota Jakarta Selatan</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
{{-- if there is a new scripts for this specific page --}}
@endpush
