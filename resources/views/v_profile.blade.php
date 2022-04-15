@extends ('layout.v_template')
@section('title','Profile Anggota Koperasi')

@section('content')
<section class="content-header">
@foreach ($pegawai as $key=> $item)
      <h1>DASHBOARD SAYA</h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</a></li>
      </ol>
</section>

<div class="">
    <div class="main-body">
          <div class="box-body box-profile" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);"">
                <!-- /.box-header -->
              
                <div class="col-md-6">
                  <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">
                      <h3 class="widget-user-username text-left">{{$item->nama}}</h3>
                      <h5 class="widget-user-desc text-left">NIK. {{$item->nik_karyawan}}</h5>
                    </div>
                    <div class="widget-user-image">
                    <img  src="{{ asset('public/public/foto_pegawai/'.$item->foto_pegawai) }}" class="img-circle" alt="User Image">
                    </div><br>
                    <div class="box-footer">
                      <div class="row">
                        <!-- <div class="col-sm-4 border-right">
                          <div class="description-block">
                          <span class="description-text">ID NUMBER</span>
                            <h5 class="description-header">{{$item->nik_ktp}}</h5>
                          </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-sm-12 border-right">
                          <div class="description-block">
                          <span class="description-text">KEANGGOTAAN</span>
                            <h5 class="description-header"><?php
                            if($item->status == "AKTIF")
                            echo '<span class="label label-success">';
                            else 
                            echo '<span class="label label-danger">';
                            ?>
                          {{$item->status}}</span></h5><br>
                          <!--<a href="#" class="btn tn-sm btn-primary" aria-label="Show Member Card" data-toggle="modal" data-target="#member-card">MEMBER CARD</a> -->

                          </div>
                          <!-- /.description-block -->
                          <!-- <a href="#" type="button" class="btn btn-block btn-primary btn-lg">MEMBER CARD</a> -->
  

                        </div>
                        <!-- /.col -->
                        <!-- <div class="col-sm-4">
                          <div class="description-block">
                          <span class="description-text">STATUS KARYAWAN</span>
                            <h5 class="description-header">{{$item->jabatan}}</h5>

                          </div>
                       
                        </div> -->
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>

              
                <div class="box">
                    <div class="box-header" style="border-width: 3px;box-shadow: 0 5px 10px rgba(0,0,0,.2);">
            
                          <strong><i class="fa fa-book margin-r-5"></i> NO. KTP</strong>
                          <p class="pull-right">
                          {{ $item->nik_ktp}}
                          </p> <hr>
                            <strong><i class="fa fa-hourglass-end "></i> Usia</strong>
                          <p class="pull-right">
                          <?php
                            // tanggal lahir
                            $tanggal = new DateTime($item->tgl_lahir);
        
                            // tanggal hari ini
                            $today = new DateTime('today');
        
                            // tahun
                            $y = $today->diff($tanggal)->y;
        
                            // bulan
                            $m = $today->diff($tanggal)->m;
        
                            // hari
                            $d = $today->diff($tanggal)->d;
                            echo  $y . " tahun " . $m . " bulan " . $d . " hari";
                            ?>
                          </p><hr>
                            <strong><i class="fa fa-info-circle"></i> Status Karyawan</strong>
            
                              <p class="pull-right">
                              {{ $item->jabatan}}
                              </p>
            
                              <hr>
            
            
                              <strong><i class="fa fa-calendar-plus-o"></i> Tempat Lahir</strong>
            
                              <p class="pull-right">{{ $item->tempat_lahir}}</p>
            
                              <hr>
            
                              <strong><i class="fa fa-calendar-o"></i> Tanggal Lahir</strong>
            
                              <p class="pull-right">{{Carbon\Carbon::parse($item->tgl_lahir)->format(" d M Y")}}</p>
            
                              <hr>
            
                              <strong><i class="fa fa-phone-square"></i> Handphone</strong>
            
                              <p class="pull-right">{{ auth()->user()->telp }}</p>
            
                              <hr>
            
                              <strong><i class="fa fa-envelope"></i> Email</strong>
            
                              <p class="pull-right">{{ auth()->user()->email }}</p>
            
                              <hr>
            
                              <strong><i class="fa fa-bank"></i> Alamat Lengkap</strong>
            
                              <p class="pull-right">{{$item->alamat}}</p>
                                </div>
                  
                  
                  
                  </div>
                 
                  <!-- /.box-body -->
                </div>
              </div>
              

              <div class="col-md-6 bg-gray"><br>
              <div class="table-responsive">
                <div class="box-header card border-primary " style="background: url('{{asset('kartu.jpg')}}') left bottom;height: 320px;width: 500px;padding: 1.5em .5em .5em;border-radius: 2em;
                  box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                    <!-- <img class="card-img text-center" src="{{asset('kartu.jpg')}}" alt="Card image" height="350px"> -->                    
                      <div class="col-xs-9">
                        <h2 class="text-gray" style="font: italic small-caps bold 24px/30px Georgia, serif;">{{$item->nama}} <br>
                        <small class="text-gray">{{$item->nik_ktp}}</small></h2> 
                      </div >
                      <div class="col-xs-3">
                        <img src="{{ asset('public/public/foto_pegawai/'.$item->foto_pegawai) }}" class="img-circle" alt="User Image" style="height:80px; width: 80px;">
                      </div>
                      <div class="col-xs-12">
                      <hr style="border-top: 3px double #8c8b8b;">
                      </div>
                      <div class="col-xs-3">
                        <img class="img-user" src="data:image/png;base64,{{\DNS2D::getBarcodePNG($item->nama,'QRCODE')}}" alt="barcode" style="width: 80px; height: 80px;"/>
                      </div>
                      <div class="col-xs-9">
                        <small class="text-gray"><strong>Tempat/Tgl Lahir</strong> : <br> {{$item->tempat_lahir}}, {{Carbon\Carbon::parse($item->tgl_lahir)->format("d-M-Y")}}</small><br>
                        <small class="text-gray"><strong>Alamat Tempat Tinggal</strong> : <br> {{$item->alamat}}</small>
                      </div>
                       
                      <div class="col-xs-12"><br><br>
                        <!-- <img class="pull-right"src="data:image/png;base64,{{DNS1D::getBarcodePNG($item->nik_ktp, 'C39')}}" alt="barcode" width="200px" height="30px"/> -->
                        <p class="text-gray pull-right"><i>www.kopkar.japernosa.com</i></p>
                      </div>
                  </div>
                </div><br>
                <!-- <div class="box box-header"> -->
                  <div class="row">
                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                        <p>SALDO TABUNGAN</p>
                              <h3>Rp. {{format_uang(($jml_simpananpokok-$jml_ambilpokok)+($jml_simpananwajib-$jml_ambilwajib)+($jml_simpanansukarela-$jml_ambilsukarela))}}</h3>
                              <!-- <p>({{terbilang(($jml_simpananpokok-$jml_ambilpokok)+($jml_simpananwajib-$jml_ambilwajib)+($jml_simpanansukarela-$jml_ambilsukarela))}} rupiah)</p> -->
                            </div>
                            <div class="icon">
                              <i class="ion ion-document-text"></i>
                            </div>
                            <a href="#" class="small-box-footer">
                              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                            </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">SIMPANAN POKOK</span>
                          <span class="info-box-number">Rp. {{format_uang($jml_simpananpokok-$jml_ambilpokok)}}</span>

                          <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                          </div>
                          <span class="progress-description">
                          Tanggal :  {{tanggal_local(date(now()))}}
                          <!-- ({{terbilang($jml_simpananpokok-$jml_ambilpokok)}} rupiah) -->
                              </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                    </div>

                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">SIMPANAN WAJIB</span>
                          <span class="info-box-number">Rp. {{format_uang($jml_simpananwajib-$jml_ambilwajib)}}</span>

                          <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                          </div>
                          <span class="progress-description">
                          Tanggal :  {{tanggal_local(date(now()))}}
                          <!-- ({{terbilang($jml_simpananpokok-$jml_ambilpokok)}} rupiah) -->
                              </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                    </div>

                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

                        <div class="info-box-content">
                          <span class="info-box-text">SIMPANAN SUKARELA</span>
                          <span class="info-box-number">Rp. {{format_uang($jml_simpanansukarela-$jml_ambilsukarela)}}</span>

                          <div class="progress">
                            <div class="progress-bar" style="width: 100%"></div>
                          </div>
                          <span class="progress-description">
                          Tanggal :  {{tanggal_local(date(now()))}}
                          <!-- ({{terbilang($jml_simpananpokok-$jml_ambilpokok)}} rupiah) -->
                              </span>
                        </div>
                        <!-- /.info-box-content -->
                      </div>
                    </div>

                    
                    <!-- ./col -->
                  </div>

                  <div class="row">
                  <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                        <p>SISA HUTANG PINJAMAN</p>
                              <h3>Rp. {{format_uang($total_kredit-$jml_angsuran)}}</h3>
                              <!-- <p>({{terbilang($total_kredit-$jml_angsuran)}} rupiah)</p> -->
                            </div>
                            <div class="icon">
                              <i class="ion ion-document-text"></i>
                            </div>
                            <a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}" class="small-box-footer">
                              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                            </a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-teal">
                            <div class="inner">
                            <p><h4 class="text-center"><strong>PINJAMAN KREDIT</strong></h4></p>
                            </div>
                          
                            <a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}" class="small-box-footer">
                            Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                    </div>
                    <!-- ./col -->
                  </div>

                  <div class="row">

                    <!-- ./col -->
                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-primary">
                            <div class="inner">
                            <p><h4 class="text-center"><strong>ANGSURAN KREDIT</strong></h4></p>
                            </div>
                            
                            <a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}" class="small-box-footer">
                            Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                          </a>
                          </div>
                    </div>
                    <!-- ./col -->
                  </div>

                  <div class="row">

                    <!-- ./col -->
                    <div class="col-lg-12 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-purple">
                      <div class="inner">
                            <p><h4 class="text-center"><strong>PEMOTONGAN GAJI</strong></h4></p>
                            </div>
                          
                            <a href="/potonggajiSaya/{{ Auth::user()->nik_ktp }}" class="small-box-footer">
                              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </div>
                    </div>
                    <!-- ./col -->
                  </div>
                <!-- </div> -->

              </div>



          </div>

          <div class="modal modal-default fade" id="member-card" style="display: none;">
              <div class="modal-dialog">

  @endforeach
</div>
<!-- <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css"> -->
@endsection