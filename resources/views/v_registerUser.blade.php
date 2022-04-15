@extends ('layout.v_template')
@section('title','Register')

@section('content')
<section class="content-header">
      <h1>REGISTER USER
      <small>Form</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/users">User</a></li>
        <li class="active">Register</a></li>
      </ol>
    </section>
<!-- /.pembatas -->

<section class="content">
        @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<div class="box-primary">
  <div class="box-header bg-blue-active color-palette">
      <div class="pull-left">
      <h5><strong>FORM REGISTER USER </strong></h5>
      </div>
    </div>

  <div class="register-box-body">
    <p class="login-box-msg"></p>

    <form  action="{{ route('simpanregistrasi') }}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <div class="form-group has-feedback">
        <select id="sel_nikKtp" name="nik_ktp" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" placeholder="Nomor Induk Kependudukan" id="nik"value="{{old('nik_ktp')}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <option value="">-Pilih NIK KTP-</option>
        @foreach($pegawai['data'] as $item)
        <option value="{{$item->nik_ktp}}">{{$item->nik_ktp}} - {{$item->nik_karyawan}} - {{$item->nama}}</option>
        @endforeach  
        </select> 
        @error('nik_ktp')
        <small class="text-danger">Kesalahan!!!</small>
        @enderror
      </div>
      <div class="form-group has-feedback">  
      <select id="sel_nama" name="name" type="text" class="form-control">
      <option value="0">-Select Name-</option>
      </select>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('name')
        <small class="text-danger">Kesalahan!!!</small>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <select id="sel_nikKaryawan" name="nik_karyawan" type="text" class="form-control">
          <option value="0">-Pilih-</option>
        </select>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('nik_karyawan')
        <small class="text-danger">Kesalahan!!!</small>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input name="telp" type="text" class="form-control" placeholder="Nomor Telepon">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @error('telp')
        <small class="text-danger">Kesalahan!!!</small>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @error('email')
        <small class="text-danger">Kesalahan!!!</small>
        @enderror
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         @error('password')
        <small class="text-danger">Kesalahan!!!</small>
        @enderror
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
        <a href="/users" type="button" class="btn btn-default btn-md">KEMBALI</a>
          <button type="submit" class="btn btn-primary btn-lg-flat">REGISTER</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){

  // Department Change
  $('#sel_nikKtp').change(function(){

      // Department id
      var nik_ktp = $(this).val();

      // Empty the dropdown
      $('#sel_nama').find('option').not(':first').remove();
      $('#sel_nikKaryawan').find('option1').not(':first').remove();

      // AJAX request 
      $.ajax({
        url: 'registrasi/'+nik_ktp,
        type: 'get',
        dataType: 'json',
        success: function(response){

          var len = 0;
          if(response['data'] != null){
            len = response['data'].length;
          }

          if(len > 0){
            // Read data and create <option >
            for(var i=0; i<len; i++){

                var id = response['data'][i].nik_ktp;
                var name = response['data'][i].nama;
                var nikKaryawan = response['data'][i].nik_karyawan;

                var option = "<option value='"+name+"'>"+name+"</option>";
                var option1 = "<option value='"+nikKaryawan+"'>"+nikKaryawan+"</option>";

                $("#sel_nama").append(option);
                $("#sel_nikKaryawan").append(option1); 
            }
          }

        }
      });
  });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
            <script>
            swal("Selamat","{!! session::get('success') !!}","success",{
              button:"OK",
            })
            </script>
            @endif
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
     
</section>
@endsection