<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kopkar Japernosa | @yield('title')</title>
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
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('template/')}}bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Pagination -->
  <link rel="stylesheet" href="{{asset('template/')}}bower_components/bootstrap/less/pagination.less">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/')}}/dist/css/AdminLTE.min.css">
  <!-- Hint style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hint.css/2.5.0/hint.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/summernote/summernote-bs4.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/jvectormap/jquery-jvectormap.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('template/')}}/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- J-Query -->
  <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
  <style type="text/css">
.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background-color: #fff;
}
.preloader .loading {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  font: 14px arial;
}
</style>  

</head>
<body class="hold-transition skin-blue fixed sidebar-mini" >
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>PNS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>KOPKAR </b>Japernosa</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <li class="dropdown messages-menu" >
            <a href="#" class="dropdown-toggle" >
                  <i><span>{{Carbon\Carbon::parse(date(now()))->isoformat("dddd, D MMM Y")}}</span> <i class="glyphicon glyphicon-minus"> </i> <span id="jam"></span> : 
                  <span id="menit"></span> :
                  <span id="detik"></span></i>
            </a>

          </li>
          <li class="dropdown messages-menu ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="label 
              <?php
              if(count(auth()->user()->unreadNotifications) == 0)
              echo 'label-success';
              else
              echo 'label-danger';
              ?>">{{count(auth()->user()->unreadNotifications)}}</span>
            </a>
            @if(Auth::user())
            <ul class="dropdown-menu ">
              <li class="header bg-blue">Anda memiliki {{count(auth()->user()->unreadNotifications)}} pesan yang belum dibaca</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                @forelse(auth()->user()->unreadNotifications as $notification)
                  <li><!-- start message -->
                    <a href="{{ route('markRead') }}">
                      <div class="pull-left">
                        <img src="{{asset('public/public/foto_user/'.strip_tags($notification->data['request']['foto_user']))}}" class="img-circle" alt="User Image">
                      </div>
                      <h4 class="text-blue"><strong>
                      {{strip_tags($notification->data['request']['name'])}}</strong> 
                      </h4>
                      <p><i>{{strip_tags($notification->data['request']['notifikasi'])}}</i><br><i class="fa fa-clock-o"></i>&nbsp{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</p>
                    </a>
                  </li>
                  <!-- end message -->
                  @empty
                @endforelse
                </ul>
              </li>
              @endif
              <li class="footer"><a href="{{ route('markRead') }}">Mark all as read</a></li>
            </ul>
          </li>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('public/public/foto_user/'.Auth::user()->foto_user)}}" class="user-image" alt="User Image">
              <span class="hidden-xs"><span id="greating"></span>
                <script>
                const time = new Date().getHours();
                let greeting;
                if (time < 10) {
                  greeting = "Selamat Pagi";
                } else if (time < 15) {
                  greeting = "Selamat Siang";
                } else if (time < 18) {
                  greeting = "Selamat Sore"
                } else {
                  greeting = "Selamat Malam";
                }
                document.getElementById("greating").innerHTML = greeting;
                </script>
                , {{ Auth::user()->name }}
                </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('public/public/foto_user/'.Auth::user()->foto_user)}}" class="img-circle" alt="User Image">

                <p>
                {{ Auth::user()->name }}
                  <small>{{ Auth::user()->email }}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                  <button  class="btn btn-primary  btn-block" data-toggle="modal" data-target="#gantifoto"> <i class="fa fa-file-photo-o"></i>    Ubah Foto </button>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
              <div class="pull-left">
              <a href="/users/ubahPassword/{{Auth::user()->id}}" class="btn btn-default btn-block"> <i class="fa fa-key"></i>     Ubah Password</a>
                
                </div>
                <div class="pull-right">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fa fa-sign-out"></i>   Sign out</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- =============================================== -->
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('public/public/foto_user/'.Auth::user()->foto_user)}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i>Online
          </a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      @include('layout/v_nav') 
   
    </section>
    
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
     @yield('content')
    <div class="box-header">
      <a id="back-to-top" href="https://api.whatsapp.com/send?phone=6285876344438" class="pull-right" role="button" aria-label="fixed">
        <img src="{{asset('wa-icon.png')}}" class="profile-user-img img-responsive img-circle bg-green" style="height: 50px; width:auto;">Bantuan ?
      </a>
    </div> 

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     <b>Version</b> 1.0.21
    </div>
    <strong>Copyright &copy; ANG-2022 <a href="">Koperasi Karyawan Jaya Persada Ekonomi Sejahtera</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;height: 300px;">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
    </ul>
    <div class="tab-content">
        <div id="control-sidebar-theme-demo-options-tab" class="tab-pane active"><div>
          <a href="#"><p class="control-sidebar-heading"></p></a>
          <div class="form-group text-center">
              <label class="control-sidebar-subheading">
                <p data-layout="fixed" ><i class="fa fa-calendar"></i> Tanggal </label></p>
                
                  <h3 class="text-aqua">{{Carbon\Carbon::parse(date(now()))->translatedFormat("l")}}</h3>                
                  <h4>{{Carbon\Carbon::parse(date(now()))->translatedFormat("d M Y")}}</h4>                
            </div>
        
    </div>
  </aside>


          <!-- /.modal-import-->
          <div class="modal modal-primary fade" id="gantifoto" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Unggah Foto</h4>
                  </div>
                  <form action="/users/editPhoto" method="post" enctype="multipart/form-data">
                      <div class="modal-body">
                        {{csrf_field()}}
                          <div class="form-group">
                            <input type="file" name="foto_user" required="required">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-outline">Ganti</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.modal-import -->
  
            <!-- /.modal-import file-->
    <div class="modal modal-info fade" id="modal-shu" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span></button>
            <h4 class="modal-title"><i class="fa fa-info"></i> NFO SHU:</h4>
          </div>
              <div class="modal-body">
                <h4 class="text-justify">Maaf, data Sisa Hasil Usaha (SHU) anda hanya bisa di akses setelah diselenggarakan Rapat Anggota Tahunan (RAT) Koperasi.</h4><br><br>                
                Terima kasih,<br>
                Admin
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
              </div>
        </div>
      </div>
    </div>
  <!-- /.modal-import-->


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('template/')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template/')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="{{asset('template/')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="{{asset('template/')}}/plugins/input-mask/jquery.inputmask.js"></script>
<script src="{{asset('template/')}}/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="{{asset('template/')}}/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="{{asset('template/')}}/bower_components/moment/min/moment.min.js"></script>
<script src="{{asset('template/')}}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('template/')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="{{asset('template/')}}/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="{{asset('template/')}}/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="{{asset('template/')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('template/')}}/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="{{asset('template/')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('template/')}}/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="{{asset('template/')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('template/')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('template/')}}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
<script src="{{asset('template/')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{asset('template/')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- ChartJS -->
<script src="{{asset('template/')}}/bower_components/chart.js/Chart.js"></script>
<!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
<script>
  $(function () {
    $('#example1').DataTable()
   
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  
    })
</script>

<script>
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'yyyy/mm/dd' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
//Date picker
$('#datepicker').datepicker({
      format: 'yyyy/mm/dd',
      autoclose: true
    })
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
	window.setTimeout("waktu()", 1000);
 
	function waktu() {
		var waktu = new Date();
		setTimeout("waktu()", 1000);
		document.getElementById("jam").innerHTML = waktu.getHours();
		document.getElementById("menit").innerHTML = waktu.getMinutes();
		document.getElementById("detik").innerHTML = waktu.getSeconds();
	}
</script>
@yield('footer')
<script>
$(document).ready(function(){
$(".preloader").fadeOut();
})
</script>
<!-- Summernote -->
<script src="{{asset('template/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })

  $(function () {
    // Summernote
    $('#summernote2').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>