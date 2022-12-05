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
                    <h4>inside</h4>
                    <h2>your cart</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="prize-list">
    <section id="cart_items" style="margin-top: 50px">
        <div class="container">
            <div class="row">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Item</td>
                                <td class="description"></td>
                                <td class="price">Price</td>
                                <td class="size">Size</td>
                                <td class="quantity">Quantity</td>
                                <td class="weight">Weight</td>
                                <td class="total">Total</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if(session('cart'))
                            @foreach(session('cart') as $id => $row)
                            <?php $total = $row['product_price'] * $row['ttlQty']; ?>
                            @for($i = 0; $i < count($row['detail']); $i++)
                            <tr>
                                @if($i == 0)
                                <td @if(count($row['detail'])> 1) rowspan="{{count($row['detail'])}}" @endif
                                    >
                                    <a href="{{ asset('images/products/'.$row['image']) }}"><img
                                            style="width:250px; height:250px"
                                            src="{{ asset('images/products/'.$row['image']) }}" alt=""></a>
                                </td>
                                <td @if(count($row['detail'])> 1) rowspan="{{count($row['detail'])}}" @endif
                                    class="cart_description">
                                    <h4><a
                                            href="{{ route('product.detail', ['id' => $row['product_id']]) }}">{{ $row['product_name'] }}</a>
                                    </h4>
                                    <p>Web ID: {{ $row['product_id'] }}</p>
                                </td>
                                <td @if(count($row['detail'])> 1) rowspan="{{count($row['detail'])}}" @endif
                                    class="cart_price">
                                    <p>Rp {{ number_format($row['product_price'], '2', ',', '.') }}</p>
                                </td>
                                @endif
                                <td class="cart_description">
                                    <p>{{ $row['detail'][$i]['product_size'] }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" id="quantity"
                                            data-id="{{ $row['product_id'] }}"
                                            data-size="{{ $row['detail'][$i]['id_product_size'] }}"
                                            max="{{ $stock->find($row['product_id'])->details->where('id_product_size', '=', $row['detail'][$i]['id_product_size'])->first()->product_stock }}"
                                            value="{{ $row['detail'][$i]['quantity'] }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>
                                    </div>
                                </td>
                                <td class="cart_weight">
                                    <p>{{ $row['detail'][$i]['subTtlWgt'] }}</p>
                                </td>
                                @if($i == 0)
                                <td @if(count($row['detail'])> 1) rowspan="{{count($row['detail'])}}" @endif
                                    class="cart_total">
                                    <p class="cart_total_price">Rp {{ number_format($total, '2', ',', '.') }}</p>
                                </td>
                                @endif
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="" data-id="{{ $row['product_id'] }}"
                                        data-size="{{ $row['detail'][$i]['product_size'] }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endfor
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6">
                                    <p>There is Nothing In The Cart Right Now</p>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="margin-bottom:50px">
                <div class="col-md-10">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger" id="clearAll"><i class="fas fa-trash"></i> Clear</button>
                </div>
            </div>
        </div>
    </section>
	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="checkbox" id="cbDiskon">
                                                <label for="cbDiskon">Use Discount Voucher</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="checkbox" id="simpandata" {{ !empty(Auth::user()->alamat) ? 'checked':'' }}>
                                                <label for="simpandata">Simpan Data</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="txtDP">Pembayaran di Depan Muka</label>
                                        <select name="txtDP" id="txtDP">
                                            <option value="100">100%</option>
                                            <option value="75">75%</option>
                                            <option value="50">50%</option>
                                        </select>
                                    </div>
                                </div>
							</li>
						</ul>
						<ul class="user_info">
                            <div class="row" style="margin-bottom:5px">
                                <div class="col-sm-6">
                                    <label for="txtNama">Nama:</label>
                                    <input type="text" id="txtNama" value="{{ !empty(Auth::user()->name) ? Auth::user()->name:'' }}">
                                </div>
                                <div class="col-sm-6">
                                    <label for="txtNomer">Nomer Handphone:</label>
                                    <input type="text" id="txtNomer" value="{{ !empty(Auth::user()->nomer) ? Auth::user()->nomer:'' }}">
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:5px">
                                <div class="col-sm-8">
                                    <label for="txtAlamat">Alamat:</label>
                                    <input type="text" id="txtAlamat" value="{{ !empty(Auth::user()->alamat) ? Auth::user()->alamat:'' }}">
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="txtRT">RT:</label>
                                            <input type="text" id="txtRT" value="{{ !empty(Auth::user()->rt) ? Auth::user()->rt:'' }}">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="txtRW">RW:</label>
                                            <input type="text" id="txtRW" value="{{ !empty(Auth::user()->rw) ? Auth::user()->rw:'' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:5px">
                                <div class="col-sm-6">
                                    <label for="txtKel">Kelurahan/Desa:</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select id="selectKel">
                                                <option value="Kel" @if(!empty(Auth::user()->keldes)) @if(Auth::user()->keldes == 'Kel') selected @endif @endif>Kel:</option>
                                                <option value="Desa" @if(!empty(Auth::user()->keldes)) @if(Auth::user()->keldes == 'Desa') selected @endif @endif>Desa:</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" id="txtKel" value="{{ !empty(Auth::user()->isi_keldes) ? Auth::user()->isi_keldes:'' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="txtKec">Kecamatan:</label>
                                    <input type="text" id="txtKec" value="{{ !empty(Auth::user()->kecamatan) ? Auth::user()->kecamatan:'' }}">
                                </div>
                            </div>
                            <li class="single_field">
								<label for="txtProvinsi">Region / State:</label>
								<select id="txtProvinsi">
                                    @foreach($province as $row)
                                        <option value="{{ $row['province_id'] }}" data-provinsi="{{ $row['province'] }}" @if(!empty(Auth::user()->province_id)) @if(Auth::user()->province_id == $row['province_id']) selected @endif @endif>{{ $row['province'] }}</option>
                                    @endforeach
								</select>
							</li>
							<li class="single_field">
								<label for="txtKota">City:</label>
								<select id="txtKota">
									<option>Select</option>
								</select>

							</li>
							<li class="single_field zip-field">
								<label for="txtKodePos">Zip Code:</label>
								<input type="text" id="txtKodePos" readonly>
							</li>
						</ul>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="txtKurir">Layanan Kurir: </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <select id="txtKurir">
                                            <option value="jne" data-kurir="JNE">JNE</option>
                                            <option value="pos" data-kurir="POS Indonesia">POS Indonesia</option>
                                            <option value="tiki" data-kurir="TIKI">TIKI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="txtPaket">Layanan Paket: </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="spinners">
                                            <select id="txtPaket" class="spin_text">
                                                <option>Select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="total_area">
                                <ul>
                                    @if(session('cart')) @php($cart = session()->get('cart')) @endif
                                    <li>Cart Item Total <span id="subITL">@if(session('cart')) {{ array_sum(array_column($cart, "ttlQty")) }} @else 0 @endif</span></li>
                                    <li>Cart Weight Total <span id="subWgt">@if(session('cart')) {{ array_sum(array_column($cart, "ttlWgt")) }}g @else 0g @endif</span></li>
                                    <li>Cart Sub Total <span id="subTTL">@if(session('cart')) Rp {{ number_format(array_sum(array_column($cart, "ttlPrice")), "2", ",", ".") }} @else 0 @endif</span></li>
                                    <li>Shipping Cost <span id="shipFEE"></span></li>
                                    <li>Total <span id="TTL">@if(session('cart')) Rp {{ number_format(array_sum(array_column($cart, "ttlPrice")), "2", ",", ".") }} @else 0 @endif</span></li>
                                    <li>DP <span id="dpTTL"></li>
                                    <li>Diskon <span id="Dskn">0%</li>
                                    <li>Harus Dibayar <span id="bayarTTL">@if(session('cart')) Rp {{ number_format(array_sum(array_column($cart, "ttlPrice")), "2", ",", ".") }} @else 0 @endif</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 mt-10 mb-10">
                            {{-- <a class="btn btn-default update" href="">Update</a> --}}
                            <button class="btn btn-default check_out" id="btn_checkout" href="{{ route('checkout', ['user' => Auth::user()->username]) }}">Check Out</button>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
</div>
<form id="checkout_data" action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" id="data" name="data" hidden>
</form>
<!-- Modal List Voucher -->
<div id="showReward" name="showReward" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="showRewardLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="showRewardLabel"><b>List Reward yang dapat digunakan</b></h5>
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
                                <th>Keterangan</th>
                                <th>Isi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($isi = App\Models\RewardHistories::where('id_user', Auth::user()->id_user)->where('status',  'Not Claimed')->where('rewards.id_reward_type', 2)->join('rewards', 'reward_histories.id_reward', '=', 'rewards.id_reward')->get())
                            @php($number = 1)
                            @foreach($isi as $row)
                            <tr>
                                <td>{{ $number }}.</td>
                                <td>{{ !empty($row->rewards->desc) ? $row->rewards->desc:"" }}</td>
                                <td>{{ !empty($row->rewards->value) ? $row->rewards->value:"" }} %</td>
                                <td>{{ !empty($row->rewards->prize_point) ? $row->rewards->prize_point:"" }} Points</td>
                                <td><button class="btn btn-primary" style="margin-top:0px" name="btnRedeem" data-id="{{ $row->id_history }}" data-diskon="{{ $row->rewards->value }}" onclick="redeem(this)">Gunakan</button></td>
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
@endsection

@push('scripts')
{{-- if there is a new scripts for this specific page --}}
<script>
    var tl = 0;
    var diskon = 0;
    var id_diskon = 0;

    $('button#btn_checkout').on('click', function(e) {
        e.preventDefault();
        var data = {};
        var href = $(this).attr('href');
        var kurir = $('select#txtKurir option:selected').data('kurir');
        var paket = $('select#txtPaket option:selected').data('service');
        var dp = $('select#txtDP option:selected').val();
        var ongkir = $('select#txtPaket').val();
        var alamat = $('input#txtAlamat').val();
        var nomer = $('input#txtNomer').val();
        var provinsi = $('select#txtProvinsi option:selected').data('provinsi');
        var kota = $('select#txtKota option:selected').data('kota');
        var id_provinsi = $('select#txtProvinsi').val();
        var id_kota = $('select#txtKota').val();
        var kodepos = $('input#txtKodePos').val();
        var kel = $('select#selectKel').val() + ". " + $('input#txtKel').val();
        // alert($('select#selectKel').val());
        var kec = $('input#txtKec').val();
        var rt = $('input#txtRT').val();
        var rw = $('input#txtRW').val();
        var alamat_full = alamat + ", RT " + rt + "/RW " + rw + ", " + kel + ", Kec. " + kec + ", " + kota + ", " + provinsi + ", " + kodepos;
        data["paket"] = paket;
        data['kurir'] = kurir;
        data['ongkir'] = ongkir;
        data["alamat"] = alamat_full;
        data["dp"] = dp;
        data["diskon"] = id_diskon;
        if($('input#simpandata').is(':checked')){
            // alert('tes');
            data["id_provinsi"] = id_provinsi;
            data["id_kota"] = id_kota;
            data["alamat_user"] = alamat;
            data["nomer"] = nomer;
            data["keldes"] = $('select#selectKel').val();
            data["isi_keldes"] =  $('input#txtKel').val();
            data["kecamatan"] = kec;
            data["rt"] = rt;
            data["rw"] = rw;
        }
        $('input#data').val(JSON.stringify(data));
        $('form#checkout_data').attr('action', href);
        $('form#checkout_data').submit();
    });

    function idr(value){
        return new Intl.NumberFormat("id", { style: "currency", currency: "IDR" }).format(value);
    }

    var kota = [];

    function get_fee(){
        $('div#spinners').addClass('spin');
        $('select#txtPaket').prop('disabled', true);
        $('button#btn_checkout').prop('disabled', true);
        var token = $('input[name=_token]').val();
        var kota = $('select#txtKota').val();
        var kurir = $('select#txtKurir').val();
        var a = "";
        $.ajax({
            type:'POST',
            url:"{{ route('ongkir') }}",
            data:{txtKota:kota, txtKurir:kurir},
            dataType: 'json',
            success:function(data){
                console.log(data);
                $.each(data, function(key, value){
                    $.each(value.costs, function(key1, value1){
                        $.each(value1.cost, function(key2, value2){
                            a += "<option value='"+value2.value+"' data-service='"+value1.service+"'>"+value1.service+" - "+value2.value+" ( "+value1.description+" )</option>";
                        });
                    });
                });
                $('select#txtPaket').html(a);
                $('div#spinners').removeClass('spin');
                $('select#txtPaket').prop('disabled', false);
                $('button#btn_checkout').prop('disabled', false);
                change_fee();
                total_price();
            },
            error:function(err){
                console.log(err.responseText);
            }
        });
    }

    $('select#txtPaket').on('change', function(e) {
        change_fee();
        total_price();
    });

    function change_fee(){
        var b = $("select#txtPaket").val();
        $('span#shipFEE').html(idr(b));
    }

    $('select#txtKurir').on('change', function(e) {
        get_fee();
    })

    $('select#txtProvinsi').on('change', function(e) {
        var id = $(this).val();
        change_cities(id);
        get_kodepos();
        get_fee();
    });
    $(document).ready(function() {

        @if(!empty(Auth::user()->province_id))
        var province_id = "{{ !empty(Auth::user()->province_id) ? Auth::user()->province_id:'' }}";
        @else
        var province_id = undefined;
        @endif

        @if(!empty(Auth::user()->city_id))
        var city_id = "{{ !empty(Auth::user()->city_id) ? Auth::user()->city_id:'' }}";
        @else
        var city_id = undefined;
        @endif


        change_cities( province_id, city_id );
        // change_cities();
        get_kodepos();
        get_fee();
        change_dp();
        change_bayar();
    });
    function change_cities(id, id_kota){
        var a = "";
        var i = 0;
        var sts;
        if(id === undefined) { id = $('#txtProvinsi').val() }
        @foreach($city as $row)
            kota[i] = ['{{ $row["province_id"] }}', '{{ $row["city_id"] }}', '{{ $row["city_name"] }}', '{{ $row["postal_code"] }}'];
            i++;
        @endforeach
        for (let index = 0; index < kota.length; index++) {
            if( kota[index][0] === id){
                if( kota[index][1] === id_kota){
                    sts = "selected";
                }
                else{
                    sts = "";
                }
                a += "<option value='" + kota[index][1] + "' data-kota='" + kota[index][2] + "' " + sts + ">" + kota[index][2] + "</option>";
            }
        }
        // console.log(kota);
        // alert(a);
        document.getElementById('txtKota').innerHTML = a;
    }

    function change_dp(){
        var dp = $('select#txtDP option:selected').val();
        $('span#dpTTL').html(dp + "%");
    }

    $('select#txtDP').on('change', function(){
        change_dp();
        total_price();
    });

    function change_bayar(){
        var bayar = 0;

        if(tl === 0){
            bayar = @if(session('cart')) {{ array_sum(array_column($cart, "ttlPrice")) }} * ($('select#txtDP option:selected').val() / 100) @else 0 @endif;
            tl = @if(session('cart')) {{ array_sum(array_column($cart, "ttlPrice")) }} * ($('select#txtDP option:selected').val() / 100) @else 0 @endif;
        }
        else{
            bayar = Number(tl) * ($('select#txtDP option:selected').val() / 100);
        }

        $('span#bayarTTL').html(idr(bayar));
    }

    $('select#txtKota').on('change', function(e) {
        var id = $(this).val();
        get_kodepos(id);
        get_fee();
    });

    function get_kodepos(id){
        if(id === undefined) { id = $('#txtKota').val() }
        for (let index = 0; index < kota.length; index++) {
            if(id === kota[index][1]){
                $('#txtKodePos').val(kota[index][3]);
            }
        }
    }

    function total_price(){
        var sub = @if(session('cart')) {{ array_sum(array_column($cart, "ttlPrice")) }} @else 0 @endif;
        var fee = $('select#txtPaket').val();
        if(diskon !== 0){
            sub = Number(sub) - ( Number(sub) * (diskon / 100));
        }
        tl = Number(sub) + Number(fee);
        $('span#TTL').html(idr(tl));
        change_bayar();
    }

    $('a.cart_quantity_down').on('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input');
        var value = parseInt($input.val());

        if (value > 1) {
            value = value - 1;
        } else {
            value = 1;
        }

        $input.val(value);

        $("input").trigger('change');
    });

    $('a.cart_quantity_up').bind('click', function(e) {
        e.preventDefault();
        var $this = $(this);
        var $input = $this.closest('div').find('input');
        var value = parseInt($input.val());
        var max = parseInt($input.attr('max'));

        if (value < max) {
            value = value + 1;
        } else {
            value = max;
        }

        $input.val(value);

        $("input").trigger('change');
    });

    $("input#quantity").on('change', function(e) {
        e.preventDefault();
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
        if(parseInt($(this).val()) > parseInt($(this).attr("max"))){
            $(this).val(parseInt($(this).attr("max")));
        }
        else if(parseInt($(this).val()) < 1 || $(this).val() === ''){
            $(this).val(1);
        }
        else{
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        }
        // alert($(this).attr("name"));

        var ele = $(this);
        // alert(ele.parents("tr").find("#quantity").val());
        $.ajax({
            url: '{{ route("cart.update", ["user" => Auth::user()->username]) }}',
            method: "patch",
            data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), size: ele.attr("data-size"), quantity: ele.parents("tr").find("#quantity").val()},
            success: function (response) {
                console.log(response);
                window.location.reload();
            },
            error: function (response) {
                alert('error');
            }
        });
    });

    $(".cart_quantity_delete").click(function (e) {
        e.preventDefault();
        var ele = $(this);

        Swal.fire({
            title: 'Are you sure?',
            text: "Produk akan di hapus dari cart anda!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("cart.delete", ["user" => Auth::user()->username]) }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), size: ele.attr("data-size")},
                    success: function (response) {
                        // alert(response);
                        window.location.reload();
                    },
                    error: function (response) {
                        alert('error');
                    }
                });
            }
        });

        // if(confirm("Are you sure")) {
        //     $.ajax({
        //         url: '{{ route("cart.delete", ["user" => Auth::user()->username]) }}',
        //         method: "DELETE",
        //         data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), size: ele.attr("data-size")},
        //         success: function (response) {
        //             // alert(response);
        //             window.location.reload();
        //         },
        //         error: function (response) {
        //             alert('error');
        //         }
        //     });
        // }
    });

    $("button#clearAll").click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "Cart anda akan di kosongkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("cart.clear", ["user" => Auth::user()->username]) }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}'},
                    success: function (response) {
                        // alert(response);
                        window.location.reload();
                    },
                    error: function (response) {
                        alert('error');
                    }
                });
            }
        });
    });

    $('input#cbDiskon').click(function(e){
        // alert('tes');
        e.preventDefault();
        $('#showReward').modal('show');
    });

    function redeem(element){
        if(diskon !== 0){
            // alert('tes');
            unredeem($('button[name="btnRedeemed"]')[0]);
        }

        diskon = element.getAttribute('data-diskon');
        id_diskon = element.getAttribute('data-id');

        element.setAttribute('class', 'btn btn-success');
        element.innerHTML = 'Digunakan';
        element.setAttribute('name', 'btnRedeemed');
        element.setAttribute('onclick', 'unredeem(this)');
        $('input#cbDiskon').prop('checked', true);
        $('span#Dskn').html(diskon + "%");
        total_price();
    }

    function unredeem(element){
        diskon = 0;
        id_diskon = 0;

        element.setAttribute('class', 'btn btn-primary');
        element.innerHTML = 'Gunakan';
        element.setAttribute('name', 'btnRedeem');
        element.setAttribute('onclick', 'redeem(this)');
        $('input#cbDiskon').prop('checked', false);
        $('span#Dskn').html(diskon + "%");
        total_price();
    }

</script>
@endpush
