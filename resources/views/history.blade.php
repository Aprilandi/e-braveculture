@extends('default')
@push('style')
{{-- for a new css for this specific page --}}
<style>

    .center{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes spinner {
        0% {
          transform: translate3d(-50%, -50%, 0) rotate(0deg);
        }
        100% {
          transform: translate3d(-50%, -50%, 0) rotate(360deg);
        }
      }

    .spin::before {
        animation: 1.5s linear infinite spinner;
        animation-play-state: inherit;
        border: solid 5px #cfd0d1;
        border-bottom-color: #1c87c9;
        border-radius: 50%;
        content: "";
        height: 20px;
        width: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%, 0);
        will-change: transform;
    }

    .spin .spin_text {
        opacity: 100;
    }
</style>
@endpush

@section('pageContent')
<!-- Page Content -->
<div class="page-heading customize-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="text-content">
                    <h4>riwayat</h4>
                    <h2>pembelian</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="prize-list">
    <section id="cart_items" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters">
                        <ul>
                            <li class="active" data-filter="*"><a href="{{ route('history.index', ['user' => Auth::user()->username]) }}">Menunggu Pembayaran</a></li>
                            <li data-filter=".des"><a href="{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'terbayar']) }}">Terbayar</a></li>
                            <li data-filter=".des"><a href="{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'ditolak']) }}">Ditolak</a></li>
                            <li data-filter=".dev"><a href="{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'pelunasan']) }}">Menunggu Pelunasan</a></li>
                            <li data-filter=".dev"><a href="{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'dikirim']) }}">Terkirim</a></li>
                            <li data-filter=".gra"><a href="{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'selesai']) }}">Selesai</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="">Transaksi</td>
                                <td class="">Tanggal Transaksi</td>
                                <td class="description">Jumlah Barang</td>
                                <td class="price">Sub Total</td>
                                <td class="size">Ongkir</td>
                                <td class="quantity">Total</td>
                                <td class="quantity">DP</td>
                                @if(!empty($prefix))
                                <td class="quantity">Sudah Dibayar</td>
                                @endif
                                @if($prefix == "" || $prefix == "pelunasan" || $prefix == "ditolak")
                                <td class="quantity">Perlu Dibayar</td>
                                @endif
                                <td class="weight">Bukti Pembayaran</td>
                                @if($prefix == "dikirim" || $prefix == "selesai")
                                <td class="quantity">Points yang Diperoleh</td>
                                @else
                                <td class="quantity">Points yang akan Diperoleh</td>
                                @endif
                                @if($prefix == "dikirim")
                                <td class="total">Konfirmasi Barang Diterima</td>
                                @else
                                <td class="total">Batal</td>
                                @endif
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $row)
                            @php($pembayaran = App\Models\SaleTransactionPayments::where('id_sale', $row->id_sale)->sum('pembayaran'))
                            @php($bayar = $row->total - $pembayaran)
                            <tr onclick="detail({{$row->id_sale}})">
                                <td>Pembelian</td>
                                <td>{{ date('j F Y', strtotime($row->created_at)) }}</td>
                                <td>{{ $row->total_quantity }}</td>
                                <td>Rp {{ number_format($row->sub_total, '2', ',', '.') }}</td>
                                <td>Rp {{ number_format($row->shipping_fee, '2', ',', '.') }}</td>
                                <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                <td>{{ $row->dp }} %</td>
                                @if(!empty($prefix))
                                @if($prefix == 'pelunasan')
                                <td>Rp {{ number_format($row->saletransactionpayments->first()->pembayaran, '2', ',', '.') }}</td>
                                @endif
                                @endif
                                <td>
                                    @if(!empty($prefix))
                                    @if($prefix == 'pelunasan')
                                    Rp {{ number_format($bayar, '2', ',', '.') }}
                                    @endif
                                    @endif
                                    @if($prefix == "" || $prefix == "terbayar" || $prefix == "ditolak")
                                    Rp {{ number_format($row->saletransactionpayments->sum('pembayaran'), '2', ',', '.') }}
                                    @endif
                                    @if($prefix == "dikirim" || $prefix == "selesai")
                                    Rp {{ number_format($row->saletransactionpayments->sum('pembayaran'), '2', ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if($row->saletransactionpayments->first()->bukti_pembayaran == null || $prefix == 'pelunasan')
                                    <form enctype="multipart/form-data" method="post" id="formbukti{{ $row->id_sale_payments }}">
                                        <input type="file" name="inputBukti" data-transaksi="sale" data-id="{{ $row->id_sale_payments }}" id="{{ $row->id_sale_payments }}" data-bayar="{{ $bayar }}"/>
                                    </form>
                                    @else
                                    <div class="row">
                                        <div class="col-6">
                                            {{ !empty($row->saletransactionpayments->first()->bukti_pembayaran) ? substr($row->saletransactionpayments->first()->bukti_pembayaran, 0, strpos($row->saletransactionpayments->first()->bukti_pembayaran, ".")):'' }}
                                        </div>
                                        <div class="class-6">
                                            <button class="btn btn-light  btn-sm" id="detail"
                                            data-gambar=
                                            '[
                                                @foreach($row->saletransactionpayments as $key => $value)
                                                    "{{ !empty($value->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$value->bukti_pembayaran):'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'>
                                            {{-- "{{ !empty($row->saletransactionpayments->first()->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$row->saletransactionpayments->first()->bukti_pembayaran):'' }}"> --}}
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    {{ $row->perolehan_points }}
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="" data-id="{{ $row->id_sale }}"><i class="fa fa-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($order as $row)
                            @php($pembayaran = App\Models\OrderTransactionPayments::where('id_order', $row->id_order)->sum('pembayaran'))
                            @php($bayar = $row->total - $pembayaran)
                            <tr onclick="detail({{$row->id_order}})">
                                <td>Pemesanan</td>
                                <td>{{ date('j F Y', strtotime($row->created_at)) }}</td>
                                <td>{{ $row->total_quantity }}</td>
                                <td>Rp {{ number_format($row->sub_total, '2', ',', '.') }}</td>
                                <td>Rp {{ number_format($row->shipping_fee, '2', ',', '.') }}</td>
                                <td>Rp {{ number_format($row->total, '2', ',', '.') }}</td>
                                <td>{{ $row->dp }} %</td>
                                @if(!empty($prefix))
                                @if($prefix == 'pelunasan')
                                <td>Rp {{ number_format($row->ordertransactionpayments->first()->pembayaran, '2', ',', '.') }}</td>
                                @endif
                                @endif
                                <td>
                                    @if(!empty($prefix))
                                    @if($prefix == 'pelunasan')
                                    Rp {{ number_format($bayar, '2', ',', '.') }}
                                    @endif
                                    @endif
                                    @if($prefix == "" || $prefix == "terbayar")
                                    Rp {{ number_format($row->ordertransactionpayments->sum('pembayaran'), '2', ',', '.') }}
                                    @endif
                                    @if($prefix == "dikirim" || $prefix == "selesai")
                                    Rp {{ number_format($row->ordertransactionpayments->sum('pembayaran'), '2', ',', '.') }}
                                    @endif
                                </td>
                                <td>
                                    @if($row->ordertransactionpayments->first()->bukti_pembayaran == null || $prefix == 'pelunasan')
                                    <form enctype="multipart/form-data" method="post" id="formbukti{{ $row->id_order_payments }}">
                                        <input type="file" name="inputBukti" data-transaksi="order" data-id="{{ $row->id_order_payments }}" id="{{ $row->id_order_payments }}" data-bayar="{{ $bayar }}"/>
                                    </form>
                                    @else
                                    <div class="row">
                                        <div class="col-6">
                                            {{ !empty($row->ordertransactionpayments->first()->bukti_pembayaran) ? substr($row->ordertransactionpayments->first()->bukti_pembayaran, 0, strpos($row->ordertransactionpayments->first()->bukti_pembayaran, ".")):'' }}
                                        </div>
                                        <div class="class-6">
                                            <button class="btn btn-light  btn-sm" id="detail"
                                            data-gambar=
                                            '[
                                                @foreach($row->ordertransactionpayments as $key => $value)
                                                    "{{ !empty($value->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$value->bukti_pembayaran):'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'>
                                            {{-- "{{ !empty($row->ordertransactionpayments->first()->bukti_pembayaran) ? asset('images/bukti_pembayaran/'.$row->ordertransactionpayments->first()->bukti_pembayaran):'' }}"> --}}
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    {{ $row->perolehan_points }}
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="" data-id="{{ $row->id_order }}"><i class="fa fa-check"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section id="cart_items" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description">Produk</td>
                                <td class="price">Harga</td>
                                <td class="size">Ukuran</td>
                                <td class="quantity">Jumlah</td>
                                <td class="weight">Weight</td>
                                <td class="total">Total</td>
                            </tr>
                        </thead>
                        <tbody id="sale_details">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
{{-- Detail Gambar Transaksi --}}
<div id="detailGambarModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailGambarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailGambarLabel"><b>Bukti Transaksi</b></h5>
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

@endsection

@push('scripts')
<script>

    $('button#detail').on('click', function() {
        var gambar = $(this).data("gambar");

        var html = "";
        gambar.forEach((element, index) => {
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
        $("#detailGambarModal").modal('show');


    });

    // GANTI GAMBAR YG DI PAJANG DI MODAL BUKTI
    function changeThumb(id){
        document.getElementById("thumb_link").href = id.src;
        document.getElementById("thumb_img").src = id.src;
    }


    $('input[type="file"][name="inputBukti"]').on('change', function(){

        // console.log($('#'+$(this).data('id'))[0]);

        let formData = new FormData($("#formbukti" + $(this).data('id'))[0]);
        // console.log($("#formbukti" + $(this).data('id'))[0]);
        var id = $(this).data('id');
        var bayar = $(this).data('bayar');
        var transaksi = $(this).data('transaksi');
        formData.append('id', id);
        formData.append('bayar', bayar);
        formData.append('transaksi', transaksi);

        // console.log(id);

        var href = "{{ route('history.bukti', [Auth::user()->username]) }}"

        $.ajax({
            type:'post',
            url:href,
            data:formData,
            dataType: 'json',
            mimeType: "multipart/form-data",
            success:function(data){
                console.log(data);
                location.href = "{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'terbayar']) }}";
            },
            error:function(err){
                console.log(err.responseText);
                location.href = "{{ route('history.index', ['user' => Auth::user()->username, 'prefix' => 'terbayar']) }}";
            },
            cache: false,
            contentType: false,
            processData: false
        })
    });

    function detail(id_sale){
        var token = $('input[name=_token]').val();
        var a = "";
        var imgURL = "{{ asset('images/products/URI') }}";
        $.ajax({
            type:'POST',
            url:"{{ route('historydetails', [Auth::user()->username]) }}",
            data:{ id_sale:id_sale },
            dataType: 'json',
            success:function(data){
                // console.log(data[0]);
                for(var i = 0; i < data.length; i++){
                    var span = data[i]["details"].length;
                    a += "<tr>";
                    a += "<td rowspan='" + span + "'>" +
                        '<img style="width:250px; height:250px" src="' + imgURL.replace('URI', data[i]['image']) + '" alt="">' +
                        "</td>";
                    a += "<td rowspan='" + span + "'>" + data[i]['product_name'] + "</td>";
                    a += "<td rowspan='" + span + "'> Rp " + data[i]['product_price'] + "</td>";
                    for(var ii = 0; ii < data[i]['details'].length; ii++){
                        if(ii !== 0){
                            a += "<tr>";
                        }
                        a += "<td>" + data[i]['details'][ii]['product_size'] + "</td>";
                        a += "<td>" + data[i]['details'][ii]['product_quantity'] + "</td>";
                        a += "<td>" + data[i]['details'][ii]['product_weight'] + "</td>";
                        a += "<td> Rp " + data[i]['details'][ii]['total'] + "</td>";
                        a += "</tr>";
                    }
                }
                $('tbody#sale_details').html(a);
            },
            error:function(err){
                console.log(err.responseText);
            }
        });
    }
</script>
@endpush
