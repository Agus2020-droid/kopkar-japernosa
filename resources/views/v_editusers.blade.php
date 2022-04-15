@extends ('layout.v_template')
@section('title','Edit Users')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<form action="/users/update/{{$users->id}}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
      <!-- /.form baru -->
      <div class="box box-default">
        <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">FORM EDIT USER</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="box-header">
          <div class="row">
            <div class="col-md-2">
            <img class="img-thumbnail" src="{{ asset('public/public/foto_user/'.$users->foto_user) }}" width="150px">
            </div>
            

            <div class="col-md-8">
            <div class="form-group">
                  <label >NIK</label>
                  <input name="nik_ktp" class="form-control" value="{{$users->nik_ktp}}" readonly>
                </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label >Username</label>
                  <input name="name" class="form-control"  value="{{$users->name}}" >
                  <div class="text-danger">
                        @error('name')
                        Kesalahan!!
                        @enderror
                    </div>
                </div>
              <!-- /.form-group -->
              <div class="form-group">
                  <label >email</label>
                  <input name="email" type="email" class="form-control" placeholder="Masukan alamat email" value="{{$users->email}}" >
                  <div class="text-danger">
                        @error('email')
                        Kesalahan!!
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                  <label >No. Handphone</label>
                  <input name="telp" type="text" class="form-control" placeholder="Masukan nomor telepon" value="{{$users->telp}}" >
                  <div class="text-danger">
                        @error('email')
                        {{error}}
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                  <label >Password</label>
                  <input name="password"  type="text" class="form-control" placeholder="Masukan nomor telepon" value="{{$users->password}}" >
                  <div class="text-danger">
                        @error('password')
                        {{error}}
                        @enderror
                    </div>
                </div>
            
                <div class="form-group">
                    <label>Level User</label>
                    <select name="level" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" value="{{$users->level}}">
                        <option value="{{$users->level}}"><?php
                        if($users->level == 1)
                        echo 'Host';
                        else if ($users->level == 2)
                        echo 'Admin';
                        else if ($users->level == 4)
                        echo 'HRBP';
                        else if ($users->level == 5)
                        echo 'Ketua';
                        else if ($users->level == 6)
                        echo 'Bendahara';
                        else if ($users->level == 7)
                        echo 'Pengurus';
                        else 
                        echo 'Anggota';
                        ?> (current)</option>
                        <!-- <option value="1">Host</option> -->
                        <option value="2">ADMIN</option>
                        <option value="3">ANGGOTA</option>
                        <option value="4">HRBP</option>
                        <option value="5">KETUA</option>
                        <option value="6">BENDAHARA</option>
                        <option value="7">PENGURUS</option>
                    </select>
                </div>
 
                <div class="form-group">
                  <div class="box-footer pull-left">
                  <button type="submit" class="btn btn-primary">UPDATE</button>
                  </div>
                </div>  
                
            </div>
            <!-- /.col -->
            <div class="col-md-5">
              <!-- /.form-group -->

              </div>
            <!-- /.col -->
            </div>
          <!-- /.row -->
          </div>
          
        </div>
        <!-- /.box-body -->
      </div>       
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif

@endsection