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
            <div id="tambahUser" name="tambahUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahUserLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="tambahUserLabel"><b>Tambah Data User</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtName">Nama</label><br>
                                    <input type="text" class="form-control" id="txtName" name="txtName"
                                        placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="txtUsername">Username</label><br>
                                    <input type="text" class="form-control" id="txtUsername" name="txtUsername"
                                        placeholder="Masukkan username">
                                </div>
                                <div class="form-group">
                                    <label for="txtRole">Role</label><br>
                                    <select name="txtRole" id="txtRole" class="form-control">
                                        <option value="" selected hidden disabled>Pilih role</option>
                                        @foreach($role as $row)
                                            <option value="{{ $row->id_role }}">{{ $row->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtEmail">Email</label><br>
                                    <input type="email" class="form-control" id="txtEmail" name="txtEmail"
                                        placeholder="Masukkan email">
                                </div>
                                <div class="form-group">
                                    <label for="txtPassword">Password</label><br>
                                    <input type="password" class="form-control" id="txtPassword" name="txtPassword"
                                        placeholder="Masukkan password">
                                </div>
                                <div class="form-group">
                                    <label for="txtAvatar">Avatar</label>
                                    <input type="file" class="form-control-file" id="txtAvatar" name="txtAvatar">
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
            <div id="editUser" name="editUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editUserLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserLabel"><b>Edit Data User</b></h5>
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
                                    <input type="text" class="form-control" id="txtedName" name="txtedName"
                                        placeholder="Masukkan Nama">
                                </div>
                                <div class="form-group">
                                    <label for="txtedUsername">Username</label><br>
                                    <input type="text" class="form-control" id="txtedUsername" name="txtedUsername"
                                        placeholder="Masukkan username">
                                </div>
                                <div class="form-group">
                                    <label for="txtedRole">Role</label><br>
                                    <select name="txtedRole" id="txtedRole" class="form-control">
                                        <option value="" selected hidden disabled>Pilih role</option>
                                        @foreach($role as $row)
                                            <option value="{{ $row->id_role }}">{{ $row->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtedEmail">Email</label><br>
                                    <input type="email" class="form-control" id="txtedEmail" name="txtedEmail"
                                        placeholder="Masukkan email">
                                </div>
                                <div class="form-group">
                                    <label for="txtedPassword">Password</label><br>
                                    <input type="password" class="form-control" id="txtedPassword" name="txtedPassword"
                                        placeholder="Tidak perlu di isi jika tidak ada perubahan password">
                                </div>
                                <div class="form-group">
                                    <label for="txtedAvatar">Avatar</label>
                                    <input type="file" class="form-control-file" id="txtedAvatar" name="txtedAvatar">
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
                        <h4 class="card-title" style="display:inline-block;">Data users</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                            <button type="button" class="btn btn-secondary mb-6" id="btnRole" name="btnRole" data-toggle="modal" data-target="#showRole">
                                <i class="fa fa-gears"></i>
                                 Data Role
                            </button>
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahUser" id="tambah" name="tambah">
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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>List Rewards</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($number = 1)
                                    @foreach($user as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->name) ? $row->name:"" }}</td>
                                        <td>{{ !empty($row->username) ? $row->username:"" }}</td>
                                        <td>{{ !empty($row->email) ? $row->email:"" }}</td>
                                        <td>{{ !empty($row->role->role) ? $row->role->role:"" }}</td>
                                        <td>
                                            <button class="btn btn-light btn-sm" id="detailStatus"
                                                data-level="{{ !empty($row->userstatus->levels->tier_level) ? $row->userstatus->levels->tier_level:0 }}"
                                                data-xp="{{ !empty($row->userstatus->experience_points) ? $row->userstatus->experience_points:0 }}"
                                                data-rp="{{ !empty($row->userstatus->redeemable_points) ? $row->userstatus->redeemable_points:0 }}"
                                                data-rppending="{{ !empty($row->userstatus->redeemable_points_pending) ? $row->userstatus->redeemable_points_pending:0 }}"
                                            >
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-light  btn-sm" id="detailRewards"
                                                data-rewards=
                                                '[
                                                    @foreach($row->rewardhistories as $row1)
                                                    {
                                                        "desc":"{{ $row1->rewards->desc }}",
                                                        "type":"{{ $row1->rewards->rewardtypes->reward_type }}",
                                                        "value":"{{ $row1->rewards->value }}",
                                                        "status":"{{ $row1->status }}",
                                                        "date":"{{ date('j F Y', strtotime($row1->created_at)) }}"
                                                    }
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                            >
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            {{-- <a href="{{ route('user.edit',  $row->id_user) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"> </i>
                                            </a> --}}
                                            <button class="btn btn-primary btn-sm" id="edit" href="{{ route('user.update',  $row->id_user) }}"
                                                data-name="{{ $row->name }}" data-user="{{ $row->username }}" data-role="{{ $row->id_role }}" data-email="{{ $row->email }}"
                                                ><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('user.destroy', $row->id_user) }}"
                                                class="btn btn-danger  btn-sm" id="delete"
                                                data-user="{{ $row->username }}">
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

{{-- Detail Status --}}
<div id="detailStatusModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailStatusLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailStatusLabel"><b>Status User</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableDetailStatus" class="table table-striped border">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Experience Points</th>
                                        <th>Redeemable Points</th>
                                        <th>Redeemable Points Pending</th>
                                    </tr>
                                </thead>
                                <tbody id="table_isi_status">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail Rewards --}}
<div id="detailRewardsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailRewardsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailRewardsLabel"><b>Rewards yang sudah di claim user</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableDetailRewards" class="table table-striped border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Deskripsi</th>
                                        <th>Value</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody id="table_isi_reward">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Show Role -->
<div id="showRole" name="showRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="showRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="showRoleLabel"><b>Data Role</b></h5>
                <div class="float-right mb-12"id="rolebutton">
                    <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahRole" id="tambahrole" name="tambahrole">
                        <i class="fa fa-plus"></i>
                        Tambah Data Role
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
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($number = 1)
                            @foreach($role as $row)
                            <tr>
                                <td>{{ $number }}.</td>
                                <td>{{ !empty($row->role) ? $row->role:"" }}</td>
                                <td class="text-center">
                                    <div class="row">
                                        <button class="btn btn-primary btn-sm col-6" id="btneditrole" href="{{ route('role.update',  $row->id_role) }}" data-role="{{ $row->role }}"><i class="fa fa-edit"> </i></button>

                                        <button href="{{ route('role.destroy', $row->id_role) }}"
                                            class="btn btn-danger btn-sm col-6" id="btndeleterole"
                                            data-role="{{ $row->role }}">
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

<!-- Modal Tambah Role -->
<div id="tambahRole" name="tambahRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRoleLabel"><b>Tambah Data Role</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="txtRole">Role</label><br>
                        <input type="text" class="form-control" id="txtRole" name="txtRole"
                            placeholder="Masukkan tipe hadiah">
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

<!-- Modal Edit Role -->
<div id="editRole" name="editRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editRoleLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleLabel"><b>Edit Data Role</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateFormRole" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="txtedRole">Role</label><br>
                        <input type="text" class="form-control" id="txtedRole" name="txtedRole"
                            placeholder="Masukkan nama role">
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

@endsection

@push('scripts')

{{-- aditional JS --}}

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>

function idr(value){
    return new Intl.NumberFormat("id", { style: "currency", currency: "IDR" }).format(value);
}

$('button#edit').on('click', function() {
    // alert('tes');
    var href = $(this).attr("href");
    var name = $(this).data("name");
    var user = $(this).data("user");
    var role = $(this).data("role");
    var email = $(this).data("email");
    $('#txtedName').val(name);
    $('#txtedUsername').val(user);
    $('#txtedRole').val(role);
    $('#txtedEmail').val(email);
    $('#updateForm').attr('action', href);
    $("#editUser").modal('show');
});

$('button#detailStatus').on('click', function() {
    var html = "";
    var level = $(this).data("level");
    var xp = $(this).data("xp");
    var rp = $(this).data("rp");
    var rpPending = $(this).data("rppending");

    html += "<tr>";
    html += "<td>" + level + "</td>";
    html += "<td>" + xp + "</td>";
    html += "<td>" + rp + "</td>";
    html += "<td>" + rpPending + "</td>";
    html += "</tr>";

    $('#table_isi_status').html(html);
    $("#detailStatusModal").modal('show');
});

$('button#detailRewards').on('click', function() {
    var html = "";
    var rewards = $(this).data("rewards");
    var index = 1;
    rewards.forEach(element => {
        html += "<tr>";
        html += "<td>" + index + "</td>";
        html += "<td>" + element.desc + "</td>";
        html += "<td>";
        if(element.type === "Voucher"){
            html += idr(element.value);
        }
        else if(element.type === "Diskon"){
            html += element.value + "%";
        }
        else{
            html += element.value;
        }
        html += "</td>";
        html += "<td>" + element.status + "</td>";
        html += "<td>" + element.date + "</td>";
        html += "</tr>";
        index++;
    });

    $('#table_isi_reward').html(html);
    $("#detailRewardsModal").modal('show');
});

$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var user = $(this).data('user');
    Swal.fire({
            title: "Anda yakin untuk menghapus data user : \"" + user + "\"?",
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

$('button#btneditrole').on('click', function() {
    // alert('tes');
    var href = $(this).attr("href");
    var role = $(this).data("role");
    $('#txtedRole').val(role);
    $('#updateFormRole').attr('action', href);
    $("#editRole").modal('show');
});

$('button#tambahrole').on('click', function(){
    $('#showRole').modal('hide');
});

$('#tambahRole').on('hidden.bs.modal', function(){
    $('#showRole').modal('show');
});

$('button#btneditrole').on('click', function(){
    $('#showRole').modal('hide');
});

$('#editRole').on('hidden.bs.modal', function(){
    $('#showRole').modal('show');
});

$('button#btndeleterole').on('click', function() {
    var href = $(this).attr('href');
    var role = $(this).data('role');
    Swal.fire({
            title: "Anda yakin untuk menghapus data role : \"" + role + "\"?",
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
