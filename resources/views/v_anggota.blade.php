@extends ('layout.v_template')
@section('title','ANGGOTA KOPKAR JAPERNOSA')

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
                <h5><strong>DAFTAR ANGGOTA KOPERASI</strong></h5>
              </div>
            
              <div class="pull-right">
                <a href="/pendaftaran" target="_blank"class="btn btn-default btn-sm hint--top" aria-label="Cetak Form Pendaftaran"><i class="fa fa-user"></i></a>
                <a href="/tambah" class="btn btn-success btn-sm hint--top" aria-label="Tambah Anggota"><i class="fa fa-plus"></i></a>
                <a href="{{ route('exportpegawai')}}" class="btn btn-default btn-sm hint--top" aria-label="Download"><i class="fa fa-download"></i></a>
                <a href="#"  class="btn btn-warning btn-sm hint--top" aria-label="Upload" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-upload"></i></a>
              </div>
            </div>

  <div class="box box-header" style="border-width: 3px; padding: 1.5em .5em .5em;border-radius: 0.5em;">

  <!-- /.box-header -->
  <table id="example1" class="table table-bordered table-hover">
    <thead class="hidden">
      <tr>
        <th></th>
      </tr>
    </thead>
    <body>
    @foreach ($pegawai as $key => $item)
    <tr>
      <td>      
      <section class="content-center">
            <div class="card card-solid">
              <div class="card-body pb-0">
                <div class="row">
                  <div class="col-sm-12 ">
                    <div class="box-header border-primary box-comments" style="border-width: 3px; padding: 1.5em .5em .5em;
          box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                    <div class="card bg-light d-flex flex-fill">
                      <div class="card-header text-muted border-bottom-0">
                        
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                        <div class="col-sm-4 text-center">
                            <img src="{{ asset('public/public/foto_pegawai/'.$item->foto_pegawai) }}" alt="user-avatar" class="profile-user-img img-responsive img-circle" style="height: 120px;width: 120px;">
                            <small class="description">Terakhir Login<br> {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</small>
                          </div>
                          <div class="col-sm-8" >
                            <h3 class="text-blue"><b>{{$item->nama}}</b></h3>
                            <p class="text-muted"><b>NIK KTP : </b> {{$item->nik_ktp}} <br>
                      <b>Status Keanggotaan : </b><i class="fa fa-circle 
                          <?php
                        if($item->status == 'AKTIF')
                        echo 'text-success';
                        else 
                        echo 'text-danger';
                        ?>"></i> {{$item->status}} </p>
                        
                      <div class="progress-bar" style="width: 100%;height: 3px;"></div><br>
                    
                            <ul class="md-4 mb-2 fa-ul text-muted">
                              <li class="small"><span class="fa-li"><i class="fa fa-lg fa-building"></i></span> <p>Alamat : {{$item->alamat}}</p></li>
                              <li class="small"><span class="fa-li"><i class="fa fa-lg fa-calendar"></i></span> <p>Lahir : {{$item->tempat_lahir}}, {{Carbon\Carbon::parse($item->tgl_lahir)->isoformat("D MMMM YYYY")}}</p></li>
                              <li class="small"><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> <p>No. HP : {{$item->telp}}</p></li>
                              <li class="small"><span class="fa-li"><i class="fa fa-lg fa-envelope-o"></i></span> <p>Email : {{$item->email}}</p></li>
                            </ul>
                          </div>

            
                        </div>
                      </div>
                      <div class="card-footer">
                        <div class="text-right">
                          <a href="{{ url('pegawai/edit/'.$item->nik_ktp) }}" class="btn btn-sm bg-teal">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$item->nik_ktp}}">
                            <i class="fa fa-trash"></i>
                          </a>
                          <a href="{{ url('anggota/'.$item->nik_ktp) }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-eye"></i> View Profile
                          </a>
                        </div>
                      </div>
                    </div>

                    </div>

                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->

            </div>
      </section>
      </td>
    </tr>
    @endforeach     
    </body> 
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
