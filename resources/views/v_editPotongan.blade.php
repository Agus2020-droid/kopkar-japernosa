@extends ('layout.v_template')
@section('title','Edit Potongan Gaji')

@section('content')
<section class="content-header">
      <h1>EDIT POTONGAN GAJI
      <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/potongan">Potongan Gaji</a></li>
        <li class="active">Edit Potongan Gaji</a></li>
      </ol>
    </section>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
<session class="content">
@foreach ($potongan as $data)
<form class="form-horizontal" action="/potongan/update/{{$data->id_potongan}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
      
        <div class="col-md-12">
          <div class="box">
          <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">FORM EDIT POTONGAN GAJI</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

  <div class="box-body">
    <div class="box-header">
        <div class="col-md-3 text-center">
            <div class="box-body box-profile">
              <img class="img-thumbnail" src="{{ asset('storage/foto_pegawai/'.$data->foto_pegawai) }}" alt="User profile picture">
              <h3 class="profile-username text-center">{{$data->nama}}</h3>
              <p class="text-muted text-center">{{$data->status}}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>NIK Karyawan</b> <a class="pull-right">{{$data->nik_karyawan}}</a>
                </li>
                <li class="list-group-item">
                  <b>Jabatan</b> <a class="pull-right">{{$data->jabatan}}</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        <!-- /.col -->
          <div class="col-md-9">
                <div class="form-group">
                  <label  for="inputName" class="col-sm-3 control-label">Kode Potongan</label>

                  <div class="col-sm-9">
                    <input name="kode_potongan" type="text" class="form-control"  value="{{$data->kode_potongan}}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-3 control-label">Tanggal Potongan</label>

                  <div class="col-sm-9">
                    <input name="tgl_potongan" type="text" class="form-control pull-right" id="datepicker" value="{{Carbon\Carbon::parse($data->tgl_potongan)->format(" d M Y")}}" disabled>
                  </div>
                </div>
               
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Jumlah Potongan</label>

                  <div class="col-sm-9">
                    <input name="jumlah_potongan" type="text"  onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control"  value="{{$data->jumlah_potongan}}">
                 
                  </div>
                </div>

                @endforeach
                <div class="form-group">
                
                      <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-primary">UPDATE</button>
                      </div>
              
                </div>
              </form>
            </div>
        </div>
    </div>
    <!-- /.col -->
  </div>
      <!-- /.row -->
</form>
</session>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@endsection