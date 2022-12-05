<!-- ✅ Load CSS file for jQuery ui  -->
<link
href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"
rel="stylesheet"
/>

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
<link rel="stylesheet" href="{{ asset('css/admin/chart-dashboard.css') }}">
<div class="chart__wrapper">
    <div class="mt-4">
        <div class=" mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <p class="text-sm">
                        <i class="fa fa-arrow-up text-success"></i>
                        <span class="font-weight-bold">Chart Transaksi
                    </p>
                    <div class="time__on__view times__container">
                        <div class="periodes__section">
                           <h1 class="periodes__heading"> Pilih Periode :</h1>
                            <select name="txtPeriode" id="txtPeriode" class="form-control form__periodes" 33333333333333>
                                <option class="periodes__select" value="tahun" selected >Pertahun</option>
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
    <script src="{{ asset('js/chartjs.min.js') }}"></script>
    {{-- DatePicker Script ( Calendar only Years ) --}}
    <script>
        $(document).ready(function(){
            change_periode();
        });

        function setDatepicker(){
            $('#datepicker').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                }
            });
        }

        $(".date-picker-year").focus(function () {
            $(".ui-datepicker-month").hide();
        });
    </script>
    {{-- Periode --}}
    <script>
        $('#txtPeriode').on('change', function(){
            change_periode();
        });

        function change_periode(){
            let html = "";
            if($('#txtPeriode').val() === "bulan"){
                html += '<div class="time__month">';
                html += '<input type="month" class="date__time" id="date">';
                html += '</div>';
            }
            else if($('#txtPeriode').val() === "tahun"){
                html += '<div class="time__years">';
                html += '<input type="text" class="date__years__time" id="datepicker"/>';
                html += '</div>';
            }
            $('#perperiode').html(html);
            if($('#txtPeriode').val() === "tahun"){
                setDatepicker();
            }
        }
    </script>
    {{-- Chart Script --}}
    <script>
        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#cb0c9f",
                borderWidth: 3,
                backgroundColor: gradientStroke1,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            },
            {
                label: "Websites",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#3A416F",
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
    </script>
