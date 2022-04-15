@extends ('layout.v_template')
@section('title','Edit Pengambilan Dana')

@section('content')
<section class="content-header">
      <h1>EDIT PENGAMBILAN SIMPANAN
      <SMALl>Form</SMALl></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/pengambilan">Pengambilan Dana</a></li>
        <li class="active">Detail Pengambilan</a></li>
      </ol>
    </section>
<!-- /.pembatas -->
<session class="content">
@foreach ($pengambilan as $data)
<form class="form-horizontal" action="/pengambilan/update/{{$data->id_pengambilan}}" method="post" enctype="multipart/form-data">
   @csrf
     
         
      <div class="col-md-12">
        <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">Detail Pengambilan Simpanan</h3>
          <div class="box-tools pull-right">
          </div>
        </div>
        
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
 
            </ul>
            <div class="tab-content">
              <div class="tab-pane" id="activity">   
                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                    </div>
                  </form>
              </div>
              <div class="tab-pane active" id="settings">
                
                  <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota</label>

                    <div class="col-sm-5">
                      <input type="text" class="form-control" value="{{$data->nama}}" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label  for="inputName" class="col-sm-3 control-label">No. Pengambilan</label>

                    <div class="col-sm-4">
                      <input name="id_pengambilan" type="text" class="form-control" value="T-{{$data->id_pengambilan}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-3 control-label">Tanggal Pengajuan</label>

                    <div class="col-sm-4">
                      <input name="tgl_pengambilan" type="text" class="form-control "  value="{{tanggal_local($data->tgl_pengambilan)}}" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-3 control-label">Simpanan Pokok yang diambil</label>

                    <div class="col-sm-2">
                      <input name="simpanan_pokok" type="text" class="form-control bg-gray-active color-palette text-right"  value="@currency($data->simpanan_pokok)"readonly>
                    </div>
                    <!-- <label  class="col-sm-3 control-label">Saldo Simpanan Pokok </label>

                    <div class="col-sm-3">
                      <input type="text" class="form-control bg-gray-active color-palette text-right"  value="@currency($data->simpanan_pokok)"readonly>
                    </div> -->
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">Simpanan Wajib yang diambil</label>

                    <div class="col-sm-2">
                      <input name="simpanan_wajib" type="text" class="form-control bg-gray-active color-palette text-right"  value="@currency($data->simpanan_wajib)" readonly>
                    </div>
                    <!-- <label  class="col-sm-3 control-label">Saldo Simpanan Wajib </label>

                      <div class="col-sm-3">
                        <input type="text" class="form-control bg-gray-active color-palette text-right"  value="@currency($data->simpanan_pokok)"readonly>
                      </div> -->
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-3 control-label">Simpanan Sukarela yang diambil</label>

                    <div class="col-sm-2">
                      <input name="simpanan_sukarela" type="text" class="form-control bg-gray-active color-palette text-right" value="@currency($data->simpanan_sukarela)" readonly>
                    </div>
                    <!-- <label  class="col-sm-3 control-label">Saldo Simpanan Wajib </label>

                      <div class="col-sm-3">
                        <input type="text" class="form-control bg-gray-active color-palette text-right"  value="@currency($data->simpanan_pokok)"readonly>
                      </div> -->
                  </div>
                  <div class="form-group">
                    <label  class="col-sm-3 control-label">Jumlah Pengambilan</label>

                    <div class="col-sm-2">
                    <input name="jumlah_pengambilan" type="text" class="form-control bg-gray-active color-palette text-right" value="@currency($data->jumlah_pengambilan)" readonly>
                    </div>
                    <h5><i>( {{terbilang($data->jumlah_pengambilan)}} rupiah)</i></h5>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-3 control-label ">Status Pengajuan</label>

                    <div class="col-sm-6">
                    <select name="status_pengajuan" type="text" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" value="{{$data->status_pengajuan}}">
                        <option value="{{$data->status_pengajuan}}"readonly>{{$data->status_pengajuan}} (current)</option>
                        <option value="WAITING APPROVAL">WAITING APPROVAL</option>
                        <option  value="APPROVED">APPROVED</option>
                    </select>
                    </div>
                  </div>
                  @endforeach
                  <div class="form-group">
                 
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-primary hint--top" aria-label="Simpan">SIMPAN</button>
                        </div>
                
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

  </form>
</session>
@endsection