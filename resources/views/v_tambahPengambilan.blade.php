@extends ('layout.v_template')
@section('title','Pengambilan')

@section('content')
  <section class="content-header">
    <h1>PENARIKAN DANA SIMPANAN
    <small>Form</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
      <li class="active">Pengambilan Simpanan </a></li>
    </ol>
  </section>

<section class="content">
@if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box">
          <div class="box-header with-border bg-blue color-palette">
            <h3 class="box-title">FORM PENARIKAN DANA</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" action="{{url('pengambilanSaya/insert')}}" method="post" enctype="multipart/form-data">
          @csrf  
          <div class="box-body">
            @foreach ($pegawai as $item)
              <input name="tgl_pengambilan" type="hidden" class="form-control" value="{{tanggal_local(date(now()))}}" readonly>
              <input name="id_user" type="hidden" class="form-control" value="{{Auth::user()->id}}" readonly>
              <input name="notifikasi" type="hidden" class="form-control" value="Penarikan dana simpanan" >
              <div class="form-group">
                  <input name="nik_ktp" type="hidden" class="form-control" value="{{$item->nik_ktp}}" readonly>
                @endforeach
              </div>
            </div>
            <!-- /.box-body -->
      
          

          <div class="box-body">
              <div class="form-group">
                <label  class="col-sm-2 control-label"> Saldo Pokok</label>

                <div class="col-sm-4">
                  <input type="text" class="form-control 
                  <?php
                  if($simp_pokok-$ambil_pokok > 0 )
                  echo 'bg-green';
                  else 
                  echo 'bg-red';
                  ?>" value="{{"Rp. ".format_uang($simp_pokok-$ambil_pokok)}}" disabled>
                </div>

                <label  class="col-sm-2 control-label">Penarikan Pokok</label>
                <div class="col-sm-4">
                  <input name="simpanan_pokok" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control text-right" placeholder="Masukan nominal" id="simpanan_pokok"  value="0"max="{{$simp_pokok-$ambil_pokok}}"
                  <?php
                  if($item->status == 'AKTIF')
                  echo 'readonly';
                  else 
                  echo '';
                  ?>
                  <?php
                  if($simp_pokok-$ambil_pokok == 0)
                  echo 'disabled';
                  else
                  echo '';
                  ?>>
                  <div class="text-danger">
                    @error('simpanan_pokok')
                    {{$message}}
                    @enderror
                  </div> 
                </div>
              </div>

              <div class="form-group">
                <label  class="col-sm-2 control-label">Saldo Wajib</label>

                <div class="col-sm-4">
                  <input type="text" class="form-control 
                  <?php
                  if($simp_wajib-$ambil_wajib > 0 )
                  echo 'bg-green';
                  else 
                  echo 'bg-red';
                  ?>" value="{{"Rp. ".format_uang($simp_wajib-$ambil_wajib)}}" disabled>
                </div>

                <label  class="col-sm-2 control-label">Penarikan Wajib</label>
                <div class="col-sm-4">
                  <input name="simpanan_wajib" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control text-right" placeholder="Masukan nominal" id="simpanan_wajib"  value="0"max="{{$simp_wajib-$ambil_wajib}}"
                  <?php
                  if($item->status == 'AKTIF')
                  echo 'readonly';
                  else 
                  echo '';
                  ?>
                  <?php
                  if($simp_wajib-$ambil_wajib == 0)
                  echo 'disabled';
                  else
                  echo '';
                  ?>>
                  <div class="text-danger">
                    @error('simpanan_wajib')
                    {{$message}}
                    @enderror
                  </div> 
                </div>
              </div>

              <div class="form-group">
                <label  class="col-sm-2 control-label">Saldo Sukarela</label>

                <div class="col-sm-4">
                  <input type="text" class="form-control 
                  <?php
                  if($simp_sukarela-$ambil_sukarela > 0 )
                  echo 'bg-green';
                  else 
                  echo 'bg-red';
                  ?>" value="{{"Rp. ".format_uang($simp_sukarela-$ambil_sukarela)}}" disabled>
                </div>

                <label  class="col-sm-2 control-label">Penarikan Sukarela</label>
                <div class="col-sm-4">
                  <input name="simpanan_sukarela" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control text-right" placeholder="Masukan nominal" id="simpanan_sukarela"  value="0"max="{{$simp_sukarela-$ambil_sukarela}}"
                  <?php
                  if($simp_sukarela-$ambil_sukarela == 0)
                  echo 'disabled';
                  else
                  echo '';
                  ?>>
                  <div class="text-danger">
                    @error('simpanan_sukarela')
                    {{$message}}
                    @enderror
                  </div> 
                </div>
              </div>

              <div class="form-group">
                <label  class="col-sm-2 control-label">TOTAL</label>

                <div class="col-sm-4">
                  <input type="text" class="form-control bg-default" value="{{"Rp. ".format_uang($simp_sukarela-$ambil_sukarela)}}" disabled>
                </div>

                <label  class="col-sm-2 control-label"></label>
                <div class="col-sm-4">
                <input name="jumlah_pengambilan" type="number" class="form-control text-right" placeholder="TOTAL JUMLAH" id="jumlah" readonly>
                </div>
              </div>
          </div>
          <div class="box-body">

          
              <div class="form-group">
                <label  class="col-sm-2 control-label">Attachment</label>

                <div class="col-sm-10">
                <input name="paklaring" type="file" id="exampleInputFile" <?php
                                if($item->status == 'AKTIF')
                                echo 'disabled';
                                else 
                                echo '';
                                ?>>
                <p class="help-block text-red">Note : Khusus untuk pengambilan simpanan pokok dan simpanan wajib harus melampirkan surat keterangan paklaring </p>

                </div>
              </div>
            <div class="box-footer ">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
          <div class="box-body">
            <div class="box-header with-border bg-blue color-palette">
              <h3 class="box-title">Penarikan Sebelumnya</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th style="width: 40%">Tanggal</th>
                  <th style="width: 40%">Jumlah</th>
                  <th style="width: 20%">Status</th>
                </tr>
                <tr>
                @foreach($pengambilan as $data)
                  <td>{{$data->tgl_pengambilan}}</td>
                  <td>@currency($data->jumlah_pengambilan)</td>
                  <td ><h5 class="label 
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
                </tr>
                @endforeach
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          </form>
        </div>
                   
            
 
        </div>
        <!-- /.box -->



      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box">

          <!-- /.box-header -->
          <!-- <div class="box-body table-responsive no-padding">
            
            <table  id="example1"class="table table-bordered table-striped dataTable">
              <tbody><tr>
                <th class="bg-blue-active text-center">KODE</th>
                <th class="bg-blue-active text-center">Tanggal</th>
                <th class="bg-blue-active text-center">Jumlah</th>
                <th class="bg-blue-active text-center">Status</th>
                <th class="bg-blue-active text-center">Detail</th>
              </tr>
              @foreach($pengambilan as $data)
              <tr>
                <th>{{$data->id_pengambilan}}</th>
                <th>{{tanggal_local($data->tgl_pengambilan)}}</th>
                <th>@currency($data->jumlah_pengambilan)</th>
                <th class="text-center"><h5 class=" 
                <?php
                if($data->status_pengajuan == "WAITING APPROVAL")
                echo 'bedge bg-yellow';
                elseif ($data->status_pengajuan == "APPROVED")
                echo 'bedge bg-green';
                else 
                echo 'bedge bg-red';
                ?>">{{$data->status_pengajuan}}</h5></th>
                <th class="text-right">P : @currency($data->simpanan_pokok)<br>
                W : @currency($data->simpanan_wajib)<br>
                S : @currency($data->simpanan_sukarela)</th>
              </tr>
              @endforeach
            </tbody></table>
            
          </div> -->



          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(".form-horizontal").keyup(function() {
      //var rupiah = parseInt($("#rupiah").val())
      var pok = parseInt($("#simpanan_pokok").val())
      var waj = parseInt($("#simpanan_wajib").val())
      var suk = parseInt($("#simpanan_sukarela").val())
 
      var jum = pok+waj+suk;
     
      $("#jumlah").attr("value",jum)
    

    }); 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif

@endsection