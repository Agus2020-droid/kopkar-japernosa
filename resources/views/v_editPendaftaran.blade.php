@extends ('layout.v_template')
@section('title','EDIT CALON ANGGOTA')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <h1>@yield('title')
      <small>Form</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
        <li><a href="/pendftaran">Pendaftaran</a></li>
        <li class="active">Edit Calon Anggota</a></li>
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
    <section class="content-header">
        <!-- /.form baru -->
        <div class="box">
          <div class="box-header with-border bg-blue color-palette">
            <h3 class="box-title">FORM EDIT CALON ANGGOTA</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="box-header">
            <div class="row">
            <form class="form-horizontal" action="/pendaftaran/update/{{ $pegawai->nik_ktp }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
              <div class="col-12 text-center">
              <img src="{{ asset('public/public/foto_pegawai/'.$pegawai->foto_pegawai) }}" width="150px" class="img-thumbnail"><br>
              <label >Ganti Foto </label><br>
              
                <center><input type="file" name="foto_pegawai"><center>
              </div>
              
            
              <div class="col-12">
              <div class="box-body">
                <table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
                  <tbody>
                    <tr>
                      <td>
                      
                      
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label">NIK KTP</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="{{$pegawai->nik_ktp}}" readonly>
                          </div>
                        </div> -->
                        <div class="form-group">
                          <label class="col-md-2 control-label" >No. KTP</label>
                          <div class="col-md-10">
                            <input name="nik_ktp" class="form-control" placeholder="Max. 17 Digit" value="{{$pegawai->nik_ktp}}" readonly>
                          </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                          <label class="col-sm-2 control-label" >Nama</label>
                        <div class="col-sm-10">
                          <input name="nama" class="form-control" placeholder="Masukan Nama Lengkap" value="{{$pegawai->nama}}" readonly>
                        </div>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Nik Karyawan</label>
                          <div class="col-sm-10">
                            <input name="nik_karyawan" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" placeholder="Masukan NIK Karyawan" value="{{$pegawai->nik_karyawan}}" >
                          </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                          <label class="col-sm-2 control-label">Tempat Lahir</label>
                        <div class="col-sm-10">
                          <input name="tempat_lahir" class="form-control" value="{{$pegawai->tempat_lahir}}">
                            <div class="text-danger">
                                @error('tempat_lahir')
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                      </div>
                      <!-- /.form-group -->
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tanggal Lahir:</label>
                          <div class="col-sm-10">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input name="tgl_lahir" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{$pegawai->tgl_lahir}}">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tanggal Masuk:</label>
                          <div class="col-sm-10">
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input name="tgl_masuk" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{$pegawai->tgl_masuk}}">
                            </div>
                          </div>
                        </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Jabatan</label>
                        <div class="col-sm-10">
                          <select name="jabatan" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" value="{{$pegawai->jabatan}}">
                          <option value="{{$pegawai->jabatan}}">{{$pegawai->jabatan}} (current)</option>
                            <option value="STAFF">STAFF</option>
                            <option value="TETAP">TETAP</option>
                            <option value="KONTRAK">KONTRAK</option>
                            <option value="MITRA">MITRA</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Kepengurusan</label>
                        <div class="col-sm-10">
                          <select name="kepengurusan" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true" value="{{$pegawai->kepengurusan}}">
                          <option value="{{$pegawai->kepengurusan}}">{{$pegawai->kepengurusan}} (current)</option>
                          <option value="PENGAWAS">PENGAWAS</option>
                          <option value="KETUA">KETUA</option>
                          <option value="SEKRETARIS">SEKRETARIS</option>
                          <option value="BENDAHARA">BENDAHARA</option>
                          <option value="PENGURUS">PENGURUS</option>
                          <option value="ANGGOTA">ANGGOTA</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                          <select name="status" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" value="{{$pegawai->status}}">
                          <option value="{{$pegawai->status}}">{{$pegawai->status}} (current)</option>
                            <option value="AKTIF">AKTIF</option>
                            <option value="NON AKTIF">NON AKTIF</option>
                          </select>
                        </div>
                      </div>

                        <div class="form-group">
                          <label class="col-sm-2 control-label">Alamat Lengkap</label>
                          <div class="col-sm-10">
                            <input name="alamat" class="form-control" placeholder="Masukan Alamat Lengkap" value="{{$pegawai->alamat}}">
                          </div>
                        </div>

                      </td>
                    </tr>
                  </tbody>
                </table>
                </div>

                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                  </div>  
                </div>
              <!-- /.col -->
              </div>
            <!-- /.row -->
            </div>
            
          </div>
          <!-- /.box-body -->
        </div>       
      </form>
</section>
@endsection
