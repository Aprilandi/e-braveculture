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

    .rectangle{
        width:40px;
        height:40px;
}
</style>
@endpush

@section('content')
{{-- MATERIAL DAN WARNA SABLON --}}

<div class="home-content">
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Modal Tambah Material -->
            <div id="tambahMaterial" name="tambahMaterial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahMaterialLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahMaterialLabel"><b>Tambah Data Material</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kain.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtNamaKain">Nama Kain</label><br>
                                    <input type="text" class="form-control" id="txtNamaKain" name="txtNamaKain"
                                        placeholder="Masukkan nama bahan kain">
                                </div>
                                <div class="form-group">
                                    <label for="txtDesc">Deskripsi</label><br>
                                    <input type="textarea" class="form-control" id="txtDesc" name="txtDesc"
                                        placeholder="Deskripsi kain...">
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
            <!-- Modal Edit Material -->
            <div id="editMaterial" name="editMaterial" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editMaterialLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMaterialLabel"><b>Edit Data Material</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedNamaKain">Nama Kain</label><br>
                                    <input type="text" class="form-control" id="txtedNamaKain" name="txtedNamaKain"
                                        placeholder="Masukkan nama bahan kain">
                                </div>
                                <div class="form-group">
                                    <label for="txtedDesc">Deskripsi</label><br>
                                    <input type="textarea" class="form-control" id="txtedDesc" name="txtedDesc"
                                        placeholder="Deskripsi kain...">
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
            <!-- Modal Tambah Warna -->
            <div id="tambahWarna" name="tambahWarna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahWarnaLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahWarnaLabel"><b>Tambah Data Warna</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('warna.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtNamaWarna">Nama Warna</label><br>
                                    <input type="text" class="form-control" id="txtNamaWarna" name="txtNamaWarna"
                                        placeholder="Masukkan nama warna">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="txtHexCode">Code Hex</label><br>
                                            <input type="text" class="form-control" id="txtHexCode" name="txtHexCode"
                                                placeholder="Code hex warna...">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="txtRGBCode">Code RGB</label><br>
                                            <input type="text" class="form-control" id="txtRGBCode" name="txtRGBCode"
                                                placeholder="Code hex warna...">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtUpload">Upload Gambar Warna</label><br>
                                    <input type="file" class="form-control-file" id="txtUpload" name="txtUpload" onchange="showPreview(event, 'tambah')">
                                </div>
                                <div class="form-group">
                                    <img id="imgWarna" src="" alt="" style="height:100%; width:100%">
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
            <!-- Modal Edit warna -->
            <div id="editWarna" name="editWarna" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editWarnaLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editWarnaLabel"><b>Edit Data Warna</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateFormWarna" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedNamaWarna">Nama Warna</label><br>
                                    <input type="text" class="form-control" id="txtedNamaWarna" name="txtedNamaWarna"
                                        placeholder="Masukkan nama warna">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="txtedHexCode">Code Hex</label><br>
                                            <input type="text" class="form-control" id="txtedHexCode" name="txtedHexCode"
                                                placeholder="Code hex warna...">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="txtedRGBCode">Code RGB</label><br>
                                            <input type="text" class="form-control" id="txtedRGBCode" name="txtedRGBCode"
                                                placeholder="Code hex warna...">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtedUpload">Upload Gambar Warna</label><br>
                                    <input type="file" class="form-control-file" id="txtedUpload" name="txtedUpload" onchange="showPreview(event, 'edit')">
                                </div>
                                <div class="form-group">
                                    <img id="imgedWarna" src="" alt="" style="height:100%; width:100%">
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
                        <h4 class="card-title" style="display:inline-block;">Data Bahan Kain</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahMaterial" id="tambahmaterial" name="tambahmaterial">
                                <i class="fa fa-plus"></i>
                                    Tambah Bahan Kain
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
                                        <th>Nama Material</th>
                                        <th>Deskripsi </th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($material as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->material_name) ? $row->material_name:"" }}</td>
                                        <td>{{ !empty($row->material_desc) ? $row->material_desc:"" }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" id="editKain" href="{{ route('kain.update',  $row->id_material) }}" data-nama="{{ $row->material_name }}" data-desc="{{ $row->material_desc }}"><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('kain.destroy', $row->id_material) }}"
                                                class="btn btn-danger  btn-sm" id="delete"
                                                data-nama="{{ $row->material_name }}">
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
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <h4 class="card-title" style="display:inline-block;">Data Rewards</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahWarna" id="tambahColour" name="tambahColour">
                                <i class="fa fa-plus"></i>
                                 Tambah Data Warna
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
                                        <th>Warna</th>
                                        <th>Contoh Warna</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($colour as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->warna) ? $row->warna:"" }}</td>
                                        <td>HEX: {{ !empty($row->hex) ? $row->hex:"" }} <div class="rectangle" style="background:{{ !empty($row->hex) ? $row->hex:"" }}"></div> <br> RGB: {{ !empty($row->rgb) ? $row->rgb:"" }} <div class="rectangle" style="background:{{ !empty($row->rgb) ? $row->rgb:"" }}"></div></td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" id="editWarna" href="{{ route('warna.update',  $row->id_colour) }}" data-nama="{{ $row->warna }}" data-rgb="{{ $row->rgb }}" data-hex="{{ $row->hex }}"><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('warna.destroy', $row->id_colour) }}"
                                                class="btn btn-danger  btn-sm" id="delete"
                                                data-nama="{{ $row->warna }}">
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

@endsection

@push('scripts')

{{-- aditional JS --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
var html = [];
var rgb = "";
var hex = "";

$('button#editKain').on('click', function() {
    // alert('tes');
    var nama = $(this).data("nama");
    var desc = $(this).data("desc");
    var href = $(this).attr('href');
    $('#txtedNamaKain').val(nama);
    $('#txtedDesc').val(desc);
    $('#updateForm').attr('action', href);
    $("#editMaterial").modal('show');
});

$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var nama = $(this).data('nama');
    Swal.fire({
            title: "Anda yakin untuk menghapus data : \"" + nama + "\"?",
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

$('button#editWarna').on('click', function() {
    // alert('tes');
    var nama = $(this).data("nama");
    var rgb = $(this).data("rgb");
    var hex = $(this).data("hex");
    var href = $(this).attr('href');
    $('#txtedNamaWarna').val(nama);
    $('#txtedRGBCode').val(rgb);
    $('#txtedHexCode').val(hex);
    $('#updateFormWarna').attr('action', href);
    $("#editWarna").modal('show');
});

function showPreview(event, status){
    if(event.target.files.length > 0){
        var src = URL.createObjectURL(event.target.files[0]);
        if(status === 'tambah'){
            var preview = document.getElementById("imgWarna");
        }
        if(status === 'edit'){
            var preview = document.getElementById("imgedWarna");
        }
        preview.src = src;
        preview.style.display = "block";
        // $('#txtHexCode').val(getRGB());
        getRGB(preview, status);
    }
}

function getRGB(img, status){
    // alert('tes');
    const colorThief = new ColorThief();
    if (img.complete) {
        color(colorThief.getColor(img), status);
    } else {
        img.addEventListener('load', function() {
            color(colorThief.getColor(img), status);
        });
    }
}

const rgbToHex = (r, g, b) => '#' + [r, g, b].map(x => {
    const hex = x.toString(16)
    return hex.length === 1 ? '0' + hex : hex
}).join('')

function color(arrayRGB, status){
    rgb = "rgb(" + arrayRGB[0] + ", " + arrayRGB[1] + ", " + arrayRGB[2] + ")";
    hex = rgbToHex(arrayRGB[0], arrayRGB[1], arrayRGB[2]);
    if(status === 'tambah'){
        $('#txtRGBCode').val(rgb);
        $('#txtHexCode').val(hex);
    }
    if(status === 'edit'){
        $('#txtedRGBCode').val(rgb);
        $('#txtedHexCode').val(hex);
    }
}

</script>

@endpush
