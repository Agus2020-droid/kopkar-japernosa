@extends ('layout.v_template')
@section('title','Dashboard')
<style>
    .highcharts-figure,
  .highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
  }

  #visitorChart {
    height: 400px;
  }

  .highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
  }

  .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
  }

  .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
  }

  .highcharts-data-table td,
  .highcharts-data-table th,
  .highcharts-data-table caption {
    padding: 0.5em;
  }

  .highcharts-data-table thead tr,
  .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
  }

  .highcharts-data-table tr:hover {
    background: #f1f7ff;
  }
</style>
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
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border bg-light-blue-active">
              <h3 class="box-title">LOGIN USER</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div> -->
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                  <!-- <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p> -->

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div id="chartUser" style="height: 50%; width: 100%;"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 text-center" >
                    <div class="box-header with-border bg-info">
                      <h3 class="box-title">Skala 4 bulan terakhir </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body ">
                      <table class="table table-bordered">
                      <thead >
                          <th class="text-center" style="width: 50%">Bulan</th>
                          <th class="text-center" style="width: 50%">Visitor</th>
                      </thead>  
                      <tbody class="text-center">
                      @foreach ($pengunjung as $kunjungan)
                        <tr style="height: 50%">
                          <td>{{$kunjungan->bulans}}</td>
                          <td>{{$kunjungan->user_count}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <!-- <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border bg-light-blue-active">
              <h3 class="box-title">PINJAMAN KREDIT </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <!-- <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div> -->
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <!-- <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p> -->

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div id="chartPinjaman" style="height: 40%; width: 100%;padding-right: 5%"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <!-- <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span> -->
                    <h5 class="description-header">Rp. {{format_uang($TtlPinjamanPengembangan)}}</h5>
                    <span class="description-text">TOTAL PINJAMAN PENGEMBANGAN</span>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6">
                  <div class="description-block border-right">
                    <!-- <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span> -->
                    <h5 class="description-header">Rp. {{format_uang($TtlPinjamanSosial)}}</h5>
                    <span class="description-text">TOTAL PINJAMAN SOSIAL</span>
                  </div>
                </div>
                <!-- <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-4">
          <div class="box box-default">
            <div class="box-header with-border bg-light-blue-active">
              <h3 class="box-title">USER & ANGGOTA</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <p class="text-center">
                    <strong></strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">User Aktivasi/Total user</span>
                    <span class="progress-number"><b>{{$user_reg}}</b>/{{$user}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: <?php
                      $hasil = round($user_reg/$user*100,2);
                      echo  "$hasil%"; 
                      ?>">
                    </div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Staff/Total Anggota</span>
                    <span class="progress-number"><b>{{$staf}}</b>/{{$pegawai}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width:                   
                      <?php
                      $hasil = round($staf/$pegawai*100,2);
                      echo  "$hasil%"; 
                      ?>">
                      </div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Tetap/Total Anggota</span>
                    <span class="progress-number"><b>{{$tetap}}</b>/{{$pegawai}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width:                   
                      <?php
                      $hasil = round($tetap/$pegawai*100,2);
                      echo  "$hasil%"; 
                      ?>">
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Kontrak/Total Anggota</span>
                    <span class="progress-number"><b>{{$kontrak}}</b>/{{$pegawai}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width:                   
                      <?php
                      $hasil = round($kontrak/$pegawai*100,2);
                      echo  "$hasil%"; 
                      ?>">
                    </div>
                  </div>
                  <!-- /.progress-group -->     
                  <div class="progress-group">
                    <span class="progress-text">Mitra/Total Anggota</span>
                    <span class="progress-number"><b>{{$mitra}}</b>/{{$pegawai}}</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-blue" style="width:                   
                      <?php
                      $hasil = round($mitra/$pegawai*100,2);
                      echo  "$hasil%"; 
                      ?>">
                    </div>
                    </div>
                  </div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="#">United States of America
                  <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                </li>
                <li><a href="#">China
                  <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
              </ul>
            </div> -->
            <!-- /.footer -->
          </div>
        </div>
        <!-- /.col -->
      </div>
</section>
    <!-- Charting library -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script type="text/javascript">
      var visitor = <?php echo json_encode($visitors)?>;
      var hari = <?php echo json_encode($hari)?>;
      var PinjamSosial = <?php echo json_encode($PinjamSosial)?>;
      var PinjamPengembangan = <?php echo json_encode($PinjamPengembangan)?>;
      var bulan = <?php echo json_encode($bulan)?>;

      Highcharts.chart('chartUser', {
  chart: {
    type: 'area'
  },
  title: {
    text: 'Tracking Login User Bulan ini'
  },
  // subtitle: {
  //   text: 'Source: WorldClimate.com'
  // },
  xAxis: {
    categories: hari
    // categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','13','15','16'],
     
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Login (kali)'
    }
  },
  // tooltip: {
  //   headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
  //   pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
  //     '<td style="padding:0"><b>{point.y:.1f} visit</b></td></tr>',
  //   footerFormat: '</table>',
  //   shared: true,
  //   useHTML: true
  // },
  plotOptions: {
    series: {
      allowPointSelect: true
    }
  },
  series: [{

    name: 'Login',
    data: visitor
  // }, {
  //   name: 'Berlin',
  //   data: [4, 8, 5, 4]

  }]
});

Highcharts.chart('chartPinjaman', {
  chart: {
    type: 'column'
  },
  title: {
    text: 'Grafik Pinjaman Anggota'
  },
  // subtitle: {
  //   text: 'Source: WorldClimate.com'
  // },
  xAxis: {
    // categories: bulan
    categories: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agst','Sept','Okt','Nov','Des'],
    // crosshair: true  
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Nominal (Rp)'
    }
  },
  // tooltip: {
  //   headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
  //   pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
  //     '<td style="padding:0"><b>{point.y:.1f} visit</b></td></tr>',
  //   footerFormat: '</table>',
  //   shared: true,
  //   useHTML: true
  // },
  plotOptions: {
    // column: {
    //   pointPadding: 0.2,
    //   borderWidth: 0
    // }
    series: {
      allowPointSelect: true
    }
  },
  series: [{
    name: 'Pengembangan',
    data: PinjamPengembangan
  }, {

    name: 'Pinjaman Sosial',
    data: PinjamSosial
  }]
});

    </script>
@endsection
