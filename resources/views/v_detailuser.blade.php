@extends ('layout.v_template')
@section('title','Detail User')
@section('content')

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6"></div>
                    </div>
                        <div class="row">
                        <div class="col-sm-12">
                <table>
                    <tr>
                        <th width="100px">NIK</th>
                        <th width="30px">:</th>
                        <th width="100px">{{$user->nik_user}}</th>
                    </tr>
                    <tr>
                        <th width="100px">Nama User</th>
                        <th width="30px">:</th>
                        <th width="500px">{{$user->nama_user}}</th>
                    </tr>
                    <tr>
                        <th width="100px">Email</th>
                        <th width="30px">:</th>
                        <th width="500px">{{$user->email_user}}</th>
                    </tr>
                    <tr>
                        <th width="100px">Foto</th>
                        <th width="30px">:</th>
                        <th> <img src="{{ url('foto_user/'.$user->foto_user)}}" width="100px"> </th>
                    </tr>
                    <tr>
                        <th><a href="/user" class="btn btn-success btn-sm">Kembali</a></th>
                    </tr>
                </table>        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection