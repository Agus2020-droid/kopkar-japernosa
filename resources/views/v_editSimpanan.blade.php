@extends ('layout.v_template')
@section('title','Edit Simpanan')

@section('content')
<section class="content-header">
      <h1>EDIT SIMPANAN
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/simpanan">Simpanan</a></li>
        <li class="active">Edit Simpanan</a></li>
      </ol>
    </section>
<!-- /.pembatas -->
<session class="content">

@foreach ($simpanan as $key => $data)
<form class="form-horizontal" action="/simpanan/update/{{$data->id_simpanan}}" method="post" enctype="multipart/form-data">
   @csrf
      
        <div class="col-md-12">
            @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          <div class="box box-primary">
          <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">FORM EDIT SIMPANAN</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

  <div class="box-body">
    <div class="box-header">
        <div class="col-md-3">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive rounded-circle" src="{{ url('public/public/foto_pegawai/'.$data->foto_pegawai) }}" alt="User profile picture">
              <h3 class="profile-username text-center">{{$data->nama}}</h3>
              <p class="text-muted text-center">{{$data->nik_ktp}}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>NIK Karyawan</b> <a class="pull-right">{{$data->nik_karyawan}}</a>
                </li>
                <li class="list-group-item">
                  <b>Jabatan</b> <a class="pull-right">{{$data->jabatan}}</a>
                </li>
                <li class="list-group-item">
                  <b>Tempat</b> <a class="pull-right">{{$data->tempat_lahir}}</a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Lahir</b> <a class="pull-right">{{Carbon\Carbon::parse($data->tgl_lahir)->format(" d M Y")}}</a>
                </li>
                <li class="list-group-item">
                  <b>Mobile</b> <a class="pull-right">{{$data->telp}}</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>

        <!-- /.col -->
          <div class="col-md-9">
                <div class="form-group">
                  <label  for="inputName" class="col-sm-3 control-label">No. Pinjaman</label>

                  <div class="col-sm-9">
                    <input name="no_pinjaman" type="text" class="form-control"  value="{{$data->id_simpanan}}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-3 control-label">Tanggal Simpanan</label>

                  <div class="col-sm-9">
                    <input name="tgl_potongan" type="text" id="datepicker" class="form-control"  value="{{Carbon\Carbon::parse($data->tgl_potongan)->format(" d M Y")}}">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Simpanan Pokok</label>

                  <div class="col-sm-9">
                    <input name="simpanan_pokok" type="text"  id="pokok" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control"  value="{{$data->simpanan_pokok}}"> 
                    @error('simpanan_pokok')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Simpanan Wajib</label>

                  <div class="col-sm-9">
                    <input name="simpanan_wajib" type="text" id="wajib" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control"  value="{{$data->simpanan_wajib}}">
                    @error('simpanan_wajib')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Simpanan Sukarela</label>

                  <div class="col-sm-9">
                    <input name="simpanan_sukarela" type="text" id="sukarela" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" value="{{$data->simpanan_sukarela}}">
                    @error('simpanan_sukarela')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Jumlah Simpanan</label>

                  <div class="col-sm-9">
                  <input name="jumlah_simpanan" type="text" class="form-control" id="hasil" value="{{$data->jumlah_simpanan}}" readonly>
                  @error('jumlah_simpanan')
                  <small class="text-danger">{{$message}}</small>
                        @enderror
                  </div>
                </div>
                @endforeach
                <div class="form-group">
                
                      <div class="col-sm-offset-3 col-sm-10">
                          <button type="submit" class="btn btn-primary">SIMPAN</button>
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(".form-horizontal").keyup(function() {
      //var rupiah = parseInt($("#rupiah").val())
      var pok = parseInt($("#pokok").val())
      var waj = parseInt($("#wajib").val())
      var suk = parseInt($("#sukarela").val())

      var total = pok + waj + suk;
      $("#hasil").attr("value",total)
      

    }); 
</script>
@endsection