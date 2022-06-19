@extends ('layout.v_template')
@section('title','HOME')

@section('content')
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
<section class="content-header"> 
          <!--<div class="col-12">-->
      
          <!--  <div class="box">-->
          <!--    <div class="box-header">-->
          <!--      <div class="col-sm-3"> -->
              
          <!--        <div class="box-body">-->
          <!--          <div class="box-body box-profile">-->
          <!--            <img class="profile-user-img img-responsive img-circle" src="{{ asset('logo.png')}}" alt="User profile picture">-->
          <!--            <h4 class="text-muted text-center">KOPKAR JAPERNOSA</h4>-->
          <!--            <address class="text-muted text-center"> PT Sumber Graha Sejahtera<br>-->
          <!--            Cabang Purbalingga</address>-->
          <!--          </div>-->

          <!--          <div class="box-body box-profile">-->
          <!--            <img class="profile-user-img img-responsive img-circle" src="{{ asset('wanamart.png')}}" alt="User profile picture">-->
          <!--            <h4 class="text-muted text-center">WANA MART</h4>-->
          <!--            <address class="text-muted text-center"> Belanja di Wana Mart<br>-->
          <!--            PASTI UNTUNG</address>-->
          <!--          </div>-->
          <!--        </div>-->
          <!--      </div>-->
              
          <!--      <div class="col-sm-9">-->
               
          <!--        <div class="box-body">-->
                    
          <!--        </div>-->
          <!--      </div>-->
          <!--    </div>-->
          <!--  </div>-->

            <div class="box box-primary" style="padding: 1.5em .5em .5em; border-radius: 0.5em;
              box-shadow: 0 5px 10px rgba(0,0,0,.2);">
              <div class="col-sm-6">
                <center><label class="box-title white" style="color: green;">INFORMASI TERBARU</label></center>

              
              <div class="box-body">
                <ul class="products-list product-list-in-box">
                  @foreach ($data as $item)
                  <li class="item" style="padding: 1.5em .5em .5em; border-radius: 0.5em;
              box-shadow: 0 5px 10px rgba(0,0,0,.2);border-color: blue;">
                    <div class="product-img">
                      <img src="{{ asset('public/public/lampiran_pengumuman/'.$item->lampiran)}}" alt="Product Image" class="img-circle">
                    </div>
                    <div class="product-info">
                      <a href="/detailPengumuman/{{$item->id_pengumuman}}" class="product-title text-red">{{$item->judul}}</a><br>
                      <!-- <span data-toggle="tooltip" title="" class="badge bg-primary" data-original-title=""><i class="fa fa-download"></i></span>
                      <a href="{{ asset('storage/lampiran_pengumuman/'.$item->lampiran)}}" target="_blank" class="text-gray-active"> Download</a></p> -->
                      <small class="text-blue"><i>Publisher {{$item->author}}</i></small> | 
                      <small>{{Carbon\Carbon::parse($item->tgl_pengumuman)->format("d-M-y H:i")}}</small>
                        </a>
                    </div>
                  </li><br>
                  @endforeach
                </ul>
                <div class="text-center">
                    {{$data->links()}}
                  </div>
                </div>
              </div>
              <div class="col-sm-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
                      </ol>
                        <div class="carousel-inner">
                          <div class="item active">
                            <img src="{{asset('public/public/foto_dashboard/IMG1.jpg')}}" alt="First slide" style="height: 350px; width: 500px;">

                            <div class="carousel-caption">
                              HEAD OFFICE JAKARTA
                            </div>
                          </div>
                          <div class="item">
                            <img src="{{asset('public/public/foto_dashboard/IMG2.jpg')}}" alt="Second slide" style="height: 350px; width: 500px;">

                            <div class="carousel-caption">
                              PT. SUMBER GRAHA SEJAHTERA <br> CABANG PURBALINGGA
                            </div>
                          </div>
                          <div class="item">
                            <img src="{{asset('public/public/foto_dashboard/IMG3.jpg')}}" alt="Third slide" style="height: 350px; width: 500px;">

                            <div class="carousel-caption">
                              JAPERNOSA WATER
                            </div>
                          </div>
                        </div>
                      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                      </a>
                    </div>
                  
              </div>
              <div class="box-footer text-center">
                
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