@extends ('layout.v_template')
@section('title','HOME')

@section('content')
<section class="content">
<section class="content-header">
  <h1>SELAMAT DATANG <b>{{Auth()->user()->name}}</b></h1>
  <ol class="breadcrumb">
    <li><a href="/home"><i class="fa fa-home"></i>Home</a></li>
  </ol>
</section>
<div class="preloader">
  <div class="loading">
    <img src="loading.gif" width="80">
    <p>Harap Tunggu</p>
  </div>
</div>
  @if (session('pesan'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Sukses!</h4>
    {{session('pesan')}}.
  </div>
  @endif
<!-- Content Header (Page header) -->
 
  <div class="row" style="padding: 2%">
    <div class="col-sm-4 text-center">
        <img class="img_home" src="{{asset('logo.png')}}" style="width: 250px">
    </div>
    <div class="col-sm-8 ">
        <div class="section-title">
        
            <h2 style="text-transform:uppercase">KOPERASI JAPERNOSA</h2>
            <p style="font-size: 17px; text-align: justify;">Koperasi Jaya Persada Ekonomi Sejahtera (JAPERNOSA) merupakan  Koperasi yang beranggotakan karyawan PT. Sumber Graha Sejahtera Cabang Purbalingga
                dengan jumlah pengurus 14 orang dan anggota sebanyak 700 orang. Berdiri pada tahun 2018 dan beralamat di Jalan Raya Bajong KM.07 Desa Bajong Kec. Bukateja Kab. Purbalingga Jawa Tengah
                <br><br>
                Koperasi Japernosa adalah Koperasi karyawan PT. Sumber Graha Sejahtera Cabang Purbalingga
                yang menjalankan bisnis utama di KSP (Koperasi Simpan Pinjam), koperasi ini juga sudah mengembangkan usaha 
                di unit penjualan barang yaitu "WANA MART" serta unit jasa Fotocopy dan Air mineral "JAPERNOSA WATER". <br><br>
                <center> www.kopkar.japernosa.com</center>
            </p>
        </div>
    </div>
  </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @if (Session::has('success'))
    <script>
    swal("Greet Job!","{!! session::get('success') !!}","success",{
      button:"OK",
    })
    </script>
  @endif
@endsection