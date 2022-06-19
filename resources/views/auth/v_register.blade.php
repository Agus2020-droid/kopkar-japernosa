@extends ('layouts.v_app')
@section('title','| Register')
<style>
    .inputs-grup {
        position: relative;
    }
    .inputs {
        padding: 15px;
        border: none;
        border-radius: 4px;
        font: inherit;
        /* color: brown; */
        background-color: transparent;
        outline: 2px solid #fff;
    }
    .inputs-label {
        position: absolute;
        top: 0;
        left: 0;
        transform: translate(10px, 10px);
        transition: transform .25s;
    }
    .inputs:focus+.inputs-label,
    .inputs:valid+.inputs-label{
        transform:
            translate(10px, -14px) scale(.8);
            color: skyblue;
            padding-inline: 5px;
            background-color: #fff;
    }
    .inputs:is(:focus, :valid) {
        outline-color: skyblue;
    }  
</style>
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container" >
            <!-- <div class="box box-widget">
                <div class="box-body">
                    <div class="row" style="padding-top: 2%">
                        <div class="col-4 text-right">
                        <img src="koperasi.jpg" class="img-circle" style="width: 130px">
                        </div>
                        <div class="col-8">
                            <h4>KOPERASI KARYAWAN (KOPKAR)<br>JAYA PERSADA EKONOMI SEJAHTERA (JAPERNOSA)</h4>
                            <p>PT. SUMBER GRAHA SEJAHTERA - CABANG PURBALINGGA <br>
                            Jl. Raya Bajong - Bukateja KM.07 Desa Bajong Kec. Bukateja Kab. Purbalingga 53382 <br>
                            Phone/Fax : (0281) 893343 | Email : kopkar.japernosa@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div> -->
            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
            
              <div class="box" style="padding: 3%; ">
                    <div class="box-header with-border" style="padding-left: 5%;padding-right: 10%;outline: 2px solid skyBlue;">
                        <div class="col-sm-2 text-center">
                            <img src="koperasi.jpg" class="img" style="width: 120px"><br>
                            <label style="font-size: 10px"> KOPERASI INDONESIA</label>
                        </div>
                        <div class="col-sm-10 hidden-xs ">
                            <label style="font-size: 18px;">KOPERASI KARYAWAN <br> JAYA PERSADA EKONOMI SEJAHTERA (JAPERNOSA)</label>
                            <p style="font-size: 16px;">PT. SUMBER GRAHA SEJAHTERA - CABANG PURBALINGGA </p>
                            <p>Alamat kantor : Jalan raya Bajong Km.07 Desa Bajong Kec. Bukateja Kab. Purbalingga JAWA TENGAH</p>
                        </div>
                    </div>
                    <form class="form-horizontal"action="{{url('insertPendaftaran')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body" style="padding-top: 3%;padding-left: 5%;padding-right: 5%;outline: 2px solid skyBlue;">
                    <!-- <div class="callout callout-info">
                        <h4>Perhatian!</h4>
                        <ul>
                            <li>Siapkan foto ktp untuk diupload.</li>
                            <li>Setelah anda mendaftar tunggu sampai Anda mendapat User dan Password dari <u>Admin Kopkar</u>.</li>
                            <li>Jika selama 1x24 jam Anda belum menerima informsi akun login, hubungi WA Admin di nomor <a href="https://api.whatsapp.com/send?phone=6285876344438">085876344438</a></li>
                        </ul>
                    </div> -->
                    <!-- @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif  -->
                    <input type="hidden" name="notifikasi" value="Pendaftaran anggota baru">
                    <input type="hidden" name="created_at" value="{{date(now())}}">
                    <input type="hidden" name="foto_user" value="user.png">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">NIK KTP <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="nik_ktp" type="text" class="form-control @error('nik_ktp') is-invalid @enderror" maxlength="16" onkeypress="return event.charCode >= 48 && event.charCode <=57" placeholder="16 digit nomor KTP">
                                @error('nik_ktp')
                                <span class="invalid-feedback text-red" role="alert">
                                <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama Lengkap<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="nama_lengkap"type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Contoh : Andianto Ramadhan">
                                @error('nama_lengkap')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email <span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="alamat_email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Contoh : abc@example.com">
                                @error('alamat_email')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Alamat sesuai KTP<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="alamat_ktp" type="text" class="form-control" placeholder="Alamat tempat tinggal saat ini">
                                @error('alamat_ktp')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tempat Lahir<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="tmpt_lhr" type="text" class="form-control" placeholder="Kota kelahiran">
                                @error('tmpt_lhr')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Lahir<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="tgl_lhr" type="date" class="form-control" >
                                @error('tgl_lhr')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nomor Whatsapp<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="telepon" type="text" class="form-control" maxlength="13" onkeypress="return event.charCode >= 48 && event.charCode <=57" placeholder="08xxxxxxxxxxxx">
                                @error('telepon')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Masuk Kerja<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="tgl_masuk" type="date" class="form-control">
                                @error('tgl_masuk')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">NIK Karyawan<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <input name="nik_karyawan" type="text" class="form-control" maxlength="6" onkeypress="return event.charCode >= 48 && event.charCode <=57" placeholder="xxxxxx">
                                @error('nik_karyawan')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status Kerja<span class="text-red">*</span></label>
                            <div class="col-sm-10">
                                <select name="status" id="" class="form-control">
                                    <option value="">-Pilih</option>
                                    <option value="Kontrak">Kontrak</option>
                                    <option value="Tetap">Tetap</option>
                                    <option value="Staf">Staf</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto KTP<span class="text-red">*</span></label> 
                            <div class="col-sm-10">
                                <input name="file" type="file" class="form-control"><p class="text-red">format : JPG/jpeg/png | max: 1025mb </p>
                                @error('file')
                                <span class="invalid-feedback text-red" role="alert">
                                    <i class="fa fa-exclamation-triangle"></i> {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Foto diri<span class="text-red">*</span></label> 
                            <div class="col-sm-2 text-center">
                                <!-- <div id="my_camera"></div>
                                <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">     -->
                                Contoh : <br>
                                <img src="{{ asset('public/public/foto_user/user1.png') }}" class="img-thumbnail" width="100px" height="100px" srcset="">
                            </div>
                            <div class="col-sm-8">
                                <!-- <div id="results">Your captured image will appear here...</div> -->
                                <input name="foto_kry" type="file" class="form-control"><p class="text-red">format : JPG/jpeg/png | max: 1025mb </p>

                            </div>
                        </div>
                        <div class="box-footer col-sm-offset-2 col-sm-10">
                            <a href="/" class="btn btn-default btn-lg pull-left">Batal</a>
                            <a href="#" class="btn btn-info btn-lg pull-right" data-toggle="modal" data-target="#modal-daftar">Lanjut</a>
                        </div>
                    </div>
                    <!-- /.modal-dialog -->
                    <div class="modal modal-info fade" id="modal-daftar" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Persetujuan ketentuan dan kebijakan </h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                    <address class="text-justify">Dengan ini mengajukan permohonan masuk menjadi anggota KOPERASI JAYA PERSADA EKONOMI SEJAHTERA di PT. SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA dan bersedia memenuhi ketentuan-ketentuan dan persyaratan yang ada, yaitu : <br><br>
                                    <ul>
                                        <li>1. Karyawan berstatus Tetap/Kontrak/Mitra PT. SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA</li>
                                        <li>2. Membayar Simpanan Pokok secara potong gaji sebesar <b class="text-red"><u>Rp.50.000 (Lima Puluh ribu rupiah)</u></b></li>
                                        <li>3. Mentaati Anggaran Dasar dan Anggaran Rumah Tangga (AD & ART) dan segala peraturan yang berlaku di KOPKAR JAPERNOSA di PT SUMBER GRAHA SEJAHTERA CABANG PURBALINGGA.</li>
                                        <li>4. Membayar Simpanan Wajib setiap bulan sejak diterima menjadi anggota koperasi karyawan sebesar <b class="text-red"><u>Rp. 20.000,- (Dua Puluh Ribu Rupiah).</u></b></li>
                                    </ul>    
                                    Pembayaran simpanan wajib dilakukan melalui bagian Personalia/Payroll dengan cara pemotongan gaji. <br><br>
                                    Demikian permohonan ini dibuat, untuk menjadi bahan pertimbangan bagi pengurus. Atas perhatiannya disampaikan terima kasih.
                                    </address> 
                                    </div>
                                    <div class="col-sm-offset-1 col-sm-11">

                                    
                                    <div class="checkbox">
                                    <label>
                                        <input id="approve1" checked="true" onclick="goFurther()" type="checkbox"><u> Saya setuju ketentuan tersebut dan bertanggungjawab terhadap kesesuaian data yang saya lampirkan.</u>
                                    </label>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">BATAL</button>
                                    <button id="buttonsubmit" type="submit" class="btn btn-outline">SUBMIT</button>
                                </div>
                            
                            </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                </form>
        </div>
    </section>
</div>
<!-- /.Web-cam -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js" integrity="sha512-dQIiHSl2hr3NWKKLycPndtpbh5iaHLo6MwrXm7F0FM5e+kL2U16oE9uIwPHUl6fQBeCthiEuV/rzP3MiAB8Vfw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script language="JavaScript">
    Webcam.set({
        width: 300,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script> -->
<script type="text/javascript">
    function goFurther(){
    if(document.getElementById('approve1').checked == false)
    document.getElementById('buttonsubmit').disabled = true;
    else
    document.getElementById('buttonsubmit').disabled = false;

    }
</script>


@endsection