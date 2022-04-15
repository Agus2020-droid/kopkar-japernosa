@extends ('layout.v_template')
@section('title','Pinjaman')

@section('content')
<section class="content-header">
      <h1 style="color: #A52A2A;text-shadow: 0 5px 10px rgba(0,0,0,.2);"><label>PINJAMAN ANGGOTA</label> 
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Pinjaman</a></li>
      </ol>
    </section>
<!-- /.tabel 2 -->
<section class="content">
      <div class="row">
        <div class="col-xs-12">
        <!-- /.box -->
          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
          <!-- <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i> Info!</h4>
                Dokumen pengajuan bisa dicetak jika status pengajuan belum disetujui
              </div> -->
            <div class="box-header bg-blue-active color-palette">
              <div class="pull-left">
                <h5><strong>TABEL PINJAMAN ANGGOTA </strong></h5>
                </div>

            <div class="text-left">
              <div class="form-inline">
              
                <form action="{{route('v_pinjamBendahara')}}" method="post">
                @csrf
                <div class="pull-right">

                  <div class="form-group">
                    <label>Start:</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control input-sm" data-inputmask="'alias': 'dd/mm/yyyy'"  id="fromDate" name="fromDate"  required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>End :</label>

                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" class="form-control input-sm" data-inputmask="'alias': 'dd/mm/yyyy'"  id="toDate" name="toDate" placeholder="dd/mm/yyyy" required>
                    </div>
                  </div>
                <button  type="submit" name="filter" id="filter" class="btn btn-success tn-sm hint--top" aria-label="Search"><i class="fa fa-search"></i></button>
                <a href="/pinjamBendahara" type="button" name="refresh" id="refresh" class="btn btn-success tn-sm hint--top" aria-label="Refresh"><i class="fa fa-refresh"></i></a>
                <!-- <a href="" onclick="this.href='/cetak-data-pinjaman-pertanggal/'+ document.getElementById('fromDate').value + '/' + document.getElementById('toDate').value "target="_blank"class="btn btn-warning tn-sm hint--top" aria-label="Cetak"><i class="fa fa-print"></i></a> -->
              </form>
              </div>
              </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-header">
          <div class="box-body table-responsive no-padding">
            @if (session('pesan'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
              <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
              
              <thead>
                <tr>
                <th class="bg-blue">No.</th>
                <th class="bg-blue">Tgl</th>
                <!--<th>NIK</th>-->
                <th class="bg-blue">Nama</th>
                <th class="bg-blue">Telp</th>
                <th class="bg-blue">Plafon</th>
                <th class="bg-blue">Tenor</th>
                <th class="bg-blue">ADMIN</th>
                <th class="bg-blue">HRBP</th>
                <th class="bg-blue">KETUA</th>
                <th class="bg-blue">Status</th>
               
                <th class="bg-blue">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
               @foreach($pinjaman as $key => $data )
                <tr>
                <td >{{ $no++}}</td>
                <td >{{Carbon\Carbon::parse($data->tgl_pengajuan)->format("d-m-y")}}</td>
                <!--<td ><small>{{$data->nik_ktp}}</small></td>-->
                <td >{{$data->nama}}<br><small class="text-red">Nik.{{$data->nik_ktp}}</small></td>
                <td >{{$data->telp}}</td>
                <td >{{format_uang($data->plafon)}}<br><small class="text-blue">{{$data->jenis_pinjaman}}</small></td>
                <td >{{$data->tenor}} Bln</td>
                <td >
                  <?php
                    if($data->status_pengajuan == "WAITING VERIFIED")
                    echo '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i></span>';
                    elseif ($data->status_pengajuan == "PENDING")
                    echo '<span class="badge bg-gray"><i class="fa fa-history"></i></span>';
                    elseif ($data->status_pengajuan == "VERIFIED")
                    echo '<span class="badge bg-green"><i class="fa fa-check-circle bg-green"></i></span>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?>
                </td>
                <td>
                  <?php
                    if($data->ttd_hrbp == "WAITING APPROVAL")
                    echo '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i></span>';
                    elseif ($data->ttd_hrbp == "APPROVED")
                    echo '<span class="badge bg-green"><i class="fa fa-check-circle bg-green"></i></span>';
                    elseif ($data->ttd_hrbp == "PENDING")
                    echo '<span class="badge bg-gray"><i class="fa fa-history"></i></span>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?>
                </td>
                <td>
                <?php
                    if($data->ttd_ketua == "WAITING APPROVAL")
                    echo '<span class="badge bg-yellow"><i class="fa fa-clock-o"></i></span>';
                    elseif ($data->ttd_ketua == "APPROVED")
                    echo '<span class="badge bg-green"><i class="fa fa-check-circle bg-green"></i></span>';
                    elseif ($data->ttd_ketua == "PENDING")
                    echo '<span class="badge bg-gray"><i class="fa fa-history"></i></span>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?>
                </td>
                <td><h5
                class="label 
                  <?php
                    if($data->posisi == "Belum BS")
                    echo 'label-warning';
                    elseif ($data->posisi == "Belum Akad")
                    echo 'label-success';
                    elseif ($data->posisi == "Non Pengembangan")
                    echo 'label-info';
                    elseif ($data->posisi == "Sudah Akad")
                    echo 'label-success';
                    elseif ($data->posisi == "Pengajuan")
                    echo 'label-primary';
                    else 
                    echo 'label-danger';
                    ?>">{{$data->posisi}}</h5>
                </td>
                <td>
                <a href="/angsuran/tambah/{{$data->no_pinjaman}}" class="btn btn-success btn-sm hint--top" aria-label="Pembayaran"><i class="fa fa-money"></i></a>
                </td>
                </tr>
              @endforeach
                </tbody>
              </table>
                  <div class="pull-right">
              <h5>Summary <span class="badge badge-secondary">{{"Rp. ".format_uang($jumlahPinjamanTotal)}}</span></h5>
                  </div>


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
<script>
$(document).ready(function){
  $('.input-daterange').datepicker({
    todayBtn:'linked',
    format:'yyy-mm-dd',
    autoclose;true
  });

  load_data();

  function load_data(daterangepicker_start = '', daterangepicker_end = '')
  {
    $('#order_table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url:'{{ route("v_pinjamBendahara") }}',
        data:{daterangepicker_start:daterangepicker_start, daterangepicker_end:daterangepicker_end}
      },
      columns: [
        {
          data:'tgl_pengajuan',
          name:'tgl_pengajuan'
        },
        {
          data:'nik_karyawan',
          name:'nik_karyawan'
        },
        {
          data:'nama',
          name:'nama'
        },
        {
          data:'total_kredit',
          name:'total_kredit'
        },
        {
          data:'status_pengajuan',
          name:'status_pengajuan'
        },
        {
          data:'ttd_ketua',
          name:'ttd_ketua'
        }
        {
          data:'ttd_hrbp',
          name:'ttd_hrbp'
        },
      ]

    });
  }
  $('#filter').click(function()) {
    var daterangepicker_start = $('#daterangepicker_start').val();
    var daterangepicker_end = $('#daterangepicker_end').val();
    if(daterangepicker_start !='' && daterangepicker_end != '')
    {
      $('#order_table').DataTable().destroy();
      load_data(daterangepicker_start, daterangepicker_end);
    }
    else {
      alert('Both Date is Required');
    }
  });
  $('#refresh').click(function() {
    $('#fromDate').val('');
    $('#toDate').val('');
    $('#order_table').DataTable().destroy();
    load_data();
  });

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
<!-- tabel2 -->
@endsection