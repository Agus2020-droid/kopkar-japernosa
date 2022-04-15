<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cetak Permohonan Pinjaman</title>
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

<body>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Koperasi Jaya Persada Ekonomi Sejahtera , Inc.
            <small class="pull-right">Date print: {{date(now())}}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
        <div class="col-sm-12">
        <img src="{{asset('kop.png')}}" height="100px"><br>
        </div>
        
    <div class="col-xs-12">
        <hr>
        </div>
      <!-- /.row -->
      <div class="row">
        <center><h3><strong>DATA PINJAMAN KOPERASI <br><small>Periode Tanggal {{Carbon\Carbon::parse($fromDate)->format("d-M-y")}} s/d  {{Carbon\Carbon::parse($toDate)->format("d-M-y")}}</small></strong></h3>
        </center>          
      </div>
      
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
                <th width="2%">No.</th>
                <th width="5%">Kode</th>
                <th width="7%">Tanggal</th>
                <th width="10%">NIK</th>
                <th width="10%">Nama</th>
                <th width="21%">Barang/Jasa</th>
                <th width="5%">Tenor</th>
                <th width="10%">Jatuh tempo</th>
                <th width="5%">Admin</th>
                <th width="5%">HRBP</th>
                <th width="5%">Ketua</th>
                <th width="10%" class="text-center">Jumlah</th>

            </tr>
            </thead>
            <tbody>
                <?php $no=1; ?>
                @foreach ($cetakPertanggal as $item)
                <tr>
                <td ><h5>{{ $no++}}</h5></td>
                <td ><h5>P-{{$item->no_pinjaman}}</h5></td>
                <td ><h5>{{Carbon\Carbon::parse($item->tgl_pengajuan)->format("d-M-y")}}</h5></td>
                <td ><h5>{{$item->nik_ktp}}</h5></td>
                <td ><h5>{{$item->nama}}</h5></td>
                <td><h5>{{$item->nama_barang}}</h5></td>
                <td ><h5>{{$item->tenor}}</h5></td>
                <td ><h5>{{$item->periode_angsuran}}</h5></td>
                <td >
                <?php
                    if($item->status_pengajuan == "WAITING VERIFIED")
                    echo '<i class="fa fa-spinner"></i>';
                    elseif ($item->status_pengajuan == "PENDING")
                    echo '<i class="fa fa-square-o""></i>';
                    elseif ($item->status_pengajuan == "VERIFIED")
                    echo '<i class="fa fa-check-square-o"></i>';
                    else 
                    echo '<i class="fa fa-minus-square"></i>';
                    ?>
                </td>
                <td>
                <?php
                    if($item->ttd_hrbp == "WAITING APPROVAL")
                    echo '<i class="fa fa-spinner"></i>';
                    elseif ($item->ttd_hrbp == "APPROVED")
                    echo '<i class="fa fa-check-square-o""></i>';
                    elseif ($item->ttd_hrbp == "PENDING")
                    echo '<i class="fa fa-square-o"></i>';
                    else 
                    echo '<i class="fa fa-minus-square"></i>';
                    ?>
                </td>
                <td>
                <?php
                    if($item->ttd_ketua == "WAITING APPROVAL")
                    echo '<i class="fa fa-spinner"></i>';
                    elseif ($item->ttd_ketua == "APPROVED")
                    echo '<i class="fa fa-check-square-o""></i>';
                    elseif ($item->ttd_ketua == "PENDING")
                    echo '<i class="fa fa-square-o"></i>';
                    else 
                    echo '<i class="fa fa-minus-square"></i>';
                    ?>
                </td>
                <td class="text-right"><h5>{{format_uang($item->plafon)}}</h5></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th colspan="10" class="text-right">JUMLAH</th>
                <th colspan="2" class="text-right">{{format_uang($sumTotal)}}</th>

            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>

      <div class="row no-print">
        <div class="col-xs-12">
          <a href="javascript:window.location.reload(true)" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('template/')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template/')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{asset('template/')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template/')}}/dist/js/demo.js"></script>
</body>









<body onload="window.print();">
</body>
</html>
