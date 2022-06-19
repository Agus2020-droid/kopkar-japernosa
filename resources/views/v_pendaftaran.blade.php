@extends ('layout.v_template')
@section('title','CALON ANGGOTA')

@section('content')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>@yield('title')
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Anggota</a></li>
      </ol>
</section>

<!-- /.tabel 2 -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
            {{session('success')}}
            </div>
        @endif
          <!-- /.box -->
          @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <div class="box">
            <div class="box-header bg-blue color-palette">
              <div class="pull-left">
                <h5><strong>DAFTAR CALON ANGGOTA KOPERASI</strong></h5>
              </div>
            
              <div class="pull-right">
                <!-- <a href="/cetakPendaftaran" target="_blank"class="btn btn-default btn-sm hint--top" aria-label="Cetak Form Pendaftaran"><i class="fa fa-print"></i></a> -->
              </div>
            </div>

  <div class="table-responsive" style="border-width: 3px; padding: 1.5em .5em .5em;">

  <table id="example1" class="table table-hover text-nowrap table-striped">
    <thead >
      <tr class="bg-info">
        <th class="text-center">#</th>
        <th class="text-center">Nama</th>
        <th class="text-center">Tgl Daftar</th>
        <th class="text-center">Status</th>
        <th class="text-center">Action</th>
        <th class="text-center">Send</th>
      </tr>
    </thead>
    <tbody>
    <?php $no=1; ?>
    @foreach ($pendaftaran as $key => $item)
      <tr>
      <td>{{ $no++}}</td>
        <td>{{$item->nama_lengkap}}</td>
        <td>{{$item->created_at}}</td>
        <td><span style="font-size: 14px" 
        <?php
        if($item->status == "Staf")
        echo 'class="label label-success label-lg"';
        elseif($item->status == "Kontrak")
        echo 'class="label label-info label-md"';
        else
        echo 'class="label label-danger label-md"';
        ?>>
        {{$item->status}}</span></td>
        <td class="text-center">
          <a type="button" class="btn btn-primary btn-sm hint--top" aria-label="View" data-toggle="modal" data-target="#view{{$item->id_pendaftaran}}">Detail</a>
          <a href="{{ url('pendaftaran/edit/'.$item->id_pendaftaran) }}" class="btn btn-sm bg-teal">Edit</a>
          <a href="{{ url('cetakPendaftaran/'.$item->id_pendaftaran) }}" target="_blank"class="btn btn-warning btn-sm hint--top" aria-label="Cetak Form Pendaftaran">Print</a>
          <a type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$item->id_pendaftaran}}">Hapus</a>
        </td>
        <td>
          <a href="" class="btn btn-md btn-default"><i class="fa fa-envelope"></i></a>
          <a href="https://api.whatsapp.com/send?phone=62{{$item->telepon}}" class="btn btn-md btn-success" target="_blank"><i class="fa fa-whatsapp"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @foreach ($pendaftaran as $item)
  <div class="modal modal-default fade" id="view{{$item->id_pendaftaran}}" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-light-blue">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">INFORMASI CALON ANGGOTA </h4>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
                <tr >
                  <th class="text-center bg-light-blue">FOTO</th>
                  <th class="text-center bg-light-blue">FOTO KTP</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center"><img src="{{ asset('storage/foto_user/'.$item->foto_kry) }}" width="150px" class="img-thumbnail"></td>
                  <td class="text-center"><img src="{{ asset('storage/foto_ktp/'.$item->file) }}" width="250px" class="img-thumbnail"></td>
                </tr>
              </tbody>
            </table>

            <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
                <tr >
                  <th class="text-center bg-light-blue">INFORMASI DATA DIRI</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-2 control-label" >No. KTP</label>
                      <div class="col-md-10">
                        <input name="nik_ktp" class="form-control" placeholder="Max. 17 Digit" value="{{$item->nik_ktp}}" readonly>
                      </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                      <label class="col-sm-2 control-label" >Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input name="nama" class="form-control" placeholder="Masukan Nama Lengkap" value="{{$item->nama_lengkap}}" readonly>
                    </div>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Nik Karyawan</label>
                      <div class="col-sm-10">
                        <input name="nik_karyawan" class="form-control" value="{{$item->nik_karyawan}}" >
                      </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                      <input name="tempat_lahir" class="form-control" value="{{$item->tmpt_lhr}}">
                    </div>
                  </div>
                  <!-- /.form-group -->
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tanggal Lahir:</label>
                      <div class="col-sm-10">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input name="tgl_lahir" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{$item->tgl_lhr}}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Tanggal Masuk:</label>
                      <div class="col-sm-10">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input name="tgl_masuk" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{$item->tgl_masuk}}">
                        </div>
                      </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                    <input  type="text" class="form-control" value="{{$item->status}}">
                    </div>
                  </div>


                    <div class="form-group">
                      <label class="col-sm-2 control-label">Alamat Lengkap</label>
                      <div class="col-sm-10">
                        <input  class="form-control"  value="{{$item->alamat_ktp}}">
                      </div>
                    </div>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>

            <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
                <tr >
                  <th class="text-center bg-light-blue">CONTACT PERSONAL</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-md-2 control-label" >Email</label>
                      <div class="col-md-10">
                        <input  class="form-control" placeholder="Max. 17 Digit" value="{{$item->alamat_email}}" readonly>
                      </div>
                    </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                      <label class="col-sm-2 control-label" >No. WhatApp/Telp</label>
                    <div class="col-sm-10">
                      <input  class="form-control" placeholder="Masukan Nama Lengkap" value="{{$item->telepon}}" readonly>
                    </div>
                  </div>
                    </form>
                  </td>
                </tr>
              </tbody>
            </table>
            

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">CLOSE</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  @endforeach
            

  @foreach ($pendaftaran as $item)
  <div class="modal modal-danger fade" id="delete{{$item->id_pendaftaran}}" style="display: none;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Konfirmasi hapus data !</h4>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin menghapus data calon anggota dengan nama <u>{{$item->nama_lengkap}}</u> ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
          <a href="/pendaftaran/delete/{{$item->id_pendaftaran}}" class="btn btn-outline">Hapus</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>
  @endforeach

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
 <script>
 swal("Greet Job!","{!! session::get('success') !!}","success",{
   button:"OK",
 })
 </script>
  @endif
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : true
    })
  
    })
</script>

<!-- tabel2 -->
@endsection
