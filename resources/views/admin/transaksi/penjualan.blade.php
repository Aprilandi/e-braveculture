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
                        <div class="card-title float-right mb-12" id="xpbutton">
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
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Alamat</th>
                                        <th>Total Barang</th>
                                        <th>Sub Total</th>
                                        <th>Paket Kurir & Ongkir</th>
                                        <th>DP</th>
                                        <th>Diskon</th>
                                        <th>Total</th>
                                        <th>Terbayar</th>
                                        <th>Poin yang akan Diperoleh</th>
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
                                        <td>{{ !empty($row->voucher->rewards->value) ? $row->voucher->rewards->value:0 }}%</td>
                                        {{-- @php($terbayar = App\Models\SaleTransactionsPayments::where('id_sale', $row->id_sale)->select('pembayaran')->sum('pembayaran')) --}}
                                        <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->saletransactionpayments->sum('pembayaran'), '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->perolehan_points) ? $row->perolehan_points:0 }} + {{ !empty($row->bonus_points) ? $row->bonus_points:0 }} ( {{ !empty($row->persentase_bonus) ? $row->persentase_bonus:0 }}% ) = {{ $row->perolehan_points + $row->bonus_points }} Point</td>
                                        <td>
                                            <button class="btn btn-light btn-sm" id="bukti"
                                            {{-- @php($images = App\Models\ProductImages::where('id_product', $row->id_product)->get()) --}}
                                            data-bukti=
                                            '[
                                                @foreach($row->saletransactionpayments as $key => $value)
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
                                                    @php($listProduk = App\Models\SaleTransactionDetails::where('id_sale', $row->id_sale)->select('id_product')->groupBy('id_product')->get())
                                                    @foreach($listProduk as $row2)
                                                    {"gambar":"{{ $row2->products->images->first()->image }}", "nama":"{{ $row2->products->product_name }}", "ukuran":
                                                        [
                                                            @php($detailProduk = App\Models\SaleTransactionDetails::where('id_sale', $row->id_sale)->where('id_product', $row2->id_product)->get())
                                                            @foreach($detailProduk as $row3)
                                                            {"size":"{{ $row3->productsize->product_size }}", "unit":"{{ $row3->product_quantity }}"}
                                                            @if($loop->last != true)
                                                            ,
                                                            @endif
                                                            @endforeach
                                                        ]
                                                    }
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-user="{{ $row->user->name }}"
                                                data-tgl="{{ date('d/m/Y', strtotime($row->created_at)) }}"
                                            ><i class="fa fa-eye"> </i></button>

                                            <button class="btn btn-primary btn-sm" id="btnKonfirmasi" href="{{ route('penjualan.konfirmasi',  $row->id_sale) }}"
                                                data-tolak="{{ route('penjualan.tolak', $row->id_sale) }}" data-status="{{ $row->status_bayar }}"><i class="fa fa-edit"> </i></button>
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
                                        <th>Diskon</th>
                                        <th>Total</th>
                                        <th>Perlu Dibayar</th>
                                        <th>Poin yang akan Diperoleh</th>
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
                                        <td>{{ !empty($row->diskon->rewards->value) ? $row->diskon->rewards->value:0 }}%</td>
                                        {{-- @php($terbayar = App\Models\SaleTransactionsPayments::where('id_sale', $row->id_sale)->select('pembayaran')->sum('pembayaran')) --}}
                                        <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->saletransactionpayments->sum('pembayaran'), '2', ',', '.') }}</td>
                                        <td>{{ !empty($row->perolehan_points) ? $row->perolehan_points:0 }} + {{ !empty($row->bonus_points) ? $row->bonus_points:0 }} ( {{ !empty($row->persentase_bonus) ? $row->persentase_bonus:0 }}% ) = {{ $row->perolehan_points + $row->bonus_points }} Point</td>
                                        <td>@if($row->saletransactionpayments->first()->bukti_pembayaran == null)Menunggu Pembayaran... @else Menunggu Pelunasan... @endif</td>
                                        <td class="text-center">
                                            <button class="btn btn-light btn-sm" id="detail"
                                                data-detail=
                                                '[
                                                    @php($listProduk = App\Models\SaleTransactionDetails::where('id_sale', $row->id_sale)->select('id_product')->groupBy('id_product')->get())
                                                    @foreach($listProduk as $row2)
                                                    {"gambar":"{{ $row2->products->images->first()->image }}", "nama":"{{ $row2->products->product_name }}", "ukuran":
                                                        [
                                                            @php($detailProduk = App\Models\SaleTransactionDetails::where('id_sale', $row->id_sale)->where('id_product', $row2->id_product)->get())
                                                            @foreach($detailProduk as $row3)
                                                            {"size":"{{ $row3->productsize->product_size }}", "unit":"{{ $row3->product_quantity }}"}
                                                            @if($loop->last != true)
                                                            ,
                                                            @endif
                                                            @endforeach
                                                        ]
                                                    }
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
                                        <th>Diskon</th>
                                        <th>Total</th>
                                        <th>Terbayar</th>
                                        <th>Poin yang Diperoleh</th>
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
                                        <td>{{ !empty($row->voucher->rewards->value) ? $row->voucher->rewards->value:0 }}%</td>
                                        {{-- @php($terbayar = App\Models\SaleTransactionsPayments::where('id_sale', $row->id_sale)->select('pembayaran')->sum('pembayaran')) --}}
                                        <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                        <td>Rp {{ number_format($row->saletransactionpayments->sum('pembayaran'), '2', ',', '.') }}
                                        <button class="btn btn-light btn-sm" id="bukti"
                                            data-bukti=
                                            '[
                                                @foreach($row->saletransactionpayments as $key => $value)
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
                                        <td>{{ !empty($row->no_resi) ? $row->no_resi:"" }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-light btn-sm" id="detail"
                                                data-detail=
                                                '[
                                                    @php($listProduk = App\Models\SaleTransactionDetails::where('id_sale', $row->id_sale)->select('id_product')->groupBy('id_product')->get())
                                                    @foreach($listProduk as $row2)
                                                    {"gambar":"{{ $row2->products->images->first()->image }}", "nama":"{{ $row2->products->product_name }}", "ukuran":
                                                        [
                                                            @php($detailProduk = App\Models\SaleTransactionDetails::where('id_sale', $row->id_sale)->where('id_product', $row2->id_product)->get())
                                                            @foreach($detailProduk as $row3)
                                                            {"size":"{{ $row3->productsize->product_size }}", "unit":"{{ $row3->product_quantity }}"}
                                                            @if($loop->last != true)
                                                            ,
                                                            @endif
                                                            @endforeach
                                                        ]
                                                    }
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
@endsection

@push('scripts')

{{-- aditional JS --}}
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>

$('button#btnKonfirmasi').on('click', function() {
    // alert('tes');
    var status = $(this).data("status");
    var href = $(this).attr('href');
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
    var imgURL = "{{ asset('images/products/variable') }}";
    $('b#nama').html(user + " ");
    $('b#tgl').html(tgl);

    var html = "";
    detail.forEach(element => {
        html += "<tr>";
        // console.log(element.ukuran.length);
        html += "<td rowspan='2'><img src='" + imgURL.replace('variable', element.gambar) + "' style='width:100px;height:100px;'></td>";
        html += "<td>Nama Produk</td>";
        html += "<td>:</td>";
        html += "<td>" + element.nama + "</td>";
        html += "</tr>";
        html += "<tr>";
        html += "<td>Ukuran Produk</td>";
        html += "<td>:</td>";
        html += "<td>";
        element.ukuran.forEach((element2, index) => {
            html += element2.size + " : " + element2.unit + " unit";
            if(index < ( element.ukuran.length - 1 )){
                html += ", ";
            }
        });
        html += "</td>";
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

@endpush
