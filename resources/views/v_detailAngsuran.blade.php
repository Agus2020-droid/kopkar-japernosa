@extends ('layout.v_template')
@section('title','DETAIL ANGSURAN ')

@section('content')
<section class="content-header">
      <h1>@yield('title')
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Detail Angsuran</a></li>
      </ol>
    </section>
<!-- /.tabel 2 -->
<section class="content">
<div class="row">
    <div class="col-xs-12">
      <div class="box">
          <div class="box-header bg-blue-active color-palette">
          <h4>Tabel Angsuran </h4>
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
                  <th >Nama</th>
                  <th >KODE Pinjam</th>
                  <th >KODE Angsur</th>
                  <th >Tanggal</th>
                  <th >Jumlah Angsuran</th>
                  <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach($angsuran as $ang)
                  <tr>
                  <td >{{$no++}}</td>
                  <th >{{$ang->nama}}</th>
                  <th >P-{{$ang->no_pinjaman}}</th>
                  <th >A-{{$ang->id_angsuran}}</th>
                  <td >{{tanggal_local($ang->tgl_angsuran)}}</td>
                  <td >{{format_uang($ang->jumlah_angsuran)}}</td>
                  <td >
                    <a href="/angsuran/edit/{{$ang->id_angsuran}}" type="button" class="btn btn-primary btn-sm">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$ang->id_angsuran}}"><i class="fa fa-trash-o"></i></button>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                @foreach ($angsuran as $ang)
                <div class="modal modal-danger fade" id="delete{{$ang->id_angsuran}}" style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">ANGSURAN NOMOR [A-{{$ang->id_angsuran}}]</h4>
                      </div>

                      <div class="modal-body">
                        <p>Apakah Anda Yakin Akan Menghapus angsuran [A-{{$ang->id_angsuran}}] ?</p><hr>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                        <a href="/angsuran/delete/{{$ang->id_angsuran}}" class="btn btn-outline">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
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