@extends ('layout.v_template')
@section('title','Pinjaman Baru')

@section('content')
  <section class="content-header">
    <h1>SIMULASI
    <small>Form</small></h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
      <li><a href="#">Simulasi </a></li>
    </ol>
  </section>
  
  <section class="content">
  <div class="row">
      <div class="col-md-12">

        <div  class="box box-primary" id="apply" style="display: block;">
          <div class="box-header bg-blue-active color-palette" >
            <div class="pull-left">
              <h5><strong>FORMULIR PENGAJUAN</strong></h5>
            </div>
          </div>

   
        <form class="form-horizontal">
          <div class="box-header">
            <div class="row">
              <div class="col-md-12"> 
                  <!-- <div class="callout callout-danger">
                    <h4>Petunjuk pengisian form :</h4>
                    <span>(*) kolom wajib diisi, atau diisi dengan tanda strip (-)</span> 
                  </div> -->

                <div class="row form-group">
                  <label for="inputName" class="col-sm-3 control-label">Jenis Pinjaman</label>
                  <div class="col-sm-9">
                    <select name="jenis_pinjaman" type="text" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true" id="jenis_pinjaman" placeholder="Pilih Jenis Pinjaman">
                      <option value="Pengembangan" >Pengembangan (Profit)</option>
                      <option value="Pinjaman Sosial" >Pinjaman Sosial (Non Profit)</option>
                    </select> 
                  </div>
                </div>
                
                <div class="row form-group">
                  <label class="col-sm-3 control-label">Nama Barang / Jasa  <span class="text-red">(*)</span> </label>
                  <div class="col-sm-9">
                    <input name="nama_barang" id="nama_barang"type="text"class="form-control"  placeholder="Nama Barang atau Jasa" >
                  </div>
                </div>

                <div class="row form-group">
                  <label type="hidden" class="col-sm-3 control-label">Merk / Brand <span class="text-red">(*)</span> </label>
                  <div class="col-sm-9">
                    <input name="merk" id="merk" type="text" class="form-control"  placeholder="Merk produk">
            
                  </div>
                </div>

                <div class="row form-group">
                  <label  class="col-sm-3 control-label">Spesifikasi <span class="text-red">(*)</span> </label>
                  <div class="col-sm-9">
                    <input name="spesifikasi" type="text"class="form-control" id="spesifikasi" placeholder="Masukan spesifikasi produk"></input>

                  </div>
                </div>

                <div class="row form-group">
                  <label  class="col-sm-3 control-label">Jumlah Unit <span class="text-red">(*)</span> </label>
                  <div class="col-sm-9">
                    <input name="unit" type="text" class="form-control" id="unit" placeholder="Unit" >
                    @error('unit')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>

                <div class="row form-group">
                  <label for="tenor" class="col-sm-3 control-label">Tenor</label>

                  <div class="col-sm-9">
                  <select name="tenor" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" id="tenor">
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
                  </div>
                </div>

                <div class="row form-group">
                  <label for="plafon" class="col-sm-3 control-label">Plafon Kredit <span class="text-red">(*)</span> </label>

                  <div class="col-sm-9">
                    <div class="input-group">
                      <span class="input-group-addon">Rp. </span>
                        <input name="plafon" type="text" class="form-control"  onkeypress="return event.charCode >= 48 && event.charCode <=57" id="rupiah" value="{{old('plafon')}}">
                      <span class="input-group-addon">.00</span>
                    </div>
                    @error('plafon')
                    <span class="label label-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
 
                <div class="row form-group">
                  <div class="col-sm-offset-0 col-sm-12 ">
                    <a type="submit" class="btn btn-primary pull-right" onclick="tombolTampil()">SUBMIT</a>
                  </div>
                </div>
                
              

              </div>
            </div>
            
            

            
          </div>



          
        </div>
      </div>

      <div class="col-md-12" id="myDIV1" style="display: none;">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-primary text-center">
              <h3 class="">SIMULASI PERHITUNGAN</h3>
              <h5 class="">Kredit Pinjaman</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Jenis Pinjaman<span class="pull-right" id="jnsp"></span></a></li>
                <li><a href="#">Nama Barang / Jasa<span class="pull-right" id="nm_barang"></span></a></li>
                <li><a href="#">Merk/Brand<span class="pull-right" id="merk_id"></span></a></li>
                <li><a href="#">Spesifikasi<span class="pull-right" id="spes_id"></span></a></li>
                <li><a href="#">Unit<span class="pull-right" id="unit_id"></span></a></li>
                <li  class="bg-gray"><a href="#">Plafon <input class="pull-right no-border text-right" id="plf" readonly></a></li>
                <li class="bg-gray"><a href="#" >Tenor (bulan)<input class="pull-right no-border text-right" id="hsl_tenor" readonly></a></li>
                <li class="bg-gray"><a href="#" >Pinjaman Kredit<input class="pull-right no-border text-right" id="kredit" readonly></a></li>
                <li class="bg-gray"><a href="#">Angsuran / bulan <input class="pull-right no-border text-right" id="hasil" readonly></a></li>
                <!-- <li class="bg-gray"><a href="#">Est. Jatuh tempo <span class="pull-right" id="temp">{{Carbon\Carbon::parse(date(now()))->addMonths(0)->isoFormat("MMM-Y")}}</span></a></li>                 -->
                <a href="/simulasi" class="btn btn-block btn-success btn-lg" ><i class="fa fa-refresh"></i>  ULANGI</a>
              </ul>
            </div>
          </div>
          </form>
          <!-- /.widget-user -->
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
<script>
  function tombolTampil() {
  var x = document.getElementById("myDIV1");
  var y = document.getElementById("apply");
    x.style.display = "block";
    y.style.display = "none";
}
</script>


<!-- <script type="text/javascript">
		var rupiah = parseInt($("#rupiah").val())
	
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script> -->
@endsection