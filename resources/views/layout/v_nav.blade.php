<ul class="sidebar-menu" data-widget="tree">
    <li class="header">
    MAIN NAVIGATION</li>
    @if (auth()->user()->level==2)
    <li class="{{request()->is('/home')?'active':''}}"><a href="/home"><i class="fa fa-home"></i> <span>HOME</span></a></li>
    <li class="{{request()->is('/welcome')?'active':''}}"><a href="/welcome"><i class="fa fa-home"></i> <span>Welcome</span></a></li>
    <li class="{{request()->is('dashboard')?'active':''}}"><a href="/dashboard"><i class="fa fa-bar-chart"></i> <span>STATISTIK</span></a></li>
    <li class="{{request()->is('pendaftaran')?'active':''}}"><a href="/pendaftaran"><i class="fa fa-users"></i> <span>PENDAFTARAN</span></a></li>
    <li class="{{request()->is('anggota')?'active':''}}"><a href="/anggota"><i class="fa fa-users"></i> <span>DATA ANGGOTA</span></a></li>
    <li class="{{request()->is('simpananAdmin')?'active':''}}"><a href="/simpananAdmin"><i class="glyphicon glyphicon-list-alt"></i> <span>TABUNGAN</span></a></li>
    <li class="{{request()->is('pengambilan')?'active':''}}">
      <a href="/pengambilan"><i class="fa fa-users"></i> <span>PENARIKAN DANA</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
    <li class="treeview {{request()->is('pengajuan','pinjam','statusPinjam') ? 'active':''}}">
        <a href="#">
        <i class="glyphicon glyphicon-menu-hamburger"></i> <span>PINJAMAN ANGGOTA</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu ">
          <li class="{{request()->is('pengajuan')?'active':''}}"><a href="/pengajuan"><i class="fa fa-chevron-circle-right text-yellow"></i> PENGAJUAN</a></li>
          <li class="{{request()->is('pinjam')?'active':''}}"><a href="/pinjam"><i class="fa fa-chevron-circle-right text-green"></i> PINJAMAN KREDIT</a></li>
          <li class="{{request()->is('statusPinjam')?'active':''}}"><a href="/statusPinjam"><i class="fa fa-chevron-circle-right text-red"></i> STATUS PINJAMAN</a></li>
        </ul>
    </li>
    <li class="{{request()->is('angsuran')?'active':''}}"><a href="/angsuran"><i class="fa fa-briefcase"></i> <span>ANGSURAN</span></a></li>
    <li class="{{request()->is('shu')?'active':''}}"><a href="/shu"><i class="fa fa-book"></i> <span>SISA HASIL USAHA</span></a></li>
    <li class="treeview {{request()->is('users','pengumuman') ? 'active':''}}">
        <a href="#">
        <i class="fa fa-wrench"></i> <span>SETTING</span>
        <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
        </span>
        </a>
        <ul class="treeview-menu ">
          <li class="{{request()->is('users')?'active':''}}"><a href="/users"><i class="fa fa-circle-o"></i> USER</a></li>
          <li class="{{request()->is('pengumuman')?'active':''}}"><a href="/pengumuman"><i class="fa fa-circle-o"></i> PENGUMUMAN</a></li>
        </ul>
    </li>
</ul>

<ul class="sidebar-menu" data-widget="tree" type="hidden" style="
<?php 
if (auth()->user()->nik_ktp == 1234567890)
echo 'display:none';
else
echo 'display:block';?>">
  <li class="header">LABELS</li> 
  <li class="{{request()->is('anggotakopkar/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}"><i class="fa fa-dashboard"></i> <span>DASHBOARD SAYA</span></a></li>
  <li class="{{request()->is('simpananSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/simpananSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>TABUNGAN</span></a></li>
  <li class="treeview {{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp,'pinjamanSaya/'.auth()->user()->nik_ktp,'angsuranSaya/'.auth()->user()->nik_ktp) ? 'active':''}}" >
    <a href="#">
      <i class="fa fa-folder "></i> <span>TRANSAKSI</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" >
      <li class="{{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pengambilanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-red"></i> <span> Penarikan</span></a></li>
      <li class="{{request()->is('pinjamanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-yellow"></i> <span> Pinjaman</span></a></li>
      <li class="{{request()->is('angsuranSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-blue"></i> <span> Angsuran</span></a></li>
    </ul>
  </li>
   <li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/shuSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>SHU</span></a></li>
  <!--<li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="#" data-toggle="modal" data-target="#modal-shu"><i class="fa fa-book"></i> <span>SHU</span></a></li>-->
 <li class="{{request()->is('simulasi')?'active':''}}"><a href="/simulasi"><i class="fa fa-calculator"></i> <span>SIMULASI KREDIT</span>
 <!-- <span class="pull-right-container">
    <small class="label pull-right bg-red">Baru</small>
  </span> -->
</a></li>
</ul>

  @elseif (auth()->user()->level==3)
    <li class="{{request()->is('/home')?'active':''}}"><a href="/home"><i class="fa fa-book"></i> <span> HOME</span></a></li>
    <li class="{{request()->is('anggotakopkar/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}"><i class="fa fa-dashboard"></i> <span>MY DASHBOARD</span></a></li>
  <li class="{{request()->is('simpananSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/simpananSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>TABUNGAN</span></a></li>
  <li class="treeview {{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp,'pinjamanSaya/'.auth()->user()->nik_ktp,'angsuranSaya/'.auth()->user()->nik_ktp) ? 'active':''}}" >
    <a href="#">
      <i class="fa fa-folder "></i> <span>TRANSAKSI</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" >
      <li class="{{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pengambilanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-red"></i> <span> TARIK SIMPANAN</span></a></li>
      <li class="{{request()->is('pinjamanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-yellow"></i> <span> PINJAMAN</span></a></li>
      <li class="{{request()->is('angsuranSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-blue"></i> <span> ANGSURAN</span></a></li>
    </ul>
  </li>
  <li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/shuSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>SHU</span></a></li>
  <!--<li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="#" data-toggle="modal" data-target="#modal-shu"><i class="fa fa-book"></i> <span>SHU</span></a></li>-->
 <li class="{{request()->is('simulasi')?'active':''}}"><a href="/simulasi"><i class="fa fa-calculator"></i> <span>SIMULASI KREDIT</span></a></li>
<li class="{{request()->is('belanjaku')?'active':''}}"><a href="/belanjaku"><i class="fa fa-shopping-cart"></i> <span>BELANJAKU</span>
 <span class="pull-right-container">
    <small class="label pull-right bg-green">Baru</small>
  </span>
  </a></li>
</ul>
@elseif (auth()->user()->level==4)  
<ul class="sidebar-menu" data-widget="tree">
  <li class="{{request()->is('/home')?'active':''}}"><a href="/home"><i class="fa fa-flag"></i> <span>HOME</span></a></li>
</ul>
<li class="{{request()->is('hrbp/dashboard')?'active':''}}"><a href="/hrbp/dashboard"><i class="fa fa-bar-chart"></i> <span>STATISTIK</span></a></li>
<li class="treeview {{request()->is('pengajuanHrbp','pinjamHrbp') ? 'active':''}}">
  <a href="#">
    <i class="glyphicon glyphicon-menu-hamburger"></i><span>PINJAMAN ANGGOTA</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu ">
    <li class="{{request()->is('pengajuanHrbp')?'active':''}}"><a href="/pengajuanHrbp"><i class="fa fa-chevron-circle-right text-yellow"></i> PENGAJUAN</a></li>
    <li class="{{request()->is('pinjamHrbp')?'active':''}}"><a href="/pinjamHrbp"><i class="fa fa-chevron-circle-right text-green"></i> PINJAMAN KREDIT</a></li>
  </ul>
</li>
  
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">LABELS</li> 
  <li class="{{request()->is('anggotakopkar/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}"><i class="fa fa-dashboard"></i> <span>DASHBOARD SAYA</span></a></li>
  <li class="{{request()->is('simpananSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/simpananSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>TABUNGAN</span></a></li>
</ul>  
  <li class="treeview {{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp,'pinjamanSaya/'.auth()->user()->nik_ktp,'angsuranSaya/'.auth()->user()->nik_ktp) ? 'active':''}}" >
    <a href="#">
      <i class="fa fa-folder "></i> <span>TRANSAKSI</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" >
      <li class="{{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pengambilanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-red"></i> <span> Penarikan</span></a></li>
      <li class="{{request()->is('pinjamanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-yellow"></i> <span> Pinjaman</span></a></li>
      <li class="{{request()->is('angsuranSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-blue"></i> <span> Angsuran</span></a></li>
    </ul>
  </li>
  <li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/shuSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>SHU</span></a></li>
  <!--<li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="#" data-toggle="modal" data-target="#modal-shu"><i class="fa fa-book"></i> <span>SHU</span></a></li>-->
   <li class="{{request()->is('simulasi')?'active':''}}"><a href="/simulasi"><i class="fa fa-calculator"></i> <span>SIMULASI KREDIT</span>
   <!-- <span class="pull-right-container">
      <small class="label pull-right bg-red">Baru</small>
    </span> -->
  </a></li>
@elseif (auth()->user()->level==5)  
<ul class="sidebar-menu" data-widget="tree">
  <li class="{{request()->is('home')?'active':''}}"><a href="/home"><i class="fa fa-home"></i> <span>HOME</span></a></li>
  <li class="{{request()->is('ketua/dashboard')?'active':''}}"><a href="/ketua/dashboard"><i class="fa fa-bar-chart"></i> <span>STATISTIK</span></a></li>
  <li class="{{request()->is('pengambilanKetua')?'active':''}}">
      <a href="/pengambilanKetua"><i class="fa fa-edit"></i> <span>PENARIKAN DANA</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
    </li>
</ul>
<li class="treeview {{request()->is('pengajuanKetua','pinjamKetua') ? 'active':''}}">
  <a href="#">
    <i class="fa fa-files-o"></i><span>PINJAMAN ANGGOTA</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu ">
    <li class="{{request()->is('pengajuanKetua')?'active':''}}"><a href="/pengajuanKetua"><i class="fa fa-chevron-circle-right text-yellow"></i> PENGAJUAN</a></li>
    <li class="{{request()->is('pinjamKetua')?'active':''}}"><a href="/pinjamKetua"><i class="fa fa-chevron-circle-right text-green"></i> PINJAMAN KREDIT</a></li>
  </ul>
</li>

<ul class="sidebar-menu" data-widget="tree">
  <li class="header">LABELS</li> 
  <li class="{{request()->is('anggotakopkar/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}"><i class="fa fa-dashboard"></i> <span>DASHBOARD SAYA</span></a></li>
  <li class="{{request()->is('simpananSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/simpananSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>TABUNGAN</span></a></li>
</ul> 
  <li class="treeview {{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp,'pinjamanSaya/'.auth()->user()->nik_ktp,'angsuranSaya/'.auth()->user()->nik_ktp) ? 'active':''}}" >
    <a href="#">
      <i class="fa fa-folder "></i> <span>TRANSAKSI</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" >
      <li class="{{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pengambilanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-red"></i> <span> Penarikan</span></a></li>
      <li class="{{request()->is('pinjamanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-yellow"></i> <span> Pinjaman</span></a></li>
      <li class="{{request()->is('angsuranSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-blue"></i> <span> Angsuran</span></a></li>
    </ul>
  </li>
   <li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/shuSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>SHU</span></a></li>
  <!--<li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="#" data-toggle="modal" data-target="#modal-shu"><i class="fa fa-book"></i> <span>SHU</span></a></li>-->
 <li class="{{request()->is('simulasi')?'active':''}}"><a href="/simulasi"><i class="fa fa-calculator"></i> <span>SIMULASI KREDIT</span>
 <!-- <span class="pull-right-container">
    <small class="label pull-right bg-red">Baru</small>
  </span> -->
</a></li>

@elseif (auth()->user()->level==6)  
<ul class="sidebar-menu" data-widget="tree">
<li class="{{request()->is('/home')?'active':''}}"><a href="/home"><i class="fa fa-flag"></i> <span>HOME</span></a></li>
<li class="{{request()->is('bendahara/dashboard')?'active':''}}"><a href="/bendahara/dashboard"><i class="fa fa-bar-chart"></i> <span>STATISTIK</span></a></li>
<li class="{{request()->is('simpanan')?'active':''}}"><a href="/simpanan"><i class="glyphicon glyphicon-list-alt"></i> <span>TABUNGAN</span></a></li>
  <li class="{{request()->is('pengambilan')?'active':''}}">
      <a href="/pengambilanBendahara"><i class="fa fa-users"></i> <span>PENARIKAN DANA</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-green"></small>
        </span>
      </a>
  </li>
</ul>
  <li class="treeview {{request()->is('pengajuanBendahara','pinjamBendahara') ? 'active':''}}">
    <a href="#">
      <i class="glyphicon glyphicon-menu-hamburger"></i><span>PINJAMAN ANGGOTA</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu ">
      <li class="{{request()->is('pengajuanBendahara')?'active':''}}"><a href="/pengajuanBendahara"><i class="fa fa-chevron-circle-right text-yellow"></i> PENGAJUAN</a></li>
      <li class="{{request()->is('pinjamBendahara')?'active':''}}"><a href="/pinjamBendahara"><i class="fa fa-chevron-circle-right text-green"></i> PINJAMAN KREDIT</a></li>
    </ul>
  </li>

<ul class="sidebar-menu" data-widget="tree">
  <li class="header">LABELS</li> 
  <li class="{{request()->is('anggotakopkar/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}"><i class="fa fa-dashboard"></i> <span>DASHBOARD SAYA</span></a></li>
  <li class="{{request()->is('simpananSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/simpananSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>TABUNGAN</span></a></li>
</ul>
  <li class="treeview {{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp,'pinjamanSaya/'.auth()->user()->nik_ktp,'angsuranSaya/'.auth()->user()->nik_ktp) ? 'active':''}}" >
    <a href="#">
      <i class="fa fa-folder "></i> <span>TRANSAKSI</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" >
      <li class="{{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pengambilanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-red"></i> <span> Penarikan</span></a></li>
      <li class="{{request()->is('pinjamanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-yellow"></i> <span> Pinjaman</span></a></li>
      <li class="{{request()->is('angsuranSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-blue"></i> <span> Angsuran</span></a></li>
    </ul>
  </li>
   <li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/shuSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>SHU</span></a></li>
  <!--<li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="#" data-toggle="modal" data-target="#modal-shu"><i class="fa fa-book"></i> <span>SHU</span></a></li>-->
 <li class="{{request()->is('simulasi')?'active':''}}"><a href="/simulasi"><i class="fa fa-calculator"></i> <span>SIMULASI KREDIT</span>
 <!-- <span class="pull-right-container">
    <small class="label pull-right bg-red">Baru</small>
  </span> -->
</a></li>

@elseif (auth()->user()->level==7)  
<ul class="sidebar-menu" data-widget="tree">
  <li class="{{request()->is('/home')?'active':''}}"><a href="/home"><i class="fa fa-flag"></i> <span>HOME</span></a></li>
  <li class="{{request()->is('pengurus/dashboard')?'active':''}}"><a href="/pengurus/dashboard"><i class="fa fa-bar-chart"></i> <span>STATISTIK</span></a></li>
</ul>  
  <li class="treeview {{request()->is('pengajuanPengurus','pinjamPengurus') ? 'active':''}}">
  <a href="#">
    <i class="glyphicon glyphicon-menu-hamburger"></i><span>PINJAMAN ANGGOTA</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu ">
    <li class="{{request()->is('pengajuanPengurus')?'active':''}}"><a href="/pengajuanPengurus"><i class="fa fa-chevron-circle-right text-yellow"></i> PENGAJUAN</a></li>
    <li class="{{request()->is('pinjamPengurus')?'active':''}}"><a href="/pinjamPengurus"><i class="fa fa-chevron-circle-right text-green"></i> PINJAMAN KREDIT</a></li>
  </ul>
</li>

  <li class="header">LABELS</li> 
  <li class="{{request()->is('anggotakopkar/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/anggotakopkar/{{ Auth::user()->nik_ktp }}"><i class="fa fa-dashboard"></i> <span>DASHBOARD SAYA</span></a></li>
  <li class="{{request()->is('simpananSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/simpananSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>TABUNGAN</span></a></li>

 
  <li class="treeview {{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp,'pinjamanSaya/'.auth()->user()->nik_ktp,'angsuranSaya/'.auth()->user()->nik_ktp) ? 'active':''}}" >
    <a href="#">
      <i class="fa fa-folder "></i> <span>TRANSAKSI</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu" >
      <li class="{{request()->is('pengambilanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pengambilanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-red"></i> <span> Penarikan</span></a></li>
      <li class="{{request()->is('pinjamanSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/pinjamanSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-yellow"></i> <span> Pinjaman</span></a></li>
      <li class="{{request()->is('angsuranSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/angsuranSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-circle-o text-blue"></i> <span> Angsuran</span></a></li>
    </ul>
  </li>
  <!--<li class="{{request()->is('potonggajiSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/potonggajiSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>POTONGAN GAJI & ANGSURAN</span></a></li>-->
   <li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="/shuSaya/{{ Auth::user()->nik_ktp }}"><i class="fa fa-book"></i> <span>SHU</span></a></li>
  <!--<li class="{{request()->is('shuSaya/'.auth()->user()->nik_ktp)?'active':''}}"><a href="#" data-toggle="modal" data-target="#modal-shu"><i class="fa fa-book"></i> <span>SHU</span></a></li>-->
   <li class="{{request()->is('simulasi')?'active':''}}"><a href="/simulasi"><i class="fa fa-calculator"></i> <span>SIMULASI KREDIT</span>
   <!-- <span class="pull-right-container">
      <small class="label pull-right bg-red">Baru</small>
    </span> -->
  </a></li>
</ul>
@endif
    

