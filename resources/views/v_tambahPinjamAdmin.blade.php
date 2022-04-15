@extends ('layout.v_template')
@section('title','Pinjaman Baru')

@section('content')
  <section class="content-header">
    <h1>PINJAMAN KREDIT BARU
    <small>Form</small></h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
      <li><a href="#">Pinjaman Kredit </a></li>
    </ol>
  </section>
  
  <section class="content">
  <div class="row">
      <div class="col-md-12">
      <!-- @if (count($errors) > 0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif   -->
        <div  class="box box-primary">
        <div class="box-header bg-blue-active color-palette">
            <div class="pull-left">
            <h5><strong>FORM PINJAMAN KREDIT</strong></h5>
            </div>
          </div>

   
      <form class="form-horizontal" action="/pinjamanByAdmin/insert" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
        <div class="box-header">
          <div class="row">
            <div class="col-md-12"> 
            
                
                
                <input type="hidden" name="tgl_pengajuan" class="form-control" value="{{date(now())}}" readonly>
                <input name="bunga" type="hidden" class="text-right"  onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" id="bunga" value="0">
 
                <div class="callout callout-info">
                <h4>Petunjuk pengisian form :</h4>
                <span>(*) kolom wajib diisi, atau diisi dengan tanda "-"</span> 
              </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">NIK</label>

                  <div class="col-sm-10">
                    @foreach ($pegawais as $data)
                    <input type="hidden" name="notifikasi" class="form-control" value="Pengajuan Pinjaman {{$data->nama}}" readonly>
                    <input type="text" name="nik_ktp" class="form-control"  value="{{$data->nik_ktp}}" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label id="nm" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                  <input name="nama" type="text" class="form-control " id="nm_box" value="{{$data->nama}}" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label id="nik" class="col-sm-2 control-label">Nik Karyawan</label>
                  <div class="col-sm-10">
                  <input name="nik_karyawan" type="text" class="form-control" id="nik_box" value="{{$data->nik_karyawan}}" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Status Karyawan</label>
                  <div class="col-sm-10">
                  <input name="jabatan" type="text" class="form-control "  value="{{$data->jabatan}}" readonly>
                  </div>
                  @endforeach
                </div>

                <div class="form-group">
                  <label for="inputName" class="col-sm-2 control-label">Jenis Pinjaman</label>
                  <div class="col-sm-10">
                    <select name="jenis_pinjaman" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true" id="jenis_pinjaman" placeholder="Pilih Jenis Pinjaman">
                        <option value="" >-PILIH-</option>
                      <option value="Pengembangan" >Pengembangan (Profit)</option>
                      <option value="Pinjaman Sosial" >Pinjaman Sosial (Non Profit)</option>
                    </select>
                     @error('jenis_pinjaman')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                 
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Barang / Jasa  <span class="text-red">(*)</span> </label>
                  <div class="col-sm-10">
                    <input name="nama_barang" id="nama_barang"type="text"class="form-control"  placeholder="Nama barang atau jasa" value="{{old('nama_barang')}}">
                    @error('nama_barang')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label type="hidden" class="col-sm-2 control-label">Merk / Brand <span class="text-red">(*)</span> </label>
                  <div class="col-sm-10">
                    <input name="merk" type="text" class="form-control" id="merk" placeholder="Merk produk" value="{{old('merk')}}">
                    @error('merk')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label  class="col-sm-2 control-label">Spesifikasi <span class="text-red">(*)</span> </label>
                  <div class="col-sm-10">
                    <input name="spesifikasi" type="text"class="form-control" id="spesifikasi" placeholder="Masukan spesifikasi produk" value="{{old('spesifikasi')}}"></input>
                    @error('spesifikasi')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah Unit <span class="text-red">(*)</span> </label>
                  <div class="col-sm-10">
                    <input name="unit"type="text" class="form-control" id="unit" placeholder="Unit" value="{{old('unit')}}">
                    @error('unit')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label for="tenor" class="col-sm-2 control-label">Tenor</label>

                  <div class="col-sm-10">
                  <select name="tenor" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" id="tenor">
                    <option value="">-PILIH-</option>
                    <option value="1">1 Bulan</option>
                    <option value="2">2 Bulan</option>
                    <option value="3">3 Bulan</option>
                    <option value="4">4 Bulan</option>
                    <option value="5">5 Bulan</option>
                    <option value="6">6 Bulan</option>
                    <option value="7">7 Bulan</option>
                    <option value="8">8 Bulan</option>
                    <option value="9">9 Bulan</option>
                    <option value="10">10 Bulan</option>
                    <option value="11">11 Bulan</option>
                    <option value="12">12 Bulan</option>
                    </select>
                    @error('tenor')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <label for="plafon" class="col-sm-2 control-label">Plafon Kredit <span class="text-red">(*)</span> </label>

                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-addon">Rp. </span>
                        <input name="plafon" type="number" class="form-control"  onkeypress="return event.charCode >= 48 && event.charCode <=57" id="rupiah" value="{{old('plafon')}}">
                      <span class="input-group-addon">.00</span>
                    </div>
                    @error('plafon')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                @foreach($user_id as $data)
                <input type="hidden" name="id_user" class="form-control" value="{{$data->id}}" readonly>
                @endforeach
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10 ">
                  <a href="/pinjam"type="button" class="btn btn-default ">Batal</a>
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#apply">
                    SUBMIT
                </button>
                    <!--<button type="submit" class="btn btn-primary pull-right">SUBMIT</button>-->
                  </div>
                </div>
         <!-- /.modal-dialog -->
        <div class="modal fade in" id="apply" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Apakah pengajuan sudah benar ?</h4>
              </div>
              <div class="modal-body">
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#"> <label>Jenis Pinjaman</label> <span class="pull-right" id="jnsp"></span></a></li>
                <li><a href="#">Nama Barang / Jasa<span class="pull-right" id="nm_barang"></span></a></li>
                <li><a href="#">Merk/Brand<span class="pull-right" id="merk_id"></span></a></li>
                <li><a href="#">Spesifikasi<span class="pull-right" id="spes_id"></span></a></li>
                <li><a href="#">Unit<span class="pull-right" id="unit_id"></span></a></li>
                <li ><a href="#">Plafon <input class="pull-right no-border text-right" id="plf"></a></li>
                <li ><a href="#" >Tenor (bulan)<input class="pull-right no-border text-right" id="hsl_tenor" readonly></a></li>
                <li ><a href="#" >Pinjaman Kredit<input name="total_kredit" class="pull-right no-border text-right" id="kredit" readonly></a></li>
                <li ><a href="#">Angsuran / bulan <input name="angsuran" class="pull-right no-border text-right" id="hasil" readonly></a></li>
                <!-- <li class="bg-gray"><a href="#">Est. Jatuh tempo <span class="pull-right" id="temp">{{Carbon\Carbon::parse(date(now()))->addMonths(0)->isoFormat("MMM-Y")}}</span></a></li>                 -->
              </ul>
            </div>
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-primary">APPLY</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
              </form>

              </div>
              </div>
          </div>
        </div>
      </div>
  </div>
</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(".form-horizontal").keyup(function() {
      //var rupiah = parseInt($("#rupiah").val())
      var jenis = document.getElementById("jenis_pinjaman")
      var nb = document.getElementById("nama_barang")
      var mr = document.getElementById("merk")
      var sp = document.getElementById("spesifikasi")
      var un = document.getElementById("unit")
      var plaf = parseInt($("#rupiah").val())
      var bung = parseInt($("#bunga").val())
      var ten = parseInt($("#tenor").val())
      if(jenis.value == 'Pengembangan') {
        var profit = (plaf*(15/100));
      }else{
        var profit = (plaf*(0/100));
      }
      var kred = (plaf+profit);
      var dump_angs = kred/ten;
      $("#plf").attr("value",plaf)
      $("#hasil").attr("value",dump_angs)
      $("#kredit").attr("value",kred)
      $("#hsl_tenor").attr("value",ten)
      document.getElementById("jnsp").innerHTML = jenis.value;
      document.getElementById("nm_barang").innerHTML = nb.value;
      document.getElementById("merk_id").innerHTML = mr.value;
      document.getElementById("spes_id").innerHTML = sp.value;
      document.getElementById("unit_id").innerHTML = un.value;

    }); 
</script>


@endsection