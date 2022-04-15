@extends ('layout.v_template')
@section('title','Edit Pengambilan Dana')

@section('content')
<section class="content-header">
      <h1>PERSETUJUAN PENARIKAN DANA SIMPANAN
      <SMALl>Form</SMALl></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/pengambilanKetua">Penarikan Dana</a></li>
        <li class="active">Persetujuan</a></li>
      </ol>
    </section>
<!-- /.pembatas -->
<session class="content">
@foreach ($pengambilan as $data)
<form class="form-horizontal" action="/pengambilanKetua/update/{{$data->id_pengambilan}}" method="post" enctype="multipart/form-data">
   @csrf     
    <div class="col-md-12">
        <div class="box box-primary table-responsive">
            <div class="box-header">
                <div>
                    <p><h4>Kode Penarikan : <strong>T-{{$data->id_pengambilan}}</strong></h4></p>
                    <small><i>{{Carbon\Carbon::parse($data->tgl_pengambilan)->format("d-M-y H:i:s")}}</i></small>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="7" class="bg-blue color-palette text-center">IDENTITAS PEMOHON</th>
                        </tr>
                        <tr>
                            <th class="bg-blue-active color-palette text-center">Nama</th>
                            <th class="bg-blue-active color-palette text-center">NIK</th>
                            <th class="bg-blue-active color-palette text-center">No. KTP</th>
                            <th class="bg-blue-active color-palette text-center">Status Kerja</th>
                            <th class="bg-blue-active color-palette text-center">Nomor Handphone</th>
                            <th class="bg-blue-active color-palette text-center">Jabatan</th>
                            <th class="bg-blue-active color-palette text-center">Status</th>
                        </tr>
                        <tr>
                            <td class="text-center">{{$data->nama}}</td>
                            <td class="text-center">{{$data->nik_karyawan}}</td>
                            <td class="text-center">{{$data->nik_ktp}}</td>
                            <td class="text-center">{{$data->jabatan}}</td>
                            <td class="text-center">{{$data->telp}}</td>
                            <td class="text-center">{{$data->kepengurusan}}</td>
                            <td class="text-center">{{$data->status}}</td>
                        </tr>
                        <tr>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="2" class="bg-blue color-palette text-center">Simpanan Pokok</th>
                            <th colspan="2" class="bg-blue color-palette text-center">Simpanan Pokok</th>
                            <th colspan="2" class="bg-blue color-palette text-center">Simpanan Pokok</th>
                            <th colspan="1" class="bg-blue color-palette text-center">JUMLAH</th>
                        </tr>
                        <tr>
                            <td class="text-center text-red" colspan="2">{{format_uang($data->simpanan_pokok)}}</td>
                            <td class="text-center text-red" colspan="2">{{format_uang($data->simpanan_wajib)}}</td>
                            <td class="text-center text-red" colspan="2">{{format_uang($data->simpanan_sukarela)}}</td>
                            <td class="text-center text-red" colspan="1">{{format_uang($data->jumlah_pengambilan)}}</td>
                        </tr>
                    </thead>
                </table>

                <div class="form-group">
                    <label  class="col-md-6 control-label ">Persetujuan</label>

                <div class="col-md-6">
                    <select name="ttd_ketua" type="text" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" value="{{$data->ttd_ketua}}">
                        <option value="{{$data->ttd_ketua}}"readonly>{{$data->ttd_ketua}} (current)</option>
                        <option  value="Approved">Approved</option>
                        <option value="Not Approved">Not Approved</option>
                    </select>
                </div>
            </div>
            <input name="tgl_disetujui_ketua" type="hidden" class="form-control" value="{{date(now())}}">
            <input name="disetujui_ketua" type="hidden" class="form-control" value="{{Auth::user()->name}}">
            <input name="notifikasi" type="hidden" class="form-control" value="Re : Permohonan penarikan dana simpanan" readonly>
                @endforeach
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-5">
                        <button type="submit" class="btn btn-primary hint--top" aria-label="Simpan">SUBMIT</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</form>
</session>
@endsection