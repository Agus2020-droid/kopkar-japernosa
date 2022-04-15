@extends ('layout.v_template')
@section('title','Tambah Anggota')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>TAMBAH ANGGOTA BARU</h1>
        <ol class="breadcrumb">
          <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
          <li><a href="#">Anggota</a></li>
          <li class="active">@yield('title')</li>
        </ol>
  </section><br>
  <!-- $config=['table'=>'pegawai','length'=>5,'prefix'=>'KJP-0'];
  $id = Haruncpi\LaravelIdGenerator\IdGenerator::generate($config);
  $id++; -->
  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
<section class="content">
  <div class="box-header bg-blue-active color-palette">
    <div class="">
      <center><label >FORM PENDAFTARAN ANGGOTA KOPERASI</label> </center>
    </div>
  </div>
  <div class="register-box-body">
    <div class="row-header">
      <form class="form-horizontal" action="/pegawai/insert" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label class="col-sm-3 control-label">NIK KTP</label>

          <div class="col-sm-9">
          <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
            <input name="nik_ktp" type="text" maxlength="16" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{old('nik_ktp')}}">
          </div>
          <div class="text-danger">
                  @error('nik_ktp')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Nama Lengkap</label>

          <div class="col-sm-9">
          <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-book"></i>
              </div>
            <input name="nama" type="text" class="form-control" value="{{old('nama')}}">
          </div>
          <div class="text-danger">
                  @error('nama')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">NIK Karyawan</label>

          <div class="col-sm-9">
          <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-book"></i>
              </div>
            <input name="nik_karyawan" type="text" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="{{old('nik_karyawan')}}">
          </div>
          <div class="text-danger">
                  @error('nik_karyawan')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Tempat Lahir</label>

          <div class="col-sm-9">
          <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-map-pin"></i>
              </div>
            <input name="tempat_lahir" type="text" class="form-control" value="{{old('tempat_lahir')}}">
          </div>
          <div class="text-danger">
                  @error('tempat_lahir')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Tanggal Lahir</label>

          <div class="col-sm-9">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input  name="tgl_lahir" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{old('tgl_lahir')}}">
            </div>
            <div class="text-danger">
                  @error('tgl_lahir')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Tanggal Masuk</label>

          <div class="col-sm-9">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="tgl_masuk" type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{old('tgl_masuk')}}">
            </div>
            <div class="text-danger">
                  @error('tgl_masuk')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Status Karyawan</label>

          <div class="col-sm-9">
            <select name="jabatan" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true" >
            <option value="">--Pilih--</option>
            <option value="Tetap">Tetap</option>
            <option value="Kontrak">Kontrak</option>
            <option value="Mitra HK">Mitra HK</option>
            </select> 
            <div class="text-danger">
                  @error('jabatan')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Kepengurusan</label>

          <div class="col-sm-9">
            <select name="kepengurusan" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" >
            <option value="">--Pilih--</option>
            <option value="Pengawas">Pengawas</option>
            <option value="Ketua">Ketua</option>
            <option value="Sekretaris">Sekretaris</option>
            <option value="Bendahara">Bendahara</option>
            <option value="Anggota">Anggota</option>
            </select> 
            <div class="text-danger">
                  @error('kepengurusan')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Alamat lengkap</label>

          <div class="col-sm-9">
          <div class="input-group">
              <!-- <div class="input-group-addon">
                <i class="fa fa-home"></i>
              </div> -->
            <textarea name="alamat" type="text" cols="100" rows="5" class="form-control" value="{{old('alamat')}}"></textarea>
            </div>
            <div class="text-danger">
                  @error('alamat')
                  Kesalahan !!!
                  @enderror
              </div>
          </div>
        </div>
        <!-- form group -->
     
        <div class="form-group">
          <label class="col-sm-3 control-label"></label>

          <div class="col-sm-9">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      <!-- /.box-body -->
    </form>
  </div>
</div>

</section>
@endsection