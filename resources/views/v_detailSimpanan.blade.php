@extends ('layout.v_template')
@section('title','DETAIL SIMPANAN')

@section('content')
<section class="content-header">
      <h1>@yield('title')
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Simpanan</a></li>
      </ol>
    </section>
<!-- /.tabel 2 -->
<section class="content">
<div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header bg-blue-active color-palette">
            <div class="row">
              <div class="col-sm-3 ">
                <ul class="list-group ">
                  <li class="list-group">
                  @foreach ($pegawai as $data)
                    <b>Nama</b> <p class="pull-right"> {{$data->nama}}</p>
                  </li>
                  <li class="list-group">
                    <b>NIK Karyawan</b> <p class="pull-right">{{$data->nik_karyawan}}</p>
                    @endforeach
                  </li>
                </ul>
              </div>
            </div>      
          </div>
            <!-- /.box-header -->
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
                  <thead class="bg-blue color-palette text-center">
                  <tr>
                  <th >No.</th>
                  <th >KODE</th>
                  <th >Tanggal</th>
                  <th >Simpanan Pokok</th>
                  <th >Simpanan Wajib</th>
                  <th >Simpanan Sukarela</th>
                  <th >Total Simpanan</th>
                  <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach($simpanan as $sim)
                  <tr>
                  <td >{{$no++}}</td>
                  <th >S-{{$sim->id_simpanan}}</th>
                  <td >{{tanggal_local($sim->tgl_potongan)}}</td>
                  <td >{{format_uang($sim->simpanan_pokok)}}</td>
                  <td >{{format_uang($sim->simpanan_wajib)}}</td>
                  <td >{{format_uang($sim->simpanan_sukarela)}}</td>
                  <td >{{format_uang($sim->jumlah_simpanan)}}</td>
                  <td >
                    <a href="/simpanan/edit/{{$sim->id_simpanan}}" type="button" class="btn btn-primary btn-sm">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$sim->id_simpanan}}"><i class="fa fa-trash-o"></i></button>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                @foreach ($simpanan as $sim)
                <div class="modal modal-danger fade" id="delete{{$sim->id_simpanan}}" style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">SIMPANAN NOMOR [S-{{$sim->id_simpanan}}]</h4>
                      </div>

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Akan Menghapus data Ini ?</p><hr>
                        <p>Sim. Pokok : {{"Rp.".format_uang($sim->simpanan_pokok)}}</p>
                        <p>Sim. Wajib : {{"Rp.".format_uang($sim->simpanan_wajib)}}</p>
                        <p>Sim. Sukarela : {{"Rp.".format_uang($sim->simpanan_sukarela)}}</p>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                        <a href="/simpanan/delete/{{$sim->id_simpanan}}" class="btn btn-outline">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                <!-- /.modal-import-->
                <div class="modal modal-info fade" id="modal-info" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Import Data</h4>
                      </div>
                      <form action="{{ route('importsimpanan') }}" method="post" enctype="multipart/form-data">
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
              <!-- /.modal-import-->
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
<!-- tabel2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@endsection