@extends ('layout.v_template')
@section('title','Pinjaman')

@section('content')
<section class="content-header">
      <h1>PINJAMAN KREDIT
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
                @if (session('pesan'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Success!</h4>
                  {{session('pesan')}}.
                </div>
                @endif
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
              
                <form action="{{route('v_pinjam')}}" method="post">
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
                    <a href="/pinjam" type="button" name="refresh" id="refresh" class="btn btn-success tn-sm hint--top" aria-label="Refresh"><i class="fa fa-refresh"></i></a>
                    <a href="" onclick="this.href='/cetak-data-pinjaman-pertanggal/'+ document.getElementById('fromDate').value + '/' + document.getElementById('toDate').value "target="_blank"class="btn btn-warning tn-sm hint--top" aria-label="Cetak"><i class="fa fa-print"></i></a>
                    <a href="{{ route('exportpinjaman')}}" class="btn btn-default tn-sm hint--top" aria-label="Download"><i class="fa fa-upload"></i></a>
                  </form>
              </div>
              </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-header">
            <div class="box-body table-responsive no-padding">

                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead class="bg-blue" style="color: #F8F8FF">
                <tr>
                <th>No.</th>
                <th>Tgl</th>
                <!-- <th>PHOTO</th> -->
                <th>INFORMASI PEMOHON</th>
                <th>Plafon</th>
                <th>TENOR</th>
                <th>ADMIN</th>
                <th>HRBP</th>
                <th>KETUA</th>
                <th>STATUS</th>
                <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; ?>
               @foreach($pinjaman as $key => $data )
                <tr>
                <td >{{ $no++}}</td>
                <td >{{Carbon\Carbon::parse($data->tgl_pengajuan)->format("d-m-y")}}</td>
                <!-- <td ><a href="{{ url('anggota/'.$data->nik_ktp) }}"> <img src="{{ asset('public/public/foto_pegawai/'.$data->foto_pegawai) }}" alt="user-avatar" class="img-responsive img-circle" style="height: 50px;width: 50px;"></a></td> -->
                <td >{{$data->nama}}<br>
                <small class="text-red">Nik.{{$data->nik_ktp}}<br><a href="https://api.whatsapp.com/send?phone=62{{$data->telp}}" target="_blank">{{$data->telp}}</a></small></td>
                <td >{{format_uang($data->plafon)}}<br><small class="text-blue">{{$data->jenis_pinjaman}}</small></td>
                <td >{{$data->tenor}} Bln</td>
                <td style="font-size: 22px">
                  <center>
                  <?php
                    if($data->status_pengajuan == "WAITING VERIFIED")
                    echo '<i class="fa fa-warning text-orange"></i>';
                    elseif ($data->status_pengajuan == "PENDING")
                    echo '<i class="fa fa-stop-circle text-yellow"></i>';
                    elseif ($data->status_pengajuan == "VERIFIED")
                    echo '<i class="fa fa-check-circle text-green"></i>';
                    else 
                    echo '<i class="fa fa-ban text-red"></i>';
                    ?></center>
                </td>
                <td style="font-size: 22px">
                <center>
                  <?php
                    if($data->ttd_hrbp == "WAITING APPROVAL")
                    echo '<i class="fa fa-warning text-orange"></i>';
                    elseif ($data->ttd_hrbp == "APPROVED")
                    echo '<i class="fa fa-check-circle text-green"></i>';
                    elseif ($data->ttd_hrbp == "PENDING")
                    echo '<i class="fa fa-stop-circle text-yellow"></i>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?></center>
                </td>
                <td style="font-size: 22px">
                <center>
                  <?php
                    if($data->ttd_ketua == "WAITING APPROVAL")
                    echo '<i class="fa fa-warning text-orange"></i>';
                    elseif ($data->ttd_ketua == "APPROVED")
                    echo '<i class="fa fa-check-circle text-green"></i>';
                    elseif ($data->ttd_ketua == "PENDING")
                    echo '<i class="fa fa-stop-circle text-yellow"></i>';
                    else 
                    echo '<span class="badge bg-red"><i class="fa fa-ban"></i></span>';
                    ?></center>
                </td>
                
                <td><h5
                class="label 
                  <?php
                    if($data->posisi == "Belum BS")
                    echo 'label-warning';
                    elseif ($data->posisi == "Belum Akad")
                    echo 'label-warning';
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
                
                <td >
                <a  href="/pinjam/editAkad/{{$data->no_pinjaman}}" class="btn btn-default btn-sm">Edit</a>
                <a  href="/pinjamanSaya/detail/{{$data->no_pinjaman}}" class="btn btn-default btn-sm  
                <?php
                if($data->ttd_ketua && $data->ttd_hrbp == "Waiting Approval")
                echo 'disabled';
                elseif($data->ttd_ketua && $data->ttd_hrbp == "Not Approved")
                echo 'disabled';
                else 
                echo '';?> ">View</a>

                 <!-- <a href="
                <?php
                if($data->jenis_pinjaman == "Pengembangan")
                echo "/pinjam/cetak/{$data->no_pinjaman}";
                else 
                echo "/pinjam/cetakNonProfit/{$data->no_pinjaman}";
                ?>" target="_blank" class="btn btn-default btn-sm"  type="button">Print Pengajuan</a> -->
                
              <a href="/pinjam/cetak-akad/{{$data->no_pinjaman}}" type="button" target="_blank" class="btn btn-sm  btn-default hint--top
              <?php
                if($data->ttd_ketua == "APPROVED" && $data->posisi == "Pencairan")
                echo '';
                elseif ($data->ttd_ketua == "APPROVED" && $data->posisi == "Belum Akad")
                echo '';
                else
                echo 'disabled';?>" aria-label="Print Akad"  type="button">Akad</a>    
              <button type="button" class="btn btn-danger btn-sm  hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$data->no_pinjaman}}">Hapus</button>
              </td>
                  
                </tr>
              @endforeach
                </tbody>
                <tfoot>
                  
                </tfoot>
              </table>
        <div class="pull-right">
              <h5>Summary <span class="badge badge-secondary"> {{"Rp. ".format_uang($jumlahPinjaman)}}</span></h5>
          </div>
              @foreach($pinjaman as $data ) 
              <div class="modal modal-default fade" id="delete{{$data->no_pinjaman}}" style="display: none;">
              <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-red">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Konfirmasi penghapusan data nomor [P-{{$data->no_pinjaman}}]</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box-body">
                      <div class="form-group">
                        <div class="row">
                          <div  class="col-xs-4 text-center">
                            <label>Nama</label>
                            <p>{{$data->nama}}</p>
                          </div>
                          
                          <div class="col-xs-4 text-center">
                            <label>NIK</label>
                            <p>{{$data->nik_karyawan}}</p>
                          </div>

                          <div class="col-xs-4 text-center">
                          <label>Status</label>
                          </div>
                        </div><hr>
                        
                        <div class="row">
                          <div class="col-xs-4 text-center">
                          <label>Nama Barang</label><br>
                            <small>{{$data->nama_barang}}</small>
                          </div>

                          <div class="col-xs-4 text-center">
                          <label>Merk</label><br>
                          <small>{{$data->merk}}</small>
                          </div>

                          <div class="col-xs-4 text-center">
                          <label>Spesifikasi</label><br>
                          <small>{{$data->spesifikasi}}</small>
                          </div>

                        </div><hr>

                        <div class="row">
                          <div class="col-xs-4 text-center">
                          <label>Jumlah Unit</label><br>
                          <small>{{$data->unit}}</small>
                          </div>

                          <div class="col-xs-4 text-center">
                          <label>Pinjaman</label><br>
                            <small>{{format_uang($data->plafon)}}</small>
                          </div>

                          <div class="col-xs-4 text-center">
                          <label>Tenor</label><br>
                          <small >{{$data->tenor}} bulan</small>
                          </div>

                        </div><hr>

                        <div class="row">
                          <div class="col-xs-6 text-center">
                          <label> Kredit</label><br>
                          <small>{{format_uang($data->total_kredit)}}</small>
                          </div>

                          <div class="col-xs-6 text-center">
                          <label>Angsuran</label><br>
                            <small>{{format_uang($data->angsuran)}}</small>
                          </div>

                        </div>

                      </div>



                    <div class="form-group">

                    </div>

                    <div class="form-group">

                    </div>
                </div>
                  </div>
                  <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Batal</button>
                    <a href="/pinjam/delete/{{$data->no_pinjaman}}" class="btn btn-primary">Hapus</a>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
            </div>

            <div class="modal modal-info fade in" id="view{{$data->no_pinjaman}}" style="display: none;padding-right: 17px;">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Kode Pinjaman [P-{{$data->no_pinjaman}}]</h4><hr>
                    <div class="col-12">
                      <div class="col-sm-4">
                        Nama Karyawan <br>
                        Nik           <br>
                        Status        <br>
                      </div>
                      <div class="col-sm-1">
                        :<br>
                        :<br>
                        :<br>
                      </div>
                      <div class="col-sm-4">
                        {{$data->nama}}<br>
                        {{$data->nik_karyawan}}<br>
                        {{$data->jabatan}}<br><br>
                      </div>
                    </div>
                    
                    <div class="col-12">
                    <h6><p></p></h6>
                      <div class="col-sm-4">
                        Tgl Pengajuan<br>
                        Jenis Pinjaman<br>
                        Nama Barang<br>
                        Merk<br>
                        Spessifikasi<br>
                        Jumlah Unit<br>
                        Plafon Pinjaman<br>
                        Tenor<br>
                        Profit<br>
                        Jumlah Kredit<br>
                        Angsuran per bulan<br>
                        Status Pengajuan<br>
                      </div>
                      <div class="col-sm-1">
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                        :<br>
                      </div>
                      <div class="col-sm-4">
                        {{tanggal_local($data->tgl_pengajuan)}}<br>
                        {{$data->jenis_pinjaman}}<br>
                        {{$data->nama_barang}}<br>
                        {{$data->merk}}<br>
                        {{$data->spesifikasi}}<br>
                        {{$data->unit}}<br>
                        {{"Rp. ".format_uang($data->plafon)}}<br>
                        {{$data->tenor}} kali<br>
                        {{$data->bunga}} %<br>
                        {{"Rp. ".format_uang($data->total_kredit)}}<br>
                        {{"Rp. ".format_uang($data->angsuran)}}<br>
                        <span class="label
                          <?php
                        if($data->status_pengajuan == "WAITING APPROVAL")
                        echo 'label-warning';
                        elseif ($data->status_pengajuan == "APPROVED")
                        echo 'label-success';
                        else 
                        echo 'label-danger';
                        ?>">{{$data->status_pengajuan}}</span><br>
                      </div>
                    </div>
                  </div>
                  
                  <div class="modal-body">
                
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
            </div>
          @endforeach
  
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
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>

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
        url:'{{ route("v_pinjam") }}',
        data:{daterangepicker_start:daterangepicker_start, daterangepicker_end:daterangepicker_end}
      },
      columns: [
        {
          data:'tgl_pengajuan',
          name:'tgl_pengajuan'
        },
        {
          data:'no_pinjaman',
          name:'no_pinjaman'
        },
        {
          data:'nik_ktp',
          name:'nik_ktp'
        },
        {
          data:'nama',
          name:'nama'
        },
        {
          data:'plafon',
          name:'plafon'
        },
        {
          data:'telp',
          name:'telp'
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
        {
          data:'posisi',
          name:'posisi'
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