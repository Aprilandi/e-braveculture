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
            <!-- Modal Tambah Reward -->
            <div id="tambahReward" name="tambahReward" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahRewardLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahRewardLabel"><b>Tambah Data Reward</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('reward.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtIDType">Reward Type</label><br>
                                    <select name="txtIDType" id="txtIDType" class="form-control">
                                        <option value="" selected hidden disabled>Pilih tipe hadiah</option>
                                        @foreach($type as $row)
                                            <option value="{{ $row->id_reward_type }}">{{ $row->reward_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtIDLevel">Level Reward</label><br>
                                    <select name="txtIDLevel" id="txtIDLevel" class="form-control">
                                        <option value="" selected hidden disabled>Pilih level hadiah</option>
                                        @foreach($level as $row)
                                            <option value="{{ $row->id_level }}">{{substr($row->badge, 0, strpos($row->badge, ".")) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtValue">Isi</label><br>
                                    <input type="number" class="form-control" id="txtValue" name="txtValue"
                                        placeholder="Masukkan nilai hadiah">
                                </div>
                                <div class="form-group">
                                    <label for="txtPoint">Harga Reedem</label><br>
                                    <input type="number" class="form-control" id="txtPoint" name="txtPoint"
                                        placeholder="Masukkan harga RP untuk reedem">
                                </div>
                                <div class="form-group">
                                    <label for="txtBerlaku">Masa Hari Berlaku</label><br>
                                    <input type="number" class="form-control" id="txtBerlaku" name="txtBerlaku"
                                        placeholder="Masukkan hari berlakunya hadiah">
                                </div>
                                <div class="form-group">
                                    <label for="txtDesc">Deskripsi</label><br>
                                    <input type="textarea" class="form-control" id="txtDesc" name="txtDesc"
                                        placeholder="Deskripsi hadiah...">
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
            <!-- Modal Edit Reward -->
            <div id="editReward" name="editReward" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editRewardLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editRewardLabel"><b>Edit Data Reward</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedIDType">Reward Type</label><br>
                                    <select name="txtedIDType" id="txtedIDType" class="form-control">
                                        <option value="" selected hidden disabled>Pilih tipe hadiah</option>
                                        @foreach($type as $row)
                                            <option value="{{ $row->id_reward_type }}">{{ $row->reward_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtedIDLevel">Level Reward</label><br>
                                    <select name="txtedIDLevel" id="txtedIDLevel" class="form-control">
                                        <option value="" selected hidden disabled>Pilih level hadiah</option>
                                        @foreach($level as $row)
                                            <option value="{{ $row->id_level }}">{{substr($row->badge, 0, strpos($row->badge, ".")) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtedValue">Isi</label><br>
                                    <input type="number" class="form-control" id="txtedValue" name="txtedValue"
                                        placeholder="Masukkan nilai hadiah">
                                </div>
                                <div class="form-group">
                                    <label for="txtedPoint">Harga Reedem</label><br>
                                    <input type="number" class="form-control" id="txtedPoint" name="txtedPoint"
                                        placeholder="Masukkan harga RP untuk reedem">
                                </div>
                                <div class="form-group">
                                    <label for="txtedBerlaku">Masa Hari Berlaku</label><br>
                                    <input type="number" class="form-control" id="txtedBerlaku" name="txtedBerlaku"
                                        placeholder="Masukkan hari berlakunya hadiah">
                                </div>
                                <div class="form-group">
                                    <label for="txtedDesc">Deskripsi</label><br>
                                    <input type="textarea" class="form-control" id="txtedDesc" name="txtedDesc"
                                        placeholder="Deskripsi hadiah...">
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
            <!-- Modal Tambah Type -->
            <div id="tambahType" name="tambahType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahTypeLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahTypeLabel"><b>Tambah Data Tipe Reward</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('typestore') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtType">Tipe Reward</label><br>
                                    <input type="text" class="form-control" id="txtType" name="txtType"
                                        placeholder="Masukkan tipe hadiah">
                                </div>
                                <div class="form-group">
                                    <label for="txtTypeDesc">Deskripsi</label><br>
                                    <input type="textarea" class="form-control" id="txtTypeDesc" name="txtTypeDesc"
                                        placeholder="Deskripsi tipe hadiah...">
                                </div>
                                <div class="form-group">
                                    <label for="txtGambar">Gambar</label>
                                    <input type="file" class="form-control-file" id="txtGambar" name="txtGambar">
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
            <!-- Modal Edit Type -->
            <div id="editType" name="editType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editTypeLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTypeLabel"><b>Edit Data Tipe Reward</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateFormType" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedType">Tipe Reward</label><br>
                                    <input type="text" class="form-control" id="txtedType" name="txtedType"
                                        placeholder="Masukkan tipe hadiah">
                                </div>
                                <div class="form-group">
                                    <label for="txtedTypeDesc">Deskripsi</label><br>
                                    <input type="textarea" class="form-control" id="txtedTypeDesc" name="txtedTypeDesc"
                                        placeholder="Deskripsi tipe hadiah...">
                                </div>
                                <div class="form-group">
                                    <label for="txtedGambar">Gambar</label>
                                    <input type="file" class="form-control-file" id="txtedGambar" name="txtedGambar">
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
            <!-- Modal Show Type -->
            <div id="showType" name="showType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="showTypeLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="showTypeLabel"><b>Data Tipe Reward</b></h5>
                            <div class="float-right mb-12"id="typebutton">
                                <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahType" id="tambahtipe" name="tambahtipe">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data Tipe
                                </button>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="table table-striped border">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Reward Type</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($number = 1)
                                        @foreach($type as $row)
                                        <tr>
                                            <td>{{ $number }}.</td>
                                            <td>{{ !empty($row->reward_type) ? $row->reward_type:0 }}</td>
                                            <td>{{ !empty($row->desc) ? $row->desc:"" }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        {{ !empty($row->gambar) ? substr($row->gambar, 0, strpos($row->gambar, ".")):'' }}
                                                    </div>
                                                    <div class="col-6">
                                                        <button class="btn btn-light  btn-sm" id="detail" data-gambar="{{ !empty($row->gambar) ? asset('images/random/'.$row->gambar):'' }}">
                                                            <i class="fa fa-eye"> </i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <button class="btn btn-primary btn-sm col-6" id="edittipe" href="{{ route('typeupdate',  $row->id_reward_type) }}" data-type="{{ $row->reward_type }}" data-desc="{{ $row->desc }}"><i class="fa fa-edit"> </i></button>

                                                    <button href="{{ route('typedestroy', $row->id_reward_type) }}"
                                                        class="btn btn-danger btn-sm col-6" id="deletetipe"
                                                        data-nama="{{ $row->reward_type }}">
                                                        <i class="fa fa-trash"> </i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @php($number++)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                            <button type="button" class="btn btn-secondary mb-6" data-toggle="modal" data-target="#showType" id="showType" name="showType">
                                <i class="fa fa-gears"></i>
                                 Data Tipe Hadiah
                            </button>
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahReward" id="tambahhadiah" name="tambahhadiah">
                                <i class="fa fa-plus"></i>
                                 Tambah Data Hadiah
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
                                        <th>Reward Type</th>
                                        <th>Level Reward</th>
                                        <th>Isi Hadiah</th>
                                        <th>Hari Berlaku</th>
                                        <th>Deskripsi</th>
                                        <th>Harga Reedem</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($reward as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->id_reward_type) ? $row->rewardtypes->reward_type:"" }}</td>
                                        <td>{{ !empty($row->levels) ? substr($row->levels->badge, 0, strpos($row->levels->badge, ".")):"" }}</td>
                                        <td>@if($row->rewardtypes->reward_type == 'Voucher')Rp {{ !empty($row->value) ? number_format($row->value, 0, ',', '.'):0 }}@elseif($row->rewardtypes->reward_type == 'Diskon'){{ !empty($row->value) ? $row->value:0 }}%@endif</td>
                                        <td>{{ !empty($row->hari_berlaku) ? $row->hari_berlaku:0 }} Hari</td>
                                        <td>{{ !empty($row->desc) ? $row->desc:"" }}</td>
                                        <td>{{ !empty($row->prize_point) ? $row->prize_point:0 }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" id="edit" href="{{ route('reward.update',  $row->id_reward) }}" data-idtype="{{ $row->id_reward_type }}" data-idlevel="{{ $row->id_level }}" data-value="{{ $row->value }}" data-berlaku="{{ $row->hari_berlaku }}" data-desc="{{ $row->desc }}" data-point="{{ $row->prize_point }}"><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('reward.destroy', $row->id_reward) }}"
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

{{-- Detail Gambar Level --}}
<div id="detailGambarModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailGambarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailGambarLabel"><b>Gambar Tipe Hadiah</b></h5>
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

@endsection

@push('scripts')

{{-- aditional JS --}}

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
var html = [];

$('button#type').on('click', function() {

});

$('button#tambahtipe').on('click', function() {
    $('#showType').modal('hide');
});

$('#tambahType').on('hidden.bs.modal', function () {
    $('#showType').modal('show');
});

// saat modal event hide ter trigger
$('#tambahType').on('hidden.bs.modal', function () {
    $('#showType').modal('show');
});

$('button#edittipe').on('click', function() {
    $('#showType').modal('hide');
    var type = $(this).data("type");
    var desc = $(this).data("desc");
    var href = $(this).attr('href');
    $('#txtedType').val(type);
    $('#txtedTypeDesc').val(desc);
    $('#updateFormType').attr('action', href);
    $("#editType").modal('show');

});

$('#editType').on('hidden.bs.modal', function () {
    $('#showType').modal('show');
});


$('button#deletetipe').on('click', function() {
    var href = $(this).attr('href');
    var nama = $(this).data('nama');
    Swal.fire({
            title: "Anda yakin untuk menghapus data tipe reward yang bernama : \"" + nama + "\"?",
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

$('button#detail').on('click', function() {
    $('#showType').modal('hide');
});

$('#detailGambarModal').on('hidden.bs.modal', function () {
    $('#showType').modal('show');
});

$('button#edit').on('click', function() {
    // alert('tes');
    var idtype = $(this).data("idtype");
    var idlevel = $(this).data("idlevel");
    var value = $(this).data("value");
    var desc = $(this).data("desc");
    var berlaku = $(this).data("berlaku");
    var point = $(this).data("point");
    var href = $(this).attr('href');
    $('#txtedIDType').val(idtype);
    $('#txtedIDLevel').val(idlevel);
    $('#txtedValue').val(value);
    $('#txtedPoint').val(point);
    $('#txtedBerlaku').val(berlaku);
    $('#txtedDesc').val(desc);
    $('#updateForm').attr('action', href);
    $("#editReward").modal('show');
});

$('button#detail').on('click', function() {
    var gambar = $(this).data("gambar");

    $('#detail_gambar').attr("src", gambar);
    $("#detailGambarModal").modal('show');
});

$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var no = $(this).data('no');
    Swal.fire({
            title: "Anda yakin untuk menghapus data reward yang benomer : \"" + no + "\"?",
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
</script>

@endpush
