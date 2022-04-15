@extends ('layout.v_template')
@section('title','Edit Angsuran')

@section('content')
<section class="content-header">
      <h1>EDIT ANGSURAN
      <small>Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/angsuran">Angsuran</a></li>
        <li class="active">Edit Angsuran</a></li>
      </ol>
    </section>

<session class="content">
@foreach ($angsuran as $data)
<form class="form-horizontal" action="/angsuran/update/{{$data->id_angsuran}}" method="post" enctype="multipart/form-data">
   @csrf
      
        <div class="col-md-12">
          <div class="box">
          <div class="box-header with-border bg-navy color-palette">
          <h3 class="box-title">FORM EDIT ANGSURAN</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

  <div class="box-body" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
    <div class="box-header">
        <div class="col-md-3">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive rounded-circle" src="{{ asset('public/public/foto_pegawai/'.$data->foto_pegawai) }}" alt="User profile picture">
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
                  <label  for="inputName" class="col-sm-3 control-label">Kode Angsuran</label>

                  <div class="col-sm-9">
                    <input name="id_angsuran" type="text" class="form-control"  value="{{$data->id_angsuran}}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputName" class="col-sm-3 control-label">Tanggal Angsuran</label>

                  <div class="col-sm-9">
                    <input name="tgl_angsuran" type="text" class="form-control"  value="{{tanggal_local($data->tgl_angsuran)}}" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Kode Pinjaman</label>

                  <div class="col-sm-9">
                    <input name="no_pinjaman" type="text"   class="form-control"  value="{{$data->no_pinjaman}}"> 
                    @error('no_pinjaman')
                      <small class="text-danger">{{$message}}</small>
                      @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Jumlah Angsuran</label>

                  <div class="col-sm-9">
                    <input name="jumlah_angsuran" type="text"  onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control"  value="{{$data->jumlah_angsuran}}">
                    @error('jumlah_angsuran')
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




@endsection