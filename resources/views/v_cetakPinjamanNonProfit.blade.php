<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Kopkar | Cetak Permohonan Pinjaman Non Profit</title>
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
            <i class="fa fa-globe"></i> Jaya Persada Ekonomi Sejahtera, 
            <small class="pull-right">Tanggal cetak : {{date(now())}}</small>
            
          </h2>
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-sm-12">
        <img src="{{asset('kop.png')}}">
        </div>
      </div><hr>

      <div class="row ">

        <div class="col-xs-8">
          <address>
            Hal : PERMOHONAN PINJAMAN
            </address>
        </div>

        <div class="col-xs-4 text-center">
          <h7 class="pull-right">
            <!-- <strong>No. Permohonan kredit  : P-{{$item->no_pinjaman}} /KOPKAR-KR/{{date(date('m'))}}/{{date(date('Y'))}}</strong> -->
            <strong>No. Register  : </strong><br>
            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($item->no_pinjaman, 'PDF417')}}" alt="barcode" width="200px" height="50px"/><br>
            P-{{$item->no_pinjaman}} /KOPKAR-KR/{{date(date('m'))}}/{{date(date('Y'))}}
          </h7>
        </div>
        <!-- /.col -->
      </div><br>

      <div class="row ">
        <div class="col-xs-12">
          <address>
            Kepada Yth.<br>
            Bpk. KISMAN<br>
            Ketua Koperasi Japernosa PT.SGS Purbalingga<br><br>
            Dengan hormat,<br>
            Saya yang bertanda tangan dibawah ini :<br>
          </address>
        </div>
        <!-- /.col -->
      </div><br>

      <div class="row ">
       
        <div class="col-xs-1">
          <address>
            Nama <br>
            NIK <br>
            Divisi <br>
            Status <br>
          </address>
        </div>

        <div class="col-xs-9">
          <address>
            : {{$item->nama}}<br>
            : {{$item->nik_ktp}}<br>
            : PRODUKSI<br>
            : {{$item->jabatan}}<br>
          </address>
        </div> 
      </div>

      <div class="row ">
        <div class="col-xs-12">
          <h7 >
          Bermaksud mengajukan pinjaman uang untuk keperluan Biaya Anak Sekolah sebesar {{"Rp. ".format_uang($item->plafon)}} ( {{terbilang($item->plafon)}} rupiah ) dan akan dilunasi melalui pemotongan gaji sebanyak {{$item->tenor}} ( {{terbilang($item->tenor)}}) kali sebesar {{"Rp. ".format_uang($item->angsuran)}} ( {{terbilang($item->angsuran)}} ) 
          mulai penggajian bulan {{$item->periode_angsuran}}.
          </h7>
        </div>
      </div><br>

      <div class="row ">
        <div class="col-xs-12">
          <h7 >
          Demikian permohonan ini kami sampaikan.
          Atas perhatian dan kebijaksanaannya kamui ucapkan terima kasih.
          </h7>
        </div>
      </div><br>

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
        <div  class="col-xs-4 ">
        <address>Disetujui pada tanggal : {{Carbon\Carbon::parse($item->tgl_disetujui_ketua)->addMonths(2)->format("d-M-y")}}<br>
        Ketua Koperasi JAPERNOSA</address>
        <!-- <img src="" class="img-thumbnail" width="200px" height="200px"><br><br> -->
        <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->disetujui_ketua,'QRCODE')}}" alt="barcode" style="widht: auto;"/><br>
        <address>
        <small class="text-gray">Ditandatangani secara elektronik</small><br>
        KISMAN</address>
        
        </div>

        <div  class="col-xs-4 ">
        <address>Disetujui pada tanggal : {{Carbon\Carbon::parse($item->tgl_disetujui_hrbp)->format("d-M-y")}}<br>
        HRBP Unit</address>
        <img   src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->disetujui_hrbp,'QRCODE')}}" alt="barcode" style="widht: auto;"/><br>
        <address>
        <small class="text-gray">Ditandatangani secara elektronik</small><br>
        IAN ALDINO</address>
        </div>

        <div  class="col-xs-4 ">
        <address>Diajukan pada tanggal : {{Carbon\Carbon::parse($item->tgl_pengajuan)->format("d-M-y")}}<br>
        Pemohon</address>
        <!-- <img src="" class="img-thumbnail" width="200px" height="200px"><br><br> -->
        <img   src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->nama,'QRCODE')}}" alt="barcode" style="widht: auto;"/><br>
        <address>
        <small class="text-gray">Ditandatangani secara elektronik</small><br>
        {{$item->nama}}</address>
        </div>
        
      </div>

      <div class="row ">
        <div  class="col-xs-12 text-right"> 
        <i><small class="pull-right">Tanggal verifikasi : {{$item->tgl_verifikasi}}<br> Admin user : {{$item->verifikator}}</small></i>
        </div>
      </div><br>
      <div class="row ">
        <div  class="col-xs-12"> 
        </div>
      </div><br>

      <div class="row ">
        <div  class="col-xs-4">
        <h6><strong>
    
          </strong></h6>
        </div>
    
        <div class="col-xs-4">
        <h6><strong>
       
          </strong></h6>
        </div>

        <div class="col-xs-4">
        
        </div>
      </div><br>

      <div class="row ">
        

      <div class="row ">
        <div class="col-xs-12">   
        </div>
      </div><br>

      <div class="row ">
    
        <div class="col-xs-6">
       
        </div>
      </div><br>

      <!-- <div class="row ">
        <div class="col-xs-12">
          <h6 >
          <label>*Tanggal Persetujuan</label><br>
          Date : .................................

          </h6>
        </div>
      </div><br> -->
      
      

      <!-- this row will not appear when printing -->
      @endforeach
</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
