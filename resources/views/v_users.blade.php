@extends ('layout.v_template')
@section('title','user ')

@section('content')
<section class="content-header">
      <h1>USER ACCOUNT
      <small>Tabel</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i>Home</a></li>
        <li class="active">User</li>
      </ol>
</section>

<section class="content">
    <div class="row">
      <div class="col-xs-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
          <!-- /.box-header -->
          <div class="box" style="box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                <div class="box-header bg-blue-active color-palette">
                  <div class="pull-left">
                    <h5><strong>TABEL USER </strong></h5>
                  </div>
                  <div class="pull-right">
                    <a href="{{route('registrasi')}}" class="btn btn-success btn-sm hint--top" aria-label="Tambah User"><i class="fa fa-plus"></i></a>
                    <a href="/export" class="btn btn-default btn-sm hint--top" aria-label="Download"><i class="fa fa-download"></i></a>
                    <a href="#" class="btn btn-warning btn-sm hint--top" aria-label="Upload File" data-toggle="modal" data-target="#modal-import"><i class="fa fa-download"></i></a>
                  </div>
                </div>

                <div class="box-header">
              <div class="box-body table-responsive no-padding">
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead>
                          <tr>
                          <th class="bg-primary color-palette"><p class="text-center">No</th>
                          <th class="bg-primary color-palette"><p class="text-center">Foto</th>
     
                          <th class="bg-primary color-palette"><p class="text-center">NAMA</th>
                          <th class="bg-primary color-palette"><p class="text-center">Email Address</th>
                          <th class="bg-primary color-palette"><p class="text-center">Telp</th>
                          <th class="bg-primary color-palette"><p class="text-center">Level</th>
                          <th class="bg-primary color-palette"><p class="text-center">Status</th>
                          <th class="bg-primary color-palette"><p class="text-center">Last Seen</th>
                          <th class="bg-primary color-palette"><p class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; ?>
                          @foreach ($users as $key => $data)
                          <tr>
                          <td>{{$no++}}</td>
                          <td><a href="{{ url('anggota/'.$data->nik_ktp) }}" ><img src="{{ asset('public/public/foto_user/'.$data->foto_user) }}" class="img-circle" width="80px" height="80px" srcset=""></a></td>
                 
                          <td>{{ $data->name }}</td>
                          <td>{{ $data->email }}</td>
                          <td><a href="https://api.whatsapp.com/send?phone=62{{$data->telp}}" target="_blank">{{$data->telp}}</a></td>
                          <td><span class=" 
                          <?php 
                          if($data->level == 2) 
                          echo 'badge label label-primary';
                          else if($data->level == 4) 
                          echo 'badge label label-info';
                          else if($data->level == 5) 
                          echo 'badge label label-success';
                          else if($data->level == 6) 
                          echo 'badge label label-danger';
                          else if($data->level == 7) 
                          echo 'badge label label-warning';
                          else 
                          echo 'badge label label-default';?>">
                          <?php 
                          if($data->level == 1)
                          echo 'Host';
                          else if ($data->level == 2)
                          echo 'Admin';
                          else if ($data->level == 4)
                          echo 'HRBP';
                          else if ($data->level == 5)
                          echo 'Ketua';
                          else if ($data->level == 6)
                          echo 'Bendahara';
                          else if ($data->level == 7)
                          echo 'Pengurus';
                          else
                          echo 'Anggota';
                          ?></span></td>
                          <td>
                            @if(Cache::has('user-is-online-' . $data->id))
                            <span class="badge label label-success"> Online</span> 
                            @else
                            <span class="badge label label-danger"> Offline</span> 
                            @endif
                          </td>
                          <td>
                          {{ \Carbon\Carbon::parse($data->last_seen)->diffForHumans() }}
                          </td>
                          <td>
                              <a href="/users/edit/{{ $data->id}}" class="btn btn-sm btn-warning hint--top" aria-label="Edit"><i class="fa fa-pencil"></i></a>
                              <button type="button" class="btn btn-sm btn-danger hint--top" aria-label="Hapus" data-toggle="modal" data-target="#delete{{$data->id}}" 
                              <?php 
                          if($data->level == 2)
                          echo 'disabled';
                          else
                          echo '';
                          ?>>
                              <i class="fa fa-trash"></i>
                              </button>
                          </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
  
                      @foreach ($users as $data)
                      <div class="modal modal-danger fade" id="delete{{$data->id}}" style="display: none;">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title">Nama User : {{$data->name}}</h4>
                            </div>
                            <div class="modal-body">
                              <p>Apakah Anda Yakin Akan Menghapus User Ini ?</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                              <a href="/users/delete/{{$data->id}}" class="btn btn-outline">Hapus</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                <!-- /.modal-import file-->
                <div class="modal modal-info fade" id="modal-import" style="display: none;">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Import Data</h4>
                      </div>
                      <form action="{{ route('UsersImport') }}" method="post" enctype="multipart/form-data">
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
              <!-- /.modal-import-->
              </div>
            </div>
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