@extends ('layout.v_template')
@section('title','Tambah Angsuran')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
        <h1>ANGSURAN BARU
        <small>Form</small></h1>
        <ol class="breadcrumb">
          <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
          <li><a href="/angsuran">Angsuran</a></li>
          <li class="active">Angsuran Baru</li>
        </ol>
  </section><br>
<form class="form-horizontal" action="/angsuran/insert" method="post" enctype="multipart/form-data">
    @csrf
    @if (session('pesan'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
  <div class="box box-default">
    <div class="box-header with-border bg-blue color-palette">
      <h3 class="box-title ">Form Angsuran Baru</h3>

      <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
   
      <div class="box-body">
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Status</label>
          <div class="col-sm-2">
          <label class="control-label"></label>
 @foreach ($pinjaman as $data)
            <div class="col-sm-1">
            <?php 
            if($jml_angsuran-($data->total_kredit) == 0)
            echo '<h4><span class="label label-success">LUNAS</span></h4>';
            else if($jml_angsuran-($data->total_kredit) < 0)
            echo '<h4><span class="label label-warning">BELUM LUNAS</span></h4>';
            else
            echo '<h4><span class="label label-danger">KELEBIHAN ANGSURAN</span></h4>';
            ?>
            </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Tanggal Angsuran</label>
         
          <div class="col-sm-3">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input name="tgl_angsuran" type="text" id="datepicker" class="form-control">
            </div>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Kode Pinjaman</label>
          <div class="col-sm-2">
            <input name="no_pinjaman" type="text" class="form-control" value="{{$data->no_pinjaman}}"readonly> 
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">NIK KTP</label>

          <div class="col-sm-3">
            <input name="nik_ktp" type="text" class="form-control" value="{{$data->nik_ktp}}"readonly>
          </div>
        </div>
         <!-- form group -->
         <div class="form-group">
          <label class="col-sm-3 control-label">Nama Anggota</label>

          <div class="col-sm-3">
            <input  type="text" class="form-control" value="{{$data->nama}}"readonly>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Jenis Pinjaman</label>

          <div class="col-sm-3">
            <input  type="text" class="form-control" value="{{$data->jenis_pinjaman}}" readonly>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Nama Barang / Jasa</label>

          <div class="col-sm-8">
            <input  type="text" class="form-control" value="{{$data->nama_barang}} - {{$data->merk}} - {{$data->spesifikasi}} " readonly>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Plafon</label>

          <div class="col-sm-2">
            <input  type="text" class="form-control text-right" value="@currency($data->plafon) " readonly>
          </div>
        </div>
         <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Total Kredit</label>

          <div class="col-sm-2">
            <input  type="text" class="form-control text-right" value="@currency($data->total_kredit) " readonly>
          </div>
        </div>
                 <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Angsuran per bulan</label>

          <div class="col-sm-2">
            <input  type="text" class="form-control text-right" value="@currency($data->angsuran) " readonly>
          </div>
        </div>
         <!-- form group -->
         <div class="form-group">
          <label class="col-sm-3 control-label">Total sudah di angsur</label>

          <div class="col-sm-2">
            <input  type="text" class="form-control text-right" value="@currency($jml_angsuran) " readonly>
          </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Sisa Kredit </label>
          <div class="col-sm-2 ">
          <input  type="text" class="form-control text-right 
          <?php
          if($jml_angsuran-($data->total_kredit) == 0) 
          echo 'bg-green';
          else if($jml_angsuran-($data->total_kredit) < 0) 
          echo 'bg-red';
          else 
          echo 'bg-aqua';
          ?>
          
          
          bg-red" value="@currency($jml_angsuran-($data->total_kredit))" readonly>
            </div>
        </div>
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label">Pembayaran Angsuran</label>

          <div class="col-sm-3">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-dollar"></i>
              </div>
                <input name="jumlah_angsuran" type="text" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control text-right" placeholder="masukan jumlah angsuran" value="{{old('jumlah_angsuran')}}" 
                <?php
                if($jml_angsuran-($data->total_kredit) == 0) 
                echo 'disabled';
                else if($jml_angsuran-($data->total_kredit) < 0) 
                echo ' ';
                else 
                echo ' ';
                ?>>
                  <div class="text-danger">
                        @error('jumlah_angsuran')
                        {{$message}}
                        @enderror
                  </div> 
              </div>
          </div>
        </div>
        @endforeach
        <!-- form group -->
        <div class="form-group">
          <label class="col-sm-3 control-label"></label>

          <div class="col-sm-4">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
        
      </div>
      <!-- /.box-footer -->
    </form>
  
@endsection