<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/')}}/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
  @foreach ($pengambilan as $item)
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="col-xs-6 text-left">
            <h4>Jaya Persada Ekonomi Sejahtera,</h4>
          </div>
          <div class="col-xs-6 text-right">
            <h4>Tanggal cetak : {{date(now())}}</h4>
          </div>
        </div>
        <!-- /.col -->
      </div>

      <div class="row bg-orange-active color-palette">
        <div class="col-xs-12">
          <div class="col-xs-5">
            <div class="box-header">
            <p ><h4 ><strong>FORMULIR PENARIKAN</strong></h4></p>
            <p>Dana Simpanan</p>
            </div>
          </div>
          <div class="box-header">
            <div class="col-xs-7 text-right">
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($item->id_pengambilan, 'PDF417')}}" alt="barcode" width="200px" height="50px"/><br>    
            <p>No. Reg : P-{{$item->id_pengambilan}} /KOPKAR-TR/{{date(date('m'))}}/{{date(date('Y'))}} </p>
            </div>
          </div>
        </div>
      </div><br>

      <div class="row">
        <div class="col-xs-12">
          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:20%">NAMA PEMOHON</th>
                <td>{{$item->nama}}</td>
              </tr>
              <tr>
                <th>NIK </th>
                <td>{{$item->nik_karyawan}}</td>
              </tr>
              <tr>
                <th>JUMLAH</th>
                <td>{{"Rp. ".format_uang($item->jumlah_pengambilan)}}</td>
              </tr>
              <tr>
                <th>Terbilang</th>
                <td><i>"{{terbilang($item->jumlah_pengambilan)}} rupiah"<i></td>
              </tr>
            </tbody></table>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <div class="col-xs-4 text-center">
          <address>Disetujui tgl :{{Carbon\Carbon::parse($item->tgl_disetujui_ketua)->format("d-M-y")}}</address>
          <p>Ketua Koperasi</p> 
          <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->disetujui_ketua,'QRCODE')}}" alt="barcode" style="widht: 2  00px;"/><br>            
          <address>
         <small class="text-gray">Ditandatangani secara elektronik</small><br>
         {{$item->disetujui_ketua}}</address>
          </div>
          <div class="col-xs-4 text-center">
          <address>Disetujui tgl :{{Carbon\Carbon::parse($item->tgl_disetujui_bendahara)->format("d-M-y")}}</address>
          <p>Bendahara</p> 
          <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->disetujui_bendahara,'QRCODE')}}" alt="barcode" style="widht: 2  00px;"/><br>            
          <address>
         <small class="text-gray">Ditandatangani secara elektronik</small><br>
         {{$item->disetujui_bendahara}}</address>
          </div>
          
          <div class="col-xs-4 text-center">
          <address>Diajukan tgl :{{Carbon\Carbon::parse($item->tgl_pengambilan)->format("d-M-y")}}</address>
          <p>Pemohon</p> 
          <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->nama,'QRCODE')}}" alt="barcode" style="widht: 2  00px;"/><br>            
          <address>
         <small class="text-gray">Ditandatangani secara elektronik</small><br>
         {{$item->nama}}</address>
          </div>    
        </div>
        <!-- /.col -->
      </div><br><br><br>
      <!-- /.row -->


      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="/pengambilan/cetak/{{$item->id_pengambilan}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          
        </div>
      </div>
      @endforeach
</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
