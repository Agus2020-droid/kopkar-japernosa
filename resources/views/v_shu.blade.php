@extends ('layout.v_template')
@section('title','Sisa Hasil Usaha (SHU)')

@section('content')
<section class="content-header">
      <h1>SISA HASIL USAHA
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">SHU</a></li>
      </ol>
    </section>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header bg-green-active color-palette">
              <div class="pull-left">
                <h5><strong>TABEL SISA HASIL USAHA (SHU) </strong></h5>
              </div>

              <div class="pull-right">
                 <a href="#" class="btn btn-info btn-sm hint--top" aria-label="Notifikasi" data-toggle="modal" data-target="#modal-notifikasi"><i class="fa fa-bell"></i></a>
                <a href="#"  class="btn btn-warning btn-sm hint--top" aria-label="Upload" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-upload"></i></a>
              </div>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
            <div class="box-header">
              <div class="box-body table-responsive no-padding">
                @if (session('pesan'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{session('pesan')}}.
                  </div>
                @endif
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr>
                  <th class="bg-green color-palette text-center"><p class="text-center">No.</th>
                  <th class="bg-green color-palette text-center"><p class="text-center">Kode SHU</th>
                  <th class="bg-green color-palette text-center"><p class="text-center">Nik</th>
                  <th class="bg-green color-palette text-center"><p class="text-center">Nama</th>
                  <th class="bg-green color-palette text-center"><p class="text-center">Tahun Periode</th>
                  <th class="bg-green color-palette text-center"><p class="text-center">Jumlah</th>
                  <th class="bg-green color-palette text-center"><p class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach($shu as $item)
                  <tr>
                  <th class="text-center"><h5>{{$no++}}</h5></th>
                  <th class="text-center"><h5>SHU-{{$item->id_shu}}</h5></th>
                  <th class="text-center"><h5>{{$item->nik_karyawan}}</h5></th>
                  <th class="text-left"><h5>{{$item->nama}}</h5></th>
                  <th class="text-center"><h5>{{Carbon\Carbon::parse($item->tgl_shu)->format("Y")}}</h5></th>
                  <th class="text-right"><h5>@currency($item->jumlah_shu)</h5></th>
                  <td class="text-center"><a href="/shu/edit/{{$item->id_shu}}" class="btn btn-warning btn-sm hint--top" aria-label="Edit" ><i class="fa fa-pencil"></i></a>
                    <button type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$item->id_shu}}"><i class="fa fa-trash-o"></i></button>
                    </td>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              @foreach ($shu as $item)
              <div class="modal modal-danger fade" id="delete{{$item->id_shu}}" style="display: none;">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">NOMOR [SHU-{{$item->id_shu}}]</h4>
                    </div>
                    <div class="modal-body">
                      <p>Apakah Anda Yakin Akan Menghapus data Ini ?</p><hr>
                      <p>Nama : {{$item->nama}}</p>
                      <p>Jumlah SHU : {{"Rp.".format_uang($item->jumlah_shu)}}</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                      <a href="/shu/delete/{{$item->id_shu}}" class="btn btn-outline">Hapus</a>
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
                      <form action="{{ route('importshu') }}" method="post" enctype="multipart/form-data">
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
                <!-- /.modal-import-->
                <div class="modal modal-primary fade" id="modal-notifikasi" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Buat Notifikasi Slip</h4>
                      </div>
                      <form action="{{ route('pushShu') }}" method="post" enctype="multipart/form-data">
                          <div class="modal-body">
                            {{csrf_field()}}
                              <div class="form-group">
                                <input type="text" name="notifikasi" class="form-control" placeholder="Masukan pesan notifikasi">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-outline">Push</button>
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
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@endsection