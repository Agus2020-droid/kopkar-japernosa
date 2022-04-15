@extends ('layout.v_template')
@section('title','Potongan Gaji')

@section('content')
<section class="content-header">
      <h1>POTONGAN GAJI ANGGOTA
      <small>Tabel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">Pemotongan Gaji</li>
        
      </ol>
    </section>
<!-- Box Content -->
<section class="content">
  <div class="row">
  <div class="col-xs-12">
  <div class="box">
  @if (session('pesan'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Success!</h4>
    {{session('pesan')}}.
  </div>
  @endif
  @if (isset($errors) && $errors->any())
  <div class="alert alert-danger">
      @foreach($errors->all() as $error)
      {{$error}}
      @endforeach 
  </div>
  @endif
    <div class="box-header bg-blue-active color-palette">
      <div class="pull-left">
        <h5><strong>TABEL POTONGAN GAJI ANGGOTA</strong></h5>
      </div>        
      
      <div class="text-left">
        <div class="form-inline">
        
          <form action="{{route('v_potonggaji')}}" method="post">
          @csrf
            <div class="pull-right">
              
                <div class="form-group">
                  <label>Start Date :</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control input-sm" data-inputmask="'alias': 'dd/mm/yyyy'"  id="fromDate" name="fromDate"  required>
                  </div>
                </div>

                <div class="form-group">
                  <label>End Date :</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="date" class="form-control input-sm" data-inputmask="'alias': 'dd/mm/yyyy'"  id="toDate" name="toDate" placeholder="dd/mm/yyyy" required>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label>Pilih Tanggal:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation" required>
                  </div>
                </div> -->

                <button  type="submit" name="filter" id="filter" class="btn btn-success tn-sm hint--top" aria-label="Search"><i class="fa fa-search"></i></button>
                <a href="/potongan" type="button" name="refresh" id="refresh" class="btn btn-success tn-sm hint--top" aria-label="Refresh"><i class="fa fa-refresh"></i></a>
                <a href="#"  class="btn btn-warning btn-sm hint--top" aria-label="Upload" data-toggle="modal" data-target="#modal-info"><i class="fa fa-upload"></i></a>
              
            </div>
            
          </form>
        </div>
      </div>
    </div>



<div class="box-primary">
    <div class="box-header">      
      <div class="box-body table-responsive no-padding">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th class="bg-blue color-palette"><p class="text-center">No.</th>
            <th class="bg-blue color-palette"><p class="text-center">Kode</th>
            <th class="bg-blue color-palette"><p class="text-center">Nik KTP</th>
            <th class="bg-blue color-palette"><p class="text-center">Periode</th>
            <th class="bg-blue color-palette"><p class="text-center">Jumlah</th>
            <th class="bg-blue color-palette"><p class="text-center">Status</th>
            <th class="bg-blue color-palette"><p class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach($query as $potong)
            <tr>
            <th class="text-center"><h5>{{$no++}}</h5></th>
            <th class="text-center"><h5>{{$potong->kode_potongan}}</h5></th>
            <th ><h5>{{$potong->nama}}</h5></th>
            <th class="text-center"><h5>{{Carbon\Carbon::parse($potong->tgl_potongan)->format(" d M Y")}}</h5></th>
            <th class="text-right"><h5>@currency($potong->jumlah_potongan)</h5></th>
            <th class="text-center"><span class="label label-success">{{$potong->status_potongan}}</span></th>
            <td class="text-center"><a href="/potongan/edit/{{$potong->id_potongan}}" class="btn btn-warning btn-sm" ><i class="fa fa-pencil"></i></a>
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$potong->id}}"><i class="fa fa-trash-o"></i></button>
              </td>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        @foreach ($query as $pot)
        <div class="modal modal-danger fade" id="delete{{$pot->id}}" style="display: none;">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">{{$pot->nik_ktp}}</h4>
              </div>
              <div class="modal-body">
                <p>Apakah Anda Yakin Akan Menghapus Data Ini ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
                <a href="/potongan/delete/{{$pot->id_potongan}}" class="btn btn-outline">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
        @endforeach
        <!-- /.modal-import-->
          <div class="modal modal-info fade" id="modal-info" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Import Data</h4>
                </div>
                <form action="{{ route('importpotongan') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                      {{csrf_field()}}
                        <div class="form-group">
                          <input type="file" name="file" required="required">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Selesai</button>
                      <button type="submit" class="btn btn-outline">Import</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          </div>
        <!-- /.modal-import -->
      </div>
    </div>
  </div>
          <!-- /.col (right) -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
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
        url:'{{ route("v_potonggaji") }}',
        data:{daterangepicker_start:daterangepicker_start, daterangepicker_end:daterangepicker_end}
      },
      columns: [
        {
          data:'id_potongan',
          name:'id_potongan'
        },
        {
          data:'nik_ktp',
          name:'nik_ktp'
        },
        {
          data:'tgl_potongan',
          name:'tgl_potongan'
        },
        {
          data:'jumlah_potongan',
          name:'jumlah_potongan'
        },
        {
          data:'status_potongan',
          name:'status_potongan'
        },
        {
          data:'created_at',
          name:'created_at'
        }
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

@endsection