@extends ('layout.v_template')
@section('title','Dashboard')

@section('content')
<section class="content-header">
      <h1>DASHBOARD
      <small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</a></li>
      </ol>
    </section>
<section class="content">



<div class="row">
        <div class="col-md-6">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">MEMBERS</span>
              <span class="info-box-number">{{$pegawai}}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
            <span class="label label-success">{{$staf}} STAF</span>
            <span class="label label-primary">{{$tetap}} Tetap</span>
            <span class="label label-danger">{{$kontrak}} Kontrak</span>
            <span class="label label-default">{{$mitra}} Mitra</span>
            </div>
            <!-- /.info-box-content -->
          </div>
         </div>
          
         <div class="col-md-6">
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">USERS ACCOUNT</span>
              <span class="info-box-number">{{$user}}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    {{$user_reg}} of {{$user}} Users
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>

        </div>
        
        <!-- ./col -->
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <p>TOTAL SIMPANAN</p>
            <h3>Rp. {{format_uang($simpanan)}}<sup style="font-size: 15px"></sup></h3>
            <p>({{terbilang($simpanan)}} rupiah)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="/simpanan" class="small-box-footer">
                  Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-12 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <p>TOTAL PINJAMAN</p>
            <h3>Rp. {{format_uang($pinjaman)}}<sup style="font-size: 15px"></sup></h3>
            <p>({{terbilang($pinjaman)}} rupiah)</p>
                </div>
                <div class="icon">
                  <i class="ion ion-document-text"></i>
                </div>
                <a href="/pinjam" class="small-box-footer">
                  Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.Grafik -->
            <div class="col-12">
              <!-- USERS LIST -->
              <div class="box box-info">
                <div class="box-header with-border bg-blue">
                  <h3 class="box-title">List User</h3>

                  <div class="box-tools pull-right">


                    <span class="label label-danger">{{$user}} Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach ($pengguna as $data)
                    <li>
                      <tr width="50%" height="50%">
                      <img src="{{ asset('public/public/foto_user/'.$data->foto_user) }}" class="img-circle" alt="User profile picture" style="height: 80px; width: 80px;">
                      <a class="users-list-name" href="#">{{$data->name}}</a>
                      <span class="users-list-date">{{$data->nik_karyawan}}</span>
                      </tr>
                      
                    </li>
                   @endforeach
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="/users" class="btn btn-sm btn-default">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->

</section>    
@endsection

@section('footer')

@stop