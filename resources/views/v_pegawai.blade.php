@extends ('layout.v_template')
@section('title','DAFTAR KARYAWAN PT. SUMBER GRAHA SEJAHTERA - PURBALINGGA')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>@yield('title')</h1>
  <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li><a href="#">Data Karyawan </a></li>
  </ol>
</section>
<!-- /.tabel 2 -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <div class="pull-left">
              <a href="/tambah" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>   Tambah</a>
              <a href="{{ route('exportpegawai')}}" class="btn btn-success btn-sm"><i class="fa fa-download"></i>   Donwload (.xlsx)</a>
              <a href="#"  class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-upload"></i>   Upload (.xlsx)</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            @if (session('pesan'))
                <div class="alert alert-info alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
              <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                <tr>
                <th class="bg-navy-active color-palette text-center">No.</th>
                <th class="bg-navy-active color-palette text-center">Photo</th>
                <th class="bg-navy-active color-palette text-center">NIK</th>
                <th class="bg-navy-active color-palette text-center">Nama Lengkap </th>
                <th class="bg-navy-active color-palette text-center">TTL </th>
                <th class="bg-navy-active color-palette text-center">No. Handphone </th>
                <th class="bg-navy-active color-palette text-center">Alamat Lengkap </th>
                <th class="bg-navy-active color-palette text-center">Jabatan</th>
                <th class="bg-navy-active color-palette text-center">Status</th>
                <th class="bg-navy-active color-palette text-center">Corrective Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($pegawai as $key => $item)
                <tr>
                  <td class="text-center">{{ $no++}}</td>
                  <td><img src="{{ url('foto_pegawai/'.$item->foto_pegawai) }}" class="" width="80px" height="80px"></td>
                  <td>{{ $item->nik_karyawan}}</td>
                  <td>{{ $item->nama}}</td>
                  <td>{{ $item->tempat_lahir}},<br> {{tanggal_local($item->tgl_lahir)}}</td>
                  <td>{{ $item->telepon}}</td>
                  <td class="float-sm-right">{{ $item->alamat}}</td>
                  <td>{{ $item->jabatan}}</td>
                  <td><i class="fa fa-circle 
                  <?php
                if($item->status == 'AKTIF')
                echo 'text-success';
                else 
                echo 'text-danger';
                ?>"></i> {{ $item->status}}</td>
                  <td>
                  <a href="{{ url('pegawai/edit/'.$item->nik_ktp) }}" class="btn btn-warning hint--top" aria-label="Ubah" ><i class="fa fa-pencil"></i></a>
                  <button type="button" class="btn btn-danger hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$item->nik_ktp}}"><i class="fa fa-trash-o"></i></button>
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
          <div class="modal modal-warning fade" id="modal-warning" style="display: none;">
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
@endsection