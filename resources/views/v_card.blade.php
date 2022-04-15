<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kopkar Japernosa | Kartu Anggota</title>
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
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
  @foreach ($pegawai as $key => $item)
  <div class="row no-print">
        <div class="col-sm-6">
          <a href="/downloadPDF/{{$item->nik_ktp}}" class="btn btn-default"><i class="fa fa-download"></i> Download</a>
        </div>
      </div><br>
 
  <div class="row">
        <div class="col-xs-6">
            <div class="widget-user-header bg-black"  style="background: url('{{asset('template')}}/dist/img/card.png') left top;width: 480px;height: 303px;rounded: -3;"><br><br><br><br><br>
                <div class="box-header">
                    <div class="header col-xs-3 text-center">
                    <img class="pull-left"src="{{ asset('storage/foto_pegawai/'.$item->foto_pegawai) }}" class="img-thumbnail" alt="User Image" width="90px" height="90px">
                    <!-- <img class="pull-left"src="{{ asset('storage/foto_pegawai/'.$item->foto_pegawai) }}" class="img-thumbnail" alt="User Image" width="90px" height="90px"> -->
                    <small class="text-blue-center"><strong>{{$item->nik_ktp}}</strong></small>
                </div>
                    <div class="col-xs-3">
                    <strong><span class="text-blue">Nama</span><br>
                    <span class="text-blue">Kota Lahir</span><br>
                    <span class="text-blue">Tgl Lahir </span><br>
                    <span class="text-blue">Alamat</span></strong>
                    </div>
                    <div class="col-xs-6">
                    <strong><span class="text-blue">: {{$item->nama}}</span><br>
                    <span class="text-blue">: {{$item->tempat_lahir}}</span><br>
                    <span class="text-blue">: {{$item->tgl_lahir}}</span><br>
                    <span class="text-blue">: {{$item->alamat}}</span></strong>
                    </div>
                    <div class="col-xs-12">
                    <h5 class="pull-left"><i><strong>www.kopkar.japernosa.com</strong></i></h5>
                    <img class="pull-right"src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->nama, 'C39')}}" alt="barcode" width="200px" height="40px"/>
                    </div> 
                    @endforeach
                </div>    
            </div>
        </div>
    </div>
</section>

  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
