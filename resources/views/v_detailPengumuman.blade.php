@extends ('layout.v_template')
@section('title','Detail Pengumuman')

@section('content')
<div class="box">
<section class="content-header">
@foreach ($data as $item)
      <h1>{{$item->judul}}</h1>
      <div class="pull-left">
      <small><i class="fa fa-user"> by : {{$item->author}}</i></small>
      </div>
      <div class="pull-right">
      <p>Posting date : {{$item->tgl_pengumuman}}</p>
      </div>
    </section>
    
<!-- /.tabel 2 -->
<section class="content">
    <div class="row"></div>
<div class="box box-primary"></div>
<h2>{{$item->notifikasi}}</h2>
<div class="text-center">
    <img src="{{ asset('public/public/lampiran_pengumuman/'.$item->lampiran) }}" width="500" height="auto" class="img-thumbnail">
</div>
<blockquote><p class="text-justify">{!!$item->isi!!}</p></blockquote><hr>
<h4><a href="/"> KOPKAR JAPERNOSA</a></h4>
@endforeach
</section>
</div>
@endsection