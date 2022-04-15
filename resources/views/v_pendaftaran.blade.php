<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cetak | Form Pendaftaran</title>
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
    <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Sumber Graha Sejahtera, PT
            
            <small class="pull-right">Tanggal cetak : {{date(now())}}</small>
            
          </h2>
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-sm-12">
        <img src="{{asset('kop.png')}}" style="height: 100px;">
        </div>
    </div>
  
      <hr>
  <div class="box-header">
      <center><h3 >FORM PENDAFTARAN ANGGOTA KOPERASI</h3> </center>
  </div>
  
  <table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
              <thead>
              <tr>
              <th colspan="3">Yang bertanda tangan di bawah ini :</th>
              </tr>
              </thead>
              <tbody>
              <tr>
              <td >
              <div class="box-body">

              <div class="row">
                <div class="col-xs-3">
                  <label>NIK KTP</label>
                </div>
                
                <div class="col-xs-9">
                  <input type="text" class="form-control" maxlength="16" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>NAMA LENGKAP</label>
                </div>
                
                <div class="col-xs-9">
                  <input type="text" class="form-control" id="name" style="text-transform:uppercase">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>NIK KARYAWAN</label>
                </div>
                <div class="col-xs-9">
                  <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>STATUS KEPEGAWAIAN</label>
                </div>
                <div class="col-xs-9">
                <select type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" style="text-transform:uppercase">
                <option value=""></option>    
                <option value="">STAF</option>    
                <option value="">TETAP</option>    
                <option value="">KONTRAK</option>
                <option value="">MITRA</option>    
                </select>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>TGL MASUK KERJA</label>
                </div>
                <div class="col-xs-9">
                  <input type="text" class="form-control" >
                </div>
              </div>
              
              <div class="row">
                <div class="col-xs-3">
                  <label>NO. WhatsApp</label>
                </div>
                <div class="col-xs-9">
                  <input type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" >
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>Email</label>
                </div>
                <div class="col-xs-9">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" >
                </div>
              </div>
              <div class="row">
                <div class="col-xs-3">
                  <label>ALAMAT</label>
                </div>
                <div class="col-xs-9">
                  <textarea type="text" class="form-control" style="width: 100%;" rows="5"></textarea>
                </div>
              </div><br>
              <div class="row">
                <div class="col-xs-12">
                <address class="text-justify">Dengan ini mengajukan permohonan masuk menjadi anggota KOPERASI JAYA PERSADA EKONOMI SEJAHTERA di PT. SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA dan bersedia memenuhi ketentuan-ketentuan dan persyaratan yang ada, yaitu : <br><br>
                    1. Karyawan berstatus Tetap/Kontrak/Mitra PT. SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA <br>
                    2. Membayar Simpanan Pokok secara potong gaji sebesar Rp.50.000 (Lima Puluh ribu rupiah) <br>
                    3. Mentaati Anggaran Dasar dan Anggaran Rumah Tangga (AD & ART) dan segala peraturan yang berlaku di KOPKAR JAPERNOSA di PT SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA. <br>
                    4. Membayar Simpanan Wajib setiap bulan sejak diterima menjadi anggota koperasi karyawan sebesar Rp. 20.000,- (Dua Puluh Ribu Rupiah). <br>
                Pembayaran simpanan wajib dilakukan melalui bagian Personalia/Payroll dengan cara pemotongan gaji. <br><br>
                Demikian permohonan ini dibuat, untuk menjadi bahan pertimbangan bagi pengurus. Atas perhatiannya disampaikan terima kasih.
                </address> 
                </div>
              </div>
            </div>
              </td>
              

              
              </tr>
              
              </tbody>
              <tfoot>
                  <th>
                     <div class="col-xs-12">
                        <div class="row-header text-right">
                            Purbalingga, {{Carbon\Carbon::parse(date(now()))->isoFormat("DD-MMMM-YYYY")}}
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row-header text-center">
                            Diketahui,
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row-header text-center">
                            Pemohon,
                        </div>
                    </div>
                    <div class="col-xs-12">
                        
                    </div><br><br><br><br><br>
                    <div class="col-xs-6">
                        <div class="row-header text-center">
                            IAN ALDINO <br>
                            (HRBP Unit)
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row-header text-center">
                            <span id="name_ttd" style="text-transform:uppercase"></span>
                        </div>
                    </div><br><br>
                    <div class="col-xs-12">
                        <div class="row-header">
                            Disposisi pengurus KOPKAR JAPERNOSA PT. SUMBER GRAHA SEJAHTERA : <br>
                            <input type="checkbox"> Diterima <br> <input type="checkbox"> Ditangguhkan <br><input type="checkbox"> Ditolak
                        </div>
                    </div><br><br><br><br><br><br>
                    <div class="col-xs-6">
                        <div class="row-header text-center">
                            KISMAN <br>
                            (Ketua KOPKAR)
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="row-header text-center">
                            Tanggal disposisi : <input type="text">
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-xs-12">
                        <a href="javascript:window.location.reload(true)" class="btn btn-default pull-right"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                  </th>

              </tfoot>

        </table>
</section>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
 
  $(".form-control").keyup(function() {
      var nama = document.getElementById("name")
      document.getElementById("name_ttd").innerHTML = nama.value;

    }); 
</script>
<!-- /.content -->
</div>


<!-- ./wrapper -->
</body>
</html>
