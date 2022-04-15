@extends ('layout.v_template')
@section('title','Edit Pengumuman')

@section('content')
<section class="content-header">
      <h1>EDIT PENGUMUMAN
      <SMALl>Form</SMALl></h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/pengumuman">Pengumuman</a></li>
        <li class="active">Edit Pengumuman</a></li>
      </ol>
    </section>
<!-- /.pembatas -->
<session class="content">
@foreach ($pengumuman as $data)
<form class="form-horizontal" action="/pengumuman/update/{{$data->id_pengumuman}}" method="post" enctype="multipart/form-data">
   @csrf
     
         
      <div class="col-md-12">
        <div class="box-header with-border bg-blue color-palette">
          <h3 class="box-title">Edit Informasi Pengumuman</h3>
        </div>
        <!-- Main content -->
        <div class="row">
          <div class="col-md-12">

            <div class="box">
              <div class="box-header">
                <label>Judul</label>
                <div >
                  <input name="judul" class="form-control"type="text" placeholder="Masukan judul" value="{{$data->judul}}">
                </div>
              </div>

              <div class="box-body pad">
                <label>Isi text</label>
                <input name="isi" class="form-control"type="textarea" placeholder="Masukan text" value="{{$data->isi}}" style="text: jusftify; width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;display: ;"><br>
                <!--<textarea name="isi" id="myTextarea" class="textarea" value="{!!$data->isi!!}"style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;display: ;" placeholder="Place some text here"></textarea>-->
                <!--<input type="hidden" name="_wysihtml5_mode" value="1"><br>-->
                
                <div class="form-group">
                  <div class="col-sm-offset-0 col-sm-12">
                      <button type="submit" class="btn btn-primary hint--top" aria-label="Simpan">UPDATE</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input name="author"type="hidden"class="form-control"  value="{{auth()->user()->name}}">
        @endforeach
      </div>
  </form>
<!-- CK Editor -->
<script src="https://cdn.tiny.cloud/1/4lytlq894hdf57n0a2qnd8on611qlofx8n8uxk1n0p61vytl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{asset('template/')}}bower_components/ckeditor/ckeditor.js"></script>
<script src="{{asset('template/')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- <script>
tinymce.init({
  selector:'#myTextarea'
});
</script> -->
<script>
tinymce.init({
  selector:'#myTextarea'
});
</script>

</session>
@endsection