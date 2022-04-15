@extends ('layout.v_template')
@section('title','Pemotongan Gaji')

@section('content')
<section class="content-header">
      <h1>PEMOTONGAN GAJI
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/anggotakopkar"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}">Profile</a></li>
        <li class="active">Pemotongan Gaji</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
          <div class="box-header bg-blue-active color-palette">
              <div class="row">
                  <div class="col-sm-3 ">
                    <ul class="list-group ">
                      <li class="list-group">
                        @foreach ($pegawai as $item)
                        <b>NAMA</b> <p class="pull-right"> {{$item->nama}}</p>
                      </li>
                      <li class="list-group">
                        <b>NIK</b> <p class="pull-right">{{$item->nik_karyawan}}</p>
                        @endforeach
                      </li>
                    </ul>
                  </div>
              </div>
            </div>

            <!-- /.box-header -->
            <div class="box-header">
              <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th class="bg-blue-active color-palette">No.</th>
                    <th class="bg-blue-active color-palette">Kode</th>
                    <th class="bg-blue-active color-palette">Tanggal</th>
                    <th class="bg-blue-active color-palette">Jumlah Potongan</th>
                    <th class="bg-blue-active color-palette">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach ($potonggaji as $item)
                  <tr>
                  <td>{{ $no++}}</td>
                  <td>PG-{{$item->id_potongan}}</td>
                  <td>{{$item->tgl_potongan}}</td>
                  <td>@currency($item->jumlah_potongan)</td>
                  <td><span class="label label-success">{{$item->status_potongan}}</span></td>
                  </tr>
                  @endforeach
                </tbody>
                </table>
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
@endsection