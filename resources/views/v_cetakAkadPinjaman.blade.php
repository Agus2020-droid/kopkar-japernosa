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

  <!-- Main content -->
  <section class="invoice">
  <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Jaya Persada Ekonomi Sejahtera, 
            <small class="pull-right">Tanggal cetak : {{date(now())}}</small>
          </h2>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
        <img src="{{asset('kop.png')}}" height="100px">
        </div>
      </div><hr>

        <div class="col-xs-12 text-center">
          <h3>
            <strong><u>AKAD JUAL BELI KREDIT</u></strong>
          </h3>
          @foreach ($pinjaman as $item)
          <h7>
            No. : P-{{$item->no_pinjaman}} /KOPKAR-KR/{{date(date('m'))}}/{{date(date('Y'))}}
          </h7>
          <h2>
          سْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ
          </h2>
        </div>


      <div class="row ">
        <div class="col-xs-12 text-justify">
          <h7>
          ”.....hai orang-orang yang beriman, janganlah kalian saling memakan (mengambil) harta sesamamu dengan jalan batil kecuali dengan jalan perniagaan yang berlaku dengan sukarela diantaramu...” (Qs.An – Nissa’(4):29) <br><br>
          Dengan berlindung kepada Allah dan senantiasa memohon RahmatNya. Akad ini dibuat dan ditandatangani pada hari ..... tanggal {{tanggal_local(date(now()))}} tempat PT.SGS Cabang Purbalingga oleh para pihak sebagai berikut :
          </h7><br>
        </div>

       
        <div class="col-xs-12">
          <div class="col-xs-1"></div>
          <div class="col-xs-3">1. Nama Lengkap</div>
          <div class="col-xs-8">: KISMAN</div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-1"></div>
          <div class="col-xs-3">&nbsp&nbsp&nbsp&nbspJabatan</div>
          <div class="col-xs-8"><address>: Ketua Kopkar Japernosa<br>
          &nbsp&nbspDalam hal ini bertindak untuk dan atas nama KOPKAR JAPERNOSA PT. SGS Cab. Purbalingga Untuk selanjutnya di sebut <strong>PIHAK I</strong> </address> </div>
        </div><br>

        <div class="col-xs-12">
          <div class="col-xs-1"></div>
          <div class="col-xs-3">2. Nama Lengkap</div>
          <div class="col-xs-8">: {{$item->nama}}</div>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-1"></div>
          <div class="col-xs-3">&nbsp&nbsp&nbsp&nbspNo.Anggota</div>
          <div class="col-xs-8"><address>: {{$item->nik_ktp}}<br>
          &nbsp&nbspUntuk selanjutnya di sebut <strong>PIHAK II</strong> </address> </div>
        </div>
     
        <div class="col-xs-12 text-justify">
          <h7>
         <address>Kedua belah pihak bertindak dalam kedudukannya masing-masing sebagaimana tersebut di atas, telah sepakat melakukan perjanjian jual beli kredit yang terikat dengan ketentuan dan syarat-syarat sebagai berikut:</address> 
          </h7>
        </div>

      <div class="row ">
        <div class="col-xs-12 text-center">
          <h3>
        PASAL 1  </h3><p>(Jual Beli)</p>
       
        </div>
      </div>

      <div class="col-xs-12 text-justify">
          <h7>
         <p>PIHAK I menjual barang kepada PIHAK II berupa barang/barang-barang yang tercantum dalam lampiran yang merupakan bagian yang tidak terpisahkan dari akad perjanjian ini,  sebesar: 
         <label>Rp. {{format_uang($item->total_kredit)}}</label> ({{terbilang($item->total_kredit)}} rupiah) 
          </h7></p>
        </div>

        <div class="col-xs-12 text-justify">
          <h7>
         <p>Dengan rincian harga pokok,  sebesar: 
         <label>Rp. {{format_uang($item->plafon)}}</label> ({{terbilang($item->plafon)}} rupiah) 
          </h7>
          </p>
        </div>

        <div class="row ">
        <div class="col-xs-12 text-center">
          <h3>
        PASAL 2</h3><p>(Sistem, Jangka Waktu Pembayaran Kembali dan Biaya-biaya)  </p>
        
        </div>
      </div>

      <div class="col-xs-12 text-justify">
          <h7>
         <p>PIHAK II sepakat untuk membeli barang sebagaimana tersebut pada pasal 1 dengan ketentuan-ketentuan sebagai berikut : </p>
          </h7>
        </div>

        <div class="col-xs-12">
          <address>
          &nbsp&nbsp1. Sistem pembayaran adalah angsuran melalui pemotongan gajih bulanan. <br>
          &nbsp&nbsp2. Tata cara pembayaran diatur dan disepakati oleh seluruh anggota koperasi dengan cara pemotongan upah/gaji pada bulan berikutnya setelah pengajuan kredit barang dikabulkan. <br>
          &nbsp&nbsp3. Jangka waktu pembayaran adalah {{$item->tenor}} ({{terbilang($item->tenor)}}) bulan dengan jumlah angsuran Rp. {{format_uang($item->angsuran)}} ({{terbilang($item->angsuran)}}) rupiah
          </address> 
        </div>

        <div class="col-xs-12 text-justify">
          <h7>
         <p>oleh karena itu perjanjian jual beli ini berlaku sejak tanggal ditandatanganinya. Adapun pelunasan pembayaran dapat dilakukan sebelum jatuh tempo atau selambat-lambatnya akan jatuh tempo pada </p>
          </h7>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-1">Tanggal</div>
          <div class="col-xs-2">{{$item->periode_angsuran}}</div>
        </div>

        <div class="col-xs-12">
          <address>
          &nbsp&nbsp4. Wajib membayar seluruh kewajiban yang muncul akibat adanya perjanjian jual beli ini sampai dengan lunas sebagaimana mestinya kepada PIHAK I<br>
          &nbsp&nbsp5. Setiap Anggota KOPKAR JAPERNOSA yang memiliki tanggungan dan akan mengundurkan diri dari perusahaan maka wajib melunasi semua tanggungan yang tersisa kepada Kopkar JAPERNOSA.<br>
          </address> 
        </div>

      <div class="row ">
        <div class="col-xs-12 text-center">
          <h3>
        PASAL 3 </h3><p>(Pengutamaan Pembayaran)  </p>
        </div>
      </div>

      <div class="col-xs-12 text-justify">
          <h7>
         <p>PIHAK II akan melakukan angsuran sesuai dengan kesepakatan sebagaimana bunyi pasal 2 berikut tata cara pembayarannya secara tertib dan teratur dan akan lebih mengutamakan kewajiban pembayaran ini daripada pembayaran kepada pihak lain.</p>
          </h7>
        </div>
        
        <div class="row ">
        <div class="col-xs-12 text-center">
          <h3>
        PASAL 4 </h3> <p>(Pengakuan Utang) </p>
        </div>
      </div>

      <div class="col-xs-12 text-justify">
          <h7>
         <p>Berkaitan dengan jual-beli ini,selama harga Pihak I sebagaimana dimaksud Pasal 2 ayat 3 belum dilunasi oleh anggota kepada dari PIHAK I, maka anggota dengan ini mengaku berutang kepada dari PIHAK I, sebagaimana dari PIHAK I menerima pengakuan utang tersebut dari anggota sebesar harga atau sisa harga yang belum dibayar lunas oleh anggota.</p>
          </h7>
        </div>

        <div class="row ">
        <div class="col-xs-12 text-center">
          <h3>
        PASAL 5</h3><p>(Domisili Hukum)</p>
        </div>
      </div>

      <div class="col-xs-12 text-justify">
          <h7>
         <p>Tentang akad ini dan segala akibatnya, para pihak memilih domisili hukum yang tetap dan tidak berubah di kantor Pengadilan Agama Kabupaten Purbalingga.</p>
          </h7>
        </div>

        <div class="row ">
        <div class="col-xs-12 text-center">
          <h3>
        PASAL 6</h3><p>(Addendum)</p> 
        </div>
      </div>

      <div class="col-xs-12 text-justify">
          <h7>
         <p>Kedua belah pihak telah bersepakat, bahwa segala sesuatu yang belum diatur dalam akad ini, akan diatur dalam addendum-addendum dan atau surat-surat dan atau lampiran-lampiran yang akan dibuat dan menjadi bagian yang tidak terpisahkan dari perjanjian ini. <br>
         Perjanjian ini ditandatangani dibuat dalam rangkap 2(dua) masing-masing bermaterai cukup dan mempunyai kekuatan pembuktian yang sama, ditandatangani kedua belah pihak dengan suka rela (saling ridlo) tanpa paksaan dari pihak manapun, serta disaksikan oleh :</p>
          </h7>
        </div>


      <div class="row ">
        <div class="col-xs-12">
        <div class="col-xs-6">Purbalingga, {{tanggal_local(date(now()))}}</div>
        </div>
      </div><br>

          
      <div class="row ">
        <div  class="col-xs-6 text-center">
        <address>
        PIHAK I</address>
        <address><br><br>
        KISMAN <br>
      Ketua Koperasi</address>
        
        </div>


        <div  class="col-xs-6 text-center">
        <address>
        PIHAK II</address>
        <address><br><br>
        {{$item->nama}}<br>
        Pemohon</address>
        </div>

        <div class="col-xs-12">
          <div class="col-xs-1">SAKSI 1</div>
          <div class="col-xs-2">: ...................</div>
        </div>        
        <div class="col-xs-12">
          <div class="col-xs-1">SAKSI 2</div>
          <div class="col-xs-2">: ...................</div>
        </div>
        
      </div>
      @endforeach

  </section>
  <!-- /.content -->

<!-- ./wrapper -->
</body>
</html>

