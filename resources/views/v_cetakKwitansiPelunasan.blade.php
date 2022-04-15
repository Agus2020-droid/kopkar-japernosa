<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kopkar Japernosa | Kwitansi</title>
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
  @foreach ($pinjaman as $item)
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
          <img src="{{asset('logo.png')}}" weight="25px" height="25px">
           Koperasi JAPERNOSA,
            
            <small class="pull-right">Tanggal cetak : {{date(now())}}</small>
            
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <div class="row bg-blue-active color-palette text-center">
        <div class="col-sm-12">
          <h4 >
            <strong>TANDA TERIMA PEMBAYARAN PELUNASAN PINJAMAN KREDIT</strong>
          </h4>
        </div>
      </div><br>

      <div class="row ">
        <div class="col-xs-12 ">
          <h7 >
          <strong>No. Kwitansi  : P-{{$item->no_pinjaman}} /KW/{{date(date('m'))}}/{{date(date('Y'))}}</strong>
          
          </h7>
        </div>
        <!-- /.col -->
      </div><br>
      <div class="box box-primary">
      </div>
      <div class="box-header ">

      <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:20%">Telah terima dari</th>
                <td>: {{$item->nama}}</td>
              </tr>
              <tr>
                <th>Uang sejumlah</th>
                <td>: {{"Rp. ".format_uang($item->total_kredit)}}</td>
              </tr>
              <tr>
                <th>Untuk pembayaran</th>
                <td>: Untuk pembayaran pelunasan kredit pinjaman {{$item->nama_barang}} merk {{$item->merk}} spesifikasi {{$item->spesifikasi}}</td>
              </tr>
              <tr>
                <th>Terbilang</th>
                <td>: <strong><i>" {{terbilang($item->total_kredit)}} rupiah "</i></strong></td>
              </tr>
            </tbody></table>
          </div>



        <!-- <div class="col-xs-2">
          Telah terima dari<br>
          Uang sejumlah <br>
          Untuk Pembayaran<br>
          Terbilang<br>   
        </div>
     
    
        <div class="col-xs-10">
          <h7 >
            : {{$item->nama}}<br>
            : {{"Rp. ".format_uang($item->total_kredit)}}
            <address>: Untuk pembayaran pelunasan kredit pinjaman {{$item->nama_barang}} merk {{$item->merk}} spesifikasi {{$item->spesifikasi}}
             dari bulan {{Carbon\Carbon::parse($item->tgl_pengajuan)->addMonth(1)->format("M Y")}} sampai dengan bulan {{Carbon\Carbon::parse($item->tgl_pengajuan)->addMonth($item->tenor)->format("M Y")}} 
             <address>
            : <strong><i>" {{terbilang($item->total_kredit)}} rupiah "</i></strong><br>
          </h7>
        </div> -->
      </div>

      <div class="row ">
        <div class="col-xs-11">
        <div class="pull-right">
          <h7 >
          Purbalingga, {{tanggal_local(date(now()))}}
          </h7>
          </div>
        </div>
      </div><br>
      
      
      <div class="row ">
        <div  class="col-xs-4">
          <center>Ketua Koperasi<br>
             <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG('3302020804840005','QRCODE')}}" alt="barcode" style="widht: auto;"/> <br>
              <small class="text-gray">Ditandatangani secara elektronik
              </small><br>KISMAN
          </center>
        </div>
        <!-- /.col -->
    
        <div class="col-xs-4">
          <center>Bendahara<br>
             <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG('3303022502980001','QRCODE')}}" alt="barcode" style="widht: auto;"/> <br>
              <small class="text-gray">Ditandatangani secara elektronik
              </small><br>GABRIELLE TEDY SETYAWAN
          </center>
        </div>
        <!-- /.col -->

        <div class="col-xs-4">
           <center>Nasabah<br>
         <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->nama,'QRCODE')}}" alt="barcode" style="widht: auto;"/> <br>
          <small class="text-gray">Ditandatangani secara elektronik
          </small><br>{{$item->nama}}
      </center>
        </div>
        <!-- /.col -->
        <br>
      </div>

     

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
      @endforeach
</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
