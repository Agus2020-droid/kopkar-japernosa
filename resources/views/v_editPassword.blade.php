@extends ('layout.v_template')
@section('title','Ubah Password')

@section('content')
<section class="content-header">
      <h1>UBAH PASSWORD
      <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Ubah Password</a></li>
      </ol>
    </section>

<session class="content">
<div class="row">
    <div class="col-md-12">
      @if (session('success'))
      <div class="alert alert-success" role="alert">
      {{session('success')}}
      </div>
      @endif
      @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif       
            <div class="box-header bg-blue-active color-palette">
            <div class="pull-left">
                <h5><strong>UBAH PASSWORD LOGIN </strong></h5>
                </div>
            </div>
            <div class="box box-header">
            <div class="col-md-2"><br>
            </div>
            <div class="col-md-10"><br>
                <form action="/users/ubahPassword/{{Auth::user()->id}}" class="form-horizontal" method="post" >
                    @csrf
                    @method("PATCH")
                    <div class="form-group" id="show_hide_password1">
                        <label for="old_password"class="col-sm-2 control-label">Current Password</label>

                        <div class="col-sm-5 " >
                    <input type="text" name="old_password" class="form-control" placeholder="Password lama">

                        </div>
                    </div>
        

                    <div class="form-group">
                        <label for="password"class="col-sm-2 control-label">New Password</label>
                        
                        <div class="col-sm-5">
                        <input type="password" class="form-control" id="password" name="password" placeholder="masukan password baru">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"class="col-sm-2 control-label">Confirm Password</label>

                        <div class="col-sm-5">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukan lagi password baru">
                        @error('password_confirmation')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-8">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>

                    
                </form>
            </div>

          
        </div>
    </div>
</div>
</session>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@if (Session::has('danger'))
  <script>
  swal("Failed!","{!! session::get('danger') !!}","danger",{
    button:"OK",
  })
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
@endif
@endsection