@extends('default')
@push('style')
{{--  for a new css for this specific page --}}
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

    .upload-wrapper{
        float: left;
        width: 100%;
        margin-top: 2.5%;
    }

    .upload-wrapper label{
        float: left;
        width: 100%;
        border-radius: 10px;
        padding: 250px 40px 5px 40px;
        text-align: center;
        background: url('{{ asset("images/company/upload_files.jpg") }}') top center no-repeat #fff;
        background-size: 300px;
        position: relative;
        box-shadow: 5px 5px 0px #ffbe32, -5px -5px 0px #32adff;
    }

    .upload-wrapper label > input[type="file"]{
        display: none;
    }

    .upload-wrapper label p{
        font-size: 20px;
        font-weight: 300;
        margin-top: 50px;
    }

    .upload-wrapper label p a{
        font-weight: 700;
        color: #007bff;
    }


    .image-gallery {
        float: left;
        width: 100%;
        margin-top: 20px;
    }

    .image-gallery .thumb-Images {
        float: left;
        width: 100%;
    }

    .image-gallery .thumb-Images li {
        float: left;
        width: 100%;
        background: #fff;
        border-radius: 10px;
        display: flex;
        padding: 10px 10px;
        margin-bottom: 30px;
        position: relative;
        box-shadow: -10px -10px 0px #ffbe32, 10px 10px 10px rgba(0, 0, 0, 0.1);
    }

    .image-gallery .thumb-Images li .file-info {
        display: inline-block;
        font-size: 15px;
        font-weight: 400;
        width: 70%;
        text-overflow: ellipsis;
        white-space: nowrap;
        line-height: 30px;
    }

    .image-gallery .thumb-Images li .img-wrap {
        margin-right: 10px;
    }

    .image-gallery .thumb-Images li .img-wrap img.thumb{
        height: 30px;
        width: 30px;
        border-radius: 30px;
        margin-left: 5px;
        cursor: pointer;
        box-shadow: 0 1px 1px rgba(0,0,0,0.15);
    }

    .image-gallery .thumb-Images li .img-wrap .close{
        position: absolute;
        right: 12px;
        color: red;
    }

    .image-gallery .thumb-Images li .img-wrap .close i{
        font-size: 20px;
    }

        /* @media only screen and (min-width: 320px) and (max-width: 767px){
        .config{
            width: 100%;
            height: 100%;
            border: 5px solid black;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1239px){
        .config{
            width: 100%;
            height: 100%;
            border: 5px solid black;
        }
    }

    @media only screen and (min-width: 1240){
        .config{
            width: 100%;
            height: 100%;
            border: 5px solid black;
        }
    } */

    .config{
        width: 100%;
        height: 100%;
        border: 5px solid black;
    }

    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
    }

    .remove:hover {
        background: white;
        color: black;
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
                    <h4>customize</h4>
                    <h2>your design</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="prize-list">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Our Prize List</h2>
                </div>
            </div>
            {{--  <div class="col-md-4">
                <div class="prize-list">
                    <div class="thumb-container">
                        <img src="assets/images/team_01.jpg" alt="">
                        <div class="hover-effect">
                            <div class="hover-content">
                                <ul class="social-icons">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-behance"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="down-content">
                        <h4>Johnny William</h4>
                        <span>CO-Founder</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing itaque corporis nulla.</p>
                    </div>
                </div>
            </div> --}}
            @foreach($material as $row)
            <div class="col-md-4">
                <div class="prize-list">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" colspan="4" class="table-active">
                                    <div class="alert-1"> {{ $row->material_name }}
                                        <popup-info id="" img="{{ asset('images/company/question-mark.svg') }}"
                                        text="{{ $row->material_desc }}">
                                            If I write something here...
                                        </popup-info>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($ii = 1)
                            @foreach($row->combed as $row1)
                            <tr>
                                <th scope="row">{{ $ii }}</th>
                                <td>Combed {{$row1->combed }}</td>
                                <td>Rp {{ $row1->harga }}</td>
                            </tr>
                            @php($ii++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>


<div class="best-features customize-features">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-heading">
                    <h2>Make Your Own Design Now</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="section-heading">
                    <button id="order" name="order" data-href="{{ route('customize.order') }}">Make Order!</button>
                    {{-- <button id="export">Export</button> --}}
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="container">
                        {{--  Radio Button Baju --}}
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
                <div class="row">
                    <div id="showImg_Depan" class="hideImages">
                        <div class="col-md-12">
                            <div class="upload-wrapper">
                                <label>
                                    <input type="file" class="uploadIMG" name="img_depan[]" id="img_depan" data-nama="depan" multiple accept="image/jpeg, image/png,">
                                    <p>Drop your files here. <br>or <a>Browse</a></p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <output id="gallery_depan" class="image-gallery"></output>
                        </div>
                    </div>
                    <div id="showImg_Belakang" class="hideImages" style="display:none">
                        <div class="col-md-12">
                            <div class="upload-wrapper">
                                <label>
                                    <input type="file" class="uploadIMG" name="img_belakang[]" id="img_belakang" data-nama="belakang" multiple accept="image/jpeg, image/png,">
                                    <p>Drop your files here. <br>or <a>Browse</a></p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <output id="gallery_belakang" class="image-gallery"></output>
                        </div>
                    </div>
                    <div id="showImg_Kanan" class="hideImages" style="display:none">
                        <div class="col-md-12">
                            <div class="upload-wrapper">
                                <label>
                                    <input type="file" class="uploadIMG" name="img_kanan[]" id="img_kanan" data-nama="kanan" multiple accept="image/jpeg, image/png,">
                                    <p>Drop your files here. <br>or <a>Browse</a></p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <output id="gallery_kanan" class="image-gallery"></output>
                        </div>
                    </div>
                    <div id="showImg_Kiri" class="hideImages" style="display:none">
                        <div class="col-md-12">
                            <div class="upload-wrapper">
                                <label>
                                    <input type="file" class="uploadIMG" name="img_kiri[]" id="img_kiri" data-nama="kiri" multiple accept="image/jpeg, image/png,">
                                    <p>Drop your files here. <br>or <a>Browse</a></p>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <output id="gallery_kiri" class="image-gallery"></output>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" id="sendModel" action="" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" id="model" name="model" hidden>
</form>
{{-- Pesan --}}
<div id="pesanModal" name="pesanModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="PesanLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="row" style="margin:5%">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="checkbox" id="cbVoucher">
                                                <label for="cbVoucher">Use Voucher</label>
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
                                <div class="row">
                                    <div class="user_info">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="txtBahanKain">Pilih Bahan Kain:</label>
                                                <select name="txtBahanKain" id="txtBahanKain">
                                                    @foreach($material as $row)
                                                    <option value="{{ $row->id_material }}"
                                                        data-combed=
                                                        '[
                                                            @foreach($row->combed as $row2)
                                                            {"id":"{{ $row2->id_combed }}", "combed":"{{ $row2->combed }}","harga":"{{ $row2->harga }}"}
                                                            @if($loop->last != true)
                                                            ,
                                                            @endif
                                                            @endforeach
                                                        ]'
                                                        >{{ $row->material_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="txtCombedKain">Pilih Combed:</label>
                                                <select name="txtCombedKain" id="txtCombedKain">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="user_info">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label for="S">S:</label>
                                                <input type="number" id="S" name="Ukuran['S']" value="0" data-berat="450">
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="M">M:</label>
                                                <input type="number" id="M" name="Ukuran['M']" value="0" data-berat="500">
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="L">L:</label>
                                                <input type="number" id="L" name="Ukuran['L']" value="0" data-berat="550">
                                            </div>
                                            <div class="col-sm-3">
                                                <label for="XL">XL:</label>
                                                <input type="number" id="XL" name="Ukuran['XL']" value="0" data-berat="600">
                                            </div>
                                        </div>
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
                                    <li>Item Total <span id="subITL"></span></li>
                                    <li>Weight Total <span id="subWgt"></span></li>
                                    <li>Sub Total <span id="subTTL"></span></li>
                                    <li>Shipping Cost <span id="shipFEE"></span></li>
                                    <li>Total <span id="TTL"></span></li>
                                    <li>DP <span id="dpTTL"></li>
                                    <li>Voucher <span id="Vchr"></li>
                                    <li>Harus Dibayar <span id="bayarTTL"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 50%">
                        <div class="col-sm-12 mt-10 mb-10">
                            {{-- <a class="btn btn-default update" href="">Update</a> --}}
                            <button class="btn btn-default check_out" id="btn_checkout" href="{{ route('customize.order', ['user' => !empty(Auth::user()->username) ? Auth::user()->username:"Not Login" ]) }}">Check Out</button>
                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>
@auth
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
                            @php($isi = App\Models\RewardHistories::where('id_user', Auth::user()->id_user)->where('status',  'Not Claimed')->where('rewards.id_reward_type', 1)->join('rewards', 'reward_histories.id_reward', '=', 'rewards.id_reward')->get())
                            @php($number = 1)
                            @foreach($isi as $row)
                            <tr>
                                <td>{{ $number }}.</td>
                                <td>{{ !empty($row->rewards->desc) ? $row->rewards->desc:"" }}</td>
                                <td>Rp {{ !empty($row->rewards->value) ? number_format($row->rewards->value, '2', ',', '.'):"" }}</td>
                                <td>{{ !empty($row->rewards->prize_point) ? $row->rewards->prize_point:"" }} Points</td>
                                <td><button class="btn btn-primary" style="margin-top:0px" name="btnRedeem" data-id="{{ $row->id_history }}" data-voucher="{{ $row->rewards->value }}" onclick="redeem(this)">Gunakan</button></td>
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
@endauth
<form id="checkout_data" action="" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="text" id="data" name="data" hidden>
</form>

@endsection

@push('scripts')
{{--  if there is a new scripts for this specific page --}}
{{-- <script>
    async function getModel(url) {
        const response = await fetch(url);

        return response.json();
    }
</script> --}}

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
    $('#export').on('click', function(e){
        // getModel('{{ asset("images/design/2022-09-05-user.json")}}');
        getModel('{{ asset("images/design/2022-11-25-user.json") }}');
    });
    // console.log(getModel('{{ asset("images/design/2022-09-04-user.json")}}'));
    // console.log(json_3d_model);
</script>

<script src="{{ asset('js/fabric.min.js') }}"></script>

<script src="{{ asset('js/multi_file.js') }}"></script>

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
    $(document).ready(function(){
        $('input[type="radio"]').click(function(){
            var demovalue = $(this).val();
            $("div.hideCanvas").hide();
            $("div.hideImages").hide();
            $("#show"+demovalue).show();
            $("#showImg_"+demovalue).show();
            // console.log(json_3d_model);
        });
        $('span#Vchr').html(idr(0));

    });
</script>
{{--  popup info --}}
<script>
    class PopUpInfo extends HTMLElement {
	constructor() {
		super();

		// Create a shadow root
		var shadow = this.attachShadow({mode: "open"});

        // Create spans
        var wrapper = document.createElement("span");
        wrapper.setAttribute("class", "wrapper");

        var icon = document.createElement("span");
        icon.setAttribute("class", "icon");
        icon.setAttribute("tabindex", 0);

        var info = document.createElement("span");
        info.setAttribute("class", "info");

        // Take attribute content and put it inside the info span
        var text = this.getAttribute("text");
        info.textContent = text;

        // Insert icon
        var imgUrl;
        if(this.hasAttribute("img")) {
            imgUrl = this.getAttribute("img");
        } else {
            imgUrl = "img/default.png";
        }

        var img = document.createElement("img");
        img.src = imgUrl;
        icon.appendChild(img);

        // Create some CSS to apply to the shadow dom
        var style = document.createElement("style");

        style.textContent = '.wrapper {' +
                                'position: relative;' +
                                '}' +

                                '.info {' +
                                    'font-size: 0.8rem;' +
                                    'width: 100px;' +
                                    'display: inline-block;' +
                                    'border: 1px solid black;' +
                                    'padding: 10px;' +
                                    'margin:  1px;' +
                                    'background: white;' +
                                    'border-radius: 2px;' +
                                    'opacity: 0;' +
                                    'transition: 0.6s all;' +
                                    'position: absolute;' +
                                    'bottom: 20px;' +
                                    'left: 20px;' +
                                    'z-index: 3;' +
                                '}' +

                                'img {' +
                                    'width: 1.2rem' +
                                '}' +

                                '.icon:hover + .info, .icon:focus + .info {' +
                                    'opacity: 1;' +
                                '}';

        // Attach the created elements to the shadow dom

        shadow.appendChild(style);
        shadow.appendChild(wrapper);
        wrapper.appendChild(icon);
        wrapper.appendChild(info);

        }
    }

// Define the new element

customElements.define("popup-info", PopUpInfo);
</script>

<script>
    var tl = 0;
    var voucher = 0;
    var id_voucher = 0;

$('select#txtBahanKain').on('change', function(){
    change_combed();
    total_price();
});

$('select#txtCombedKain').on('change', function(){
    // alert($(this).val());
    subTotal();
    total_price();
});

$('input[name*="Ukuran["').on('change', function(){
    // console.log(total_item());
    subTotal();
    get_fee();
    total_price();
});

$('select#txtProvinsi').on('change', function(e) {
    var id = $(this).val();
    change_cities(id);
    get_kodepos();
    get_fee();
    total_price();
});

$('select#txtKota').on('change', function(e) {
    var id = $(this).val();
    get_kodepos(id);
    get_fee();
    total_price();
});

$('select#txtKurir').on('change', function(e) {
    get_fee();
    total_price();
});

$('select#txtPaket').on('change', function(e) {
    change_fee();
    total_price();
});

$('button#btn_checkout').on('click', function(e) {
    // alert('tes');
    var width = document.getElementById('depan').offsetWidth;
    var height = document.getElementById('depan').offsetHeight;
    var lgnSTS = "{{ !empty(Auth::user()->username) ? Auth::user()->username:'' }}";
    if(lgnSTS === ""){
        window.location.href = "{{ route('login') }}";
    }
    e.preventDefault();
    var data = {};
    var href = $(this).attr('href');
    var id_bahan = $('select#txtBahanKain option:selected').val();
    var id_combed = $('select#txtCombedKain option:selected').val();
    var ukuran = $('input[name*="Ukuran[').map(function(){ return {ukuran:this.id , jumlah:this.value}; }).get();
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
    data["voucher"] = id_voucher;
    data["bahan"] = id_bahan;
    data["combed"] = id_combed;
    data["ukuran"] = ukuran;
    data["paket"] = paket;
    data['kurir'] = kurir;
    data['ongkir'] = ongkir;
    data["alamat"] = alamat_full;
    data['total_quantity'] = total_item().items;
    data['total_weight'] = total_item().berat;
    data["dp"] = dp;
    data["ttl"] = tl;
    data["width"] = width;
    data["height"] = height;
    data["subttl"] = subTotal();
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
    var json_mmodel = saveCanvas();
    // $('input#data').val(JSON.stringify(data));
    // $('form#checkout_data').attr('action', href);
    // $('form#checkout_data').submit();
    $.post(href, { data:JSON.stringify(data), model:JSON.stringify(json_model), image:JSON.stringify(AttachmentArray) }, function(result){
        console.log(result);
    })
    .done( function(d) {
        // alert('done');
        console.log(d);
    })
    .fail( function(e) {
        console.log(e);
    });
});

function idr(value){
    return new Intl.NumberFormat("id", { style: "currency", currency: "IDR" }).format(value);
}

var kota = [];

function subTotal(){
    var harga = $('select#txtCombedKain :selected').data("harga");
    var i = 0;
    // console.log(AttachmentArray);
    Object.entries(AttachmentArray).forEach(element => {
        i += element[1].length;
    });
    var tambahan = i * Number(5000);
    var subttl = (Number(harga) + Number(tambahan)) * total_item().items;
    $('span#subTTL').html(idr(subttl));
    return subttl;
}

function total_item(){
    var total = 0;
    var arr = $('input[name*="Ukuran["');
    var subBerat = 0;
    for(var i = 0; i < arr.length; i++){
        if(parseInt(arr[i].value)){
            total += parseInt(arr[i].value);
            subBerat += parseInt(arr[i].value) * Number(arr[i].getAttribute('data-berat'));
        }
    }
    $('span#subITL').html(total);
    $('span#subWgt').html(subBerat + "g");
    return {items:total, berat:subBerat};
}

function get_fee(){
    $('div#spinners').addClass('spin');
    $('select#txtPaket').prop('disabled', true);
    $('button#btn_checkout').prop('disabled', true);
    var token = $('input[name=_token]').val();
    var kota = $('select#txtKota').val();
    var kurir = $('select#txtKurir').val();
    var gram = total_item().berat;
    var a = "";
    $.ajax({
        type:'POST',
        url:"{{ route('ongkir') }}",
        data:{txtKota:kota, txtKurir:kurir, gram:gram},
        dataType: 'json',
        success:function(data){
            // console.log(data);
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

function change_fee(){
    var b = $("select#txtPaket").val();
    $('span#shipFEE').html(idr(b));
}

// Check for Saved Data of Province and Cities, use RajaOngkir ID
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

    change_combed();
    subTotal();
    change_cities( province_id, city_id );
    // change_cities();
    get_kodepos();
    get_fee();
    change_dp();
    change_bayar();
    setCanvas();
    module.innit();
    module.getCanvas();
    module.loadModel();
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
    change_bayar();
});

function change_bayar(){
    var bayar = Number(tl) * ($('select#txtDP option:selected').val() / 100);
    if(voucher !== 0){
        console.log("tl : " + tl);
        console.log("bayar : " + bayar);
        bayar = bayar - voucher;
        console.log("bayar : " + bayar + " Setelah diskon");
    }
    $('span#bayarTTL').html(idr(bayar));
}


function get_kodepos(id){
    if(id === undefined) { id = $('#txtKota').val() }
    for (let index = 0; index < kota.length; index++) {
        if(id === kota[index][1]){
            $('#txtKodePos').val(kota[index][3]);
        }
    }
}

function total_price(){
    var sub = subTotal();
    var fee = $('select#txtPaket').val();
    tl = Number(sub) + Number(fee);
    $('span#TTL').html(idr(tl));
    change_bayar();
}

function change_combed(){
    var combed = $('select#txtBahanKain :selected').data('combed');
    var html = "";
    combed.forEach(element => {
        html += "<option value='" + element.id + "' data-combed='" + element.combed + "' data-harga='" + element.harga + "'>" + element.combed + " / " + idr(element.harga) + "</option>";
    });
    $('select#txtCombedKain').html(html);
}

$('button#order').on('click', function(){
    var href = $(this).attr('href');
    $('#pesanModal').modal('show');
});

$('#showReward').on('hidden.bs.modal', function(){
    $('#pesanModal').modal('show');
})

$('input#cbVoucher').click(function(e){
    // alert('tes');
    e.preventDefault();
    $('#pesanModal').modal('hide');
    $('#showReward').modal('show');
});

function redeem(element){
    if(voucher !== 0){
        // alert('tes');
        unredeem($('button[name="btnRedeemed"]')[0]);
    }

    voucher = element.getAttribute('data-voucher');
    id_voucher = element.getAttribute('data-id');

    element.setAttribute('class', 'btn btn-success');
    element.innerHTML = 'Digunakan';
    element.setAttribute('name', 'btnRedeemed');
    element.setAttribute('onclick', 'unredeem(this)');
    $('input#cbVoucher').prop('checked', true);
    $('span#Vchr').html(idr(voucher));
    change_bayar();
}

function unredeem(element){
    voucher = 0;
    id_voucher = 0;

    element.setAttribute('class', 'btn btn-primary');
    element.innerHTML = 'Gunakan';
    element.setAttribute('name', 'btnRedeem');
    element.setAttribute('onclick', 'redeem(this)');
    $('input#cbVoucher').prop('checked', false);
    $('span#Vchr').html(idr(voucher));
    change_bayar();
}

</script>

@endpush

{{-- Percobaan --}}

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #scene {
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
            height: 100vh;
        }

        .w-256 {
            width: 1140px;
        }

        #configure {
            width: 100%;
            height: 100%;
            border: 5px solid black;
        }

        input[type="file"] {
            display: block;
        }

        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }

        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }

        .remove:hover {
            background: white;
            color: black;
        }
    </style>
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="field">
                    <h3>Upload your images</h3>
                    <input type="file" id="files" name="files[]" multiple />
                </div>
                <div class="relative h-256">
                    <div id="scene">
                        <canvas id="configure"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="relative h-256">
                    <div id="scene">
                        <canvas id="model"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    var bg_depan = '{{ asset("images/company/model/t_shirts_male_front.png") }}';
    var bg_belakang = '{{ asset("images/company/model/t_shirts_male_back.png") }}';
    var bg_kanan = '{{ asset("images/company/model/t_shirts_male_right.png") }}';
    var bg_kiri = '{{ asset("images/company/model/t_shirts_male_left.png") }}';
    var model = '{{ asset("images/company/model/coba.gltf")}}';
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{ asset('css/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/fabric.min.js') }}"></script>
    <script src="{{ asset('js/3d_fabric.js') }}"></script>
    <script src="{{ asset('js/3d_model.js') }}" type="module"></script>
    <script src="{{ asset('css/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html> --}}
