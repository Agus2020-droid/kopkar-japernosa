<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kopkar Japernosa | Log in</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('template/')}}/plugins/iCheck/square/blue.css">
 
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition login-page">
  
<div class="login-box">
  <div class="login-logo">
  <img src="{{asset('logo.png')}}" weight="150px" height="150px">
  <h3 class="text-blue"><b>KOPERASI KARYAWAN </h3>
  <h5><b>JAYA PERSADA EKONOMI SEJAHTERA</h5>
  <h5>PT. SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA</h5>
  </div>
  <!-- /.login-logo -->
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
  <div class="login-box-body">
    <!-- <p class="login-box-msg">Masukan Nomor Handphone dan Password</p> -->

    <form method="POST" action="{{ route('login') }}">
    {{csrf_field()}}
      <div class="form-group has-feedback">
        <input type="text" name="telp" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" placeholder="Phone number">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        
      </div>
      <div class="form-group has-feedback" id="show_hide_password">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
        <span style="display: block" class="glyphicon glyphicon-eye-open form-control-feedback"></span>
        
      </div>
      <div class="row">
        <div class="col-xs-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultCheck5">
                  Remember me
                </label>
            </div>
            <div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="small text-right">Forget password?</a></div>
            </a>
            @endif
        </div>
        </div>
        <!-- /.col --> 
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('template/')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('template/')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{asset('template/')}}/plugins/iCheck/icheck.min.js"></script>
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
</body>
</html>
