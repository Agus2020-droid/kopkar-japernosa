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
          <h2 class="page-header">
            <i class="fa fa-globe">
            
            </i> Sumber Graha Sejahtera, PT
            
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
          <h7 >
            <strong class="text-center">TANDA BUKTI PELUNASAN PINJAMAN</strong>
          </h7>
        </div>

        <div class="col-xs-4">
          <h7 class="pull-right">
            <strong>No. Permohonan kredit  : {{$item->id_pengambilan}} /KOPKAR-KR/{{date(date('m'))}}/{{date(date('Y'))}}</strong>
          </h7>
        </div>
        <!-- /.col -->
      </div><br><br>

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
    
        <div class="col-xs-2">
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

        <div class="col-xs-8">
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
    
        <div class="col-xs-2">
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

        <div class="col-xs-8">
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
    
        <div class="col-xs-2">
          <h7 >
            Bagian
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-1">
          <h7 >
            :
          </h7>
        </div>
        <!-- /.col -->

        <div class="col-xs-8">
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
    
        <div class="col-xs-2">
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

        <div class="col-xs-8">
          <h7 >
            {{$item->telp}}
          </h7>
        </div>
        <!-- /.col -->
      </div>

      <div class="row ">
        <div class="col-xs-1">
          
        </div>
        <!-- /.col -->
    
        <div class="col-xs-2">
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

        <div class="col-xs-8">
          <h7 >
            {{$item->alamat}}
          </h7>
        </div>
        <!-- /.col -->
      </div><br>
      
      <div class="row ">
        <div class="col-xs-12">
          <h7 >
          Bermaksud mengajukan permohonan pengambilan simpanan kepada KOPKAR JAPERNOSA yang berada di PT. SUMBER GRAHA SEJAHTERA Cabang Purbalingga, untuk keperluan Saya. Adapun simpanan yang akan saya ambil adalah sebagai berikut :
          </h7>
        </div>
      </div><br>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>No.</th>
              <th>Kode Transaksi</th>
              <th>Tanggal pengajuan</th>
              <th>Nik Karyawan</th>
              <th>Nama Lengkap</th>
              <th>Alasan Pengambilan</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            <tr>
              <td>{{ $no++}}</td>
              <td>AMSM-{{$item->id_pengambilan}}</td>
              <td>{{tanggal_local($item->tgl_pengambilan)}}</td>
              <td>{{$item->nik_karyawan}}</td>
              <td>{{$item->nama}}</td>
              <td>Untuk Keperluan Pribadi</td>
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
          <p class="lead">*) Persetujuan Pembelian</p>

            <div class="row">
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
            </div>
          
        </div>

        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead">Rincian simpanan yang akan diambil</p>

          <div class="table-responsive">
            <table class="table">
              <tbody><tr>
                <th style="width:50%">Simpanan Pokok:</th>
                <td>{{"Rp. ".format_uang($item->simpanan_pokok)}}</td>
              </tr>
              <tr>
                <th>Simpanan Wajib</th>
                <td>{{"Rp. ".format_uang($item->simpanan_wajib)}}</td>
              </tr>
              <tr>
                <th>Simpanan Sukarela</th>
                <td>{{"Rp. ".format_uang($item->simpanan_sukarela)}}</td>
              </tr>
              <tr>
                <th>Total:</th>
                <td>{{"Rp. ".format_uang($item->jumlah_pengambilan)}}</td>
              </tr>
              <tr>
                <th></th>
                <td><i>({{terbilang($item->jumlah_pengambilan)}} rupiah)<i></td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row ">
        <div class="col-xs-12">
          <h7 >
          Demikian permohonan ini saya ajukan, besar harapan Saya agar pengajuan pengambilan simpanan ini bisa dikabulkan.<br>
          Atas perhatian dan terwujudnya harapan ini saya sampaikan terima kasih.
          </h7>
        </div>
      </div><br>
      
      
      <div class="row ">
        <div  class="col-xs-4">
          <center>Bendahara</center>
        </div>
        <!-- /.col -->
    
        <div class="col-xs-4">
        <center>HRBP Unit</center>
        </div>
        <!-- /.col -->

        <div class="col-xs-4">
        <center>Pemohon</center>
        </div>
        <!-- /.col -->
        <br>
      </div>

      <div class="row ">
        <div  class="col-xs-12"> 
        </div>
      </div><br>
      <div class="row ">
        <div  class="col-xs-12"> 
        </div>
      </div><br>

      <div class="row ">
        <div  class="col-xs-4">
        <h6><strong>
        <center>GABRIELLE TEDY SETYAWAN</center>
          </strong></h6>
        </div>
    
        <div class="col-xs-4">
        <h6><strong>
        <center>IAN ALDINO</center>
          </strong></h6>
        </div>

        <div class="col-xs-4">
        <h6><strong>
        <center>{{$item->nama}}</center>
          </strong></h6>
        </div>
      </div><br><hr>

      <div class="row ">
        <div  class="col-xs-6">
        <center>Pengawas KOPKAR</center>
        </div>
        
        <div class="col-xs-6">
        <center>Ketua KOPKAR</center>
        </div>
      </div><br>

      <div class="row ">
        <div class="col-xs-12">   
        </div>
      </div><br>

      <div class="row ">
        <div  class="col-xs-6">
        <h6><strong>
        <center>AHMAD DEDE ROSADI</center>
          </strong></h6>
        </div>
    
        <div class="col-xs-6">
        <h6><strong>
        <center>KISMAN</center>
          </strong></h6>
        </div>
      </div><br>
      

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="/pengambilan/cetak/{{$item->id_pengambilan}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div>
      @endforeach
</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
