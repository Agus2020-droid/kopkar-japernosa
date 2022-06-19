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
                <th class="bg-blue color-palette"><p class="text-center">Kode Pinjam </th>
                <th class="bg-blue color-palette"><p class="text-center">Nama Anggota</th>
                <th class="bg-blue color-palette"><p class="text-center">NIK Karyawan </th>
                <th class="bg-blue color-palette"><p class="text-center">Total Angsuran</th>
                <th class="bg-blue color-palette"><p class="text-center">Option</p></th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($angsuran as $key => $item)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>P-{{ $item->no_pinjaman}}</td>
                  <td>{{ $item->nama}}</td>
                  <td>{{ $item->nik_ktp}}</td>
                  <td>@currency($item->total_angsuran)</td>
                  <td>
                  <a href="/angsuran/detail/{{$item->no_pinjaman}}" class="btn btn-primary btn-sm" ><i class="fa fa-eye"></i> View detail</a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>

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