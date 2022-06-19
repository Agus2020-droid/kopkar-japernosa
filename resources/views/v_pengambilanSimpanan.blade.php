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
          @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
            <div class="box-header bg-blue-active color-palette">
              <div class="pull-left">
                  <h5><strong>TABEL PENARIKAN DANA </strong></h5>
                  </div>
                  <div class="pull-right">
                <a href="{{ route('exportpengambilan')}}" class="btn btn-default btn-sm hint--top" aria-label="Download"><i class="fa fa-download"></i></a>
                <a href="#" class="btn btn-warning tn-sm hint--top" aria-label="Upload File" data-toggle="modal" data-target="#Import-Penarikan"><i class="fa fa-download"></i></a>
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
                  <th rowspan="2" class="bg-primary color-palette"><p class=" text-center">No.</th>
                  <th rowspan="2" class="bg-primary color-palette"><p class="text-center">Kode </th>
                  <th rowspan="2" class="bg-primary color-palette"><p class="text-center">Tanggal</th>
                  <th rowspan="2" class="bg-primary color-palette"><p class="text-center">Nama</th>
                  <th colspan="3" class="bg-primary color-palette"><p class="text-center">Simpanan </th>
                  <th rowspan="2" class="bg-primary color-palette"><p class="text-center">Jumlah</th>
                  <th colspan="2" class="bg-primary color-palette"><p class="text-center">Persetujuan</th>
                  <th rowspan="2" class="bg-primary color-palette"><p class="text-center">Attachement</th>
                  <th rowspan="2" class="bg-primary color-palette"><p class="text-center">Action</th>
                  </tr>
                  <tr>
                  <th class="bg-primary color-palette"><p class="text-center">P</th>
                  <th class="bg-primary color-palette"><p class="text-center">W</th>
                  <th class="bg-primary color-palette"><p class="text-center">S</th>
                  
                  <th class="bg-primary color-palette"><p class="text-center">Ketua</th>
                  <th class="bg-primary color-palette"><p class="text-center">Bendahara</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach($pengambilan as $key => $data)
                  <tr>
                  <td class="text-center">{{$no++}}</td>
                  <td class="text-center">T-{{$data->id_pengambilan}}</td>
                  <td class="text-center">{{$data->tgl_pengambilan}}</td>
                  <td class="text-center">{{$data->nama}}</td>
                  <td class="text-right">{{format_uang($data->simpanan_pokok)}}</td>
                  <td class="text-right">{{format_uang($data->simpanan_wajib)}}</td>
                  <td class="text-right">{{format_uang($data->simpanan_sukarela)}}</td>
                  <td class="text-right">{{format_uang($data->jumlah_pengambilan)}}</td>
                <td style="font-size: 22px">
                <center>
                  <?php
                    if($data->ttd_ketua == "Waiting Approval")
                    echo '<i class="fa fa-warning text-orange"></i>';
                    elseif ($data->ttd_ketua == "Approved")
                    echo '<i class="fa fa-check-circle text-green"></i>';
                    elseif ($data->ttd_ketua == "Pending")
                    echo '<i class="fa fa-stop-circle text-yellow"></i>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?></center>
                </td>
                <td style="font-size: 22px">
                <center>
                  <?php
                    if($data->ttd_bendahara == "Waiting Approval")
                    echo '<i class="fa fa-warning text-orange"></i>';
                    elseif ($data->ttd_bendahara == "Approved")
                    echo '<i class="fa fa-check-circle text-green"></i>';
                    elseif ($data->ttd_bendahara == "Pending")
                    echo '<i class="fa fa-stop-circle text-yellow"></i>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?></center>
                </td>
                  
                  <td class="text-center">
                  <!-- <img src="{{ asset('public/public/foto_paklaring/'.$data->paklaring) }}" class="" width="80px" height="80px"><br> -->
                  <a target="_blank" href="{{ asset('public/public/foto_paklaring/'.$data->paklaring)}}"><i class="fa fa-paperclip"></i> Attachement</a></td>

                  <td class="text-center">
                  <button  class="btn btn-info btn-sm hint--top" aria-label="Lihat" data-toggle="modal" data-target="#view{{$data->id_pengambilan}}"><i class="fa fa-eye"></i></button>
                  <!--<a href="/pengambilan/cetak/{{$data->id_pengambilan}}" target="_blank" class="btn btn-primary btn-sm hint--top" aria-label="Cetak" ><i class="fa fa-print"></i></a>-->
                  <!--<a href="/pengambilan/edit/{{$data->id_pengambilan}}" class="btn btn-warning btn-sm hint--top" aria-label="Ubah" ><i class="fa fa-pencil"></i></a>-->
                  <button type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$data->id_pengambilan}}" 
                  <?php
                  if($data->ttd_ketua == "Waiting Approval")
                  echo '';
                  else 
                  echo 'disabled';
                  ?>><i class="fa fa-trash-o"></i></button>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>

             
                
                
                @foreach ($pengambilan as $data)
              <div class="modal modal-danger fade" id="delete{{$data->id_pengambilan}}" style="display: none;">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Kode Pengambilan [T-{{$data->id_pengambilan}}]</h4><hr>
                      <div class="col-12">
                        <div class="col-sm-4">
                          Nama Karyawan <br>
                          Nik           <br>
                          Status        <br>
                        </div>
                        <div class="col-sm-1">
                          :<br>
                          :<br>
                          :<br>
                        </div>
                        <div class="col-sm-4">
                          {{$data->nama}}<br>
                          {{$data->nik_karyawan}}<br>
                          <span class="label
                            <?php
                          if($data->status == "AKTIF")
                          echo 'label-success';
                          else 
                          echo 'label-danger';
                          ?>">{{$data->status}}</span><br><br>
                        </div>
                      </div>
                      
                      <div class="col-12">
                      <h6><p></p></h6>
                        <div class="col-sm-4">
                          Tgl Pengajuan<br>
                          Simpanan Pokok<br>
                          Simpanan Wajib<br>
                          Simpanan Sukarela<br>
                          J U M L A H<br><br>
                          Status Pengajuan<br>
                        </div>
                        <div class="col-sm-1">
                          :<br>
                          :<br>
                          :<br>
                          :<br>
                          :<br><br>
                          :<br>
                        </div>
                        <div class="col-sm-4">
                          {{tanggal_local($data->tgl_pengambilan)}}<br>
                          {{"Rp. ".format_uang($data->simpanan_pokok)}}<br>
                          {{"Rp. ".format_uang($data->simpanan_wajib)}}<br>
                          {{"Rp. ".format_uang($data->simpanan_sukarela)}}<br>
                          {{"Rp. ".format_uang($data->jumlah_pengambilan)}}<br><br>
                          <span class="label
                            <?php
                          if($data->ttd_ketua == "Waiting Approval")
                          echo 'label-warning';
                          elseif ($data->ttd_ketua == "Approved")
                          echo 'label-success';
                          else 
                          echo 'label-danger';
                          ?>">{{$data->ttd_ketua}}</span><br>
                        </div>
                      </div>
                    </div>
                    <div class="modal-body">
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                      <a href="/pengambilan/delete/{{$data->id_pengambilan}}" class="btn btn-outline">Hapus</a>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
              </div>

              <div class="modal modal-info fade in" id="view{{$data->id_pengambilan}}" style="display: none;padding-right: 17px;">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Kode Pengambilan [T-{{$data->id_pengambilan}}]</h4><hr>
                      <div class="col-12">
                        <div class="col-sm-4">
                          Nama Karyawan <br>
                          Nik           <br>
                          Status        <br>
                        </div>
                        <div class="col-sm-1">
                          :<br>
                          :<br>
                          :<br>
                        </div>
                        <div class="col-sm-4">
                          {{$data->nama}}<br>
                          {{$data->nik_karyawan}}<br>
                          <span class="label
                            <?php
                          if($data->status == "AKTIF")
                          echo 'label-success';
                          else 
                          echo 'label-danger';
                          ?>">{{$data->status}}</span><br><br>
                        </div>
                      </div>
                      
                      <div class="col-12">
                      <h6><p></p></h6>
                        <div class="col-sm-4">
                          Tgl Pengajuan<br>
                          Simpanan Pokok<br>
                          Simpanan Wajib<br>
                          Simpanan Sukarela<br>
                          J U M L A H<br><br>
                          Status Pengajuan<br>
                        </div>
                        <div class="col-sm-1">
                          :<br>
                          :<br>
                          :<br>
                          :<br>
                          :<br><br>
                          :<br>
                        </div>
                        <div class="col-sm-4">
                          {{tanggal_local($data->tgl_pengambilan)}}<br>
                          {{"Rp. ".format_uang($data->simpanan_pokok)}}<br>
                          {{"Rp. ".format_uang($data->simpanan_wajib)}}<br>
                          {{"Rp. ".format_uang($data->simpanan_sukarela)}}<br>
                          {{"Rp. ".format_uang($data->jumlah_pengambilan)}}<br><br>
                          <span class="label
                          <?php
                          if($data->ttd_ketua == "Waiting Approval")
                          echo 'label-warning';
                          elseif ($data->ttd_ketua == "Approved")
                          echo 'label-success';
                          else 
                          echo 'label-danger';
                          ?>">{{$data->ttd_ketua}}</span><br>
                        </div>
                      </div>
                    </div>
                    
                    <div class="modal-body">
                  
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right"  data-dismiss="modal">Close</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
              </div>
            @endforeach
                <!-- /.modal-import file-->
                <div class="modal modal-info fade" id="Import-Penarikan" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Import Data Penarikan</h4>
                      </div>
                      <form action="{{ route('importpenarikan') }}" method="post" enctype="multipart/form-data">
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
@endsection