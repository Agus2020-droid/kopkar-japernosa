@extends ('layout.v_template')
@section('title','ANGSURAN ANGGOTA')

@section('content')
<section class="content-header">
      <h1>@yield('title')
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Angsuran</a></li>
      </ol>
    </section>

<!-- /.tabel 2 -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
            <div class="box-header bg-blue-active color-palette">
              <div class="pull-left">
                <h5><strong>TABEL ANGSURAN </strong></h5>
                </div>
              
                <div class="pull-right">
                <!-- <a href="/angsuran/tambah" class="btn btn-success btn-sm hint--top" aria-label="Tambah Angsuran"><i class="fa fa-plus"></i></a> -->
                <a href="{{ route('exportangsuran')}}" class="btn btn-default btn-sm hint--top" aria-label="Download"><i class="fa fa-download"></i></a>
                <a href="#"  class="btn btn-warning btn-sm hint--top" aria-label="Upload" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-upload"></i></a>
                </div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
                @if (isset($errors) && $errors->any())
                  <div class="alert alert-danger">
                      @foreach($errors->all() as $error)
                      {{$error}}
                      @endforeach 
                  </div>
                  @endif
            <!-- /.box-header -->
            <div class="box-header">
              <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th class="bg-blue color-palette"><p class="text-center">No.</th>
                <th class="bg-blue color-palette"><p class="text-center">Kode </th>
                <th class="bg-blue color-palette"><p class="text-center">Tanggal Angsuran</th>
                <th class="bg-blue color-palette"><p class="text-center">Kode Pinjaman </th>
                <th class="bg-blue color-palette"><p class="text-center">NIK Karyawan </th>
                <th class="bg-blue color-palette"><p class="text-center">Nama Anggota</th>
                <th class="bg-blue color-palette"><p class="text-center">Nominal</th>
                <th class="bg-blue color-palette"><p class="text-center">Option</p></th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($angsuran as $key => $item)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>A-{{ $item->id_angsuran}}</td>
                  <td>{{tanggal_local($item->tgl_angsuran)}}</td>
                  <td>P-{{ $item->no_pinjaman}}</td>
                  <td>{{ $item->nik_karyawan}}</td>
                  <td>{{ $item->nama}}</td>
                  <td>@currency($item->jumlah_angsuran)</td>
                  <td>
                  <a href="/angsuran/edit/{{$item->id_angsuran}}" class="btn btn-warning btn-sm" ><i class="fa fa-pencil"></i></a>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$item->id_angsuran}}"><i class="fa fa-trash-o"></i></button>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>

              @foreach ($angsuran as $data)
              <div class="modal modal-danger fade" id="delete{{$data->id_angsuran}}" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Kode Pinjaman [A-{{$data->id_angsuran}}]</h4><hr>
                    <div class="col-12">
                      <div class="col-sm-4">
                        Nama Karyawan <br>
                        Nik           <br>
                        Status        <br>
                      </div>
                      <div class="col-sm-1">
                        :<br>
                        :<br>
                        :<br>
                      </div>
                      <div class="col-sm-4">
                        {{$data->nama}}<br>
                        {{$data->nik_karyawan}}<br>
                        {{$data->jabatan}}<br><br>
                      </div>
                    </div>
                    
                    <div class="col-12">
                    <h6><p></p></h6>
                      <div class="col-sm-4">
                        Tgl Angsuran<br>
                        No. Pinjaman<br>
                        Jumlah Angsuran<br>
                      </div>
                      <div class="col-sm-1">
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                      </div>
                      <div class="col-sm-4">
                        {{tanggal_local($data->tgl_angsuran)}}<br>
                        P-{{$data->no_pinjaman}}<br>
                        {{"Rp. ".format_uang($data->jumlah_angsuran)}}<br>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                  Apakah yakin akan menghapus data ini ?
                   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                    <a href="/angsuran/delete/{{$data->id_angsuran}}" class="btn btn-outline">Hapus</a>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
            </div>
          @endforeach
          <!-- /.modal-import-->
          <div class="modal modal-primary fade" id="modal-warning" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Import Data Angsuran</h4>
                  </div>
                  <form action="{{ route('importangsuran') }}" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                        {{csrf_field()}}
                          <div class="form-group">
                            <input type="file" name="file" required="required">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Selesai</button>
                        <button type="submit" class="btn btn-outline">Import</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.modal-import -->
            </div>
            </div>
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
<!-- tabel2 -->
@endsection