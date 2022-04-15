@extends ('layout.v_template')
@section('title','Tambah Simpanan')

@section('content')
<section class="content-header">
      <h1>SIMPANAN BARU
      <small>Form</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="/simpanan">Simpanan</a></li>
        <li><a href="#">Simpanan Baru</a></li>
      </ol><br>
    </section>
<!-- Box Table -->
@if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
<form class="form-horizontal" action="{{ route('simpansimpanan') }}" method="post" enctype="multipart/form-data">
{{csrf_field()}}
  <div class="box box-default">
    <div class="box-header with-border bg-blue color-palette">
      <h3 class="box-title ">Form Tambah Simpanan Baru</h3>

      <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
   
      <div class="box-body">
          <div class="box-header">
          <div class="col-sm-6">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Info!</h4>
                <address class="text-justify">1. Simpanan Pokok hanya diisi jika karyawan baru menjadi anggota dengan nominal sebesar Rp.50.000,- <br>
                2. Simpanan Wajib diisi jika karyawan belum ada potongan bulanan. <br>
                3. Simpanan Sukarela diisikan jika karywan menyetorkan dana sukarela.</address>
            </div>
          </div>
          <div class="col-sm-6">

          <!-- form group -->
            <div class="form-group">
            <input name="tgl_simpanan" type="hidden" class="form-control" value="{{date(now())}}" readonly>
              <label class="col-sm-4 control-label">NIK KTP</label>
                <div class="col-sm-8">
                  <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-user"></i>
                      </div>
                      <select name="nik_ktp" type="text" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" value="{{old('nik_ktp')}}">
                    <option value="">--Pilih--</option>
                    @foreach ($pegawai as $key => $data)
                    <option value="{{$data->nik_ktp}}">{{$data->nik_ktp}}- {{$data->nama}}</option>
                    @endforeach
                    <div class="text-danger">
                                @error('nik_ktp')
                                {{$message}}
                                @enderror
                        </div>
                    </select> 
                  </div>
                </div>
            </div>

            <!-- form group -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Tanggal</label>
    
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                <input name="tgl_potongan"  type="text" class="form-control" id="datepicker">
                <div class="text-danger">
                            @error('tgl_simpanan')
                            {{$message}}
                            @enderror
                    </div> 
                </div>
              </div>
            </div>
            
            <!-- form group -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Simpanan Pokok</label>
    
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                  </div>
                <input name="simpanan_pokok" id='t1' type="text" class="form-control text-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" data-inputmask="" data-mask="" max="50000" value="0">
                <div class="text-danger">
                            @error('simpanan_pokok')
                            {{$message}}
                            @enderror
                    </div> 
                </div>
              </div>
            </div>
            <!-- form group -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Simpanan Wajib</label>
    
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                  </div>
                <input name="simpanan_wajib"  id='t2' type="text" class="form-control text-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" data-inputmask="" data-mask="" value="0">
                <div class="text-danger">
                            @error('simpanan_wajib')
                            {{$message}}
                            @enderror
                    </div> 
                </div>
              </div>
            </div>
            <!-- form group -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Simpanan Sukarela</label>
    
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                  </div>
                <input name="simpanan_sukarela" id='t3' type="text" class="form-control text-right" onkeypress="return event.charCode >= 48 && event.charCode <=57" data-inputmask="" data-mask="" value="0">
                <div class="text-danger">
                            @error('simpanan_sukarela')
                            {{$message}}
                            @enderror
                    </div> 
                </div>
              </div>
            </div>
            <!-- form group -->
            <div class="form-group">
              <label class="col-sm-4 control-label">Jumlah Simpanan</label>
    
              <div class="col-sm-8">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                  </div>
                <input name="jumlah_simpanan" type="text" class="form-control text-right" data-inputmask="" data-mask="" id="hasil" readonly>
                <div class="text-danger">
                            @error('jumlah_simpanan')
                            {{$message}}
                            @enderror
                    </div> 
                </div>
              </div>
            </div>
            <!-- form group -->
            <div class="form-group">
              <label class="col-sm-4 control-label"></label>
              <div class="col-sm-8">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </div>
          </div>
      </div>

</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(".form-group").keyup(function() {
    var bil1 = parseInt($("#t1").val())
    var bil2 = parseInt($("#t2").val())
    var bil3 = parseInt($("#t3").val())
    var hasil = bil1 + bil2 + bil3;
    $("#hasil").attr("value",hasil)
});
</script>          
          
@endsection