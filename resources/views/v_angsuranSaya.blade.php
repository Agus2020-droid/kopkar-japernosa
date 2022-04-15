@extends ('layout.v_template')
@section('title','Angsuran Kredit')

@section('content')
<section class="content-header">
      <h1>ANGSURAN KREDIT
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}">Profile</a></li>
        <li class="active">Angsuran Kredit</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
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
                    <th class="bg-blue-active color-palette">Tanggal Angsuran</th>
                    <th class="bg-blue-active color-palette">Kode Pinjaman</th>
                    <th class="bg-blue-active color-palette">Jumlah Angsuran</th>
                    <th class="bg-blue-active color-palette">Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach ($angsuran as $item)
                  <tr>
                  <td>{{ $no++}}</td>
                    <td >A-{{$item->id_angsuran}}</td>
                    <td>{{Carbon\Carbon::parse($item->tgl_angsuran)->format("d M y")}}</td>
                    <td>P-{{$item->no_pinjaman}}</td>
                    <td>@currency($item->jumlah_angsuran)</td>
                    <td><span class="label label-success">{{$item->status_angsuran}}</span></td>
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