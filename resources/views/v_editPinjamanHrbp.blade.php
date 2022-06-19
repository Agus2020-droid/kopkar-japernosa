@extends ('layout.v_template')
@section('title','Approval Pinjaman')

@section('content')
<section class="content-header">
      <h1>APPROVAL PINJAMAN 
      <small>Formulir</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/pengajuanHrbp">Pengajuan Pinjaman</a></li>
        <li class="active">Edit Pinjaman</a></li>
      </ol>
    </section>
<!-- /.pembatas -->

<session class="content">
@if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif     
@foreach ($pinjaman as $key => $data)
<form class="form-horizontal" action="/pinjamHrbp/update/{{$data->no_pinjaman}}" method="post" enctype="multipart/form-data">
   @csrf
      
        <div class="col-md-12">
          <div class="box box-primary">
          <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">FORMULIR APPROVAL PINJAMAN (HRBP)</h3>
          <!-- <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div> -->
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
        <input name="tgl_disetujui_hrbp" type="hidden" class="form-control" value="{{date(now())}}">
        <input name="disetujui_hrbp" type="hidden" class="form-control" value="{{Auth::user()->nik_ktp}}">
        <!-- /.col -->
            <div class="box-header bg-blue color-palette">
              <h3 class="box-title">DETAIL PINJAMAN</h3>
            </div>
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
              <tr>
              </tr>
              </thead>
              <tbody>
              <tr>
              <td >
              <div class="box-body">
              <div class="row">
                <div class="col-md-2">
                  <label>KODE PINJAMAN</label>
                </div>
                
                <div class="col-md-10">
                  <input type="text" class="form-control" value="P-{{$data->no_pinjaman}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>TANGGAL PENGAJUAN</label>
                </div>
                
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->tgl_pengajuan}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>JENIS PINJAMAN</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->jenis_pinjaman}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>NAMA BARANG</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->nama_barang}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>MERK</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->merk}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>SPESIFIKASI</label>
                </div>
                <div class="col-md-10">
                <input type="text" class="form-control" value="{{$data->spesifikasi}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>PLAFON</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->plafon}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>TENOR</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->tenor}} bulan" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>PERIODE ANGSURAN</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->periode_angsuran}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>PENGEMBANGAN</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->bunga}} %" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>TOTAL KREDIT</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="Rp. {{format_uang($data->total_kredit)}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>ANGSURAN</label>
                </div>
                <div class="col-md-10">
                  <input type="text" class="form-control" value="Rp. {{format_uang($data->angsuran)}} / bulan" readonly>
                </div>
              </div>
            </div>
              </td>
              </tr>
              
              </tbody>
        </table>
            
            <div class="box box-primary">
            </div>
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
              <tr>
              </tr>
              </thead>
              <tbody>
              <tr>
              <td >
              <div class="box-body">
              <div class="row">
                <div class="col-md-2">
                  <label>TANGGAL VERIFIKASI</label>
                </div>
                
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->tgl_verifikasi}}" readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-md-2">
                  <label>NAMA ADMIN</label>
                </div>
                
                <div class="col-md-10">
                  <input type="text" class="form-control" value="{{$data->verifikator}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                  <label>APPROVAL HRBP</label>
                </div>
                
                <div class="col-md-10">
                <select name="ttd_hrbp" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" id="status" value="{{$data->ttd_hrbp}}">
                      <option value="{{$data->ttd_hrbp}}"readonly>{{$data->ttd_hrbp}} (current)</option>
                      <option class="bg-blue"value="PENDING">PENDING</option>
                      <option class="bg-green"value="APPROVED">APPROVED</option>
                      <option class="bg-orange"value="WAITING APPROVAL">WAITING APPROVAL</option>
                      <option class="bg-red" value="NOT APPROVED">NOT APPROVED</option>
                  </select>  
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                  <label>CATATAN HRBP</label>
                </div>
                
                <div class="col-md-10">
                <textarea name="note" id="summernote" class="textarea" value="{{Auth::user()->name}}{!!$data->note!!}"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;display: ;" placeholder="Silahkan ketik pesan ....."></textarea>
                @error('note')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
              </td>
              </tr>
              
              </tbody>
        </table>

            <div class="row">
                <input name="notifikasi" type="hidden" value="Re: Pinjaman {{$data->nama}}">
                <input name="foto_user" type="hidden" value="{{auth()->user()->foto_user}}">
                <input name="name" type="hidden" value="{{auth()->user()->name}}">
                @endforeach
                <div class="col-md-12">
                  <a href="/pengajuanHrbp"type="submit" class="btn btn-default pull-left">CANCEL</a>
                  <button type="submit" class="btn btn-primary pull-right">SUBMIT</button>
                </div>
              </div>
            </div>
  </div>
</form>
</session>
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css"> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.tiny.cloud/1/4lytlq894hdf57n0a2qnd8on611qlofx8n8uxk1n0p61vytl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('template/')}}bower_components/ckeditor/ckeditor.js"></script>
<script src="{{asset('template/')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
tinymce.init({
  selector:'#myTextarea'
});
</script>
@endsection