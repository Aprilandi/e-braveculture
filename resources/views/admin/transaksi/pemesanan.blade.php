@extends('admin.admin')
@push('style')
{{-- aditional style --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{ asset('css/frontend/frontStyles.css') }}">
<style>
    .scene {
        overflow: hidden;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .relative {
        position: relative;
    }

    .h-256 {
        height: 50vh;
    }

    .w-256 {
        width: 1140px;
    }
</style>
@endpush

@section('content')

<div class="home-content">
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Konfirmasi Transaksi -->
            <div id="konfirmasiTransaksi" name="konfirmasiTransaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="konfirmasiTransaksiLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="konfirmasiTransaksiLabel"><b>Pengiriman Transaksi </b><b id="nama_pembeli"></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtNomerResi">Nomor Resi Paket</label><br>
                                    <input type="text" class="form-control" id="txtNomerResi" name="txtNomerResi"
                                        placeholder="Masukkan nomer resi paket">
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger" id="btnTolak">Tolak</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Transaksi Terbayar --}}
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <h4 class="card-title" style="display:inline-block;">Transaksi Pembelian Yang Sudah Terbayar</h4>
                        <div class="card-title float-right mb-12" id="xpbutton"></div>
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
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Alamat</th>
                                        <th>Total Barang</th>
                                        <th>Sub Total</th>
                                        <th>Paket Kurir & Ongkir</th>
                                        <th>DP</th>
                                        <th>Voucher</th>
                                        <th>Total</th>
                                        <th>Terbayar</th>
                                        <th>Poin yang akan Diperoleh</th>
                                        <th>Model Sablon</th>
                                        <th>Bukti Pembayaran</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($terbayar as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ date('j F Y', strtotime($row->created_at)) }}</td>
                                        <td>{{ !empty($row->user->name) ? $row->user->name:"" }}</td>
                                        <td>{{ !empty($row->alamat_penuh) ? $row->alamat_penuh:"" }}</td>
                                        <td>{{ !empty($row->total_quantity) ? $row->total_quantity:"" }}</td>
                                        <td>Rp {{ number_format($row->sub_total, '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->kurir) ? $row->kurir:"" }} : {{ !empty($row->paket) ? $row->paket:"" }} Rp {{ number_format($row->shipping_fee, '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->dp) ? $row->dp:"" }}%</td>
                                        <td>Rp {{ !empty($row->voucher->rewards->value) ? number_format($row->voucher->rewards->value, '2', ',', '.'):number_format(0, '2', ',', '.') }}</td>
                                        {{-- @php($terbayar = App\Models\SaleTransactionsPayments::where('id_sale', $row->id_sale)->select('pembayaran')->sum('pembayaran')) --}}
                                        <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->ordertransactionpayments->sum('pembayaran'), '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->perolehan_points) ? $row->perolehan_points:0 }} + {{ !empty($row->bonus_points) ? $row->bonus_points:0 }} ( {{ !empty($row->persentase_bonus) ? $row->persentase_bonus:0 }}% ) = {{ $row->perolehan_points + $row->bonus_points }} Point</td>
                                        <td>
                                            <button class="btn btn-light btn-sm" name="model3d" data-model="{{ !empty($row->model_3d_json) ? $row->model_3d_json:'' }}" data-height="{{ $row->canvas_height }}" data-width="{{ $row->canvas_width }}">
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-light btn-sm" id="bukti"
                                            {{-- @php($images = App\Models\ProductImages::where('id_product', $row->id_product)->get()) --}}
                                            data-bukti=
                                            '[
                                                @foreach($row->ordertransactionpayments as $key => $value)
                                                    "{{ !empty($value->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$value->bukti_pembayaran):'' }}"
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
                                            <button class="btn btn-light btn-sm" id="detail"
                                                data-detail=
                                                '[
                                                    @php($listUkuran = App\Models\OrderTransactionDetails::where('id_order', $row->id_order)->get())
                                                    @foreach($listUkuran as $row2)
                                                    {"size":"{{ $row2->size }}", "jumlah":"{{ $row2->product_quantity }}"}
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-user="{{ $row->user->name }}"
                                                data-tgl="{{ date('d/m/Y', strtotime($row->created_at)) }}"
                                            ><i class="fa fa-eye"> </i></button>

                                            <button class="btn btn-primary btn-sm" id="btnKonfirmasi" href="{{ route('pemesanan.konfirmasi',  $row->id_order) }}"
                                                data-tolak="{{ route('pemesanan.tolak', $row->id_order) }}" data-status="{{ $row->status_bayar }}"><i class="fa fa-edit"> </i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    $number++;
                                    ?>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$terbayar->appends(['terbayar' => $terbayar->currentPage()])->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Transaksi menunggu pembayaran --}}
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <h4 class="card-title" style="display:inline-block;">Transaksi Pembelian Menunggu Pembayaran</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                        </div>
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
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Alamat</th>
                                        <th>Total Barang</th>
                                        <th>Sub Total</th>
                                        <th>Paket Kurir & Ongkir</th>
                                        <th>DP</th>
                                        <th>Voucher</th>
                                        <th>Total</th>
                                        <th>Terbayar</th>
                                        <th>Poin yang akan Diperoleh</th>
                                        <th>Model Sablon</th>
                                        <th>Bukti Pembayaran</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($menunggu as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ date('j F Y', strtotime($row->created_at)) }}</td>
                                        <td>{{ !empty($row->user->name) ? $row->user->name:"" }}</td>
                                        <td>{{ !empty($row->alamat_penuh) ? $row->alamat_penuh:"" }}</td>
                                        <td>{{ !empty($row->total_quantity) ? $row->total_quantity:"" }}</td>
                                        <td>Rp {{ number_format($row->sub_total, '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->kurir) ? $row->kurir:"" }} : {{ !empty($row->paket) ? $row->paket:"" }} Rp {{ number_format($row->shipping_fee, '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->dp) ? $row->dp:"" }}%</td>
                                        <td>Rp {{ !empty($row->voucher->rewards->value) ? number_format($row->voucher->rewards->value, '2', ',', '.'):number_format(0, '2', ',', '.') }}</td>
                                        {{-- @php($terbayar = App\Models\SaleTransactionsPayments::where('id_sale', $row->id_sale)->select('pembayaran')->sum('pembayaran')) --}}
                                        <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->ordertransactionpayments->sum('pembayaran'), '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->perolehan_points) ? $row->perolehan_points:0 }} + {{ !empty($row->bonus_points) ? $row->bonus_points:0 }} ( {{ !empty($row->persentase_bonus) ? $row->persentase_bonus:0 }}% ) = {{ $row->perolehan_points + $row->bonus_points }} Point</td>
                                        <td>
                                            <button class="btn btn-light btn-sm" name="model3d" data-model="{{ !empty($row->model_3d_json) ? $row->model_3d_json:'' }}" data-height="{{ $row->canvas_height }}" data-width="{{ $row->canvas_width }}">
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td>@if($row->ordertransactionpayments->first()->bukti_pembayaran == null)Menunggu Pembayaran... @else Menunggu Pelunasan... @endif</td>
                                        <td class="text-center">
                                            <button class="btn btn-light btn-sm" id="detail"
                                                data-detail=
                                                '[
                                                    @php($listUkuran = App\Models\OrderTransactionDetails::where('id_order', $row->id_order)->get())
                                                    @foreach($listUkuran as $row2)
                                                    {"size":"{{ $row2->size }}", "jumlah":"{{ $row2->product_quantity }}"}
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-user="{{ $row->user->name }}"
                                                data-tgl="{{ date('d/m/Y', strtotime($row->created_at)) }}"
                                            ><i class="fa fa-eye"> </i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    $number++;
                                    ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$menunggu->appends(['menunggu' => $menunggu->currentPage()])->links()}}
                    </div>
                </div>
            </div>
        </div>
        {{-- Transaksi terkirim --}}
        <div class="row">
            <div class="col-12">
                <div class="material-card card">
                    <div class="card-body">
                        <h4 class="card-title" style="display:inline-block;">Transaksi Terkirim</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                        </div>
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
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Alamat</th>
                                        <th>Total Barang</th>
                                        <th>Sub Total</th>
                                        <th>Paket Kurir & Ongkir</th>
                                        <th>DP</th>
                                        <th>Voucher</th>
                                        <th>Total</th>
                                        <th>Terbayar</th>
                                        <th>Poin yang Diperoleh</th>
                                        <th>Model Sablon</th>
                                        <th>Nomer Resi</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    @foreach($dikirim as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ date('j F Y', strtotime($row->created_at)) }}</td>
                                        <td>{{ !empty($row->user->name) ? $row->user->name:"" }}</td>
                                        <td>{{ !empty($row->alamat_penuh) ? $row->alamat_penuh:"" }}</td>
                                        <td>{{ !empty($row->total_quantity) ? $row->total_quantity:"" }}</td>
                                        <td>Rp {{ number_format($row->sub_total, '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->kurir) ? $row->kurir:"" }} : {{ !empty($row->paket) ? $row->paket:"" }} Rp {{ number_format($row->shipping_fee, '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->dp) ? $row->dp:"" }}%</td>
                                        <td>Rp {{ !empty($row->voucher->rewards->value) ? number_format($row->voucher->rewards->value, '2', ',', '.'):number_format(0, '2', ',', '.') }}</td>
                                        {{-- @php($terbayar = App\Models\SaleTransactionsPayments::where('id_sale', $row->id_sale)->select('pembayaran')->sum('pembayaran')) --}}
                                        <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->ordertransactionpayments->sum('pembayaran'), '2', ',', '.') }}
                                        <button class="btn btn-light btn-sm" id="bukti"
                                            data-bukti=
                                            '[
                                                @foreach($row->ordertransactionpayments as $key => $value)
                                                    "{{ !empty($value->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$value->bukti_pembayaran):'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'
                                            >
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td>{{ !empty($row->perolehan_points) ? $row->perolehan_points:0 }} + {{ !empty($row->bonus_points) ? $row->bonus_points:0 }} ( {{ !empty($row->persentase_bonus) ? $row->persentase_bonus:0 }}% ) = {{ $row->perolehan_points + $row->bonus_points }} Point</td>
                                        <td>
                                            <button class="btn btn-light btn-sm" name="model3d" data-model="{{ !empty($row->model_3d_json) ? $row->model_3d_json:'' }}" data-height="{{ $row->canvas_height }}" data-width="{{ $row->canvas_width }}">
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td>{{ !empty($row->no_resi) ? $row->no_resi:"" }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-light btn-sm" id="detail"
                                                data-detail=
                                                '[
                                                    @php($listUkuran = App\Models\OrderTransactionDetails::where('id_order', $row->id_order)->get())
                                                    @foreach($listUkuran as $row2)
                                                    {"size":"{{ $row2->size }}", "jumlah":"{{ $row2->product_quantity }}"}
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-user="{{ $row->user->name }}"
                                                data-tgl="{{ date('d/m/Y', strtotime($row->created_at)) }}"
                                            ><i class="fa fa-eye"> </i></button>
                                        </td>
                                    </tr>
                                    <?php
                                    $number++;
                                    ?>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$dikirim->appends(['dikirim' => $dikirim->currentPage()])->links()}}                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="post" id="tolakForm">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
</form>

{{-- Bukti Pembayaran --}}
<div id="buktiModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="buktiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buktiLabel"><b>List Bukti Pembayaran</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-sm-6 mb-sm-40"><a class="gallery" id="thumb_link"
                                href="">
                                <img id="thumb_img"
                                    style="width: 640px; height:640px; margin-bottom:10px"
                                    src=""
                                    alt="Single Product Image" /></a>
                            <ul class="product-gallery" id="list_gambar">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail Transaksi --}}
<div id="detailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailLabel"><b>Detail Transaksi : </b><b id="nama"></b><b id="tgl"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody id="isiDetail">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Model 3D --}}
{{-- <div id="modelModal" class="modal fade model__3d" tabindex="-1" role="dialog" aria-labelledby="modelLabel"
    aria-hidden="true">
    <div class="model__3d__wrapper" role="document">
        <div class="modal-content modal__content__3d">
            <div class="modal-header">
                <h5 class="modal-title" id="modelLabel"><b>Model Sablon : </b><b id="nama"></b><b id="tgl"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal__canvas__3d">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="container">
                                 Radio Button Baju
                                <div id="baju" class="pilihan">
                                    <div class="row">
                                        <div class="col">
                                            <label><input type="radio" name="bagian" value="Depan" checked /> Depan</label>
                                        </div>
                                        <div class="col">
                                            <label><input type="radio" name="bagian" value="Belakang"> Belakang</label>
                                        </div>
                                        <div class="col">
                                            <label><input type="radio" name="bagian" value="Kanan"> Lengan Kanan</label>
                                        </div>
                                        <div class="col">
                                            <label><input type="radio" name="bagian" value="Kiri"> Lengan Kiri</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="left-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="relative h-256">
                                                <div id="showDepan" class="hideCanvas">
                                                    <div id="scene">
                                                        <canvas class="config" id="depan"></canvas>
                                                    </div>
                                                </div>
                                                <div id="showBelakang" class="hideCanvas" style="display:none">
                                                    <div id="scene">
                                                        <canvas class="config" id="belakang"></canvas>
                                                    </div>
                                                </div>
                                                <div id="showKanan" class="hideCanvas" style="display:none">
                                                    <div id="scene">
                                                        <canvas class="config" id="kanan"></canvas>
                                                    </div>
                                                </div>
                                                <div id="showKiri" class="hideCanvas" style="display:none">
                                                    <div id="scene">
                                                        <canvas class="config" id="kiri"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="right-content">
                                    <div class="relative h-256">
                                        <div id="scene">
                                            <canvas id="model"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- Modal Model 3d V2 --}}
{{-- <div id="moodelModal" class="modal fade model__3d" tabindex="-1" role="dialog" aria-labelledby="moodelLabel"
    aria-hidden="true">
    <div class="model__3d__wrapper" role="document">
        <div class="modal-content">
            <div class="modal__content__3d">
                <h5 class="modal-title" id="moodelLabel">
                    <b>Model 3d : </b><b id="nama"></b><b id="tgl"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal__canvas__3d">
             Modal Canvas Container
                <div class="modal__3d__canvas--container">
                    <div class="modal__section__option">
                         Radio Button Baju
                        <div id="baju" class="pilihan__3d">
                            <div class="row">
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Depan" checked /> Depan</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Belakang"> Belakang</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Kanan"> Lengan Kanan</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Kiri"> Lengan Kiri</label>
                                </div>
                            </div>
                        </div>
                    </div>
                     Canvas 3D MODEL
                    <div class="canvas__model__3d">
                        <div id="showDepan" class="hideCanvas">
                            <div id="scene">
                                <canvas class="config" id="depan"></canvas>
                            </div>
                        </div>
                        <div id="showBelakang" class="hideCanvas" style="display:none">
                            <div id="scene">
                                <canvas class="config" id="belakang"></canvas>
                            </div>
                        </div>
                        <div id="showKanan" class="hideCanvas" style="display:none">
                            <div id="scene">
                                <canvas class="config" id="kanan"></canvas>
                            </div>
                        </div>
                        <div id="showKiri" class="hideCanvas" style="display:none">
                            <div id="scene">
                                <canvas class="config" id="kiri"></canvas>
                            </div>
                        </div>
                    </div>
                     END  Canvas 3D MODEL
                </div>
             End Modal Canvas Container
            </div>
        </div>
    </div>
</div> --}}

{{-- 3D Trial Error --}}
<div id="moodelModal" class="modal fade model__3" tabindex="-1" role="dialog" aria-labelledby="moodelLabel"
    aria-hidden="true">
    <div class="model__3d__wrapper" role="document">
        <div class="modal-content">
            <div class="modal-header modal__header__3d">
                <h5 class="modal-title" id="moodelLabel"><b>Detail Transaksi : </b><b id="nama"></b><b id="tgl"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container">
                        {{-- Radio Button Baju --}}
                        <div id="baju" class="pilihan">
                            <div class="row">
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Depan" checked /> Depan</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Belakang"> Belakang</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Kanan"> Lengan Kanan</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Kiri"> Lengan Kiri</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="left-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="relative h-256" id="canvasJSON">
                                        <div id="showDepan" class="hideCanvas">
                                            <div id="scene">
                                                <canvas class="config" id="depan" style="border: 2px solid #000"></canvas>
                                            </div>
                                        </div>
                                        <div id="showBelakang" class="hideCanvas" style="display:none">
                                            <div id="scene">
                                                <canvas class="config" id="belakang"></canvas>
                                            </div>
                                        </div>
                                        <div id="showKanan" class="hideCanvas" style="display:none">
                                            <div id="scene">
                                                <canvas class="config" id="kanan"></canvas>
                                            </div>
                                        </div>
                                        <div id="showKiri" class="hideCanvas" style="display:none">
                                            <div id="scene">
                                                <canvas class="config" id="kiri"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-content">
                            <div class="relative h-256">
                                <div id="scene">
                                    <canvas id="model"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODEL MODAL --}}
{{--  <div id="moodelModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="moodelLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="moodelLabel"><b>Detail Transaksi : </b><b id="nama"></b><b id="tgl"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="container">
                         Radio Button Baju
                        <div id="baju" class="pilihan">
                            <div class="row">
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Depan" checked /> Depan</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Belakang"> Belakang</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Kanan"> Lengan Kanan</label>
                                </div>
                                <div class="col">
                                    <label><input type="radio" name="bagian" value="Kiri"> Lengan Kiri</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="left-content">
                            <div class="relative h-256">
                                <div id="showDepan" class="hideCanvas">
                                    <div class="scene">
                                        <canvas class="config" id="depan"></canvas>
                                    </div>
                                </div>
                                <div id="showBelakang" class="hideCanvas" style="display:none">
                                    <div class="scene">
                                        <canvas class="config" id="belakang"></canvas>
                                    </div>
                                </div>
                                <div id="showKanan" class="hideCanvas" style="display:none">
                                    <div class="scene">
                                        <canvas class="config" id="kanan"></canvas>
                                    </div>
                                </div>
                                <div id="showKiri" class="hideCanvas" style="display:none">
                                    <div class="scene">
                                        <canvas class="config" id="kiri"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="right-content">
                            <div class="relative h-256">
                                <div class="scene">
                                    <canvas id="model"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  --}}

@endsection

@push('scripts')

{{-- aditional JS --}}
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script src="{{ asset('js/fabric.min.js') }}"></script>

<script src="{{ asset('js/3d_fabric.js') }}"></script>

<script>
    const module = {};
</script>

<script type="module">
    import { innit } from "{{ asset('js/3d_model.js') }}";
    import { getCanvas } from "{{ asset('js/3d_model.js') }}";
    import { loadModel } from "{{ asset('js/3d_model.js') }}";
    module.innit = innit;
    module.getCanvas = getCanvas;
    module.loadModel = loadModel;
</script>

<script>

$('button#btnKonfirmasi').on('click', function() {
    // alert('tes');
    var status = $(this).data("status");
    var href = $(this).attr('href');
    var tolak = $(this).data('tolak');
    $('#txtedNamaKain').val(nama);
    if(status == "Belum Lunas"){
        var status = "Kirim Notifikasi untuk melunasi pembayaran";
        $('#txtNomerResi').val(status);
        $('#txtNomerResi').attr('disabled', 'disabled');
    }
    else{
        $('#txtNomerResi').val("");
        $('#txtNomerResi').removeAttr('disabled', 'disabled');
    }
    $('#btnTolak').attr('data-href', tolak);
    $('#updateForm').attr('action', href);
    $("#konfirmasiTransaksi").modal('show');
});

$('button#btnTolak').on('click', function() {
    var href = $(this).data('href');
    Swal.fire({
            title: "Anda yakin untuk menolak transaksi ini?",
            text: "Tolak transaksi ini dan kirim notifikasi untuk mengupload ulang bukti pembayaran!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya, hapus'
        })
        .then((willDelete) => {
            if (willDelete.value) {
                $('#tolakForm').attr('action', href);
                $('#tolakForm').submit();
            }
        })
});

// MODAL DETAIL
$('button#detail').on('click', function() {
    var detail = $(this).data('detail');
    var user = $(this).data('user');
    var tgl = $(this).data('tgl');
    // var imgURL = "{{ asset('images/products/variable') }}";
    $('b#nama').html(user + " ");
    $('b#tgl').html(tgl);

    var html = "";
    detail.forEach(element => {
        html += "<tr>";
        // console.log(element.ukuran.length);
        html += "<td>Ukuran : " + element.size + "</td>";
        html += "<td>" + element.jumlah + " Unit</td>";
        html += "</tr>";
    });

    $('tbody#isiDetail').html(html);

    $('#detailModal').modal('show');
});

// MODAL BUKTI
$('button#bukti').on('click', function() {
    var bukti = $(this).data("bukti");
    // console.log(bukti);
    var html = "";
    // console.log(bukti);
    bukti.forEach((element, index) => {
        if(index == 0){
            $('#thumb_link').attr('href', element);
            $('#thumb_img').attr('src', element);
        }
        html += "<li>";
        html += "<a class='gallery' href='" + element + "'></a>";
        html += "<img onclick='changeThumb(this)' style='width:60px; height:60px; margin-bottom:10px' src='" + element + "' alt='Single Product' />";
        html += "</li>";
    });

    $('#list_gambar').html(html);
    $("#buktiModal").modal('show');
});

// GANTI GAMBAR YG DI PAJANG DI MODAL BUKTI
function changeThumb(id){
    document.getElementById("thumb_link").href = id.src;
    document.getElementById("thumb_img").src = id.src;
}

</script>

{{-- Script 3d Model --}}
<script>
    var bg_depan = '{{ asset("images/company/model/t_shirts_male_front.png") }}';
    var bg_belakang = '{{ asset("images/company/model/t_shirts_male_back.png") }}';
    var bg_kanan = '{{ asset("images/company/model/t_shirts_male_right.png") }}';
    var bg_kiri = '{{ asset("images/company/model/t_shirts_male_left.png") }}';
    var model = '{{ asset("images/company/model/coba.gltf")}}';
    var srcBtnHapus = '{{ asset("images/random/CanceledX.png") }}';
    function getModel(url){
        fetch(url)
        .then(
            function(u){ return u.json();}
        )
        .then(
            function(json){
                // console.log(json);
                loadCanvas(json);
            }
        )
    }
    $('button[name="model3d"]').on('click', function(e){
        // getModel('{{ asset("images/design/2022-09-05-user.json")}}');
        let html = "";
        html += '<div id="showDepan" class="hideCanvas">';
        html += '<div id="scene">';
        html += '<canvas class="config" id="depan" style="border: 2px solid #000"></canvas>';
        html += '</div>';
        html += '</div>';
        html += '<div id="showBelakang" class="hideCanvas" style="display:none">';
        html += '<div id="scene">';
        html += '<canvas class="config" id="belakang"></canvas>';
        html += '</div>';
        html += '</div>';
        html += '<div id="showKanan" class="hideCanvas" style="display:none">';
        html += '<div id="scene">';
        html += '<canvas class="config" id="kanan"></canvas>';
        html += '</div>';
        html += '</div>';
        html += '<div id="showKiri" class="hideCanvas" style="display:none">';
        html += '<div id="scene">';
        html += '<canvas class="config" id="kiri"></canvas>';
        html += '</div>';
        html += '</div>';

        $('#canvasJSON').html(html);
        var json = $(this).data('model');
        var url = "{{ asset('images/design/name') }}"
        var width = $(this).data('width');
        var height = $(this).data('height');
        $('.config').width(width);
        $('.config').height(height);
        $('.scene').width(width);
        $('.scene').height(height);
        setCanvas(width, height);
        getModel(url.replace("name", json));
        module.innit(width, height);
        module.getCanvas();
        module.loadModel();
        $('#moodelModal').modal('show');
    });
    // console.log(getModel('{{ asset("images/design/2022-09-04-user.json")}}'));
    // console.log(json_3d_model);
</script>


@endpush
