@extends ('layout.v_template')
@section('title','Pengumuman')
@section('content')
<section class="content-header">
      <h1>PENGUMUMAN
      <small>Information</small></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Pengumuman</a></li>
      </ol>
    </section>
    
<!-- /.tabel 2 -->
<section class="content">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="box box-header">
        <div clas="pull-right">
            <!-- <button class="btn btn-primary"><i class="fa fa-plus" aria-label="New" data-toggle="modal" data-target="#tambahPengumuman"></i>Tambah</a> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Tambah</button>
        </div><br>
        
        <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
            <tr>
            <th width="1%"><p class="text-center">No.</th>
            <th width="50%"><p class="text-center">Judul</th>
            <th width="5%"><p class="text-center">tanggal</th>
            <th width="5%"><p class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $no=1; ?>
            @foreach ($data as $item)
            <tr>
            <td >{{ $no++}}</td>
            <td ><a href="/detailPengumuman/{{$item->id_pengumuman}}">{{ $item->judul}}</a></td>
            <td >{{Carbon\Carbon::parse($item->tgl_pengumuman)->format("d-M-y")}}</td>
            <td>
            <a href="/pengumuman/edit/{{$item->id_pengumuman}}" class="btn btn-warning btn-sm hint--top" aria-label="Edit" ><i class="fa fa-pencil"></i></a>
            <button type="button" class="btn btn-danger btn-sm hint--top" aria-label="Hapus" data-toggle="modal" data-target="#hapus{{$item->id_pengumuman}}"><i class="fa fa-trash-o"></i></button>
            </td>
            </tr>
            @endforeach
            </tbody>
        </table>
       
    </div>
</section>

        <div class="modal fade in" id="modal" style="display: none; padding-right: 17px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Pengumuman Baru</h4>
              </div>
              <div class="modal-body">

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ route('simpanPengumuman') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="box-body" style="padding: 20px">
                <div class="form-group">
                  <label>Judul</label>
                  <input name="judul" type="text" class="form-control" id="judul" placeholder="Masukan Judul">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Kategori</label>
                  <select name="notifikasi" class="form-control select2 select2-accessible" style="width: 100%;" data-select2-id="3" tabindex="-1" aria-hidden="true" id="tenor">
                    <option value="Promosi">Promosi</option>
                    <option value="Pengumuman">Pengumuman</option>
                    <option value="Informasi">Informasi</option>
                    <option value="Artikel baru">Artikel baru</option>
                    </select>
                </div>
                <div class="form-group">
                  <textarea name="isi" id="summernote"  style="width: 100%; height: 200px;" placeholder="Place some text here"></textarea>
                </div>
                <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" name="lampiran" class="form-control">
                  <p class="help-block text-red">File berekstensi jpg,jpeg,bmp,png,max:1024 mb</p>
                </div>
                <input name="tgl_pengumuman" type="hidden" class="form-control"  value="{{date(now())}}">
                <input name="author" type="hidden" class="form-control" value="{{auth()->user()->name}}">
                <input name="foto_user" type="hidden" value="{{auth()->user()->foto_user}}">
                <input name="name" type="hidden" value="{{auth()->user()->name}}">

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" class="btn btn-default pull-left" data-loading-text="Loading..." data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary pull-right" data-loading-text="Loading...">Publish</button>
              </div>
            </form>
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

        @foreach ($data as $item)
        <div class="modal modal-default fade in" id="hapus{{$item->id_pengumuman}}" style="display: none; padding-right: 17px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Konfirmasi penghapusan data</h4>
              </div>
              <div class="modal-body">
                <div class="box-body">
                    <div class="form-group">
                    <label>Judul</label>
                    <div class="box box-header">
                            <p>{{$item->judul}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi Pengumuman</label>
                        <div class="box box-header">
                            <p>{!!$item->isi!!}</p>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <a href="/pengumuman/delete/{{$item->id_pengumuman}}"type="button" class="btn btn-danger ">Hapus</a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        @endforeach

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Greet Job!","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
<!-- CK Editor -->
<script src="https://cdn.tiny.cloud/1/4lytlq894hdf57n0a2qnd8on611qlofx8n8uxk1n0p61vytl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('template/')}}bower_components/ckeditor/ckeditor.js"></script>
<script src="{{asset('template/')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script>
tinymce.init({
  selector:'#myTArea'
});
</script>

@endif
@endsection