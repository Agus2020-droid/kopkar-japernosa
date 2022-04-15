@extends ('layout.v_template')
@section('title','Edit Pinjaman')

@section('content')
<section class="content-header">
      <h1>EDIT PINJAMAN ANGGOTA
      <small>Form</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/pinjam">Pinjaman Anggota</a></li>
        <li class="active">Edit Pinjaman</a></li>
      </ol>
    </section>
<!-- /.pembatas -->

<session class="content">  
@foreach ($pinjaman as $key => $data)
@if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
<form class="form-horizontal" action="/pinjam/update/{{$data->no_pinjaman}}" method="post" enctype="multipart/form-data">
   @csrf
      
        <div class="col-md-12">
          <div class="box box-primary">
          <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">FORMULIR EDIT PINJAMAN</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

        <div class="box-body">
        <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
              <tr>
              <th colspan="3" class="bg-primary color-palette"><h4>INFORMASI PEMOHON</h4></th>
              </tr>
              </thead>
              <tbody>
              <tr>
              <td >
              <div class="box-body">
              <div class="row">               
                <div class="col-md-12 text-center">
                <img class="profile-user-img img-responsive rounded-circle" src="{{ url('public/public/foto_pegawai/'.$data->foto_pegawai) }}" alt="">
                <span class="
                  <?php
                    if($data->status == "NON AKTIF")
                    echo 'label label-danger';
                    else
                    echo ' label label-success';
                    ?>
                    ">{{$data->status}}</span>
              </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-2">
                  <label>NIK KTP</label>
                </div>
                
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->nik_ktp}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>NAMA LENGKAP</label>
                </div>
                
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->nama}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>NIK KARYAWAN</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->nik_karyawan}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>STATUS KEPEGAWAIAN</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->jabatan}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>TGL MASUK KERJA</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->tgl_masuk}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>USIA</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="<?php
                    // tanggal lahir
                    $tanggal = new DateTime($data->tgl_lahir);

                    // tanggal hari ini
                    $today = new DateTime('today');

                    // tahun
                    $y = $today->diff($tanggal)->y;

                    // bulan
                    $m = $today->diff($tanggal)->m;

                    // hari
                    $d = $today->diff($tanggal)->d;
                    echo  $y . " Tahun " . $m . " Bulan " . $d . " Hari";
                    ?>" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>NO. TELP</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->telp}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>ALAMAT</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->alamat}}" readonly>
                </div>
              </div>
            </div>
              </td>
              </tr>
              
              </tbody>
      </table>

        <input name="tgl_disetujui_ketua" type="hidden" class="form-control" value="{{date(now())}}"readonly>
        <input name="disetujui_ketua" type="hidden" class="form-control" value="{{Auth::user()->name}}">
        <!-- /.col -->
          
            <div class="box-header with-border bg-gray">
              <h3 class="box-title"><strong>DETAIL PINJAMAN</strong></h3>
            </div>
            <table id="example2" class="table table-bordered table-hover dataTable">
              <thead>
              </thead>
              <tbody>
              <tr>
                          <td >
                          <div class="box-body">
                          <div class="row">
                            <div class="col-md-2">
                              <label>NO. PINJAMAN</label>
                            </div>
                            
                            <div class="col-md-10">
                              <input name="no_pinjaman" type="text" class="form-control" value="{{$data->no_pinjaman}}" readonly>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>TGL PENGAJUAN</label>
                            </div>
                            
                            <div class="col-md-10">
                              <input name="tgl_pengajuan"type="text" class="form-control" value="{{$data->tgl_pengajuan}}" readonly>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>JENIS PINJAMAN</label>
                            </div>
                            <div class="col-md-10">
                            <select name="jenis_pinjaman" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" value="{{$data->jenis_pinjaman}}">
                                <option value="{{$data->jenis_pinjaman}}"readonly>{{$data->jenis_pinjaman}} (current)</option>
                                <option value="Pengembangan">Pengembangan</option>
                                <option value="Pinjaman Sosial">Pinjaman Sosial</option>
                                </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>NAMA BARANG</label>
                            </div>
                            <div class="col-md-10">
                              <input name="nama_barang" type="text" class="form-control" value="{{$data->nama_barang}}" >
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>MERK/BRAND</label>
                            </div>
                            <div class="col-md-10">
                              <input name="merk"type="text" class="form-control" value="{{$data->merk}}" >
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>SPESIFIKASI</label>
                            </div>
                            <div class="col-md-10">
                              <input name="spesifikasi" type="text" class="form-control" value="{{$data->spesifikasi}}" >
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>UNIT</label>
                            </div>
                            <div class="col-md-10">
                              <input name="unit" type="text" class="form-control" value="{{$data->unit}}" >
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>TENOR</label>
                            </div>
                            <div class="col-md-10">
                            <select name="tenor" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" id="tenor" value="{{$data->tenor}}">
                                <option value="{{$data->tenor}}"readonly>{{$data->tenor}} Bulan (default)</option>
                                <option value="1">1 Bulan</option>
                                <option value="2">2 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="4">4 Bulan</option>
                                <option value="5">5 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="7">7 Bulan</option>
                                <option value="8">8 Bulan</option>
                                <option value="9">9 Bulan</option>
                                <option value="10">10 Bulan</option>
                                <option value="11">11 Bulan</option>
                                <option value="12">12 Bulan</option>
                                </select>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>PLAFON</label>
                            </div>
                            <div class="col-md-10">
                              <input id="plafon" name="plafon" type="text" class="form-control" value="{{$data->plafon}}" >
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>JATUH TEMPO</label>
                            </div>
                            <div class="col-md-10">
                              <input name="periode_angsuran"type="text" class="form-control" id="datepicker" value="{{$data->periode_angsuran}}" >
                            </div>
                            @error('periode_angsuran')
                            <span class="label label-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>% PENGEMBANGAN</label>
                            </div>
                            <div class="col-md-10">
                              <input id="bunga" name="bunga" type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->bunga}}" >
                            </div>
                            @error('bunga')
                            <p class="label label-danger">{{$message}}</p>
                            @enderror
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>TOTAL KREDIT</label>
                            </div>
                            <div class="col-md-10">
                              <input id="kredit" name="total_kredit"type="text" class="form-control" value="{{$data->total_kredit}}" readonly>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>ANGSURAN PER BULAN</label>
                            </div>
                            <div class="col-md-10">
                              <input id="hasil" name="angsuran" type="text" class="form-control" value="{{$data->angsuran}}" readonly>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>VERIFIKASI</label>
                            </div>
                            <div class="col-md-10">
                            <select name="status_pengajuan" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" id="status" value="{{$data->status_pengajuan}}">
                                  <option value="{{$data->status_pengajuan}}"readonly>{{$data->status_pengajuan}} (current)</option>
                                  <option class="bg-green"value="VERIFIED">VERIFIED</option>
                                  <option class="bg-orange"value="WAITING VERIFIED">WAITING VERIFIED</option>
                                  <option class="bg-yellow"value="PENDING">PENDING</option>
                                  <option class="bg-red"value="CANCEL">CANCEL</option>
                              </select> 
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-2">
                              <label>CATATAN</label>
                            </div>
                            <div class="col-md-10">
                            
                            
                           
                            <select name="note" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true">
                                  <option value="{{$data->note}}">{{$data->note}} (current)</option>
                                  <option value="LANJUT APPROVAL HRD & KETUA">LANJUT APPROVAL HRD & KETUA</option>
                                  <option value="LAIN-LAIN">LAIN-LAIN</option>
                              </select> 
                              
                            <!-- <textarea name="note" id="myTextarea" class="textarea" value="{{Auth::user()->name}}{!!$data->note!!}"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;display: ;" placeholder="Place some text here"></textarea> -->
                            @error('note')
                                <span class="label label-danger">{{$message}}</span>
                                @enderror
                                <!-- <input type="hidden" name="_wysihtml5_mode" value="1"> -->
                            </div>
                          </div>
                        </div>
                          </td>
                          </tr>          
              </tbody>
            </table>
            <input name="tgl_verifikasi" type="hidden" class="form-control" value="{{Carbon\Carbon::parse(date(now()))->format("d-M-y H:i:s")}}" readonly>
            <input name="verifikator" type="hidden" class="form-control" value="{{Auth::user()->name}}" readonly>
            <input name="notifikasi" type="hidden" class="form-control" value="Verifikasi pinjaman {{$data->nama}}" readonly>
            @endforeach
            <div class="col-md-12">
              <br>
              <a href="/pengajuan" class="btn btn-default pull-left">CANCEL</a>
              <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
            </div>
  </div>
</form>
</session>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(".form-horizontal").keyup(function() {
      //var rupiah = parseInt($("#rupiah").val())
      var plaf = parseInt($("#plafon").val())
      var bung = parseInt($("#bunga").val())
      var ten = parseInt($("#tenor").val())

      var kred = (plaf+(plaf*(bung/100)));
  
      var angs = kred/ten;
      $("#hasil").attr("value",angs)
      $("#kredit").attr("value",kred)

    }); 
</script>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css"> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
<script src="https://cdn.tiny.cloud/1/4lytlq894hdf57n0a2qnd8on611qlofx8n8uxk1n0p61vytl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('template/')}}bower_components/ckeditor/ckeditor.js"></script>
<script src="{{asset('template/')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
tinymce.init({
  selector:'#myTextarea'
});
</script>
@endsection