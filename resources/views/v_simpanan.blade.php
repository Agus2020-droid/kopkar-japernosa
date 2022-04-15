@extends ('layout.v_template')
@section('title','SIMPANAN ANGGOTA')

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
      <div class="box" style="border-radius: 1em;box-shadow: 0 5px 10px rgba(0,0,0,.2);" >
            <div class="box-header bg-blue-active color-palette" >
              <div class="pull-left">
                <h5><strong>TABEL SIMPANAN ANGGOTA </strong></h5>
                </div>
                <div class="pull-right">
                <a href="/simpanan/tambah" class="btn btn-primary btn-sm hint--top" aria-label="Tambah Simpanan"><i class="fa fa-plus"></i></a>
                <a href="{{ route('exportsimpanan')}}" class="btn btn-default btn-sm hint--top 
                      <?php
                    if(auth()->user()->level == 6)
                    echo 'hidden';
                    else
                    echo ' ';
                    ?>" aria-label="Download"><i class="fa fa-download"></i></a>
                <a href="#" class="btn btn-warning btn-sm hint--top 
                    <?php
                    if(auth()->user()->level == 6)
                    echo 'hidden';
                    else
                    echo ' ';
                    ?>" aria-label="Upload File" data-toggle="modal" data-target="#modal-info"><i class="fa fa-download"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-header ">
              <div class="box-body table-responsive no-padding">
                @if (session('pesan'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{session('pesan')}}.
                  </div>
                  @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                  <thead class="bg-gray color-palette text-center">
                  <tr>
                  <th >No.</th>
                  <th >Nama</th>
                  <th >NIK KTP</th>
                  <th >Simp. Pokok</span></th>
                  <th >Simp. Wajib</span></th>
                  <th >Simp. Sukarela</span></th>
                  <th >Jumlah </th>
                  <th >Action</th>
                  </tr>
                  
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach($simpanan as $key => $sim)
                  <tr>
                  <td class="text-center">{{$no++}}</td>
                  <td >{{$sim->nama}}</td>
                  <td >{{$sim->nik_ktp}}</td>
                  <td class="text-right">@currency($sim->total_simpanan_pokok)</td>
                  <td class="text-right">@currency($sim->total_simpanan_wajib)</td>
                  <td class="text-right">@currency($sim->total_simpanan_sukarela)</td>
                  <td class="text-right">@currency($sim->total_jumlah_simpanan)</td>
                  <td><a href="{{ url('simpanan/detailSimpanan/'.$sim->nik_ktp) }}"  class="btn btn-primary btn-sm">Detail</a></td>
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
                        <p>Nama : {{$sim->nama}}</p>
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