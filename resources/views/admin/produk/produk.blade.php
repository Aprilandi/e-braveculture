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

    .modal-body {
        max-height: calc(100vh - 210px);
        overflow-y: auto;
    }
</style>
@endpush

@section('content')


<div class="home-content">
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Modal Tambah Produk -->
            <div id="tambahProduk" name="tambahProduk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahProdukLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahProdukLabel"><b>Tambah Data Produk</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtIDType">Tipe Produk</label><br>
                                    <select name="txtIDType" id="txtIDType" class="form-control">
                                        <option value="" selected hidden disabled>Pilih tipe produk</option>
                                        @foreach($tipe as $row)
                                        @php($listsize = App\Models\ProductSize::where('id_product_type', $row->id_product_type)->get())
                                        @php($isiUmur = App\Models\ProductSize::select('umur')->where('id_product_type', $row->id_product_type)->groupBy('umur')->get())
                                        @php($isiKelamin = App\Models\ProductSize::select('kelamin')->where('id_product_type', $row->id_product_type)->groupBy('kelamin')->get())
                                            <option value="{{ $row->id_product_type }}"
                                                data-size=
                                                '[
                                                    @foreach($listsize as $row2)
                                                    {"id_size":"{{ $row2->id_product_size }}","umur":"{{ $row2->umur }}","kelamin":"{{ $row2->kelamin }}","size":"{{ $row2->product_size }}"}
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-umur=
                                                '[
                                                    @foreach($isiUmur as $row2)
                                                    "{{ $row2->umur }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-kelamin=
                                                '[
                                                    @foreach($isiKelamin as $row2)
                                                    "{{ $row2->kelamin }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                >{{ $row->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtIDMaterial">Material Produk</label><br>
                                    <select name="txtIDMaterial" id="txtIDMaterial" class="form-control">
                                        <option value="" selected hidden disabled>Pilih material produk</option>
                                        @foreach($material as $row)
                                            <option value="{{ $row->id_material }}">{{ $row->material_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtNama">Nama Produk</label><br>
                                    <input type="text" class="form-control" id="txtNama" name="txtNama"
                                        placeholder="Masukkan nama produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtDesc">Deskripsi Produk</label><br>
                                    <input type="textarea" class="form-control" id="txtDesc" name="txtDesc"
                                        placeholder="Deskripsi Produk...">
                                </div>
                                <div class="form-group">
                                    <label for="txtHarga">Harga Produk</label><br>
                                    <input type="number" class="form-control" id="txtHarga" name="txtHarga"
                                        placeholder="Masukkan harga produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtEdisi">Edisi Produk</label><br>
                                    <input type="text" class="form-control" id="txtEdisi" name="txtEdisi"
                                        placeholder="Masukkan edisi produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtDiskon">Diskon Produk</label><br>
                                    <input type="number" class="form-control" id="txtDiskon" name="txtDiskon" max="100"
                                        placeholder="Masukkan diskon produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtUmur">Untuk Umur</label><br>
                                    <select name="txtUmur" id="txtUmur" class="form-control">
                                        <option value="Dewasa">Dewasa</option>
                                        <option value="Anak-anak">Anak-anak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtKelamin">Jenis Kelamin</label><br>
                                    <select name="txtKelamin" id="txtKelamin" class="form-control">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="divStock">Stock Produk</label>
                                    <div class="row" id="divStock"></div>
                                </div>
                                <div class="form-group">
                                    <label for="divBerat">Berat Produk (gram)</label>
                                    <div class="row" id="divBerat"></div>
                                </div>
                                <div class="form-group">
                                    <label for="listgambar">Upload Gambar Produk (bisa milih lebih dari 1 gambar)</label>
                                    <input type="file" name="uploadgambar[]" accept=".jpg,.png" multiple>
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
            <!-- Modal Edit Produk -->
            <div id="editProduk" name="editProduk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProdukLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProdukLabel"><b>Edit Data Produk</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedIDType">Tipe Produk</label><br>
                                    <select name="txtedIDType" id="txtedIDType" class="form-control">
                                        <option value="" selected hidden disabled>Pilih tipe produk</option>
                                        @foreach($tipe as $row)
                                        @php($listsize = App\Models\ProductSize::where('id_product_type', $row->id_product_type)->get())
                                        @php($isiUmur = App\Models\ProductSize::select('umur')->where('id_product_type', $row->id_product_type)->groupBy('umur')->get())
                                        @php($isiKelamin = App\Models\ProductSize::select('kelamin')->where('id_product_type', $row->id_product_type)->groupBy('kelamin')->get())
                                            <option value="{{ $row->id_product_type }}"
                                                data-size=
                                                '[
                                                    @foreach($listsize as $row2)
                                                    {"id_size":"{{ $row2->id_product_size }}","umur":"{{ $row2->umur }}","kelamin":"{{ $row2->kelamin }}","size":"{{ $row2->product_size }}"}
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-umur=
                                                '[
                                                    @foreach($isiUmur as $row2)
                                                    "{{ $row2->umur }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                data-kelamin=
                                                '[
                                                    @foreach($isiKelamin as $row2)
                                                    "{{ $row2->kelamin }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                    @endforeach
                                                ]'
                                                >{{ $row->product_type_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtedIDMaterial">Material Produk</label><br>
                                    <select name="txtedIDMaterial" id="txtedIDMaterial" class="form-control">
                                        <option value="" selected hidden disabled>Pilih material produk</option>
                                        @foreach($material as $row)
                                            <option value="{{ $row->id_material }}">{{ $row->material_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtedNama">Nama Produk</label><br>
                                    <input type="text" class="form-control" id="txtedNama" name="txtedNama"
                                        placeholder="Masukkan nama produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtedDesc">Deskripsi Produk</label><br>
                                    <input type="textarea" class="form-control" id="txtedDesc" name="txtedDesc"
                                        placeholder="Deskripsi Produk...">
                                </div>
                                <div class="form-group">
                                    <label for="txtedHarga">Harga Produk</label><br>
                                    <input type="number" class="form-control" id="txtedHarga" name="txtedHarga"
                                        placeholder="Masukkan harga produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtedEdisi">Edisi Produk</label><br>
                                    <input type="text" class="form-control" id="txtedEdisi" name="txtedEdisi"
                                        placeholder="Masukkan edisi produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtedDiskon">Diskon Produk</label><br>
                                    <input type="number" class="form-control" id="txtedDiskon" name="txtedDiskon" max="100"
                                        placeholder="Masukkan diskon produk">
                                </div>
                                <div class="form-group">
                                    <label for="txtedUmur">Untuk Umur</label><br>
                                    <select name="txtedUmur" id="txtedUmur" class="form-control">
                                        <option value="Dewasa">Dewasa</option>
                                        <option value="Anak-anak">Anak-anak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="txtedKelamin">Jenis Kelamin</label><br>
                                    <select name="txtedKelamin" id="txtedKelamin" class="form-control">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="divedStock">Stock Produk</label>
                                    <div class="row" id="divedStock"></div>
                                </div>
                                <div class="form-group">
                                    <label for="divedBerat">Berat Produk (gram)</label>
                                    <div class="row" id="divedBerat"></div>
                                </div>
                                <div class="form-group">
                                    <label for="listgambared">Upload Gambar Produk (bisa milih lebih dari 1 gambar)</label>
                                    <input type="file" name="uploadgambared[]" accept=".jpg,.png" multiple>
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
                            <h5 class="modal-title" id="tambahTypeLabel"><b>Tambah Data Tipe Produk</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('produk.typestore') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtType">Masukkan tipe produk</label><br>
                                    <input type="text" class="form-control" id="txtType" name="txtType"
                                        placeholder="Masukkan tipe produk ( baju / hoodie / dll )">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="form-control btn btn-info" id="btnTambahDetail">Tambah Detail</button>
                                </div>
                                <div class="form-group">
                                    <div id="grupDetail">
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
            <!-- Modal Edit Type -->
            <div id="editType" name="editType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editTypeLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTypeLabel"><b>Edit Data Tipe Produk</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateFormType" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedType">Masukkan tipe produk</label><br>
                                    <input type="text" class="form-control" id="txtedType" name="txtedType"
                                        placeholder="Masukkan tipe produk ( baju / hoodie / dll )">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="form-control btn btn-info" id="btnEditDetail" onclick="tambaheditDetail()">Tambah Detail</button>
                                </div>
                                <div class="form-group">
                                    <div id="grupedDetail">
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
            <!-- Modal Show Type -->
            <div id="showType" name="showType" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="showTypeLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="showTypeLabel"><b>Data Tipe Produk</b></h5>
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
                                <table id="tableType" class="table table-striped border">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Tipe Produk</th>
                                            <th>Ukuran</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($number = 1)
                                        @foreach($tipe as $row)
                                        <tr>
                                            <td>{{ $number }}.</td>
                                            <td>{{ !empty($row->product_type_name) ? $row->product_type_name:0 }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6">
                                                        Detail
                                                    </div>
                                                    <div class="col-6">
                                                        <button class="btn btn-light  btn-sm" id="detail"
                                                        data-id_type="{{ !empty($row->id_product_type) ? $row->id_product_type:'' }}"
                                                        data-ukuran=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                "{{ $row2->product_size }}"
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        data-isi_ukuran=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                {{ $row2->ukuran }}
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        data-umur=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                "{{ $row2->umur }}"
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        data-kelamin=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                "{{ $row2->kelamin }}"
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        >
                                                            <i class="fa fa-eye"> </i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <button class="btn btn-primary btn-sm col-6" id="edittipe" href="{{ route('produk.typeupdate',  $row->id_product_type) }}"
                                                        data-type="{{ $row->product_type_name }}"
                                                        data-id_type="{{ !empty($row->id_product_type) ? $row->id_product_type:'' }}"
                                                        data-ukuran=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                "{{ $row2->product_size }}"
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        data-isi_ukuran=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                {{ $row2->ukuran }}
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        data-umur=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                "{{ $row2->umur }}"
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        data-kelamin=
                                                        '[
                                                            @foreach($row->productsize as $row2)
                                                                "{{ $row2->kelamin }}"
                                                                @if($loop->last != true)
                                                                ,
                                                                @endif
                                                            @endforeach
                                                        ]'
                                                        ><i class="fa fa-edit"> </i></button>

                                                    <button href="{{ route('produk.typedestroy', $row->id_product_type) }}"
                                                        class="btn btn-danger btn-sm col-6" id="deletetipe"
                                                        data-nama="{{ $row->product_type_name }}">
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
            {{-- Detail Type Product --}}
            <div id="detailTypeModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailTypeLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailTypeLabel"><b>Detail Ukuran Tipe Produk</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="overflow-x: auto; height:500px">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tableDetailType" class="table table-striped border">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Umur</th>
                                                    <th>Kelamin</th>
                                                    <th>Size</th>
                                                    <th>Detail Ukuran</th>
                                                </tr>
                                            </thead>
                                            <tbody id="type_detail_isi">
                                                <tr>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
                        <h4 class="card-title" style="display:inline-block;">Data Produk</h4>
                        <div class="card-title float-right mb-12" id="xpbutton">
                            <button type="button" class="btn btn-secondary mb-6" data-toggle="modal" data-target="#showType" id="showType" name="showType">
                                <i class="fa fa-gears"></i>
                                 Data Tipe Produk
                            </button>
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahProduk" id="tambahproduct" name="tambahproduct">
                                <i class="fa fa-plus"></i>
                                 Tambah Data Produk
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
                            <table id="tableProduct" class="table table-striped border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Tipe Produk</th>
                                        <th>Bahan Kain</th>
                                        <th>Edisi</th>
                                        <th>Diskon</th>
                                        <th>Harga</th>
                                        <th>Detail</th>
                                        <th>Gambar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    ?>
                                    {{-- @php(dd($produk)) --}}
                                    @foreach($product as $row)
                                    <tr>
                                        <td>{{ $number }}.</td>
                                        <td>{{ !empty($row->product_name) ? $row->product_name:"" }}</td>
                                        <td>{{ !empty($row->product_desc) ? $row->product_desc:"" }}</td>
                                        <td>{{ !empty($row->id_product_type) ? $row->type->product_type_name:"" }}</td>
                                        <td>{{ !empty($row->id_material) ? $row->material->material_name:"" }}</td>
                                        <td>{{ !empty($row->product_edition) ? $row->product_edition:"" }}</td>
                                        <td>{{ !empty($row->product_discount) ? $row->product_discount:0 }}</td>
                                        <td>{{ !empty($row->product_price) ? $row->product_price:"" }}</td>
                                        <td>
                                            <button class="btn btn-light  btn-sm" id="detailproduct"
                                            @php($details = App\Models\ProductDetails::where('id_product', $row->id_product)->get())
                                            data-size=
                                            '[
                                                @foreach($details as $key => $value)
                                                    "{{ !empty($value->sizes->product_size) ? $value->sizes->product_size:'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'
                                            data-umur=
                                            '[
                                                @foreach($details as $key => $value)
                                                    "{{ !empty($value->sizes->umur) ? $value->sizes->umur:'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'
                                            data-kelamin=
                                            '[
                                                @foreach($details as $key => $value)
                                                    "{{ !empty($value->sizes->kelamin) ? $value->sizes->kelamin:'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'
                                            data-stock=
                                            '[
                                                @foreach($details as $key => $value)
                                                    "{{ !empty($value->product_stock) ? $value->product_stock:'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'
                                            data-weight=
                                            '[
                                                @foreach($details as $key => $value)
                                                    "{{ !empty($value->product_weight) ? $value->product_weight:'' }}"
                                                    @if($loop->last != true)
                                                    ,
                                                    @endif
                                                @endforeach
                                            ]'
                                            >
                                                <i class="fa fa-eye"> </i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-light  btn-sm" id="gambar"
                                            @php($images = App\Models\ProductImages::where('id_product', $row->id_product)->get())
                                            data-gambar=
                                            '[
                                                @foreach($images as $key => $value)
                                                    "{{ !empty($value->image) ? asset('images/products/'.$value->image):'' }}"
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
                                            <button class="btn btn-primary btn-sm" id="edit" href="{{ route('produk.update',  $row->id_product) }}"
                                                data-idtype="{{ $row->id_product_type }}" data-idMat="{{ $row->id_material }}" data-name="{{ $row->product_name }}"
                                                data-desc="{{ $row->product_desc }}" data-edition="{{ $row->product_edition }}" data-disc="{{ $row->product_discount }}"
                                                data-price="{{ $row->product_price }}"
                                                @php($details = App\Models\ProductDetails::where('id_product', $row->id_product)->get())
                                                data-detail=
                                                '[
                                                    @foreach($details as $key => $value)
                                                        {
                                                            "id_size":"{{ $value->sizes->id_product_size }}",
                                                            "age":"{{ $value->sizes->umur }}",
                                                            "sex":"{{ $value->sizes->kelamin }}",
                                                            "stock":"{{ $value->product_stock }}",
                                                            "berat":"{{ $value->product_weight }}"
                                                        }
                                                        @if($loop->last != true)
                                                        ,
                                                        @endif
                                                    @endforeach
                                                ]'
                                                ><i class="fa fa-edit"> </i></button>

                                            <button href="{{ route('produk.destroy', $row->id_product) }}"
                                                class="btn btn-danger btn-sm" id="delete"
                                                data-nama="{{ $row->product_name }}">
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

{{-- Detail Product --}}
<div id="detailProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailProductLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailProductLabel"><b>Ukuran dan Stok Produk</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableDetailProduct" class="table table-striped border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Size</th>
                                        <th>Umur</th>
                                        <th>Kelamin</th>
                                        <th>Stock</th>
                                        <th>Weight</th>
                                    </tr>
                                </thead>
                                <tbody id="table_isi">
                                    <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail Gambar Level --}}
<div id="detailGambarModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="detailGambarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailGambarLabel"><b>List Gambar Produk</b></h5>
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

{{-- aditional JS --}}

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

{{-- Script Type Product --}}
<script>
// SHOW
$('button#detail').on('click', function() {
    var isi = $(this).data('isi_ukuran');
    var ukuran = $(this).data('ukuran');
    var isiKey = [];
    var umur = $(this).data('umur');
    var kelamin = $(this).data('kelamin');
    var html = "";
    for (let i = 0; i < isi.length; i++) {
        isiKey.push(Object.getOwnPropertyNames(isi[i]));
    }

    for (let i = 0; i < isi.length; i++) {
        html += "<tr>";
        html += "<td rowspan='" + isiKey[i].length + "'>" + (i + 1) + "</td>";
        html += "<td rowspan='" + isiKey[i].length + "'>" + umur[i] + "</td>";
        html += "<td rowspan='" + isiKey[i].length + "'>" + kelamin[i] + "</td>";
        html += "<td rowspan='" + isiKey[i].length + "'>" + ukuran[i] + "</td>";
        for (let ii = 0; ii < isiKey[i].length; ii++) {
            if(ii != 0){
                html += "</tr><tr>";
            }
            html += "<td>" + isiKey[i][ii].replace(/_/g, ' ') + " : " + isi[i][isiKey[i][ii]] + "</td>";
        }
        html += "</tr>";
    }

    $('tbody#type_detail_isi').html(html);
    $('#showType').modal('hide');
    $('#detailTypeModal').modal('show');
});

$('#detailTypeModal').on('hidden.bs.modal', function(){
    $('#showType').modal('show');
});

$('#tambahtipe').on('click', function(){
    $('#showType').modal('hide');
});

// INSERT
var detailID = 0;
var ukuranID = 0;
var jenisID = 0;
$('#btnTambahDetail').on('click', function(){
    ukuranID = 0;
    jenisID = 0;
    var html = "";
    html += '<div class="form-group" id="isiDetail-' + detailID + '">';
    html += '<label for="txtKelamin[]">Untuk Kelamin</label>';
    html += '<select class="form-control" name="txtKelamin[]">';
    html += '<option value="Laki-laki">Laki-laki</option>';
    html += '<option value="Perempuan">Perempuan</option>';
    html += '<option value="Unisex">Unisex</option>';
    html += '</select>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<label for="txtUmur[]">Untuk Umur</label>';
    html += '<select class="form-control" name="txtUmur[]">';
    html += '<option value="Dewasa">Dewasa</option>';
    html += '<option value="Anak-anak">Anak-anak</option>';
    html += '</select>';
    html += '</div>';
    html += '<div class="form-group" id="isiUkuran-' + detailID + '">';
    html += '<div id="grupUkuran-' + detailID + '-' + ukuranID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtNamaUkuran[' + detailID + '][]">Nama ukuran</label>';
    html += '<input class="form-control" type="text" name="txtNamaUkuran[' + detailID + '][]" placeholder="S/M/L/XL">';
    html += '</div>';
    html += '<div class="form-group" id="isiJenis-' + detailID + '-' + ukuranID + '">';
    html += '<div id="grupJenis-' + detailID + '-' + ukuranID + '-' + jenisID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtJenisUkuran[' + detailID + '][' + ukuranID + '][]">Jenis Ukuran</label>';
    html += '<div class="row">';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtJenisUkuran[' + detailID + '][' + ukuranID + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan">';
    html += '</div>';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtIsiJenis[' + detailID + '][' + ukuranID + '][]" placeholder="...cm">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<button type="button" class="form-control btn btn-info" name="btnJenisUkuran" onclick="tambahJenis(' + detailID + ', ' + ukuranID + ', ' + jenisID + ')">Tambah Jenis Ukuran</button>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<button type="button" class="form-control btn btn-info" name="btnUkuran" onclick="tambahUkuran(' + detailID + ', ' + ukuranID + ')">Tambah Ukuran</button>';
    html += '</div>';
    html += '</div>';
    detailID++;
    document.getElementById('grupDetail').innerHTML += html;
});

function tambahUkuran(id, id2){
    ukuranID++;
    jenisID = 0;
    var html = '';
    html += '<div id="grupUkuran-' + id + '-' + ukuranID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtNamaUkuran[' + id + '][]">Nama ukuran</label>';
    html += '<input class="form-control" type="text" name="txtNamaUkuran[' + id + '][]" placeholder="S/M/L/XL">';
    html += '</div>';
    html += '<div class="form-group" id="isiJenis-' + id + '-' + ukuranID + '">';
    html += '<div id="grupJenis-' + id + '-' + ukuranID + '-' + jenisID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtJenisUkuran[' + id + '][' + ukuranID + '][]">Jenis Ukuran</label>';
    html += '<div class="row">';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtJenisUkuran[' + id + '][' + ukuranID + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan">';
    html += '</div>';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtIsiJenis[' + id + '][' + ukuranID + '][]" placeholder="...cm">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<button type="button" class="form-control btn btn-info" name="btnJenisUkuran" onclick="tambahJenis(' + id + ', ' + ukuranID + ', ' + jenisID + ')">Tambah Jenis Ukuran</button>';
    html += '</div>';
    html += '</div>';
    $('#grupUkuran-' + id + '-' + (Number(ukuranID) - 1)).after(html);
}

function tambahJenis(id, id2, id3){
    var html = '';
    jenisID++;
    html += '<div id="grupJenis-' + id + '-' + id2 + '-' + jenisID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtJenisUkuran[' + id + '][' + ukuranID + '][]">Jenis Ukuran</label>';
    html += '<div class="row">';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtJenisUkuran[' + id + '][' + ukuranID + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan">';
    html += '</div>';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtIsiJenis[' + id + '][' + ukuranID + '][]" placeholder="...cm">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    // console.log(html);
    $('#grupJenis-' + id + '-' + id2 + '-' + id3).after(html);
}

// UPDATE
// MODAL UPDATE
var detailedID = 0;
var ukuranedID = 0;
var jenisedID = 0;
$('button#edittipe').on('click', function(){
    $('#showType').modal('hide');
    var tipe = $(this).data('type');
    var id = $(this).data('id_type');
    var href = "{{ route('produk.typeupdate', 'id_tipe') }}";
    href = href.replace('id_tipe', id);

    var isi = $(this).data('isi_ukuran');
    var ukuran = $(this).data('ukuran');
    var isiKey = [];
    var umur = $(this).data('umur');
    var kelamin = $(this).data('kelamin');
    var html = "";
    for (let i = 0; i < isi.length; i++) {
        isiKey.push(Object.getOwnPropertyNames(isi[i]));
    }

    var laki = "";
    var perempuan = "";
    var unisex = "";
    var dewasa = "";
    var anak = "";

    $('#txtedType').val(tipe);

    for (let i = 0; i < ukuran.length; i++) {
        html += '<div class="form-group" id="isiedDetail-' + detailedID + '">';
        html += '<label for="txtedKelamin[]">Untuk Kelamin</label>';
        html += '<select class="form-control" name="txtedKelamin[]">';
        if(kelamin[i] == "Laki-laki"){
            laki = "selected";
        }
        if(kelamin[i] == "Perempuan"){
            perempuan = "selected";
        }
        if(kelamin[i] == "Unisex"){
            unisex = "selected";
        }
        html += '<option value="Laki-laki" '+laki+'>Laki-laki</option>';
        html += '<option value="Perempuan" '+perempuan+'>Perempuan</option>';
        html += '<option value="Unisex" '+unisex+'>Unisex</option>';
        html += '</select>';
        html += '</div>';
        html += '<div class="form-group">';
        html += '<label for="txtedUmur[]">Untuk Umur</label>';
        html += '<select class="form-control" name="txtedUmur[]">';
        if(umur[i] == "Dewasa"){
            dewasa = "selected";
        }
        if(umur[i] == "Anak-anak"){
            anak = "selected";
        }
        html += '<option value="Dewasa" '+dewasa+'>Dewasa</option>';
        html += '<option value="Anak-anak" '+anak+'>Anak-anak</option>';
        html += '</select>';
        html += '</div>';
        html += '<div class="form-group" id="isiedUkuran-' + detailedID + '">';
        html += '<div id="grupedUkuran-' + detailedID + '-' + ukuranedID + '">';
        html += '<div class="form-group">';
        html += '<label for="txtedNamaUkuran[' + detailedID + '][]">Nama ukuran</label>';
        html += '<input class="form-control" type="text" name="txtedNamaUkuran[' + detailedID + '][]" placeholder="S/M/L/XL" value="' + ukuran[i] + '">';
        html += '</div>';
        html += '<div class="form-group" id="isiedJenis-' + detailedID + '-' + ukuranedID + '">';
        for (let ii = 0; ii < isiKey[i].length; ii++) {
            jenisedID = ii;
            html += '<div id="grupedJenis-' + detailedID + '-' + ukuranedID + '-' + jenisedID + '">';
            html += '<div class="form-group">';
            html += '<label for="txtedJenisUkuran[' + detailedID + '][' + ukuranedID + '][]">Jenis Ukuran</label>';
            html += '<div class="row">';
            html += '<div class="col-sm-6">';
            html += '<input class="form-control" type="text" name="txtedJenisUkuran[' + detailedID + '][' + ukuranedID + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan" value="' + isiKey[i][ii].replace(/_/g, ' ') + '">';
            html += '</div>';
            html += '<div class="col-sm-6">';
            html += '<input class="form-control" type="text" name="txtedIsiJenis[' + detailedID + '][' + ukuranedID + '][]" placeholder="...cm" value="' + isi[i][isiKey[i][ii]] + '">';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
        html += '</div>';
        html += '<div class="form-group">';
        html += '<button type="button" class="form-control btn btn-info" name="btnedJenisUkuran" onclick="tambahedJenis(' + detailedID + ', ' + ukuranedID + ', ' + jenisedID + ')">Tambah Jenis Ukuran</button>';
        html += '</div>';
        html += '</div>';
        html += '<div class="form-group">';
        html += '<button type="button" class="form-control btn btn-info" name="btnedUkuran" onclick="tambahedUkuran(' + detailedID + ', ' + ukuranedID + ')">Tambah Ukuran</button>';
        html += '</div>';
        html += '</div>';
        detailedID++;
        ukuranedID++;
        jenisedID = 0;
    }
    document.getElementById('grupedDetail').innerHTML = html;
    $('#updateFormType').attr('action', href);
    $('#editType').modal('show');
});

function tambahedUkuran(id, id2){
    id2++;
    jenisedID = 0;
    var html = '';
    html += '<div id="grupedUkuran-' + id + '-' + id2 + '">';
    html += '<div class="form-group">';
    html += '<label for="txtedNamaUkuran[' + id + '][]">Nama ukuran</label>';
    html += '<input class="form-control" type="text" name="txtedNamaUkuran[' + id + '][]" placeholder="S/M/L/XL">';
    html += '</div>';
    html += '<div class="form-group" id="isiedJenis-' + id + '-' + id2 + '">';
    html += '<div id="grupedJenis-' + id + '-' + id2 + '-' + jenisedID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtedJenisUkuran[' + id + '][' + id2 + '][]">Jenis Ukuran</label>';
    html += '<div class="row">';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtedJenisUkuran[' + id + '][' + id2 + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan">';
    html += '</div>';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtedIsiJenis[' + id + '][' + id2 + '][]" placeholder="...cm">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<button type="button" class="form-control btn btn-info" name="btnedJenisUkuran" onclick="tambahedJenis(' + id + ', ' + id2 + ', ' + jenisedID + ')">Tambah Jenis Ukuran</button>';
    html += '</div>';
    html += '</div>';
    $('#grupedUkuran-' + id + '-' + (Number(id2) - 1)).after(html);
}

function tambahedJenis(id, id2, id3){
    var html = '';
    id3++;
    html += '<div id="grupedJenis-' + id + '-' + id2 + '-' + id3 + '">';
    html += '<div class="form-group">';
    html += '<label for="txtedJenisUkuran[' + id + '][' + id2 + '][]">Jenis Ukuran</label>';
    html += '<div class="row">';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtedJenisUkuran[' + id + '][' + id2 + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan">';
    html += '</div>';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtedIsiJenis[' + id + '][' + id2 + '][]" placeholder="...cm">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    // console.log(html);
    $('#grupedJenis-' + id + '-' + id2 + '-' + (Number(id3) - 1)).after(html);
}

function tambaheditDetail(){
    ukuranedID = 0;
    jenisedID = 0;
    var html = "";
    html += '<div class="form-group" id="isiedDetail-' + detailedID + '">';
    html += '<label for="txtedKelamin[]">Untuk Kelamin</label>';
    html += '<select class="form-control" name="txtedKelamin[]">';
    html += '<option value="Laki-laki">Laki-laki</option>';
    html += '<option value="Perempuan">Perempuan</option>';
    html += '<option value="Unisex">Unisex</option>';
    html += '</select>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<label for="txtedUmur[]">Untuk Umur</label>';
    html += '<select class="form-control" name="txtedUmur[]">';
    html += '<option value="Dewasa">Dewasa</option>';
    html += '<option value="Anak-anak">Anak-anak</option>';
    html += '</select>';
    html += '</div>';
    html += '<div class="form-group" id="isiedUkuran-' + detailedID + '">';
    html += '<div id="grupedUkuran-' + detailedID + '-' + ukuranedID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtedNamaUkuran[' + detailedID + '][]">Nama ukuran</label>';
    html += '<input class="form-control" type="text" name="txtedNamaUkuran[' + detailedID + '][]" placeholder="S/M/L/XL">';
    html += '</div>';
    html += '<div class="form-group" id="isiedJenis-' + detailedID + '-' + ukuranedID + '">';
    html += '<div id="grupedJenis-' + detailedID + '-' + ukuranedID + '-' + jenisedID + '">';
    html += '<div class="form-group">';
    html += '<label for="txtedJenisUkuran[' + detailedID + '][' + ukuranedID + '][]">Jenis Ukuran</label>';
    html += '<div class="row">';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtedJenisUkuran[' + detailedID + '][' + ukuranedID + '][]" placeholder="Lingkar badan/Panjang/Lingkar lengan">';
    html += '</div>';
    html += '<div class="col-sm-6">';
    html += '<input class="form-control" type="text" name="txtedIsiJenis[' + detailedID + '][' + ukuranedID + '][]" placeholder="...cm">';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<button type="button" class="form-control btn btn-info" name="btnedJenisUkuran" onclick="tambahedJenis(' + detailedID + ', ' + ukuranedID + ', ' + jenisedID + ')">Tambah Jenis Ukuran</button>';
    html += '</div>';
    html += '</div>';
    html += '<div class="form-group">';
    html += '<button type="button" class="form-control btn btn-info" name="btnedUkuran" onclick="tambahedUkuran(' + detailedID + ', ' + ukuranedID + ')">Tambah Ukuran</button>';
    html += '</div>';
    html += '</div>';
    detailedID++;
    document.getElementById('grupedDetail').innerHTML += html;
}

// DELETE
</script>


{{-- Script Product --}}
<script>

// SHOW
// MODAL DETAIL PRODUK
$('button#detailproduct').on('click', function() {
    var size = $(this).data("size");
    var umur = $(this).data("umur");
    var kelamin = $(this).data("kelamin");
    var stock = $(this).data("stock");
    var weight = $(this).data("weight");
    var isi = "";

    for(var i = 0; i < size.length; i++){
        isi += "<tr>";
        isi += "<td>" + (i + 1) + "</td>";
        isi += "<td>" + size[i] + "</td>";
        isi += "<td>" + umur[i] + "</td>";
        isi += "<td>" + kelamin[i] + "</td>";
        isi += "<td>" + stock[i] + "</td>";
        isi += "<td>" + weight[i] + "</td>";
        isi += "</tr>";
    }

    $('#table_isi').html(isi);
    $("#detailProductModal").modal('show');
});

// MODAL GAMBAR
$('button#gambar').on('click', function() {
    var gambar = $(this).data("gambar");
    var html = "";
    console.log(gambar);
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

// GANTI GAMBAR YG DI PAJANG DI MODAL GAMBAR
function changeThumb(id){
    document.getElementById("thumb_link").href = id.src;
    document.getElementById("thumb_img").src = id.src;
}

// INSERT
// NAMBAH STOCK TERGANTUNG
$('select#txtIDType').on('change', function(){
    var kelamin = $('select#txtIDType :checked').data('kelamin');
    var umur = $('select#txtIDType :checked').data('umur');
    var size = $('select#txtIDType :checked').data('size');

    var selectUmur = "";
    for (let i = 0; i < umur.length; i++) {
        selectUmur += "<option value='" + umur[i] + "'>" + umur[i] + "</option>";
    }
    $('select#txtUmur').html(selectUmur);

    var selectKelamin = "";
    for (let i = 0; i < kelamin.length; i++) {
        selectKelamin += "<option value='" + kelamin[i] + "'>" + kelamin[i] + "</option>";
    }
    $('select#txtKelamin').html(selectKelamin);

    htmlStock();
    // alert(htmlberat);
});

$('select#txtUmur').on('change', function(){
    htmlStock();
});

$('select#txtKelamin').on('change', function(){
    htmlStock();
});

function htmlStock(){
    var size = $('select#txtIDType :checked').data('size');
    var isiKelamin = $('select#txtKelamin :checked').val();
    var isiUmur = $('select#txtUmur :checked').val();
    var html = "";
    for(var i = 0; i < size.length; i++){
        if(size[i].umur === isiUmur && size[i].kelamin === isiKelamin){
            html += "<div class='col-sm-3'>";
            html += "<label for='txtStock'>" + size[i].size + ":</label>";
            html += "<input type='text' name='txtStock[" + size[i].id_size + "]' class='form-control'>"
            html += "</div>";
        }
    }
    $('#divStock').html(html);
    var htmlberat = html.replace(/txtStock/g, 'txtBerat');
    $('#divBerat').html(htmlberat);
}

// UPDATE
var detail = "";
$('button#edit').on('click', function(){
    var href = $(this).attr('href');
    var idType = $(this).data('idtype');
    var idMat = $(this).data('idmat');
    var name = $(this).data('name');
    var desc = $(this).data('desc');
    var edition = $(this).data('edition');
    var disc = $(this).data('disc');
    var price = $(this).data('price');
    detail = $(this).data('detail');
    // alert(detail[0].id_size);

    $('#txtedIDType').val(idType);
    $('#txtedIDMaterial').val(idMat);
    $('#txtedNama').val(name);
    $('#txtedDesc').val(desc);
    $('#txtedHarga').val(price);
    $('#txtedEdisi').val(edition);
    $('#txtedDiskon').val(disc);

    $('#txtedUmur').val(detail[0].age);
    $('#txtedKelamin').val(detail[0].sex);

    htmledStock(detail);

    $('#updateForm').attr('action', href);
    $('#editProduk').modal('show');
});

$('#txtedUmur').on('change', function(){
    htmledStock(detail);
});

$('#txtedKelamin').on('change', function(){
    htmledStock(detail);
});

function htmledStock(detail){
    var size = $('select#txtedIDType :checked').data('size');
    var isiKelamin = $('select#txtedKelamin :checked').val();
    var isiUmur = $('select#txtedUmur :checked').val();
    var html = "";
    for(var i = 0; i < size.length; i++){
        if(size[i].umur === isiUmur && size[i].kelamin === isiKelamin){
            html += "<div class='col-sm-3'>";
            html += "<label for='txtedStock'>" + size[i].size + ":</label>";
            html += "<input type='text' name='txtedStock[" + size[i].id_size + "]' class='form-control'";
            if(detail !== undefined){
                for (let ii = 0; ii < detail.length; ii++) {
                    const element = detail[ii];
                    if(size[i].id_size === detail[ii].id_size){
                        html += "value='" + detail[ii].stock + "'";
                    }
                }
            }
            html += ">";
            html += "</div>";
        }
    }
    $('#divedStock').html(html);

    var htmlberat = "";
    for(var i = 0; i < size.length; i++){
        if(size[i].umur === isiUmur && size[i].kelamin === isiKelamin){
            htmlberat += "<div class='col-sm-3'>";
            htmlberat += "<label for='txtedBerat'>" + size[i].size + ":</label>";
            htmlberat += "<input type='text' name='txtedBerat[" + size[i].id_size + "]' class='form-control'";
            if(detail !== undefined){
                for (let ii = 0; ii < detail.length; ii++) {
                    const element = detail[ii];
                    if(size[i].id_size === detail[ii].id_size){
                        htmlberat += "value='" + detail[ii].berat + "'";
                    }
                }
            }
            htmlberat += ">";
            htmlberat += "</div>";
        }
    }
    $('#divedBerat').html(htmlberat);
}


// DELETE
$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var nama = $(this).data('nama');
    Swal.fire({
            title: "Anda yakin untuk menghapus data produk : \"" + nama + "\"?",
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
