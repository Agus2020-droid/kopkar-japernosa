@extends ('layout.v_template')
@section('title','Detail Pinjaman Saya')

@section('content')
<session class="content"> 
@foreach ($pinjaman as $key => $data)
<form class="form-horizontal" action="#" method="" enctype="multipart/form-data">
<div class="col-md-12">
  <div class="box box-primary" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
  <div class="box-header with-border bg-blue color-palette">
  <h3 class="box-title">INFORMASI PINJAMAN KREDIT</h3>
  <!-- <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool hint--top" aria-label="View/Hide" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button type="button" class="btn btn-box-tool hint--top" aria-label="Close" data-widget="remove"><i class="fa fa-remove"></i></button>
  </div> -->
</div>
<div class="box-body">

<table id="example1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
      <thead>
      <tr>
      <th colspan="3" class="bg-primary color-palette"><h4>INFORMASI PEMOHON</h4></th>
      </tr>
      </thead>
      <tbody>
      <tr>
      <td >
      <div class="box-body">
      <div class="row">               
        <div class="col-md-12 text-center">
        <img class="profile-user-img img-responsive rounded-circle" src="{{ url('public/public/foto_pegawai/'.$data->foto_pegawai) }}" alt="">
        <span class="
          <?php
            if($data->status == "NON AKTIF")
            echo 'label label-danger';
            else
            echo ' label label-success';
            ?>
            ">{{$data->status}}</span>
      </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-2">
          <label>NIK KTP</label>
        </div>
        
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->nik_ktp}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>NAMA LENGKAP</label>
        </div>
        
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->nama}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>NIK KARYAWAN</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->nik_karyawan}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>STATUS KEPEGAWAIAN</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->jabatan}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>TGL MASUK KERJA</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{Carbon\Carbon::parse($data->tgl_masuk)->format(" d M Y")}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>USIA </label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="<?php
            // tanggal lahir
            $tanggal = new DateTime($data->tgl_lahir);

            // tanggal hari ini
            $today = new DateTime('today');

            // tahun
            $y = $today->diff($tanggal)->y;

            // bulan
            $m = $today->diff($tanggal)->m;

            // hari
            $d = $today->diff($tanggal)->d;
            echo  $y . " Tahun " . $m . " Bulan " . $d . " Hari";
            ?>" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>NO. TELP</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->telp}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>ALAMAT</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->alamat}}" readonly>
        </div>
      </div>
    </div>
      </td>
      </tr>
      
      </tbody>
</table>
<input name="tgl_disetujui_hrbp" type="hidden" class="form-control" value="{{date(now())}}"readonly>
<input name="disetujui_hrbp" type="hidden" class="form-control" value="{{Auth::user()->nik_ktp}}">
<!-- /.col -->
    <div class="box-header bg-blue color-palette">
      <h3 class="box-title">DETAIL PINJAMAN</h3>
    </div>
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
      <thead>
      <tr>
      </tr>
      </thead>
      <tbody>
      <tr>
      <td >
      <div class="box-body">
      <div class="row">
        <div class="col-md-2">
          <label>KODE PINJAMAN</label>
        </div>
        
        <div class="col-md-10">
          <input type="text" class="form-control" value="P-{{$data->no_pinjaman}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>TANGGAL PENGAJUAN</label>
        </div>
        
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{Carbon\Carbon::parse($data->tgl_pengajuan)->format("d-M-y H:i:s")}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>JENIS PINJAMAN</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->jenis_pinjaman}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>NAMA BARANG</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->nama_barang}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>MERK</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->merk}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>SPESIFIKASI</label>
        </div>
        <div class="col-md-10">
        <input type="text" class="form-control" value="{{$data->spesifikasi}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>PLAFON</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->plafon}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>TENOR</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->tenor}} bulan" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>JATUH TEMPO</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{Carbon\Carbon::parse($data->periode_angsuran)->format("M Y")}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>PENGEMBANGAN</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="{{$data->bunga}} %" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>TOTAL KREDIT</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="Rp. {{format_uang($data->total_kredit)}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>ANGSURAN</label>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" value="Rp. {{format_uang($data->angsuran)}} / bulan" readonly>
        </div>
      </div>
    </div>
      </td>
      </tr>
      
      </tbody>
</table>
    
    <div class="box box-primary">
    </div>
    <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example1_info">
      <thead>
      <tr>
      </tr>
      </thead>
      <tbody>
      <tr>
      <td >
      <div class="box-body">
      <div class="row">
        <div class="col-md-2">
          <label>TANGGAL VERIFIKASI</label>
        </div>
        
        <div class="col-md-4">
          <input type="text" class="form-control" value="{{Carbon\Carbon::parse($data->tgl_verifikasi)->format("d-M-y H:i:s")}}" readonly>
        </div>

        <div class="col-md-2">
          <label>NAMA ADMIN</label>
        </div>
        
        <div class="col-md-4">
          <input type="text" class="form-control" value="{{$data->verifikator}}" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2">
          <label>TANGGAL APPROVAL</label>
        </div>
        
        <div class="col-md-4">
          <input type="text" class="form-control" value="{{Carbon\Carbon::parse($data->tgl_disetujui_hrbp)->format("d-M-y H:i:s")}}" readonly>
        </div>

        <div class="col-md-2">
          <label>HRBP</label>
        </div>
        
        <div class="col-md-4">
        @foreach ($users_hrbp as $hrbp)
          <input type="text" class="form-control" value="{{$hrbp->name}}" readonly>
          @endforeach
        </div>
      </div>
    <div class="row">
      <div class="col-md-2">
          <label>TANGGAL APPROVAL</label>
        </div>
        
        <div class="col-md-4">
          <input type="text" class="form-control" value="{{Carbon\Carbon::parse($data->tgl_disetujui_ketua)->format("d-M-y H:i:s")}}" readonly>
        </div>

        <div class="col-md-2">
          <label>KETUA</label>
        </div>
        
        <div class="col-md-4">
        @foreach ($users_ketua as $ket)
          <input type="text" class="form-control" value="{{$ket->name}}" readonly>
          @endforeach
        </div>
    </div><br>
    <div class="row">
    <a type="button" href="/pinjamanSaya/cetakKwitansi/{{$data->no_pinjaman}}" class="btn btn-lg 
      <?php
          if(($data->total_kredit)-$jml_angsuran == 0)
          echo 'btn-success btn-block ';
          else 
          echo 'btn-danger btn-block disabled';
        ?> pull-right  
        <?php
        if($data->nik_ktp == auth()->user()->nik_ktp)
        echo '';
        else
        echo 'hidden';
        ?>" target="_blank">
      <?php
          if(($data->total_kredit)-$jml_angsuran == 0)
          echo 'LUNAS - CETAK BUKTI PELUNASAN';
          else 
          echo 'BELUM LUNAS';
        ?></a> 
</div>

      </td>
      </tr>
      
      </tbody>
</table>

    <div class="row">
        <input name="notifikasi" type="hidden" class="form-control" value="Re: Pinjaman {{$data->nama}}" readonly>
        @endforeach
      </div>
    </div>
  </div>
</form>







<div class="row">

  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
    
        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true" class="bg-blue">Detail Angsuran</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="settings">
        <div class="box-body table-responsive no-padding">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="bg-navy-active color-palette text-center">Angsuran Ke-</th>
                        <th class="bg-navy-active color-palette text-center">Kode Angsuran</th>
                        <th class="bg-navy-active color-palette text-center">Bulan Angsuran </th>
                        <th class="bg-navy-active color-palette text-center">Jumlah Angsuran</th>
                        <th class="bg-navy-active color-palette text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; ?>
                      <tr>
                        @foreach ($angsuran as $item)
                        <td class="text-center">{{ $no++}}</td>
                        <td class="text-center">A-{{$item->id_angsuran}}</td>
                        <td class="text-center">{{Carbon\Carbon::parse($item->tgl_angsuran)->format("M Y")}}</td>
                        <td class="text-right">Rp. {{format_uang($item->jumlah_angsuran)}}</td>
                        <td class="text-center"><span class="label label-success">Verified</span></td>  
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <th></th>
                    <th></th>
                    <th class="text-right">SISA ANGSURAN</th>
                    <th class="text-right 
                    <?php
                    if($jml_angsuran-$total_kredit < 0)
                    echo 'bg-red';
                    else
                    echo '';?>">{{"Rp. ".format_uang($jml_angsuran-$total_kredit)}} </th>
                    <th></th>
                    </tr>
                    </tfoot>
                    <tfoot>
                    <tr>
                    <th></th>
                    <th></th>
                    <th class="text-right">JUMLAH</th>
                    <th class="text-right">{{"Rp. ".format_uang($jml_angsuran)}} </th>
                    <th></th>
                    </tr>
                    </tfoot>
                  </table>

                </div>
                
        </div>
        <!-- /.tab-pane -->
                 
      </div>
      <!-- /.tab-content -->

    </div>
    <!-- /.nav-tabs-custom -->

  </div>

  
  <!-- /.col -->
</div>
<!-- /.row -->

</session>


@endsection