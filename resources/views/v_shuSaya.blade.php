@extends ('layout.v_template')
@section('title','SHU Saya')

@section('content')
<section class="content-header">
      <h1>SISA HASIL USAHA (SHU)
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/anggotakopkar"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}">Profile</a></li>
        <li class="active"><a href="#">SHU</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
          <div class="box-header bg-gray-active">
              <table>
                  <tbody>
                  @foreach ($pegawai as $item)
                    <tr style="font-size:16px;height: 20px">
                      <td width="40%">NAMA</td>
                      <td width="20%">:</td>
                      <td width="40%">{{$item->nama}}</td>
                    </tr>
                    <tr style="font-size:16px;height: 40px">
                      <td>NIK KARYAWAN</td>
                      <td>:</td>
                      <td>{{$item->nik_karyawan}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>  
            </div>
            <!-- /.box-header -->
            <div class="box-header">
              <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                    <th class="bg-blue-active color-palette"><p class="text-center">No.</th>
                    <th class="bg-blue-active color-palette"><p class="text-center">Kode</th>
                    <th class="bg-blue-active color-palette"><p class="text-center">Tanggal Dikeluarkan</th>
                    <th class="bg-blue-active color-palette"><p class="text-center">Jumlah SHU</th>
                    <th class="bg-blue-active color-palette"><p class="text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; ?>
                  @foreach ($shu as $item)
                  <tr>
                  <td class="text-center">{{ $no++}}</td>
                  <td class="text-center">SHU-{{$item->id_shu}}</td>
                  <td class="text-center">{{tanggal_local($item->tgl_shu)}}</td>
                  <td class="text-right">@currency($item->jumlah_shu)</td>
                  <td class="text-center">
                    <!-- <a href="#" data-toggle="modal" data-target="#detail_shu" class="btn btn-md btn-primary" type="button">Detail</a> -->
                    <a href="/downloadSlipShu/{{$item->nik_ktp}}" class="btn btn-md btn-primary" type="button"><i class="fa fa-download"></i> PDF</a>
                  </td>
                  </tr>
                  @endforeach
                </tbody>
                </table>

            <!-- /.modal-import file-->
            @foreach ($pegawai as $item)
            <div class="modal modal-info fade" id="detail_shu" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">SLIP SHU</h4>
                  </div>
                      <div class="modal-body ">
                        <div class="box box-header card login-card border-success table-responsive" style="border-width: 3px; padding: 1.5em .5em .5em;border-radius: 0.5em;
    box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <img src="{{asset('kop.png')}}" alt="" width="500px"><hr>
                        <CENTER><LABEL>SLIP SHU</LABEL></CENTER>
                          <div class="col-sm-3">
                           <p>Nama Anggota :</P>
                           <p>NIK Karyawan  :</p> 
                          </div>
                          <div class="col-sm-9 text-right">
                           <p>{{$item->nama}}</p>
                           <p>{{$item->nik_ktp}}</p> 
                          </div>                         
                          <div class="col-sm-5">
                           <p>Simpanan Pokok  :</P>
                           <p>Simpanan Wajib  :</p> 
                           <p>SHU Peran Wanamart </p>  
                             <p><i class="fa fa-book"></i> Peran Belanja</p>
                             <p><i class="fa fa-book"></i> Peran Simpanan</p>
                            <p>Pendapatan Lain-Lain </p>  
                            <p>SHU Peran Kredit </p>  
                             <p><i class="fa fa-book"></i> Peran Kredit</p>
                             <p><i class="fa fa-book"></i> Peran Simpanan</p>
                            <p>Pengurus </p>  
                            <p>Potongan </p>  
                            <center><p><b>JUMLAH SHU</b></p>  </center>
                          </div>
                          @foreach ($shu as $item)
                          <div class="col-sm-7 text-right">
                           <p>{{format_uang($item->simpanan_pokok)}}</P>
                           <p>{{format_uang($item->simpanan_wajib)}}</p> 
                           <p>***************************************</p> 
                            <p>{{format_uang($item->peran_belanja_wanamart)}}</p>
                            <p>{{format_uang($item->peran_simpanan_wanamart)}}</p>
                            <p>{{format_uang($item->lain_lain)}}</p>
                            <p>**************************************</p> 
                            <p>{{format_uang($item->peran_kredit)}}</p>
                            <p>{{format_uang($item->peran_simpanan)}}</p>
                            <p>{{format_uang($item->pengurus)}}</p>
                            <p>{{format_uang($item->potongan)}}</p>
                            <p><b>{{format_uang($item->jumlah_shu)}}</b></p>
                          </div>
                          @endforeach
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">CLOSE</button>
                        <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">DOWNLOAD PDF</button>
                      </div>
                </div>
              </div>
            </div>
            @endforeach
            <!-- /.modal-import-->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>
@endsection