@extends ('layout.v_template')
@section('title','PENARIKAN DANA')

@section('content')
<section class="content-header">
    <h1>@yield('title')
        <small>Tabel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Penarikan Dana</li>
        </ol>
    </section>

<!-- /.tabel 2 -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);"">
            <div class="box-header bg-blue-active color-palette">
              <div class="pull-left">
                  <h5><strong>TABEL PENARIKAN DANA </strong></h5>
                  </div>
                  <div class="pull-right">
                <!-- <a href="{{ route('exportpengambilan')}}" class="btn btn-default btn-sm hint--top" aria-label="Download"><i class="fa fa-download"></i></a> -->
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
                  @if (session('status'))
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Sukses</h4>
                    {{session('status')}}.
                  </div>
                  @endif
                <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">No.</th>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">Kode </th>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">Tanggal</th>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">Nama</th>
                  <th colspan="3"class="bg-gray color-palette"><p class="text-center">Simpanan </th>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">Jumlah </th>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">Attachement</th>
                  <th colspan="2"class="bg-gray color-palette"><p class="text-center">Status</th>
                  <th rowspan="2"class="bg-gray color-palette"><p class="text-center">Action</th>
                  </tr>
                  <tr>
                  <th class="bg-gray color-palette"><p class="text-center"><span class="label label-danger">P</span></th>
                  <th class="bg-gray color-palette"><p class="text-center"><span class="label label-success">W</span></th>
                  <th class="bg-gray color-palette"><p class="text-center"><span class="label label-primary">S</span></th>
                  <th class="bg-gray color-palette"><p class="text-center">Ketua</th>
                  <th class="bg-gray color-palette"><p class="text-center">Bendahara</th>
                  
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach($pengambilan as $data)
                  <tr>
                  <td >{{$no++}}</td>
                  <td >T-{{$data->id_pengambilan}}</td>
                  <td >{{Carbon\Carbon::parse($data->tgl_pengambilan)->format("d-M-y")}}</td>
                  <td >{{$data->nama}}</td>
                  <td ><small>{{format_uang($data->simpanan_pokok)}}</small></td>
                  <td ><small>{{format_uang($data->simpanan_wajib)}}</small></td>
                  <td ><small>{{format_uang($data->simpanan_sukarela)}}</small></td>
                  <td>{{format_uang($data->jumlah_pengambilan)}}</td>
                  <td>
                    <!-- <img src="{{ asset('foto_paklaring/'.$data->paklaring) }}" class="" width="80px" height="80px"><br> -->
                  <a target="_blank" href="{{ asset('foto_paklaring/'.$data->paklaring)}}">Lihat</a>
                </td>
                  <td><h5 class="label 
                <?php
                  if($data->ttd_ketua == "Waiting Approval")
                  echo 'label-warning ';
                  elseif ($data->ttd_ketua == "Approved")
                  echo 'label-success ';
                  elseif ($data->ttd_ketua == "Pending")
                  echo 'label-warning ';
                  else 
                  echo 'label-danger ';
                  ?>"><span class="
                  <?php
                  if($data->ttd_ketua == "Waiting Approval")
                  echo 'glyphicon glyphicon-time';
                  elseif ($data->ttd_ketua == "Approved")
                  echo 'glyphicon glyphicon-ok';
                  elseif ($data->ttd_ketua == "Pending")
                  echo 'glyphicon glyphicon-time';
                  else 
                  echo 'glyphicon glyphicon-remove';
                  ?>"></span>
                  <?php
                  if ($data->ttd_ketua == "Waiting Approval")
                  echo ' Menunggu Persetujuan';
                  elseif ($data->ttd_ketua == "Approved")
                  echo ' Disetujui';
                  elseif ($data->ttd_ketua == "Pending")
                  echo ' Tertunda';
                  else 
                  echo ' Ditolak';
                  ?>
                </h5></td>

                <td><h5 class="label 
                <?php
                  if($data->ttd_bendahara == "Waiting Approval")
                  echo 'label-warning ';
                  elseif ($data->ttd_bendahara == "Approved")
                  echo 'label-success ';
                  elseif ($data->ttd_bendahara == "Pending")
                  echo 'label-warning ';
                  else 
                  echo 'label-danger ';
                  ?>"><span class="
                  <?php
                  if($data->ttd_bendahara == "Waiting Approval")
                  echo 'glyphicon glyphicon-time';
                  elseif ($data->ttd_bendahara == "Approved")
                  echo 'glyphicon glyphicon-ok';
                  elseif ($data->ttd_bendahara == "Pending")
                  echo 'glyphicon glyphicon-time';
                  else 
                  echo 'glyphicon glyphicon-remove';
                  ?>"></span>
                  <?php
                  if ($data->ttd_bendahara == "Waiting Approval")
                  echo ' Menunggu Persetujuan';
                  elseif ($data->ttd_bendahara == "Approved")
                  echo ' Disetujui';
                  elseif ($data->ttd_bendahara == "Pending")
                  echo ' Tertunda';
                  else 
                  echo ' Ditolak';
                  ?>
                </h5></td>

                  <td>
                  <a href="/pengambilanKetua/edit/{{$data->id_pengambilan}}" class="btn btn-primary btn-sm hint--top" aria-label="Approval" ><i class="fa fa-pencil"></i></a>  
                    </td>
                    </td>
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
<!-- tabel2 -->
@endsection