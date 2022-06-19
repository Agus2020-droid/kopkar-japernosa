@extends ('layout.v_template')
@section('title','ANGGOTA KOPKAR JAPERNOSA')

@section('content')
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
                <h5><strong>DAFTAR ANGGOTA KOPERASI</strong></h5>
              </div>
            
              <div class="pull-right">
                <a href="/cetakPendaftaran" target="_blank"class="btn btn-default btn-sm hint--top" aria-label="Cetak Form Pendaftaran"><i class="fa fa-user"></i></a>
                <a href="/tambah" class="btn btn-success btn-sm hint--top" aria-label="Tambah Anggota"><i class="fa fa-plus"></i></a>
                <a href="{{ route('exportpegawai')}}" class="btn btn-default btn-sm hint--top" aria-label="Download"><i class="fa fa-download"></i></a>
                <a href="#"  class="btn btn-warning btn-sm hint--top" aria-label="Upload" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-upload"></i></a>
              </div>
            </div>

  <div class="table-responsive" style="border-width: 3px; padding: 1.5em .5em .5em;">

  <table id="example1" class="table table-hover text-nowrap table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Tgl Lahir</th>
        <th>Status</th>
        <th>Keanggotaan</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php $no=1; ?>
    @foreach ($pegawai as $key => $item)
      <tr>
      <td>{{ $no++}}</td>
        <td>{{$item->nama}}</td>
        <td>{{$item->tgl_lahir}}</td>
        <td>{{$item->jabatan}}</td>
        <td><span 
        <?php
        if($item->status == "AKTIF")
        echo 'class="label label-success"';
        else
        echo 'class="label label-danger"';
        ?>>
        {{$item->status}}</span></td>
        <td>
          <a href="{{ url('anggota/'.$item->nik_ktp) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>
          <a href="{{ url('pegawai/edit/'.$item->nik_ktp) }}" class="btn btn-sm bg-teal"><i class="fa fa-pencil"></i></a>
          <a type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$item->nik_ktp}}"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

            

                @foreach ($pegawai as $item)
                <div class="modal modal-danger fade" id="delete{{$item->nik_ktp}}" style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">{{$item->nik_ktp}} - {{$item->nama}}</h4>
                      </div>
                      <div class="modal-body">
                        <p>Apakah Anda Yakin Akan Menghapus Data Ini ?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                        <a href="/pegawai/delete/{{$item->nik_ktp}}" class="btn btn-outline">Hapus</a>
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
                      <h4 class="modal-title">Import Data</h4>
                    </div>
                    <form action="{{ route('importpegawai') }}" method="post" enctype="multipart/form-data">
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>-->
<!--@if (Session::has('success'))-->
<!--  <script>-->
<!--  swal("Greet Job!","{!! session::get('success') !!}","success",{-->
<!--    button:"OK",-->
<!--  })-->
<!--  </script>-->
  
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
@endif
<!-- tabel2 -->
@endsection
