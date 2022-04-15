@extends ('layout.v_template')
@section('title','Pinjaman ')

@section('content')
<section class="content-header">
      <h1>PINJAMAN KREDIT
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}">Profile</a></li>
        <li class="active">Pinjaman Kredit</a></li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
        
          <!-- /.box -->

          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
              <div class="box-header bg-blue-active color-palette">
                <div class="row">
                  <div class="col-sm-3 ">
                    <ul class="list-group ">
                      <li class="list-group">
                        <b>Nama</b> <p class="pull-right"> {{$pegawai->nama}}</p>
                      </li>
                      <li class="list-group">
                        <b>NIK</b> <p class="pull-right">{{$pegawai->nik_karyawan}}</p>
                      </li>
                    </ul>

                  </div>

                  <div class="col-sm-12 ">
                  <a href="{{ url('tambahpinjaman/'.$pegawai->nik_ktp) }}" class="btn btn-info btn-block
                    <?php
                    if($total_kredit-$jml_angsuran > 0)
                    echo 'disabled';
                    elseif ($pegawai->status == "NON AKTIF")
                    echo 'disabled';
                    else
                    echo '';
                    ?>" role="button" aria-label="Klik"><i class="fa fa-plus"> </i> PENGAJUAN PINJAMAN</a> 
                </div>
                  
                </div>
              </div>

            <!-- /.box-header -->
            <div class="box-header">
              <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                 <thead>
                 <tr>
                <th rowspan="2" class="text-center bg-primary color-palette">No.</th>
                <th rowspan="2" class="text-center bg-primary color-palette">Tanggal</th>
                <th rowspan="2" class="text-center bg-primary color-palette">KODE</th>
                <th rowspan="2" class="text-center bg-primary color-palette">Nama</th>
                
                <th rowspan="2" class="text-center bg-primary color-palette">Plafon</th>
                <th colspan="3" class="text-center bg-primary color-palette">Persetujuan</th>
                <th rowspan="2" class="text-center bg-primary color-palette">Action</th>
                  <tr>
                  <th class="text-center bg-primary color-palette">ADMIN</th>
                  <th class="text-center bg-primary color-palette">HRBP</th>
                  <th class="text-center bg-primary color-palette">KETUA</th>
                  </tr>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
                @foreach ($pinjaman as $item)
                <tr>
                  <td >{{ $no++}}</td>
                  <td >{{Carbon\Carbon::parse($item->tgl_pengajuan)->format("d-M-y")}}</td>
                  <td >P - {{$item->no_pinjaman}}</td>
                  <td >{{$item->nama_barang}}</td>
                  <td >{{"Rp. ".format_uang($item->plafon)}}</td>
                  <td ><span class="label
                  <?php
                if($item->status_pengajuan == "WAITING VERIFIED")
                echo 'label-warning';
                elseif ($item->status_pengajuan == "VERIFIED")
                echo 'label-success';
                else 
                echo 'label-danger';
                ?>">{{$item->status_pengajuan}}</span></td>
                <td>
                <h5 class="label 
                  <?php
                    if($item->ttd_hrbp == "WAITING APPROVAL")
                    echo 'label-warning';
                    elseif ($item->ttd_hrbp == "PENDING")
                    echo 'label-warning';
                    elseif ($item->ttd_hrbp == "APPROVED")
                    echo 'label-success';
                    else 
                    echo 'label-danger';
                    ?>">{{$item->ttd_hrbp}}
                  </h5>
                </td>
                <td>
                <h5 class="label 
                  <?php
                    if($item->ttd_ketua == "WAITING APPROVAL")
                    echo 'label-warning';
                    elseif ($item->ttd_ketua == "PENDING")
                    echo 'label-warning';
                    elseif ($item->ttd_ketua == "APPROVED")
                    echo 'label-success';
                    else 
                    echo 'label-danger';
                    ?>">{{$item->ttd_ketua}}
                  </h5>
                </td>

                <td class="text-center">
                  <a href="{{ url('pinjamanSaya/detail/'.$item->no_pinjaman) }}" class="btn btn-primary btn-sm 
                  <?php
                    if($item->ttd_ketua == "APPROVED" && $item->ttd_hrbp == "APPROVED")
                    echo '';
                    else 
                    echo 'disabled';?>
                    " ><i class="fa fa-eye"></i>  Lihat Detail</a>
                    </td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@endsection