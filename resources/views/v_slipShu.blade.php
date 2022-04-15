<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kopkar Japernosa | Slip SHU</title>
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
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <center><h2 class="page-header">
            KOPKAR JAPERNOSA</h2> 
            <small>JAYA PERSADA EKONOMI SEJAHTERA</small>
          </center><hr style="border-top: 3px double #8c8b8b;">
        </div>
        <div class="col-xs-12">
            <center><label>-- SLIP SHU --</label></center>
        </div><br>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
        <table class="table"> 
            <tbody>
            @foreach ($pegawai as $item)
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td>{{$item->nama}}</td>
            </tr>
            <tr>
              <td>NIK KTP</td>
              <td>:</td>
              <td>{{$item->nik_ktp}}</td>
            </tr>
            <tr>
              <td>Alamat Lengkap</td>
              <td>:</td>
              <td>{{$item->alamat}}</td>
            </tr>
            @endforeach
            @foreach ($user as $item)
            <tr>
            <td>Telp</td>
            <td>:</td>
              <td>{{$item->telp}}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
                <td>{{$item->email}}</td>
            </tr>
            @endforeach
            @foreach ($shu as $data)
            <tr>
              <td>Nama Bank</td>
              <td>:</td>
                <td>{{$data->nama_bank}}</td>
            </tr>
            <tr>
              <td>No. Rekening</td>
              <td>:</td>
                <td>{{$data->no_rek}}</td>
            </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-6 invoice-col">
    
        </div>
        <!-- /.col -->
      </div><hr>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr class="bg-gray">
              <th width="5%">NO.</th>
              <th width="50%">Keterangan</th>
              <th width="5%"></th>
              <th width="40%">Jumlah</th>             
            </tr>
            </thead>
            <tbody>
             
             <tr>  
            <td>1</td>
              <td>SHU peran Wanamart (peran belanja)</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->peran_belanja_wanamart)}}</td>
            </tr>
            <tr>
            <td>2</td>
              <td>SHU peran Wanamart (peran simpanan)</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->peran_simpanan_wanamart)}}</td>
            </tr>
            <tr>
            <td>3</td>
              <td >SHU Japernosa Water & fotocopy</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->lain_lain)}}</td>
            </tr>
            <tr>
            <td>4</td>
              <td>SHU peran kredit pinjaman</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->peran_kredit)}}</td>
            </tr>
            <tr>
            <td>5</td>
              <td>SHU peran kredit dari simpanan</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->peran_simpanan)}}</td>
            </tr>
            <tr>
            <td>6</td>
              <td>SHU pengurus</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->pengurus)}}</td>
            </tr>
            <tr class="bg-black text-white">
            <td></td>
              <td>JUMLAH SHU yang ditransfer</td>
              <td style="text-align: right;">Rp. </td>
              <td style="text-align: right;">{{format_uang($data->jumlah_shu)}}</td>
            </tr>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div><br><hr>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

          <p class="text-muted well well-lg no-shadow " style="margin-top: 10px;">
            <strong>PERHATIAN !!</strong><br>
            1. SHU akan di transfer ke nomor rekening yang tertera di atas. mohon cek no. rekening tersebut. <br> 
            2. Jika terdapat ketidaksesuaian data Bank/nomor rekening  segera hubungi admin kopkar di nomor 0858-7634-4438.<br>
            3. Info paling lambat kami terima sebelum tgl 7 Februari 2022.<br>
            4. SHU ditransfer tanggal 7 Februari 2022.
            
          </p>
          <center>
          <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->nik_ktp, 'PDF417')}}" alt="barcode" width="200px" height="50px"/><br>
            <small>Tanggal download : {{date(now())}}</small><br>
          <small><i>www.kopkar.japernosa.com</i> </small>
        </center>
        </div>
        @endforeach
        <div class="col-xs-6">

       
        </div>

      </div>

    </section>
      <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>