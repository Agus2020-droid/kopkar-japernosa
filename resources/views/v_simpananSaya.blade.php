@extends ('layout.v_template')
@section('title','Simpanan')

@section('content')
<section class="content-header">
      <h1>SIMPANAN TABUNGAN KOPERASI
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}">Profile</a></li>
        <li class="active">Simpanan Saya</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
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
                    <tr class="bg-gray">
                      <td colspan="3" class="text-center" style="font-size:20px">
                      SALDO SIMPANAN
                      </td>
                    </tr>
                    <tr class="bg-gray">
                      <td colspan="3" class="text-center" style="font-size:30px">
                      {{"Rp. ".format_uang($jml_simpanan)}}
                      </td>
                    </tr>
                  </tbody>
                </table>  
            </div>
        
            <!-- /.box-header -->
            
              <div class="box-header">

                <div class="box-body table-responsive no-padding">
                  <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                      <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Tgl Transaksi</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Pokok</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Wajib</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Sukarela</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Jumlah</th></tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach ($simpanan as $item)
                      <tr role="row" class="odd">
                        <td class="sorting_1">{{ $no++}}</td>
                        <td>{{Carbon\Carbon::parse($item->tgl_potongan)->format(" d M Y")}}</td>
                        <td>@currency($item->simpanan_pokok)</td>
                        <td>@currency($item->simpanan_wajib)</td>
                        <td>@currency($item->simpanan_sukarela)</td>
                        <td>@currency($item->jumlah_simpanan)</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
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