@extends('admin.admin')
@push('style')
{{-- aditional style --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style>

    input.form-control-file#txtIcon {
        position: absolute;
        top: 50%;
        transform: translate(0, -50%);
    }

</style>
@endpush

@section('content')


<div class="home-content">
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Modal Tambah -->
            <div id="tambahLevel" name="tambahLevel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahLevelLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="tambahLevelLabel"><b>Tambah Data Level</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('level.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtTier">Tier Level</label><br>
                                    <input type="text" class="form-control" id="txtTier" name="txtTier" value="{{ $tl }}"
                                        placeholder="Masukkan Tier Level" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txtMin">Minimal XP yang dibutuhkan</label><br>
                                    <input type="number" class="form-control" id="txtMin" name="txtMin" @if(!empty($max)) max="{{ $max }}" @endif @if(!empty($min)) min="{{ $min }}" @endif
                                        placeholder="Masukkan minimal XP yg diperlukan">
                                </div>
                                <div class="form-group">
                                    <label for="txtBonus">Bonus RP</label><br>
                                    <input type="number" class="form-control" id="txtBonus" name="txtBonus" max="100"
                                        placeholder="Masukkan bonus RP yang diperoleh dalam level ini dalam persentase">%
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm"><label for="txtBadge">Badge</label></div>
                                        <div class="col-sm"><label for="txtIcon">Icon</label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="txtBadge" name="txtBadge" placeholder="Masukkan Nama Badge Beserta Iconnya">
                                        </div>
                                        <div class="col-sm">
                                            <input type="file" class="form-control-file" id="txtIcon" name="txtIcon">
                                        </div>
                                    </div>
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
            <div id="editLevel" name="editLevel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editLevelLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLevelLabel"><b>Edit Data Level</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedTier">Tier Level</label><br>
                                    <input type="text" class="form-control" id="txtedTier" name="txtedTier" value=""
                                        placeholder="Masukkan Tier Level" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="txtedMin">Minimal XP yang dibutuhkan</label><br>
                                    <input type="number" class="form-control" id="txtedMin" name="txtedMin" min="" max=""
                                        placeholder="Masukkan minimal XP yang dibutuhkan untuk memperoleh level ini">
                                </div>
                                <div class="form-group">
                                    <label for="txtedBonus">Bonus RP</label><br>
                                    <input type="number" class="form-control" id="txtedBonus" name="txtedBonus" max="100"
                                        placeholder="Masukkan bonus RP yang diperoleh dalam level ini dalam persentase">%
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm"><label for="txtedBadge">Badge</label></div>
                                        <div class="col-sm"><label for="txtedIcon">Icon</label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="txtedBadge" name="txtedBadge" placeholder="Masukkan Nama Badge Beserta Iconnya">
                                        </div>
                                        <div class="col-sm">
                                            <input type="file" class="form-control-file" id="txtedIcon" name="txtedIcon">
                                        </div>
                                    </div>
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

            {{-- <div id="editLevel" name="editLevel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editLevelLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editLevelLabel"><b>Edit Data Level</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedName">Nama</label><br>
                                    <input type="text" class="form-control-file" id="txtedName" name="txtedName"
                                        placeholder="Masukkan Nama Level">
                                </div>
                                <div class="form-group">
                                    <label for="txtedIcon">Icon</label><br>
                                    <input type="file" class="form-control-file" id="txtedIcon" name="txtedIcon">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <h4 class="card-title" style="display:inline-block;">Data levels</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                            <button type="button" class="btn btn-secondary mb-6" id="btneditxp" name="btneditxp" onclick="editxp()">
                                <i class="fa fa-gears"></i>
                                 Edit XP
                            </button>
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahLevel" id="tambah" name="tambah">
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
                                        <th>Tier Level</th>
                                        <th>Range XP</th>
                                        <th>Badge</th>
                                        <th>Bonus RP</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($number = 1)
                                    {{-- @php(dd($mdLevels[0]->levels->level_name)) --}}
                                    @foreach($mdLevels as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->tier_level) ? $row->tier_level:0 }}</td>
                                        <td id="xp-{{ $row->id_level }}">{{ $min = !empty($row->minimal) ? $row->minimal:0 }}@if($loop->last == true) {{ $x = (!empty($mdLevels[( $loop->index + 1 )]->minimal) ? $mdLevels[( $loop->index + 1 )]->minimal:"<" ) }} @else - {{ $x = (!empty($mdLevels[( $loop->index + 1 )]->minimal) ? $mdLevels[( $loop->index + 1 )]->minimal:0 ) - 1 }} @endif</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    {{ !empty($row->badge) ? substr($row->badge, 0, strpos($row->badge, ".")):'' }}
                                                </div>
                                                <div class="class-6">
                                                    <button class="btn btn-light  btn-sm" id="detail" data-gambar="{{ !empty($row->badge) ? asset('images/avatar/badge/'.$row->badge):'' }}">
                                                        <i class="fa fa-eye"> </i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ !empty($row->bonus_point) ? $row->bonus_point:0 }}%</td>
                                        <td class="text-center">
                                            {{-- <a href="{{ route('level.edit',  $row->id_level) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"> </i>
                                            </a> --}}
                                            <button class="btn btn-primary btn-sm" id="edit" href="{{ route('level.update',  $row->id_level) }}" data-xp="{{ $row->minimal }}" data-tier="{{ $row->tier_level }}" data-bonus="{{ $row->bonus_point }}" data-badge="{{ !empty($row->badge) ? substr($row->badge, 0, strpos($row->badge, ".")):'' }}" data-min="@if($loop->first) 0 @else {{ $mdLevels[$x = ($loop->index - 1)]->minimal }} @endif" @if($loop->last != true) data-max="{{ $mdLevels[$x = ($loop->index + 1)]->minimal }}" @endif><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('level.destroy', $row->id_level) }}"
                                                class="btn btn-danger  btn-sm" id="delete"
                                                data-tier="{{ $row->tier_level }}">
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

{{-- Detail Gambar Level --}}
<div id="detailGambarModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailGambarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailGambarLabel"><b>Icon Badge</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="" width="100%" id="detail_gambar" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="xpForm" action="" method="post" enctype="multipart/form-data">
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

function editxp() {
    document.getElementById('xpbutton').innerHTML = '<button type="button" class="btn btn-danger mb-4" id="btncancelxp" name="btncancelxp" onclick="cancelxp()"><i class="fas fa-times"></i> Cancel</button>' + '&nbsp' + '<button type="button" class="btn btn-success mb-4" id="btnsavexp" name="btnsavexp" onclick="savexp()"><i class="fas fa-save"></i> Simpan</button>' + '&nbsp' + '<button type="button" class="btn btn-info mb-4" data-toggle="modal" data-target="#tambahLevel" id="tambah" name="tambah"><i class="fa fa-plus"></i>Tambah Data</button>';
    showrangexp();
}

function cancelxp() {
    document.getElementById('xpbutton').innerHTML = '<button type="button" class="btn btn-secondary mb-6" id="btneditxp" name="btneditxp" onclick="editxp()"><i class="fa fa-gears"></i> Edit XP</button>' + '&nbsp' + '<button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahLevel" id="tambah" name="tambah"><i class="fa fa-plus"></i> Tambah Data</button>';
    cancelrangexp();
}

function savexp() {
    var xp = {};

    $("input[class=rangexpminimal]").each(function() {

        var id = $(this).attr("title");
        var minimal = $(this).val()

        xp[id] = minimal;
    });

    // var data = [];

    // data['_token'] = $('input[name=_token]').val();
    // data['xp'] = JSON.stringify(xp);
    $('#data').val(JSON.stringify(xp));
    // alert($('#data').val());
    $('#xpForm').attr('action', '{{ route("simpanxp") }}');
    $('#xpForm').submit();

    // console.log(xp);

    // $.ajax({
    //     url: "{{ route('simpanxp') }}",
    //     type: "POST",
    //     data: {
    //         _method:'PUT',
    //         xp: JSON.stringify(xp),
    //         _token:'{{ csrf_token() }}'
    //     },
    //     dataType: "json",
    //     success: function (result) {
    //         console.log(result);
    //         window.location.reload();
    //     },
    //     error: function (xhr) {
    //         console.log(xhr);
    //     }
    // });
}

$('button#edit').on('click', function() {
    // alert('tes');
    var tier = $(this).data("tier");
    var xp = $(this).data("xp");
    var min = $(this).data("min");
    var max = $(this).data("max");
    if(max === undefined) { max = "" };
    var bonus = $(this).data("bonus");
    var badge = $(this).data("badge");
    var href = $(this).attr('href');
    $('#txtedTier').val(tier);
    $('#txtedMin').val(xp);
    $('#txtedMin').attr('min', min);
    $('#txtedMin').attr('max', max);
    $('#txtedBonus').val(bonus);
    $('#txtedBadge').val(badge);
    $('#updateForm').attr('action', href);
    $("#editLevel").modal('show');
});

$('button#detail').on('click', function() {
    var gambar = $(this).data("gambar");

    $('#detail_gambar').attr("src", gambar);
    $("#detailGambarModal").modal('show');


});

$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var tier = $(this).data('tier');
    Swal.fire({
            title: "Anda yakin untuk menghapus data level tier : \"" + tier + "\"?",
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

    function xparray() {
        @foreach($mdLevels as $row)
            html[{{ $loop->index }}] = '<p>' + '<label for="rangexp-{{ $row->tier_level }}">Tier {{ $row->tier_level }}:</label>&nbsp' +
                    '<input type="number" class="rangexpminimal" id="rangexp-{{ $row->tier_level }}" title="{{ $row->tier_level }}" style="border:0; color:#f6931f; font-weight:bold; width:8%;" @if($loop->last != true) readonly @else step="10" onchange="slidervalue(this.value, this.title)" @endif> XP @if($loop->last != true) - <input type="text" class="rangexpmaksimal" id="rangexp-{{ $row->tier_level }}" style="border:0; color:#f6931f; font-weight:bold; width:8%;" readonly> XP @endif' +
                    @if($loop->first) '<div id="slider-range-min"></div>' @elseif($loop->last) '<div id="slider-range-max"></div>' @else '<div id="slider-range-{{ $row->tier_level }}"></div>' @endif +
                    '</p>';
        @endforeach
    }

    function showrangexp() {
        xparray();
        // var a = "";
        @foreach($mdLevels as $row)
            document.getElementById('xp-{{ $row->id_level }}').innerHTML = html[{{ $loop->index }}];
        @endforeach
        // for (let i = 0; i < html.length; i++) {
        //     a += html[i];
        // }
        // // console.log(a);
        // document.getElementById('xprange').innerHTML = a;
        slidervalue();
    }

    function cancelrangexp(){
        @foreach($mdLevels as $row)
            document.getElementById('xp-{{ $row->id_level }}').innerHTML = "{{ $min = !empty($row->minimal) ? $row->minimal:0 }}@if($loop->last == true) {{ $x = (!empty($mdLevels[( $loop->index + 1 )]->minimal) ? $mdLevels[( $loop->index + 1 )]->minimal:"<" ) }} @else - {{ $x = (!empty($mdLevels[( $loop->index + 1 )]->minimal) ? $mdLevels[( $loop->index + 1 )]->minimal:0 ) - 1 }} @endif";
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
            max = {{ $xpmax }} + 500;
            val = {{ $xpmax }}
        }
        // alert(max);
        @foreach($mdLevels as $row)
            @if($loop->index == ( count($mdLevels) - 2 ))
                if(a !== undefined){
                    $( function() {
                        $( "#slider-range-@if($loop->first){{'min'}}@elseif($loop->last){{'max'}}@else{{ $row->tier_level }}@endif" ).slider({
                            range: @if($loop->first) "min" @elseif($loop->last) "max" @else true @endif,
                            min: 0,
                            max: max,
                            step: 10,
                            @if($loop->first == true || $loop->last == true) value @else values @endif: @if($loop->first) {{ $x = $mdLevels[$loop->index + 1]->minimal}} @elseif($loop->last) val @else [ {{ $row->minimal }}, val ] @endif,

                            slide: function( event, ui ) {
                                console.log(ui.value);
                                refresh();
                                @if($loop->first)
                                    $("#slider-range-{{ $mdLevels[1]->tier_level }}").slider('values', 0, ( ui.value + 1 ) );
                                @elseif($loop->last)
                                    $("#slider-range-{{ $mdLevels[( count($mdLevels) - 2 )]->tier_level }}").slider('values', 1, ( ui.value - 1 ) );
                                @else
                                    if(ui.handleIndex == 0){
                                        if({{$loop->index}} == 1){
                                            $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
                                        }
                                        $("#slider-range-{{ $mdLevels[( $loop->index - 1 )]->tier_level }}").slider('values', 1, ( ui.value - 1 ) );
                                    }
                                    if(ui.handleIndex == 1){
                                        if({{$loop->index}} == {{ $x = count($mdLevels) - 2 }}){
                                            $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
                                        }
                                        $("#slider-range-{{ $mdLevels[( $loop->index + 1 )]->tier_level }}").slider('values', 0, ( ui.value + 1 ) );
                                    }
                                @endif
                            }
                        });
                        refresh();
                    } );
                }
                else{
                    $( function() {
                        $( "#slider-range-@if($loop->first){{'min'}}@elseif($loop->last){{'max'}}@else{{ $row->tier_level }}@endif" ).slider({
                            range: @if($loop->first) "min" @elseif($loop->last) "max" @else true @endif,
                            min: 0,
                            max: max,
                            step: 10,
                            @if($loop->first == true || $loop->last == true) value @else values @endif: @if($loop->first) {{ $x = $mdLevels[$loop->index + 1]->minimal}} @elseif($loop->last) val @else [ {{ $row->minimal }}, {{ $x = $mdLevels[( $loop->index + 1 )]->minimal }} ] @endif,

                            slide: function( event, ui ) {
                                console.log(ui.value);
                                refresh();
                                @if($loop->first)
                                    $("#slider-range-{{ $mdLevels[1]->tier_level }}").slider('values', 0, ( ui.value + 1 ) );
                                @elseif($loop->last)
                                    $("#slider-range-{{ $mdLevels[( count($mdLevels) - 2 )]->tier_level }}").slider('values', 1, ( ui.value - 1 ) );
                                @else
                                    if(ui.handleIndex == 0){
                                        if({{$loop->index}} == 1){
                                            $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
                                        }
                                        $("#slider-range-{{ $mdLevels[( $loop->index - 1 )]->tier_level }}").slider('values', 1, ( ui.value - 1 ) );
                                    }
                                    if(ui.handleIndex == 1){
                                        if({{$loop->index}} == {{ $x = count($mdLevels) - 2 }}){
                                            $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
                                        }
                                        $("#slider-range-{{ $mdLevels[( $loop->index + 1 )]->tier_level }}").slider('values', 0, ( ui.value + 1 ) );
                                    }
                                @endif
                            }
                        });
                        refresh();
                    } );
                }
            @else
                $( function() {
                    $( "#slider-range-@if($loop->first){{'min'}}@elseif($loop->last){{'max'}}@else{{ $row->tier_level }}@endif" ).slider({
                        range: @if($loop->first) "min" @elseif($loop->last) "max" @else true @endif,
                        min: 0,
                        max: max,
                        step: 10,
                        @if($loop->first == true || $loop->last == true) value @else values @endif: @if($loop->first) {{ $x = $mdLevels[$loop->index + 1]->minimal}} @elseif($loop->last) val @else [ {{ $row->minimal }}, {{ $x = $mdLevels[( $loop->index + 1 )]->minimal }} ] @endif,

                        slide: function( event, ui ) {
                            console.log(ui.value);
                            refresh();
                            @if($loop->first)
                                $("#slider-range-{{ $mdLevels[1]->tier_level }}").slider('values', 0, ( ui.value + 1 ) );
                            @elseif($loop->last)
                                $("#slider-range-{{ $mdLevels[( count($mdLevels) - 2 )]->tier_level }}").slider('values', 1, ( ui.value - 1 ) );
                            @else
                                if(ui.handleIndex == 0){
                                    if({{$loop->index}} == 1){
                                        $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
                                    }
                                    $("#slider-range-{{ $mdLevels[( $loop->index - 1 )]->tier_level }}").slider('values', 1, ( ui.value - 1 ) );
                                }
                                if(ui.handleIndex == 1){
                                    if({{$loop->index}} == {{ $x = count($mdLevels) - 2 }}){
                                        $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
                                    }
                                    $("#slider-range-{{ $mdLevels[( $loop->index + 1 )]->tier_level }}").slider('values', 0, ( ui.value + 1 ) );
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
        @foreach($mdLevels as $row){
            @if($loop->first)
                $( ".rangexpminimal#rangexp-{{ $row->tier_level }}" ).val( {{ $row->minimal }});
                $( ".rangexpmaksimal#rangexp-{{ $row->tier_level }}").val( $( "#slider-range-min" ).slider( "value" ));
            @elseif($loop->last)
                $( ".rangexpminimal#rangexp-{{ $row->tier_level }}" ).val( $( "#slider-range-max" ).slider( "value" ));
                $( ".rangexpmaksimal#rangexp-{{ $row->tier_level }}").val( "<" );
            @else
                $( ".rangexpminimal#rangexp-{{ $row->tier_level }}" ).val( $( "#slider-range-{{ $row->tier_level }}" ).slider( "values", 0 ));
                $( ".rangexpmaksimal#rangexp-{{ $row->tier_level }}").val( $( "#slider-range-{{ $row->tier_level }}" ).slider( "values", 1 ));
            @endif
        }
        @endforeach
    }
</script>

@endpush

{{-- JQuery Slider --}}
{{-- <!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Slider - Range slider</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount-range" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
        $("#slider-range-min").slider('value', ( ui.values[ 0 ] - 1 ) );
        $("#slider-range-max").slider('value', ( ui.values[ 1 ] + 1 ) );
        refresh();
      }
    });
    refresh();
  } );
  $( function() {
    $( "#slider-range-min" ).slider({
      range: "min",
      value: 74,
      min: 0,
      max: 500,
      slide: function( event, ui ) {
        $( "#amount-min" ).val( "$" + ui.value );
        $("#slider-range").slider('values', 0, ( ui.value + 1 ) );
        refresh();
        }
    });
    refresh();
  } );
  $( function() {
    $( "#slider-range-max" ).slider({
      range: "max",
      min: 0,
      max: 500,
      value: 301,
      slide: function( event, ui ) {
        $( "#amount-max" ).val( ui.value );
        $("#slider-range").slider('values', 1, ( ui.value - 1 ) );
        refresh();
      }
    });
    refresh();
  } );
function refresh(){
  $( "#amount-max" ).val( "$" + $( "#slider-range-max" ).slider( "value" ) );
  $( "#amount-min" ).val( "$" + $( "#slider-range-min" ).slider( "value" ) );
  $( "#amount-range" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  }
</script>
</head>
<body>

<p>
  <label for="amount-min">Price min:</label>
  <input type="text" id="amount-min" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>

<div id="slider-range-min"></div>

<p>
  <label for="amount-range">Price range:</label>
  <input type="text" id="amount-range" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>

<div id="slider-range"></div>

<p>
  <label for="amount-max">Price max:</label>
  <input type="text" id="amount-max" readonly style="border:0; color:#f6931f; font-weight:bold;">
</p>

<div id="slider-range-max"></div>

</body>
</html> --}}
