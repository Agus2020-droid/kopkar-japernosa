@extends ('layout.v_template')
@section('title','Dashboard Anggota Kopkar')

@section('content')
@if (session('pesan'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> Sukses!</h4>
          {{session('pesan')}}.
        </div>
        @endif
<!-- Content Header (Page header) -->
<section class="content-header">
      <h3><strong>WELCOME {{Auth::user()->name}}</strong></h3><br>
</section>
    
<div class="row">
            <div class="container">
              <div class="col-sm-8">
              
              

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators"> 
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>

                  <!-- deklarasi carousel -->
                  <div class="carousel-inner" role="listbox">
                    <div class="item active">
                      <img src="{{asset('/foto_dashboard/IMG1.JPG')}}" alt="www.malasngoding.com">
                      <div class="carousel-caption">
                        <h3>HEAD OFFICE</h3>
                        <p>www.sampoernakayoe.co.id</p>
                      </div>
                    </div>

                    <div class="item">
                      <img src="{{asset('/foto_dashboard/IMG2.JPG')}}" alt="www.malasngoding.com">
                      <div class="carousel-caption">
                        <h3>PT. SUMBER GRAHA SEJAHTERA</h3>
                        <h5>KANTOR CABANG PURBALINGGA</h5>
                        <p>Jawa Tengah - Indonesia</p>
                      </div>
                    </div>

                    <div class="item">
                      <img src="{{asset('/foto_dashboard/IMG3.JPG')}}" alt="www.malasngoding.com">
                      <div class="carousel-caption">
                        <h3>Japernosa Water</h3>
                        <p>Air Mineral Kesegaran Alami</p>
                      </div>
                    </div>
                  </div>

                  <!-- membuat panah next dan previous -->
                  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>

              <div class="col-sm-3">
              <center><img src="{{asset('logo.png')}}" alt="Admin" class="rounded-circle" width="130" class="center"> 
              </center>
              <center>
              <h5>KOPERASI KARYAWAN (JAPERNOSA)</h5>
              <h6>PT. SUMBER GRAHA SEJAHTERA</h56>
              <h6>CABANG PURBALINGGA </h6>
              </div>

              <div class="col-sm-3">
              <center><img src="{{asset('wanamart.png')}}" alt="Admin" class="rounded-circle" width="130" class="center"> 
              </center>
              <center>
              <h5>Toko "WANA MART"</h5>
              <h6>Belanja Pasti Untung </h6>
              <h6> </h6>
              </center>
              </div>
            </div>
          </div>  
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif

@endsection