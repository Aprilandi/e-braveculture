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
                <div class="box-topic">Total Transaksi</div>
                <div class="number" id="boxTransaksi"></div>
            </div>
            <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Pemesanan</div>
                <div class="number" id="boxPemesanan"></div>
            </div>
            <i class='bx bxs-cart-add cart two'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Penjualan</div>
                <div class="number" id="boxPenjualan"></div>
            </div>
            <i class='bx bx-cart cart three'></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Total Pendapatan</div>
                <div class="number" id="boxPendapatan"></div>
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
                                            <option class="periodes__select" value="tahun">Pertahun</option>
                                            <option class="periodes__select" value="bulan" selected>Perbulan</option>
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
            <div class="title">Ranking Points Leaderboard</div>
            <ul class="top-sales-details" id="ranking_points">
                {{-- <li>
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
                        <img src="images/shirt.jpg" alt="">
                        <span class="product">Bilack Wear's Shirt</span>
                    </a>
                    <span class="price">$1245</span>
                </li> --}}
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
        getRanking();
        getData();
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
            $('#date').val(today.getFullYear() + "-" + ( today.getMonth() + 1 ));
        }
        getData();
    }
</script>
{{-- Chart Script --}}
<script>

    function getData(){
        var perperiode = $('#txtPerperiode').val();
        var periode = $('input[name="txtPeriode"]').val();
        $.ajax({
            type:'GET',
            url:"{{ route('dataChart') }}",
            data:{perperiode:perperiode, periode:periode},
            dataType: 'json',
            success:function(data){
                console.log(data);
                setChart(data);
                setOverviewBox(data);
            },
            error:function(err){
                console.log(err.responseText);
            }
        });

        // console.log(perperiode + " : " + periode);
    }

    function getRanking(){
        $.ajax({
            type:'GET',
            url:"{{ route('rankingPoint') }}",
            dataType: 'json',
            success:function(data){
                // console.log(data);
                setRanking(data);
            },
            error:function(err){
                console.log(err.responseText);
            }
        });
    }

    function setRanking(listRanking){
        // console.log(listRanking);
        let html = "";
        let avatar = "{{ asset('images/avatar/user') }}";

        listRanking.forEach(element => {
            html += '<li>';
            html += '<a>';
            html += '<img src="' + avatar.replace('user', element.users.avatar) + '" alt="">';
            html += '<span class="product">' + element.users.username + '</span>';
            html += '</a>';
            html += '<span class="price">' + element.redeemable_points + ' Points</span>';
            html += '</li>';
        });

        $('#ranking_points').html(html);
    }

    function setOverviewBox(data){
        let penjualan = 0, pemesanan = 0;
        data.pendapatanPembelian.forEach(element => {
            penjualan += Number(element.pendapatan);
        });
        data.pendapatanPemesanan.forEach(element => {
            pemesanan += Number(element.pendapatan);
        })
        $('#boxTransaksi').html(data.totalTransaksi);
        $('#boxPemesanan').html('Rp ' + intToString(pemesanan));
        $('#boxPenjualan').html('Rp ' + intToString(penjualan));
        $('#boxPendapatan').html('Rp ' + intToString(data.totalPendapatan));
    }

    function intToString(num) {
        num = num.toString().replace(/[^0-9.]/g, '');
        if (num < 1000) {
            return num;
        }
        let si = [
        {v: 1E3, s: "K"},
        {v: 1E6, s: "M"},
        {v: 1E9, s: "B"},
        {v: 1E12, s: "T"},
        {v: 1E15, s: "P"},
        {v: 1E18, s: "E"}
        ];
        let index;
        for (index = si.length - 1; index > 0; index--) {
            if (num >= si[index].v) {
                break;
            }
        }
        return (num / si[index].v).toFixed(2).replace(/\.0+$|(\.[0-9]*[1-9])0+$/, "$1") + si[index].s;
    }

    function setChart(data){
        var ctx2 = document.getElementById("chart-line").getContext("2d");
        let chartStatus = Chart.getChart("chart-line");
        if (chartStatus != undefined) {
            chartStatus.destroy();
        }
        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(115, 111, 78,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(115, 111, 78,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(52, 63, 62,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(52, 63, 62,0)'); //purple colors

        let allLabel = new Array();
        let pemesananLabel = new Array(), penjualanLabel = new Array();
        let pemesananData = new Array(), penjualanData = new Array();

        data.transaksiPembelian.forEach(element => {
            if(element.day === undefined){
                penjualanLabel.push(element.month);
            }
            else{
                penjualanLabel.push(element.day);
            }
        });
        data.transaksiPemesanan.forEach(element => {
            if(element.day === undefined){
                pemesananLabel.push(element.month);
            }
            else{
                pemesananLabel.push(element.day);
            }
        })

        allLabel = [...new Set([...pemesananLabel, ...penjualanLabel])];

        // console.log(data.transaksiPembelian);

        // console.log(allLabel);
        // console.log(penjualanData);
        // console.log(pemesananData);

        for (let index = 0; index < allLabel.length; index++) {
            for (let index2 = 0; index2 < data.transaksiPembelian.length; index2++) {
                if(data.transaksiPembelian[index2].day === undefined){
                    if(allLabel[index] === data.transaksiPembelian[index2].month){
                        penjualanData.push(data.transaksiPembelian[index2].transaksi);
                        break;
                    }
                    else{
                        if(index2 === ( data.transaksiPembelian.length - 1 )){
                            penjualanData.push(0);
                        }
                    }
                }
                else{
                    if(allLabel[index] === data.transaksiPembelian[index2].day){
                        penjualanData.push(data.transaksiPembelian[index2].transaksi);
                        break;
                    }
                    else{
                        if(index2 === ( data.transaksiPembelian.length - 1 )){
                            penjualanData.push(0);
                        }
                    }
                }
            }
            // data.transaksiPembelian.forEach(([element, index2]) => {
            //     if(allLabel[index] === element.day){
            //         penjualanData.push(element.transaksi);
            //     }
            //     else{
            //         if(index2 === ( data.transaksiPembelian.length - 1 )){
            //             penjualanData.push(0);
            //         }
            //     }
            // });
            for (let index2 = 0; index2 < data.transaksiPemesanan.length; index2++) {
                if(data.transaksiPemesanan[index2].day === undefined){
                    if(allLabel[index] === data.transaksiPemesanan[index2].month){
                        pemesananData.push(data.transaksiPemesanan[index2].transaksi);
                        break;
                    }
                    else{
                        if(index2 === ( data.transaksiPemesanan.length - 1 )){
                            pemesananData.push(0);
                        }
                    }
                }
                else{
                    if(allLabel[index] === data.transaksiPemesanan[index2].day){
                        pemesananData.push(data.transaksiPemesanan[index2].transaksi);
                        break;
                    }
                    else{
                        if(index2 === ( data.transaksiPemesanan.length - 1 )){
                            pemesananData.push(0);
                        }
                    }
                }
            }
            // data.transaksiPemesanan.forEach(([element, index2]) => {
            //     if(allLabel[index] === element.day){
            //         pemesananData.push(element.transaksi);
            //     }
            //     else{
            //         if(index2 === ( data.transaksiPemesanan.length - 1 )){
            //             pemesananData.push(0);
            //         }
            //     }
            // });
        }

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: allLabel,
                datasets: [{
                    label: "Penjualan",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#736F4E",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: penjualanData,
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
                    data: pemesananData,
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
