<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Kopkar | Cetak Permohonan Pinjaman</title>
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
<body >
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
        <img src="{{asset('kop.png')}}" height="100px">
        </div>
      </div><hr>

      <div class="row ">

        <div class="col-xs-8">
          <h7 >
            <strong class="text-center">FORMULIR PERMOHONAN PINJAMAN KREDIT KOPERASI</strong>
          </h7>
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
          <h7 >
            Yang bertanda tangan dibawah ini saya :
          </h7>
        </div>
        <!-- /.col -->
      </div><br>

      <div class="row ">
        <div class="col-xs-1">
          
        </div>
        <!-- /.col -->
    
        <div class="col-xs-3">
          <h7 >
            Nama
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-1">
          <h7 >
            :
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-7">
          <h7 >
            <strong>{{$item->nama}}</strong>
          </h7>
        </div>
        <!-- /.col -->
      </div>

      <div class="row ">
        <div class="col-xs-1">
          
        </div>
        <!-- /.col -->
    
        <div class="col-xs-3">
          <h7 >
            Nomor anggota / NIK
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-1">
          <h7 >
            :
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-7">
          <h7 >
            {{$item->nik_ktp}}
          </h7>
        </div>
        <!-- /.col -->
      </div>

      <div class="row ">
        <div class="col-xs-1">
          
        </div>
        <!-- /.col -->
    
        <div class="col-xs-3">
          <h7 >
            Status Karyawan
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-1">
          <h7 >
            :
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-7">
          <h7 >
          {{$item->jabatan}}
          </h7>
        </div>
        <!-- /.col -->
      </div>

      <div class="row ">
        <div class="col-xs-1">
          
        </div>
        <!-- /.col -->
    
        <div class="col-xs-3">
          <h7 >
            Nomor Telp./ HP
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-1">
          <h7 >
            :
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-7">
          <h7 >
            {{$item->telepon}}
          </h7>
        </div>
        <!-- /.col -->
      </div>

      <div class="row ">
        <div class="col-xs-1">
          
        </div>
        <!-- /.col -->
    
        <div class="col-xs-3">
          <h7 >
            Alamat Rumah
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-1">
          <h7 >
            :
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-7">
          <h7 >
            {{$item->alamat}}
          </h7>
        </div>
        <!-- /.col -->
      </div><br>
      
      <div class="row ">
        <div class="col-xs-12">
          <h7 >
          Bermaksud mengajukan kredit kepada KOPKAR JAPERNOSA yang berada di PT. SUMBER GRAHA SEJAHTERA Cabang Purbalingga, berupa barang/barang-barang untuk keperluan Saya. Adapun barang/barang-barang yang akan saya ajukan untuk kredit adalah sebagai berikut :
          </h7>
        </div>
      </div><br>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th><p class="text-center">No.</th>
              <th><p class="text-center">Nama Barang</th>
              <th><p class="text-center">Merk / Brand</th>
              <th><p class="text-center">Spesifikasi</th>
              <th><p class="text-center">Jumlah/Unit</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <tr>
              <td><p class="text-center">{{ $no++}}</td>
              <td><p class="text-center">{{$item->nama_barang}}</td>
              <td><p class="text-center">{{$item->merk}}</td>
              <td><p class="text-center">{{$item->spesifikasi}}</td>
              <td><p class="text-center">{{$item->unit}}</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <!-- <p class="lead">*) Persetujuan Pembelian</p> -->

            <!-- <div class="row">
            <div class="col-xs-8">
            <div class="pull-left" class="form-group">
                <label> 
                <div class="fa fa-square-o"> </div>
                Disetujui untuk di proses lebih lanjut
                </label>
            </div>
            </div>
            </div>

            <div class="row">
            <div class="col-xs-8">
            <div class="pull-left" class="form-group">
                <label>  
                <div class="fa fa-square-o"> </div>
                Tidak disetujui untuk di proses lebih lanjut
                </label>
            </div>
            </div>
            </div> -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row ">
        <div class="col-xs-12">
          <h7 >
          Demikian permohonan ini saya ajukan, besar harapan Saya agar pengajuan kredit  ini bisa dikabulkan. 
          Atas perhatian dan terwujudnya harapan ini saya sampaikan terima kasih.
          </h7>
        </div>
      </div><br>

      <div class="row ">
        <div class="col-xs-11">
        <div class="pull-left">
          <h7 >
          Purbalingga, {{tanggal_local($item->tgl_pengajuan)}}
          </h7>
          </div>
        </div>
      </div><br>
      
      
      <div class="row ">
        <div  class="col-xs-4 ">
        <address>Disetujui pada tanggal : {{Carbon\Carbon::parse($item->tgl_disetujui_ketua)->format("d-M-y")}}<br>
        Ketua Koperasi JAPERNOSA</address>
        <!-- <img src="" class="img-thumbnail" width="200px" height="200px"><br><br> -->
        <img src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->disetujui_ketua,'QRCODE')}}" alt="barcode" style="widht: auto;"/><br>
        <address>
        <small class="text-gray">Ditandatangani secara elektronik</small><br>
        {{$item->disetujui_ketua}}</address>
        
        </div>

        <div  class="col-xs-4 ">
        <address>Disetujui pada tanggal : {{Carbon\Carbon::parse($item->tgl_disetujui_hrbp)->format("d-M-y")}}<br>
        HRBP Unit</address>
        <img   src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->disetujui_hrbp,'QRCODE')}}" alt="barcode" style="widht: auto;"/><br>
        <address>
        <small class="text-gray">Ditandatangani secara elektronik</small><br>
        {{$item->disetujui_hrbp}}</address>
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
