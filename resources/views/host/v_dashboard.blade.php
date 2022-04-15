@extends ('layout.v_template')
@section('title','Dashboard Host')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">

<h3>ini halaman {{ Auth::user()->level }}</h3>

</section>

@endsection