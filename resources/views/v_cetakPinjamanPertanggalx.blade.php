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
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
<section class="invoice">
  
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

      <!-- Table row -->
      <section class="content">

        <div class="col-xs-12">
        <!-- /.box -->
          <div class="box">
          <!-- <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Info!</h4>
                Dokumen pengajuan bisa dicetak jika status pengajuan belum disetujui
              </div> -->
          
                <center><h3><strong>DATA PINJAMAN KOPERASI <br><small>Periode Tanggal {{Carbon\Carbon::parse($fromDate)->format("d-M-y")}} s/d  {{Carbon\Carbon::parse($toDate)->format("d-M-y")}}</small></strong></h3></center>
           
            <!-- /.box-header -->
            <div class="box-header">
                <div class="box-body table-responsive no-padding">
                <table id="example1" class="table bordered table-hover dataTable " role="grid" aria-describedby="example2_info">
                <thead>
                <tr>
                <th width="2%"><p class="text-center">No.</th>
                <th width="10%"><p class="text-center">Tanggal</th>
                <th width="10%"><p class="text-center">NIK</th>
                <th width="30%"><p class="text-center">Nama</th>
                
                <th width="10%"><p class="text-center">Jumlah</th>
                <th width="10%"><p class="text-center">Verifikasi Admin</th>
                <th width="10%"><p class="text-center">Persetujuan Ketua</th>
                <th width="10%"><p class="text-center">Persetujuan HRD</th>
                <th width="8%"><p class="text-center">Nama Barang/Jasa</th>
                </tr>
                </thead>
                <tbody>
                
                <?php $no=1; ?>
                @foreach ($cetakPertanggal as $item)
                <tr>
                <td ><h5>{{ $no++}}</h5></td>
                <td ><h5>{{Carbon\Carbon::parse($item->tgl_pengajuan)->format("d-M-y")}}</h5></td>
                <td ><h5>{{$item->nik_karyawan}}</h5></td>
                <td ><h5>{{$item->nama}}</h5></td>
                <td ><h5>{{format_uang($item->total_kredit)}}</h5></td>
                <td >
                <?php
                    if($item->status_pengajuan == "WAITING VERIFIED")
                    echo '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i></span>';
                    elseif ($item->status_pengajuan == "PENDING")
                    echo '<span class="badge bg-gray"><i class="fa fa-history"></i></span>';
                    elseif ($item->status_pengajuan == "VERIFIED")
                    echo '<span class="badge bg-green"><i class="fa fa-check-circle bg-green"></i></span>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?>
                </td>
                <td>
                <?php
                    if($item->ttd_hrbp == "WAITING APPROVAL")
                    echo '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i></span>';
                    elseif ($item->ttd_hrbp == "APPROVED")
                    echo '<span class="badge bg-green"><i class="fa fa-check-circle bg-green"></i></span>';
                    elseif ($item->ttd_hrbp == "PENDING")
                    echo '<span class="badge bg-gray"><i class="fa fa-history"></i></span>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?>
                </td>

                <td>
                  <h5>
                  <?php
                    if($item->ttd_hrbp == "WAITING APPROVAL")
                    echo 'Waiting Approval';
                    elseif ($item->ttd_hrbp == "APPROVED")
                    echo 'Approved';
                    elseif ($item->ttd_hrbp == "PENDING")
                    echo 'Pending';
                    else 
                    echo 'Not Approved';
                    ?>
                   
                  </h5>
                </td>

                </td>
                <td >
                
              </td>
                  </td>
                </tr>

                </tbody>
                @endforeach
              </table>
    
      
</section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
