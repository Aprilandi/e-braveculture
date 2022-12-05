@extends('admin.admin')
@push('style')
{{-- aditional style --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style>

</style>
@endpush

@section('content')

<div class="home-content">
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Modal Tambah -->
            <div id="tambahPoint" name="tambahPoint" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahPointLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="tambahPointLabel"><b>Tambah Data Point</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('point.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtPoint">Perolehan Bonus Point</label><br>
                                    <input type="number" class="form-control" id="txtPoint" name="txtPoint" max="100"
                                        placeholder="Masukkan persentase point yang diperoleh dari total pembelian">%
                                </div>
                                <div class="form-group">
                                    <label for="txtMin">Minimal Total Harga Pembelian Untuk Mendapatkan Bonus Point</label><br>
                                    <input type="number" class="form-control" id="txtMin" name="txtMin"
                                        placeholder="Masukkan minimal total pembelian untuk mendapatkan bonus point tersebut">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Modal Edit -->
            <div id="editPoint" name="editPoint" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editPointLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPointLabel"><b>Edit Data Point</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedPoint">Perolehan Bonus Point</label><br>
                                    <input type="number" class="form-control" id="txtedPoint" name="txtedPoint" max="100"
                                        placeholder="Masukkan persentase point yang diperoleh dari total pembelian">%
                                </div>
                                <div class="form-group">
                                    <label for="txtedMin">Minimal Total Harga Pembelian Untuk Mendapatkan Bonus Point</label><br>
                                    <input type="number" class="form-control" id="txtedMin" name="txtedMin"
                                        placeholder="Masukkan minimal total pembelian untuk mendapatkan bonus point tersebut">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <h4 class="card-title" style="display:inline-block;">Data Points</h4>
                        <div class="card-title float-right mb-12" id="sumbutton">
                            <button type="button" class="btn btn-secondary mb-6" id="btneditsum" name="btneditsum" onclick="editsum()">
                                <i class="fa fa-gears"></i>
                                 Edit Total Harga
                            </button>
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahPoint" id="tambah" name="tambah">
                                <i class="fa fa-plus"></i>
                                 Tambah Data
                            </button>
                        </div>

                        {{-- <a href="{{ route('barang.create') }}" class="btn btn-danger float-right mb-3"
                            style="margin-right:15px">
                            <i class="fa fas fa-file-pdf"></i>
                            Cetak PDF
                        </a> --}}
                        <div class="clearfix"></div>
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="basic-datatables" class="table table-striped border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Persentase Point</th>
                                        <th>Range Total Harga</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($number = 1)
                                    @foreach($point as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->point) ? $row->point:0 }}%</td>
                                        <td id="sum-{{ $row->id_point }}">Rp {{ $min = !empty($row->min_sum_total) ? number_format($row->min_sum_total, 2, ',', '.'):0 }}@if($loop->last == true) < @else - Rp {{ $x = (!empty($point[( $loop->index + 1 )]->min_sum_total) ? number_format(($point[( $loop->index + 1 )]->min_sum_total - 1), 2, ',', '.'):0 )}} @endif</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" id="edit" href="{{ route('point.update',  $row->id_point) }}" data-sum="{{ $row->min_sum_total }}" data-point="{{ $row->point }}" data-min="@if($loop->first) 0 @else {{ $point[$x = ($loop->index - 1)]->min_sum_total }} @endif" @if($loop->last != true) data-max="{{ $point[$x = ($loop->index + 1)]->min_sum_total }}" @endif><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('point.destroy', $row->id_point) }}"
                                                class="btn btn-danger  btn-sm" id="delete"
                                                data-no="{{ $number }}">
                                                <i class="fa fa-trash"> </i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                    $number++;
                                    ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="post" id="deleteForm">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
<form id="sumForm" action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <input type="text" id="data" name="data" hidden>
</form>
@endsection

@push('scripts')

{{-- aditional JS --}}

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
var html = [];

$('button#tambah').on('click', function() {

});

function editsum() {
    document.getElementById('sumbutton').innerHTML = '<button type="button" class="btn btn-danger mb-4" id="btncancelsum" name="btncancelsum" onclick="cancelsum()"><i class="fas fa-times"></i> Cancel</button>' + '&nbsp' + '<button type="button" class="btn btn-success mb-4" id="btnsavesum" name="btnsavesum" onclick="savesum()"><i class="fas fa-save"></i> Simpan</button>' + '&nbsp' + '<button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#tambahPoint" id="tambah" name="tambah"><i class="fa fa-plus"></i>Tambah Data</button>';
    showrangesum();
}

function cancelsum() {
    document.getElementById('sumbutton').innerHTML = '<button type="button" class="btn btn-secondary mb-6" id="btneditsum" name="btneditsum" onclick="editsum()"><i class="fa fa-gears"></i> Edit Harga</button>' + '&nbsp' + '<button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahPoint" id="tambah" name="tambah"><i class="fa fa-plus"></i> Tambah Data</button>';
    cancelrangesum();
}

function savesum() {
    var sum = {};

    $("input[class=rangesumminimal]").each(function() {

        var id = $(this).attr("title");
        var minimal = $(this).val()

        sum[id] = minimal;
    });

    $('#data').val(JSON.stringify(sum));
    $('#sumForm').attr('action', '{{ route("simpanharga") }}');
    $('#sumForm').submit();

}

$('button#edit').on('click', function() {
    // alert('tes');
    var sum = $(this).data("sum");
    var point = $(this).data("point");
    var min = $(this).data("min");
    var max = $(this).data("max");
    if(max === undefined) { max = "" };
    var href = $(this).attr('href');
    $('#txtedPoint').val(point);
    $('#txtedMin').val(sum);
    $('#txtedMin').attr('min', min);
    $('#txtedMin').attr('max', max);
    $('#updateForm').attr('action', href);
    $("#editPoint").modal('show');
});

$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var no = $(this).data('no');
    Swal.fire({
            title: "Anda yakin untuk menghapus data nomer : \"" + no + "\"?",
            text: "Setelah dihapus, data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, hapus'
        })
        .then((willDelete) => {
            if (willDelete.value) {
                $('#deleteForm').attr('action', href);
                $('#deleteForm').submit();
            }
        })
});

    function sumarray() {
        @foreach($point as $row)
            html[{{ $loop->index }}] = '<p>' + '<label for="rangesum-{{ $row->id_point }}">Point {{ $row->point }}:</label>&nbsp' +
                    '<input type="number" class="rangesumminimal" id="rangesum-{{ $row->id_point }}" title="{{ $row->id_point }}" style="border:0; color:#f6931f; font-weight:bold; width:8%;" @if($loop->last != true) readonly @else step="1000" onchange="slidervalue(this.value, this.title)" @endif> @if($loop->last != true) - <input type="text" class="rangesummaksimal" id="rangesum-{{ $row->id_point }}" style="border:0; color:#f6931f; font-weight:bold; width:8%;" readonly> @endif' +
                    @if($loop->first) '<div id="slider-range-min"></div>' @elseif($loop->last) '<div id="slider-range-max"></div>' @else '<div id="slider-range-{{ $row->id_point }}"></div>' @endif +
                    '</p>';
        @endforeach
    }

    function showrangesum() {
        sumarray();
        @foreach($point as $row)
            document.getElementById('sum-{{ $row->id_point }}').innerHTML = html[{{ $loop->index }}];
        @endforeach
        slidervalue();
    }

    function cancelrangesum(){
        @foreach($point as $row)
            document.getElementById('sum-{{ $row->id_point }}').innerHTML = "Rp {{ $min = !empty($row->min_sum_total) ? number_format($row->min_sum_total, 0, ',', '.'):0 }}@if($loop->last == true) {{ "<" }} @else - Rp {{ $x = (!empty($point[( $loop->index + 1 )]->min_sum_total) ? number_format(( $point[( $loop->index + 1 )]->min_sum_total - 1 ), 0, ',', '.'):0 ) }} @endif";
        @endforeach
    }

    function slidervalue(a, b){
        let max;
        let val;
        if(a !== undefined){
            max = parseInt(a) + 500;
            val = parseInt(a);
        }
        else{
            max = {{ $summax }} + 500;
            val = {{ $summax }}
        }
        // alert(max);
        @foreach($point as $row)
            @if($loop->index == ( count($point) - 2 ))
                if(a !== undefined){
                    $( function() {
                        $( "#slider-range-@if($loop->first){{'min'}}@elseif($loop->last){{'max'}}@else{{ $row->id_point }}@endif" ).slider({
                            range: @if($loop->first) "min" @elseif($loop->last) "max" @else true @endif,
                            min: 0,
                            max: max,
                            step: 1000,
                            @if($loop->first == true || $loop->last == true) value @else values @endif: @if($loop->first) {{ $x = $point[$loop->index + 1]->min_sum_total}} @elseif($loop->last) val @else [ {{ $row->min_sum_total }}, val ] @endif,

                            slide: function( event, ui ) {
                                console.log(ui.value);
                                refresh();
                                @if($loop->first)
                                    $("#slider-range-{{ $point[1]->id_point }}").slider('values', 0, ( ui.value + 1 ) );
                                @elseif($loop->last)
                                    $("#slider-range-{{ $point[( count($point) - 2 )]->id_point }}").slider('values', 1, ( ui.value - 1 ) );
                                @else
                                    if(ui.handleIndex == 0){
                                        if({{$loop->index}} == 1){
                                            $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
                                        }
                                        $("#slider-range-{{ $point[( $loop->index - 1 )]->id_point }}").slider('values', 1, ( ui.value - 1 ) );
                                    }
                                    if(ui.handleIndex == 1){
                                        if({{$loop->index}} == {{ $x = count($point) - 2 }}){
                                            $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
                                        }
                                        $("#slider-range-{{ $point[( $loop->index + 1 )]->id_point }}").slider('values', 0, ( ui.value + 1 ) );
                                    }
                                @endif
                            }
                        });
                        refresh();
                    } );
                }
                else{
                    $( function() {
                        $( "#slider-range-@if($loop->first){{'min'}}@elseif($loop->last){{'max'}}@else{{ $row->id_point }}@endif" ).slider({
                            range: @if($loop->first) "min" @elseif($loop->last) "max" @else true @endif,
                            min: 0,
                            max: max,
                            step: 1000,
                            @if($loop->first == true || $loop->last == true) value @else values @endif: @if($loop->first) {{ $x = $point[$loop->index + 1]->min_sum_total}} @elseif($loop->last) val @else [ {{ $row->min_sum_total }}, {{ $x = $point[( $loop->index + 1 )]->min_sum_total }} ] @endif,

                            slide: function( event, ui ) {
                                console.log(ui.value);
                                refresh();
                                @if($loop->first)
                                    $("#slider-range-{{ $point[1]->id_point }}").slider('values', 0, ( ui.value + 1 ) );
                                @elseif($loop->last)
                                    $("#slider-range-{{ $point[( count($point) - 2 )]->id_point }}").slider('values', 1, ( ui.value - 1 ) );
                                @else
                                    if(ui.handleIndex == 0){
                                        if({{$loop->index}} == 1){
                                            $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
                                        }
                                        $("#slider-range-{{ $point[( $loop->index - 1 )]->id_point }}").slider('values', 1, ( ui.value - 1 ) );
                                    }
                                    if(ui.handleIndex == 1){
                                        if({{$loop->index}} == {{ $x = count($point) - 2 }}){
                                            $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
                                        }
                                        $("#slider-range-{{ $point[( $loop->index + 1 )]->id_point }}").slider('values', 0, ( ui.value + 1 ) );
                                    }
                                @endif
                            }
                        });
                        refresh();
                    } );
                }
            @else
                $( function() {
                    $( "#slider-range-@if($loop->first){{'min'}}@elseif($loop->last){{'max'}}@else{{ $row->id_point }}@endif" ).slider({
                        range: @if($loop->first) "min" @elseif($loop->last) "max" @else true @endif,
                        min: 0,
                        max: max,
                        step: 1000,
                        @if($loop->first == true || $loop->last == true) value @else values @endif: @if($loop->first) {{ $x = $point[$loop->index + 1]->min_sum_total}} @elseif($loop->last) val @else [ {{ $row->min_sum_total }}, {{ $x = $point[( $loop->index + 1 )]->min_sum_total }} ] @endif,

                        slide: function( event, ui ) {
                            console.log(ui.value);
                            refresh();
                            @if($loop->first)
                                $("#slider-range-{{ $point[1]->id_point }}").slider('values', 0, ( ui.value + 1 ) );
                            @elseif($loop->last)
                                $("#slider-range-{{ $point[( count($point) - 2 )]->id_point }}").slider('values', 1, ( ui.value - 1 ) );
                            @else
                                if(ui.handleIndex == 0){
                                    if({{$loop->index}} == 1){
                                        $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
                                    }
                                    $("#slider-range-{{ $point[( $loop->index - 1 )]->id_point }}").slider('values', 1, ( ui.value - 1 ) );
                                }
                                if(ui.handleIndex == 1){
                                    if({{$loop->index}} == {{ $x = count($point) - 2 }}){
                                        $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
                                    }
                                    $("#slider-range-{{ $point[( $loop->index + 1 )]->id_point }}").slider('values', 0, ( ui.value + 1 ) );
                                }
                            @endif
                        }
                    });
                    refresh();
                } );
            @endif
        @endforeach
    }

    function refresh(){
        @foreach($point as $row){
            @if($loop->first)
                $( ".rangesumminimal#rangesum-{{ $row->id_point }}" ).val( {{ $row->min_sum_total }});
                $( ".rangesummaksimal#rangesum-{{ $row->id_point }}").val( $( "#slider-range-min" ).slider( "value" ));
            @elseif($loop->last)
                $( ".rangesumminimal#rangesum-{{ $row->id_point }}" ).val( $( "#slider-range-max" ).slider( "value" ));
                $( ".rangesummaksimal#rangesum-{{ $row->id_point }}").val( "<" );
            @else
                $( ".rangesumminimal#rangesum-{{ $row->id_point }}" ).val( $( "#slider-range-{{ $row->id_point }}" ).slider( "values", 0 ));
                $( ".rangesummaksimal#rangesum-{{ $row->id_point }}").val( $( "#slider-range-{{ $row->id_point }}" ).slider( "values", 1 ));
            @endif
        }
        @endforeach
    }
</script>

@endpush
