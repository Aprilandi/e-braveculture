@extends('admin.admin')
@push('style')
{{-- aditional style --}}
<link rel="stylesheet" href="{{ asset('css/admin/chart-dashboard.css') }}">
<!-- ✅ Load CSS file for jQuery ui  -->
<link
href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"
rel="stylesheet"
/>

@endpush

@section('content')

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Order</div>
                <div class="number">40,876</div>
                <div class="indicator">
                    <i class='bx bx-up-arrow-alt'></i>
                    <span class="text">Up from yesterday</span>
                </div>
            </div>
            <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Sales</div>
                <div class="number">38,876</div>
                <div class="indicator">
                    <i class='bx bx-up-arrow-alt'></i>
                    <span class="text">Up from yesterday</span>
                </div>
            </div>
            <i class='bx bxs-cart-add cart two'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Profit</div>
                <div class="number">$12,876</div>
                <div class="indicator">
                    <i class='bx bx-up-arrow-alt'></i>
                    <span class="text">Up from yesterday</span>
                </div>
            </div>
            <i class='bx bx-cart cart three'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Return</div>
                <div class="number">11,086</div>
                <div class="indicator">
                    <i class='bx bx-down-arrow-alt down'></i>
                    <span class="text">Down From Today</span>
                </div>
            </div>
            <i class='bx bxs-cart-download cart four'></i>
        </div>
    </div>

    <div class="sales-boxes">
        <div class="recent-sales box">
            {{-- Chart --}}
            <div class="chart__wrapper">
                <div class="mt-4">
                    <div class=" mb-lg-0">
                        <div class="card z-index-2">
                            <div class="card-header pb-0">
                                <p class="text-sm">
                                    <i class="fa fa-arrow-up text-success"></i>
                                    <span class="font-weight-bold title__head">Chart Transaksi
                                </p>
                                <div class="time__on__view times__container">
                                    <div class="periodes__section">
                                        <h1 class="periodes__heading"> Pilih Periode :</h1>
                                        <select name="txtPerperiode" id="txtPerperiode" class="form-control form__periodes">
                                            <option class="periodes__select" value="tahun" selected>Pertahun</option>
                                            <option class="periodes__select" value="bulan">Perbulan</option>
                                        </select>
                                        <div id="perperiode">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart">
                                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-sales box">
            <div class="title">Top Seling Product</div>
            <ul class="top-sales-details">
                <li>
                    <a href="#">
                        <!--<img src="images/sunglasses.jpg" alt="">-->
                        <span class="product">Vuitton Sunglasses</span>
                    </a>
                    <span class="price">$1107</span>
                </li>
                <li>
                    <a href="#">
                        <!--<img src="images/jeans.jpg" alt="">-->
                        <span class="product">Hourglass Jeans </span>
                    </a>
                    <span class="price">$1567</span>
                </li>
                <li>
                    <a href="#">
                        <!-- <img src="images/nike.jpg" alt="">-->
                        <span class="product">Nike Sport Shoe</span>
                    </a>
                    <span class="price">$1234</span>
                </li>
                <li>
                    <a href="#">
                        <!--<img src="images/scarves.jpg" alt="">-->
                        <span class="product">Hermes Silk Scarves.</span>
                    </a>
                    <span class="price">$2312</span>
                </li>
                <li>
                    <a href="#">
                        <!--<img src="images/blueBag.jpg" alt="">-->
                        <span class="product">Succi Ladies Bag</span>
                    </a>
                    <span class="price">$1456</span>
                </li>
                <li>
                    <a href="#">
                        <!--<img src="images/bag.jpg" alt="">-->
                        <span class="product">Gucci Womens's Bags</span>
                    </a>
                    <span class="price">$2345</span>
                <li>
                    <a href="#">
                        <!--<img src="images/addidas.jpg" alt="">-->
                        <span class="product">Addidas Running Shoe</span>
                    </a>
                    <span class="price">$2345</span>
                </li>
                <li>
                    <a href="#">
                        <!--<img src="images/shirt.jpg" alt="">-->
                        <span class="product">Bilack Wear's Shirt</span>
                    </a>
                    <span class="price">$1245</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script src="{{ asset('js/chartjs.min.js') }}"></script>
{{-- DatePicker Script ( Calendar only Years ) --}}
<script>
    let today = new Date();
    $(document).ready(function(){
        change_periode();
        setChart();
    });

    function setDatepicker(){
        $('#datepicker').datepicker({
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            onClose: function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, 1));
                getData();
            }
        });
        $('#datepicker').val(today.getFullYear());
    }

    $(".date-picker-year").focus(function () {
        $(".ui-datepicker-month").hide();
    });
</script>
{{-- Periode --}}
<script>
    $('#txtPerperiode').on('change', function(){
        change_periode();
    });

    function change_periode(){
        let html = "";
        if($('#txtPerperiode').val() === "bulan"){
            html += '<div class="time__month">';
            html += '<input type="month" class="date__time" id="date" name="txtPeriode" onchange="getData()">';
            html += '</div>';
        }
        else if($('#txtPerperiode').val() === "tahun"){
            html += '<div class="time__years">';
            html += '<input type="text" class="date__years__time" id="datepicker" name="txtPeriode" readonly/>';
            html += '</div>';
        }
        $('#perperiode').html(html);
        if($('#txtPerperiode').val() === "tahun"){
            setDatepicker();
        }
        else if($('#txtPerperiode').val() === "bulan"){
            $('#date').val(today.getFullYear() + "-" + today.getMonth());
        }
    }
</script>
{{-- Chart Script --}}
<script>

    function getData(){
        var perperiode = $('#txtPerperiode').val();
        var periode = $('input[name="txtPeriode"]').val();
        console.log(perperiode + " : " + periode);
    }

    function setChart(pembelian, pemesanan){
        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(115, 111, 78,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(115, 111, 78,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(52, 63, 62,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(52, 63, 62,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Pembelian",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#736F4E",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                },
                {
                    label: "Pemesanan",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#343f3e",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    }
</script>

{{-- aditional JS --}}
<!-- ✅ load jQuery ✅ -->
<script
src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
crossorigin="anonymous"
></script>

<!-- ✅ load jquery UI ✅ -->
<script
src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
crossorigin="anonymous"
referrerpolicy="no-referrer"
></script>

@endpush
