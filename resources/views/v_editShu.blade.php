@extends ('layout.v_template')
@section('title','Edit SHU')

@section('content')
<section class="content-header">
      <h1>EDIT SHU ANGGOTA
      <small>Form</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/shu">Sisa Hasil Usaha</a></li>
        <li class="active">Edit SHU</a></li>
      </ol>
    </section>
<!-- /.pembatas -->
<session class="content">
@foreach ($shu as $key => $data)
<form class="form-horizontal" action="/shu/update/{{$data->id_shu}}" method="post" enctype="multipart/form-data">
   @csrf
      
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border bg-green-active color-palette">
              <h3 class="box-title">FORM EDIT SHU</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>

        <div class="box-body">
          <div class="box-header">
              <div class="col-md-4">
                  <div class="box-body box-profile" >
                    <img class="profile-user-img img-responsive rounded-circle" src="{{ url('public/public/foto_pegawai/'.$data->foto_pegawai) }}" alt="User profile picture">
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
                <div class="col-md-8">
                      <div class="form-group">
                        <label  for="inputName" class="col-sm-4 control-label">No. SHU</label>

                        <div class="col-sm-8">
                          <input name="id_shu" type="text" class="form-control"  value="{{$data->id_shu}}" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Tanggal SHU</label>

                          <div class="col-sm-8">
                          <input name="tgl_shu" type="text" class="form-control pull-right"  value="{{$data->tgl_shu}}" id="datepicker">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Nama Bank</label>

                          <div class="col-sm-8">
                          <input name="nama_bank" type="text" class="form-control pull-right"  value="{{$data->nama_bank}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">No. Rekening</label>

                          <div class="col-sm-8">
                          <input name="no_rek" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->no_rek}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Peran Belanja Wanamart</label>

                          <div class="col-sm-8">
                          <input name="peran_belanja_wanamart" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->peran_belanja_wanamart}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Peran Simpanan Wanamart</label>

                          <div class="col-sm-8">
                          <input name="peran_simpanan_wanamart" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->peran_simpanan_wanamart}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Japernosa Water & FC</label>

                          <div class="col-sm-8">
                          <input name="lain_lain" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->lain_lain}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">SHU peran kredit</label>

                          <div class="col-sm-8">
                          <input name="peran_kredit" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->peran_kredit}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">SHU peran Simpanan</label>

                          <div class="col-sm-8">
                          <input name="peran_simpanan" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->peran_simpanan}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-4 control-label">Pengurus</label>

                          <div class="col-sm-8">
                          <input name="pengurus" type="number" class="form-control pull-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{$data->pengurus}}" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label  class="col-sm-4 control-label">Jumlah SHU</label>

                        <div class="col-sm-8">
                          <input name="jumlah_shu" type="text"  id="pokok" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control"  value="{{$data->jumlah_shu}}"> 
                          @error('jumlah_shu')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                      </div>
                      @endforeach
                      <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-9">
                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                            </div>
                    
                      </div>
                    </form>
                  </div>
              </div>
          </div>
          <!-- /.col -->
        
      <!-- /.row -->
</form>
</session>

@endsection