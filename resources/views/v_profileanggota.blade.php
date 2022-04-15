@extends ('layout.v_template')
@section('title','PROFILE ANGGOTA')

@section('content')
<section class="content-header">
      <h1>@yield('title')</h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggota">Anggota</a></li>
        <li><a href="#">Profile</a></li>
      </ol>
    </section>
<!-- /.pembatas -->
<section class="content">
      <div class="row">

            <div class="col-md-12">
                  <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">
                        @foreach ($pegawais as $pegawai) 
                      <h3 class="widget-user-username text-left">{{$pegawai->nama}}</h3>
                      <h5 class="widget-user-desc text-left">NIK. {{$pegawai->nik_karyawan}}</h5>
                    </div>
                    <div class="widget-user-image">
                    <img  src="{{ asset('public/public/foto_pegawai/'.$pegawai->foto_pegawai) }}" class="img-user" alt="User Image">
                    </div><br>
                    <div class="box-footer">
                      <div class="row">
                        <div class="col-sm-12 border-right">
                          <div class="description-block">
                          <span class="description-text">KEANGGOTAAN</span>
                            <h5 class="description-header"><?php
                            if($pegawai->status == "AKTIF")
                            echo '<span class="label label-success">';
                            else 
                            echo '<span class="label label-danger">';
                            ?>
                          {{$pegawai->status}}</span></h5>
                          </div>
                          <!-- /.description-block -->
                        </div>

                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <hr>

                <div class="box-header">
                  <div class="col-md-6">
                    <strong><i class="fa fa-book margin-r-5"></i> NO. KTP</strong>

                    <p class="pull-right">
                    {{ $pegawai->nik_ktp}}
                    </p>

                    <hr>
                    <strong><i class="fa fa-hourglass-end "></i> Usia </strong>

                    <p class="pull-right">
                    <?php
                      // tanggal lahir
                      $tanggal = new DateTime($pegawai->tgl_lahir);

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
                    </p>

                    <hr>
                    <strong><i class="fa fa-info-circle"></i> Status Karyawan</strong>

                    <p class="pull-right">
                    {{ $pegawai->jabatan}}
                    </p>

                    <hr>


                    <strong><i class="fa fa-calendar-plus-o"></i> Tempat Lahir</strong>

                    <p class="pull-right">{{ $pegawai->tempat_lahir}}</p>

                    <hr>
                  </div>

                <div class="col-md-6">
                  <strong><i class="fa fa-calendar-o"></i> Tanggal Lahir</strong>

                  <p class="pull-right">{{Carbon\Carbon::parse($pegawai->tgl_lahir)->format(" d M Y")}}</p>

                  <hr>

                  <strong><i class="fa fa-phone-square"></i> Handphone</strong>
                
                  <p class="pull-right">{{ $pegawai->telp}}</p>

                  <hr>

                  <strong><i class="fa fa-envelope"></i> Email</strong>
                  
                  <p class="pull-right">{{ $pegawai->email }}</p>
               
                  <hr>

                  <strong><i class="fa fa-bank"></i> Alamat Lengkap</strong>

                  <p class="pull-right">{{$pegawai->alamat}}</p>
                    @endforeach
                    <hr>
                  </div>
                </div>
                  <!-- /.box-body -->
                </div>
              </div>

            <!-- <div class="card mb-3">
              <div class="card-body">
              <div class="row">
                  
                </div><hr>
                <div class="row">
                  <div class="col-sm-4">
                    <h4 class="mb-0"><strong><i class="fa fa-user"></i> NIK Karyawan</strong></h4>
                  </div>
                  <div class="col-sm-8 text-secondary"> <h4>{{$pegawai->nik_karyawan}}</h4></div>
                </div><hr>
                <div class="row">
                  <div class="col-sm-4">
                    <h4 class="mb-0"><strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong></h4>
                  </div>
                  <div class="col-sm-8 text-secondary"> <h4>{{$pegawai->alamat}}</h4></div>
                </div><hr>
                <div class="row">
                <div class="col-sm-4">
                    <h4 class="mb-0"><strong><i class="fa fa-calendar"></i> Tempat/ Tgl Lahir</strong></h4>
                  </div>
                  <div class="col-sm-8 text-secondary"> <h4>{{$pegawai->tempat_lahir}} {{Carbon\Carbon::parse($pegawai->tgl_lahir)->format(" d M Y")}}</h4></div>
                </div><hr>
                <div class="row">
                <div class="col-sm-4">
                    <h4 class="mb-0"><strong><i class="fa fa-phone"></i> Nomor Telepon</strong></h4>
                  </div>
                  <div class="col-sm-8 text-secondary"> <h4>{{$pegawai->telepon}}</h4></div>
                </div><hr>
              </div>
            </div> -->
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
            <li class="active">
              <a href="#simpanan" data-toggle="tab" class="bg-green-active">SIMPANAN</a></li>
              <li><a href="#pinjaman" data-toggle="tab" class="bg-blue-active">PINJAMAN</a></li>
              <li><a href="#angsuran" data-toggle="tab" class="bg-yellow-active">ANGSURAN</a></li>
              <!--<li><a href="#potongangaji" data-toggle="tab" class="bg-red-active">POTONG GAJI</a></li>              -->
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="simpanan">

              <div class="row">

              <div class="col-md-12 col-sm-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <span class="info-box-text">Total Simpanan</span>
              <h4><strong>{{"Rp. ".format_uang($jml_simpananpokok-$jml_ambilpokok+$jml_simpananwajib-$jml_ambilwajib+$jml_simpanansukarela-$jml_ambilsukarela)}}</strong></h4>
              <span class="info-box-text">{{terbilang($jml_simpananpokok-$jml_ambilpokok+$jml_simpananwajib-$jml_ambilwajib+$jml_simpanansukarela-$jml_ambilsukarela)}} RUPIAH</span>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Saldo Simpanan Pokok</span>
              <span class="info-box-number">{{"Rp. ".format_uang($jml_simpananpokok-$jml_ambilpokok)}}</span>
              <p>{{terbilang($jml_simpananpokok-$jml_ambilpokok)}}  rupiah</p>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Saldo Simpanan Wajib</span>
              <span class="info-box-number">{{"Rp. ".format_uang($jml_simpananwajib-$jml_ambilwajib)}}</span>
              <p>{{terbilang($jml_simpananwajib-$jml_ambilwajib)}}  rupiah</p>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Saldo Simpanan Sukarela</span>
              <span class="info-box-number">{{"Rp. ".format_uang($jml_simpanansukarela-$jml_ambilsukarela)}}</span>
              <p>{{terbilang($jml_simpanansukarela-$jml_ambilsukarela)}} rupiah</p>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

                <div class="box-body table-responsive no-padding">
                  <div class="col-sm-6">
                <h4 class="box-title text-primary"><strong>SIMPANAN KOPERASI</strong></h4>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kode </th>
                        <th>tanggal Simpanan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @foreach ($simpanan as $item)
                        <td>S-{{$item->id_simpanan}}</td>
                        <td>{{Carbon\Carbon::parse($item->tgl_potongan)->isoFormat("D MMM Y")}}</td>
                        <td>@currency($item->jumlah_simpanan)</td>
                        <td><span class="label label-success">Diterima</span></td>  
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th></th>
                    <th>JUMLAH</th>
                    <th></th>
                    <th> </th>
                    </tr>
                    </tfoot>
                  </table>
                  </div>
                  <div class="col-sm-6">
                  <h4 class="box-title text-primary"><strong>PENGAMBILAN SIMPANAN</strong></h4>
                    <table id="" class="table table-bordered table-striped">
                      <thead>
                        <tr>

                          <th>Kode </th>
                          <th>tanggal </th>
                          <th>Jumlah </th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no=1; ?>
                      @foreach ($pengambilan as $item)
                        <tr>

                          <td>T-{{$item->id_pengambilan}}</td>
                          <td>{{Carbon\Carbon::parse($item->tgl_pengambilan)->format("Y-m-d")}}</td>

                          <td>@currency($item->jumlah_pengambilan)</td>
                          <td><span class="label
                            <?php
                          if($item->status_pengajuan == "WAITING APPROVAL")
                          echo 'label-warning';
                          elseif ($item->status_pengajuan == "APPROVED")
                          echo 'label-success';
                          else 
                          echo 'label-danger';
                          ?>">{{$item->status_pengajuan}}</span></td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                      <th></th>
                      <th>JUMLAH</th>
                      <th></th>
                      <th> </th>
                      </tr>
                      </tfoot>
                    </table>
                    </div>
                    <br>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="pinjaman">
              <div class="box-body table-responsive no-padding">
              <h4 class="box-title text-primary"><strong>HISTORY TRANSAKSI PINJAMAN</strong></h4>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>Plafon</th>
                  <th>Tgl Pengajuan</th>
                  <th>Status Pengajuan</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($pinjaman as $item)
                <tr>
                  <td>{{ $no++}}</td>
                  <td>P-{{$item->no_pinjaman}}</td>
                  <td>{{$item->nama_barang}}</td>
                  <td>{{"Rp. ".format_uang($item->plafon)}}</td>
                  <td>{{Carbon\Carbon::parse($item->tgl_pengajuan)->format("Y-m-d")}}</td>
                  <td><span class="label
                  <?php
                if($item->status_pengajuan == "WAITING VERIFIED")
                echo 'label-warning';
                elseif ($item->status_pengajuan == "VERIFIED")
                echo 'label-success';
                else 
                echo 'label-danger';
                ?>">{{$item->status_pengajuan}}</span></td>
             
                  <td>
                  <a  href="{{ url('pinjamanSaya/detail/'.$item->no_pinjaman) }}" class="btn btn-primary btn-sm hint--top 
                  <?php
                if($item->status_pengajuan == "WAITING APPROVAL")
                echo 'disabled';
                elseif ($item->status_pengajuan == "NOT APPROVED")
                echo 'disabled';
                else 
                echo '';
                ?>" aria-label=" Lihat Detail"><i class="fa fa-eye"></i>Detail</a></td>
                </tr>
                @endforeach
              </tbody>
              </table>
              </div> 
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="angsuran">
              <div class="box-body table-responsive no-padding">
              <h4 class="box-title text-primary"><strong>ANGSURAN KREDIT</strong></h4>
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr>
                  <th>Kode</th>
                  <th>Tanggal</th>
                  <th>Kode</th>
                  <th>Jumlah</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                @foreach ($angsuran as $item)
                  <td>A-{{$item->id_angsuran}}</td>
                  <td>{{Carbon\Carbon::parse($item->tgl_angsuran)->format("Y-m-d")}}</ttdh>
                  <td>P-{{$item->no_pinjaman}}</td>
                  <td>@currency($item->jumlah_angsuran)</td>
                  <td><span class="label label-success">Verified</span></td>
                </tr>
                @endforeach
              </tbody>
              </table>
              <div>
                  {{$angsuran->links()}}
              </div>
              
              </div> 
              </div>
              <!-- /.tab-pane -->

              <!--<div class="tab-pane" id="potongangaji">-->
              <!--  <div class="box-body table-responsive no-padding">-->
              <!--  <h4 class="box-title text-primary"><strong>POTONGAN GAJI</strong></h4>-->
              <!--      <table id="" class="table table-bordered table-striped">-->
              <!--        <thead>-->
              <!--          <tr>-->
              <!--          <th>Kode</th>-->
              <!--          <th>Tanggal</th>-->
              <!--          <th>Jumlah</th>-->
              <!--          <th>Status</th>-->
              <!--        </tr>-->
              <!--        </thead>-->
              <!--        <tbody>-->
              <!--        <?php $no=1; ?>-->
              <!--        @foreach ($potonggaji as $item)-->
              <!--        <tr>-->
                        
              <!--          <th>{{$item->kode_potongan}}</th>-->
              <!--          <th>{{Carbon\Carbon::parse($item->tgl_potongan)->format("Y-m-d")}}</th>-->
              <!--          <th>@currency($item->jumlah_potongan)</th>-->
              <!--          <th><span class="label label-success">Verfifikasi</span></th>-->
              <!--        </tr>-->
              <!--        @endforeach-->
              <!--      </tbody>-->
              <!--      </table>-->
              <!--    </div> -->
              <!--  </div>-->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

 
@endsection