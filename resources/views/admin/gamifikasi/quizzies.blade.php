@extends('admin.admin')
@push('style')
{{-- aditional style --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<style>

</style>
@endpush

@section('content')

<div class="home-content">
    <div class="page-content container-fluid">
        <div class="row">
            <!-- Modal Tambah -->
            <div id="tambahQuiz" name="tambahQuiz" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="tambahQuizLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="tambahQuizLabel"><b>Tambah Data Quiz</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('quiz.store') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="txtPertanyaan">Pertanyaan</label><br>
                                    <input type="text" class="form-control" id="txtPertanyaan" name="txtPertanyaan"
                                        placeholder="Masukkan pertanyaan quiz">
                                </div>
                                <div class="form-group">
                                    <label for="txtJawaban[]">Jawaban Pertama</label><br>
                                    <input type="text" class="form-control" id="txtJawaban[]" name="txtJawaban[]"
                                        placeholder="Masukkan jawaban pertama">
                                </div>
                                <div class="form-group">
                                    <label for="txtJawaban[]">Jawaban kedua</label><br>
                                    <input type="text" class="form-control" id="txtJawaban[]" name="txtJawaban[]"
                                        placeholder="Masukkan jawaban kedua">
                                </div>
                                <div class="form-group">
                                    <label for="txtJawaban[]">Jawaban ketiga</label><br>
                                    <input type="text" class="form-control" id="txtJawaban[]" name="txtJawaban[]"
                                        placeholder="Masukkan jawaban ketiga">
                                </div>
                                <div class="form-group">
                                    <label for="txtJawaban[]">Jawaban keempat</label><br>
                                    <input type="text" class="form-control" id="txtJawaban[]" name="txtJawaban[]"
                                        placeholder="Masukkan jawaban keempat">
                                </div>
                                <div class="form-group">
                                    <label for="txtJawabanBenar">Jawaban yang benar</label><br>
                                    <select name="txtJawabanBenar" id="txtJawabanBenar" class="form-control">
                                        <option value="" selected hidden disabled>Pilih jawaban yang benar</option>
                                        <option value="0">Jawaban Pertama</option>
                                        <option value="1">Jawaban Kedua</option>
                                        <option value="2">Jawaban Ketiga</option>
                                        <option value="3">Jawaban Keempat</option>
                                    </select>
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
            <div id="editQuiz" name="editQuiz" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editQuizLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editQuizLabel"><b>Edit Data Quiz</b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="txtedPertanyaan">Pertanyaan</label><br>
                                    <input type="text" class="form-control" id="txtedPertanyaan" name="txtedPertanyaan"
                                        placeholder="Masukkan pertanyaan quiz">
                                </div>
                                <div class="form-group">
                                    <label for="txtedJawaban[]">Jawaban Pertama</label><br>
                                    <input type="text" class="form-control" name="txtedJawaban[]" id="jawab1"
                                        placeholder="Masukkan jawaban pertama">
                                </div>
                                <div class="form-group">
                                    <label for="txtedJawaban[]">Jawaban kedua</label><br>
                                    <input type="text" class="form-control" name="txtedJawaban[]" id="jawab2"
                                        placeholder="Masukkan jawaban kedua">
                                </div>
                                <div class="form-group">
                                    <label for="txtedJawaban[]">Jawaban ketiga</label><br>
                                    <input type="text" class="form-control" name="txtedJawaban[]" id="jawab3"
                                        placeholder="Masukkan jawaban ketiga">
                                </div>
                                <div class="form-group">
                                    <label for="txtedJawaban[]">Jawaban keempat</label><br>
                                    <input type="text" class="form-control" name="txtedJawaban[]" id="jawab4"
                                        placeholder="Masukkan jawaban keempat">
                                </div>
                                <div class="form-group">
                                    <label for="txtedJawabanBenar">Jawaban yang benar</label><br>
                                    <select name="txtedJawabanBenar" id="txtedJawabanBenar" class="form-control">
                                        <option value="" selected hidden disabled>Pilih jawaban yang benar</option>
                                        <option value="0">Jawaban Pertama</option>
                                        <option value="1">Jawaban Kedua</option>
                                        <option value="2">Jawaban Ketiga</option>
                                        <option value="3">Jawaban Keempat</option>
                                    </select>
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
                        <h4 class="card-title" style="display:inline-block;">Data Quiz</h4>
                        <div class="card-title float-right mb-12" id="sumbutton">
                            <button type="button" class="btn btn-info mb-6" data-toggle="modal" data-target="#tambahQuiz" id="tambah" name="tambah">
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
                                        <th>Pertanyaan</th>
                                        <th>Jawaban</th>
                                        <th>Jawaban yang benar</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($number = 1)
                                    @foreach($quizzes as $row)
                                    <tr>
                                        <td rowspan="{{ count($row->answer) }}">{{ $number }}.</td>
                                        <td rowspan="{{ count($row->answer) }}">{{ !empty($row->pertanyaan) ? $row->pertanyaan:"" }}</td>
                                        @foreach($row->answer as $row2)
                                            @if($loop->first != true)
                                                <tr>
                                            @endif
                                            <td>{{ !empty($row2->jawab) ? $row2->jawab:"" }}</td>
                                            <td>@if($row2->benar == true) Benar @else Salah @endif</td>
                                            @if($loop->first != true)
                                                </tr>
                                            @endif
                                            @if($loop->first)
                                            <td rowspan="{{ count($row->answer) }}" class="text-center">
                                                <button class="btn btn-primary btn-sm" id="edit" href="{{ route('quiz.update',  $row->id_quiz) }}"
                                                    data-pertanyaan="{{ $row->pertanyaan }}"
                                                    data-jawab1="{{ $row->answer->first()->jawab }}"
                                                    data-jawab2="{{ $row->answer->skip(1)->first()->jawab }}"
                                                    data-jawab3="{{ $row->answer->skip(2)->first()->jawab }}"
                                                    data-jawab4="{{ $row->answer->skip(3)->first()->jawab }}"
                                                    data-benar="{{ $row->answer->where('benar', true)->first()->jawab }}"
                                                    ><i class="fa fa-edit"> </i></button>

                                                <button href="{{ route('quiz.destroy', $row->id_quiz) }}"
                                                    class="btn btn-danger  btn-sm" id="delete"
                                                    data-nama="{{ $row->pertanyaan }}">
                                                    <i class="fa fa-trash"> </i>
                                                </button>
                                            </td>
                                        </tr>
                                            @endif
                                        @endforeach
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

<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script>
var html = [];

$('button#tambah').on('click', function() {

});

$('button#edit').on('click', function() {
    // alert('tes');
    var pertanyaan = $(this).data("pertanyaan");
    var jawab1 = $(this).data("jawab1");
    var jawab2 = $(this).data("jawab2");
    var jawab3 = $(this).data("jawab3");
    var jawab4 = $(this).data("jawab4");
    var benar = $(this).data("benar");
    var val = "";
    if(benar == jawab1){
        val = 0;
    }
    if(benar == jawab2){
        val = 1;
    }
    if(benar == jawab3){
        val = 2;
    }
    if(benar == jawab4){
        val = 3;
    }
    // alert(jawab1);
    var href = $(this).attr('href');
    $('#txtedPertanyaan').val(pertanyaan);
    $('#jawab1').val(jawab1);
    $('#jawab2').val(jawab2);
    $('#jawab3').val(jawab3);
    $('#jawab4').val(jawab4);
    $('#txtedJawabanBenar').val(val);
    $('#updateForm').attr('action', href);
    $("#editQuiz").modal('show');
});

$('button#delete').on('click', function() {
    var href = $(this).attr('href');
    var nama = $(this).data('nama');
    Swal.fire({
            title: "Anda yakin untuk menghapus data pertanyaan : \"" + nama + "\"?",
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
