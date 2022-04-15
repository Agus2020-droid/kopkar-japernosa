@extends ('layout.v_template')
@section('title','PENARIKAN DANA')

@section('content')
<section class="content-header">
      <h1>PENARIKAN DANA SIMPANAN
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}">Profile</a></li>
        <li class="active">Penarikan</a></li>
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
                  <ul class="list-group">
                    <li class="list-group ">
                    @foreach ($pegawai as $item)
                      <b>Nama</b> <p class="pull-right"> {{$item->nama}}</p>
                    </li>
                    <li class="list-group">
                      <b>NIK</b> <p class="pull-right">{{$item->nik_karyawan}}</p>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-12 ">
                <a href="{{ url('tambahpengambilan/'.$item->nik_ktp) }}" class="btn btn-info btn-block" role="button" aria-label="Klik"><i class="fa fa-plus"> </i> PENGAJUAN PENARIKAN SIMPANAN</a>
                @endforeach
                </div>
              </div>
            </div>

            <div class="box-header">
              <div class="box-body table-responsive no-padding">
                @if (session('pesan'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr>
                  <th class="bg-blue-active color-palette text-center"rowspan="2">No.</th>
                  <th class="bg-blue-active color-palette text-center"rowspan="2">Tanggal</th>
                  <th class="bg-blue-active color-palette text-center"colspan="4">Jumlah Penarikan</th>
                  <th class="bg-blue-active color-palette text-center"colspan="2">Persetujuan</th>
                </tr>
                <tr>
                  <th class="bg-blue-active color-palette text-center">P</th>
                  <th class="bg-blue-active color-palette text-center" >W</th>
                  <th class="bg-blue-active color-palette text-center">S</th>
                  <th class="bg-blue-active color-palette text-center">SUM</th>
                  <th class="bg-blue-active color-palette text-center">Ketua</th>
                  <th class="bg-blue-active color-palette text-center">Bendahara</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($pengambilan as $item)
                <tr>
                  <td class="text-center">{{ $no++}}</td>
                  <td class="text-center">{{$item->tgl_pengambilan}}</td>
                  <td class="text-center">{{format_uang($item->simpanan_pokok)}}</td>
                  <td class="text-center">{{format_uang($item->simpanan_wajib)}}</td>
                  <td class="text-center">{{format_uang($item->simpanan_sukarela)}}</td>
                  <td class="text-right">{{format_uang($item->jumlah_pengambilan)}}</td>
                  <td class="text-center">
                  <h5 class="label 
                <?php
                  if($item->ttd_ketua == "Waiting Approval")
                  echo 'label-warning ';
                  elseif ($item->ttd_ketua == "Approved")
                  echo 'label-success ';
                  elseif ($item->ttd_ketua == "Pending")
                  echo 'label-warning ';
                  else 
                  echo 'label-danger ';
                  ?>"><span class="
                  <?php
                  if($item->ttd_ketua == "Waiting Approval")
                  echo 'glyphicon glyphicon-time';
                  elseif ($item->ttd_ketua == "Approved")
                  echo 'glyphicon glyphicon-ok';
                  elseif ($item->ttd_ketua == "Pending")
                  echo 'glyphicon glyphicon-time';
                  else 
                  echo 'glyphicon glyphicon-remove';
                  ?>"></span>
                </h5></td>

                  <td class="text-center">
                  <h5 class="label 
                <?php
                  if($item->ttd_bendahara == "Waiting Approval")
                  echo 'label-warning ';
                  elseif ($item->ttd_bendahara == "Approved")
                  echo 'label-success ';
                  elseif ($item->ttd_bendahara == "Pending")
                  echo 'label-warning ';
                  else 
                  echo 'label-danger ';
                  ?>"><span class="
                  <?php
                  if($item->ttd_bendahara == "Waiting Approval")
                  echo 'glyphicon glyphicon-time';
                  elseif ($item->ttd_bendahara == "Approved")
                  echo 'glyphicon glyphicon-ok';
                  elseif ($item->ttd_bendahara == "Pending")
                  echo 'glyphicon glyphicon-time';
                  else 
                  echo 'glyphicon glyphicon-remove';
                  ?>"></span>
                </h5></td>

                </tr>
                @endforeach
                </tbody>
              </table>
              @foreach ($pengambilan as $data)
            <div class="modal modal-warning fade" id="delete{{$data->id_pengambilan}}" style="display: none;">
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
                      @foreach ($pegawai as $item)
                        {{$item->nama}}<br>
                        {{$item->nik_karyawan}}<br>
                        <span class="label
                          <?php
                        if($item->status == "Active")
                        echo 'label-success';
                        else 
                        echo 'label-danger';
                        ?>">{{$item->status}}</span><br><br>
                         @endforeach
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
                        if($data->status_pengajuan == "WAITING APPROVAL")
                        echo 'label-warning';
                        elseif ($data->status_pengajuan == "APPROVED")
                        echo 'label-success';
                        else 
                        echo 'label-danger';
                        ?>">{{$data->status_pengajuan}}</span><br>
                      </div>
                    </div>
                  </div>
                  <div class="modal-body">
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                    <a href="/pengambilan/deletePengambilan/{{$data->id_pengambilan}}" class="btn btn-outline">Hapus</a>
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
                    <h4 class="modal-title"><strong>Kode Pengambilan [T-{{$data->id_pengambilan}}]</strong></h4>                  
                    <div class="box-body">
                    </div>
                    <div class="modal-body">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                <label>Tanggal:</label>

                <div class="input-group">
                  {{tanggal_local($data->tgl_pengambilan)}}
                </div>
                <!-- /.input group -->
              </div>
           
              <div class="form-group">
                <label>Simpanan Pokok:</label>

                <div class="input-group">
                {{"Rp. ".format_uang($data->simpanan_pokok)}}
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Simpanan Wajib:</label>

                <div class="input-group">
                {{"Rp. ".format_uang($data->simpanan_wajib)}}
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Simpanan Sukarela:</label>

                <div class="input-group">
                {{"Rp. ".format_uang($data->simpanan_sukarela)}}
                </div>
                <!-- /.input group -->
              </div>
            
              <div class="form-group">
                <label>TOTAL:</label>

                <div class="input-group">
                {{"Rp. ".format_uang($data->jumlah_pengambilan)}}
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Status Pengajuan:</label>

                <div class="input-group">
                <span class="label
                          <?php
                        if($data->status_pengajuan == "WAITING APPROVAL")
                        echo 'label-warning';
                        elseif ($data->status_pengajuan == "APPROVED")
                        echo 'label-success';
                        else 
                        echo 'label-danger';
                        ?>">{{$data->status_pengajuan}}</span>
                </div>
                <!-- /.input group -->
              </div>
            </div>
            </div>


                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@endsection