
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/ico" href="http://www.kopkar.japernosa.com/favicon.ico"  />
  <title>KOPKAR JAPERNOSA | Login</title>
  
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
   <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template/')}}/bower_components/font-awesome/css/font-awesome.min.css">
 <!-- Ionicons -->
 <link rel="stylesheet" href="{{asset('template/')}}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template/')}}/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: url('background.png') top;center">
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0 ">
    <div class="container" >
     <marquee><strong><h4 class="text-primary">BERKARYA BERSAMA UNTUK MEMAJUKAN KESEJAHTERAAN ANGGOTA</h4></strong></marquee>
      <div class="box-header card login-card " style="border-width: 3px; padding: 1.5em .5em .5em;border-radius: 2em" >
      <div class="col-sm-5">
        <div class="box-header no-border">
         
              <center><img src="{{asset('logo.png')}}" alt="logo" class="bg-default img-responsive img-circle" style="height: 255px; width:255px;">
              <h3 class="text-primary"><b>KOPERASI KARYAWAN </h3>
              <h5 class="text-orange"><b>JAYA PERSADA EKONOMI SEJAHTERA</h5>
              <p style="font-size: 12px">PT. SUMBER GRAHA SEJAHTERA - CABANG PURBALINGGA</p></center>
          
        </div>
      </div>
      <div class="col-sm-7">
        <div >
          <div class="card-body">
          <h2 class="login-card-title">Login</h2>
          <h6 class="login-card-description">Masukan user dan password Anda untuk melanjutkan.</h6>
          <form method="POST" action="{{ route('login') }}">
          {{csrf_field()}}
            <div class="form-group">
              <label for="email" class="sr-only">Phone Number</label>
              <input type="number" name="telp" id="telp" class="form-control @error('telp') is-invalid @enderror" onkeypress="return event.charCode >= 48 && event.charCode <=57" placeholder="Nomor Whatsapp" style="border-radius: 2em;">
              @error('telp')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group" id="show_hide_password">
              <label for="password" class="sr-only">Password</label>
              <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" style="border-radius: 2em;">
              @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror            
            </div>
            <div class="row">
            <div class="col-6">
                {!! NoCaptcha::display() !!}
                {!! NoCaptcha::renderJs() !!}
                @error('g-recaptcha-response')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div><br>
            <div class="form-prompt-wrapper">
              <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="defaultCheck5"><h6>Ingatkan saya</h6></label>
              </div>
              @if (Route::has('password.request'))              
              <a href="{{ route('password.request') }}" class="text-reset-blue pull-right"><h6>Lupa password?</h6></a>
              @endif
            </div>
            <!-- <input name="login" id="login" class="btn btn-block btn-primary login-btn mb-4" type="submit" value="Login"> -->
            <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 2em;">LOGIN</button>
          </form>
          <!--<h6 class="login-card-footer-text">Don't have an account? <a href="https://api.whatsapp.com/send?phone=6285876344438" target="_blank" class="text-reset-blue">Call Center Admin</a></h6>-->
          <h6 class="login-card-footer-text">Belum punya akun ? <a href="https://forms.gle/fsWPWzyyGu72miMK7" target="_blank" class="text-reset-blue">Register Akun</a></h6>
          <i class="fa fa-chevron-left"></i> <a href="/welcome" class="text-reset-blue">Kembali</a>

        </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-sm-12 text-center">
        <LABEL><u>Alamat Kantor :</u></LABEL><br>
        <LABEL class="text-default">Jalan Raya Bajong Km.07 Desa Bajong Kec. Bukateja Kab. Purbalingga</LABEL><br>
        <label class="text-default">JAWA TENGAH - INDONESIA 53382</label>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="{{asset('template/')}}/plugins/iCheck/icheck.min.js"></script>
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
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#show_hide_password").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password span').addClass( "glyphicon-eye-close" );
            $('#show_hide_password span').removeClass( "glyphicon-eye-open" );
        
        
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password span').addClass( "glyphicon-eye-open" );
            $('#show_hide_password span').removeClass( "glyphicon-eye-close" );
            
        }
    });
    });
</script>
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
</body>
</html>
