@extends ('layout.v_template')
@section('title','Belanjaku')
<style>
    .card1 {
        box-shadow: 0px 18px 30px 8px rgba(0,0,0,.05);
        padding: 10px;
        border-radius: 1rem;
        width: 230px;
        min-width: 150px;
        position: relative;
        margin: 10px 10px;
        background: #fff;
        scroll-snap-align: center;
        transition: all .25s ease;
        border: 2px solid #fff;
        /* display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));  */
        /* margin: 100px; */
    }
    .add-active {
        box-shadow: 0px 10px 30px 0px rgba(254, 160, 26, .2);
        border: 2px solid #fea01a;
    }
    .add-active .add{
        display: none;
    }
    .add-active .con-image img:not(.bg){
        transform: scale(1.15);
    }
    .add-active .con-input-btns {
        display: flex;
    }
    .con-star{
        position: absolute;
        left: 8px;
        top: 8px;
        margin: 10px;
        font-size: 2rem;
    }
    .con-image{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 130px;
        border-radius: 20px;
        background: #f5f5f5;
    }
    .con-image .img{
        width: 150px;
        z-index: 20;
        transition: all .25s ease;
    }
    .con-image .bg{
        position: absolute;
        transform: translate(10px, 30px);
        z-index: 10;
        filter: blur(20px);
        opacity: .4;
    }
    .con-text {
        width: 100%;
        padding: 10px 0px;
        opacity: 1;
        font-size: 8px;
    }
    .con-text h3{
        padding: 1px 0px;
    }
    .con-price {
        width: 100%;
        text-align: center;
        font-weight: bold;
        color: blue;
        padding: 10px;
        font-size: 20px;
        padding-top: 0px;
    } 
    .add {
        width: 100%;
        padding: 10px;
        background: linear-gradient(130deg, #fdc527 0%, #fea01a 100%);
        border: 0px;
        border-radius: 16px;
        color: #fff;
        font-weight: bold;
        font-size: 12px;        
    }
    .con-input-btns {
        display: flex;
        align-items: center;
        justify-content: center;
        display: none;
    }
    .con-input-btns input{
        padding: 10px;
        flex: 1;
        width: calc(100% - 100px);
        height: 49px;
        border: 0px;
        border-bottom: 2px solid #f5f5f5;
        text-align: center;
        font-size: 1.3rem;
    }
    .con-input-btns button{
        padding: 10px;
        min-width: 49px;
        height: 49px;
        border: 0px;
        border-radius: 20px;
        background: linear-gradient(130deg, #fdc527 0%, #fea01a 100%);
        color: #fff;
        font-size: 1.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .25s ease;         
    }
</style>
@section('content')
<div class="preloader">
  <div class="loading">
    <img src="loading.gif" width="80">
    <p>Harap Tunggu</p>
  </div>
</div>

    <section class="content-header">
      <h1>
        PRODUK MITRA KOPKAR
        <small>List Produk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Produk Mitra</li>
      </ol>
    </section>

    <div class="row">
        <div class="col-sm-12">
            <div class="box-tools text-center" style="padding: 10px;">
                <div class="has-feedback">
                    <input type="text" class="form-control input-lg" placeholder="Cari...">
                    <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <center>
    <div class="col-sm-3">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('template/shoes2.png')}}" alt="">
                    <!-- <img class="bg" src="{{asset('template/shoes2.png')}}" alt=""> -->
                </div>
                <div class="con-text">
                    <h3>Training Shoes</h3>
                    <h2 class="label bg-green" style="font-size: 12px;border-radius: 1.5em">SPORT SHOP</h2>
                </div>
                <div class="con-price">
                    Rp. 129.344        
                </div>
                <div class="con-btn">
                    <a href="/detail-produk" class="add btn-block">Detail</a>
                    <!-- <div class="con-input-btns">
                        <button onClick="plusLess(event,'less')" class="less"><i class="fa fa-minus"></i></button>
                        <input value="1" type="text">
                        <button onClick="plusLess(event,'plus')" class="plus"><i class="fa fa-plus"></i></button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-tags text-green"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('logo.png')}}" alt="">
                    <!-- <img class="bg" src="{{asset('template/shoes2.png')}}" alt=""> -->
                </div>
                <div class="con-text">
                    <h3>Training Shoes</h3>
                    <h2 class="label bg-green" style="font-size: 12px;border-radius: 1.5em">SPORT SHOP</h2> 
                </div>
                <div class="con-price">
                IDR 19.344        
                </div>
                <div class="con-btn">
                    <button onClick="handleAdd(event)" class="add btn-block">Add to chart</button>
                    <div class="con-input-btns">
                        <button onClick="plusLess(event,'less')" class="less"><i class="fa fa-minus"></i></button>
                        <input value="1" type="text">
                        <button onClick="plusLess(event,'plus')" class="plus"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star text-orange"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('template/gitar.png')}}" alt="">
                    <!-- <img class="bg" src="{{asset('template/shoes2.png')}}" alt=""> -->
                </div>
                <div class="con-text">
                    <h3>Gitar Akustik</h3>
                    <h2 class="label bg-green" style="font-size: 12px;border-radius: 1.5em">MUSICA SHOP</h2>
                </div>
                <div class="con-price">
                IDR 59.344        
                </div>
                <div class="con-btn">
                    <button onClick="handleAdd(event)" class="add btn-block">Add to chart</button>
                    <div class="con-input-btns">
                        <button onClick="plusLess(event,'less')" class="less"><i class="fa fa-minus"></i></button>
                        <input value="1" type="text">
                        <button onClick="plusLess(event,'plus')" class="plus"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('template/shoes2.png')}}" alt="">
                    <!-- <img class="bg" src="{{asset('template/shoes2.png')}}" alt=""> -->
                </div>
                <div class="con-text">
                    <h3>Training Shoes</h3>
                    <h2 class="label bg-green" style="font-size: 12px;border-radius: 1.5em">SPORT SHOP</h2>
                </div>
                <div class="con-price">
                IDR 129.344        
                </div>
                <div class="con-btn">
                    <button onClick="handleAdd(event)" class="add btn-block">Add to chart</button>
                    <div class="con-input-btns">
                        <button onClick="plusLess(event,'less')" class="less"><i class="fa fa-minus"></i></button>
                        <input value="1" type="text">
                        <button onClick="plusLess(event,'plus')" class="plus"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('template/shoes2.png')}}" alt="">
                    <!-- <img class="bg" src="{{asset('template/shoes2.png')}}" alt=""> -->
                </div>
                <div class="con-text">
                    <h3>Training Shoes</h3>
                    <h2 class="label bg-red" style="font-size: 12px;border-radius: 1.5em">SPORT SHOP</h2>
                </div>
                <div class="con-price">
                    IDR 100.000        
                </div>
                <div class="con-btn">
                    <button onClick="handleAdd(event)" class="add btn-block">Add to chart</button>
                    <div class="con-input-btns">
                        <button onClick="plusLess(event,'less')" class="less"><i class="fa fa-minus"></i></button>
                        <input value="1" type="text">
                        <button onClick="plusLess(event,'plus')" class="plus"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div></center>
    </div>
    <!-- /.box-body -->
    <div class="text-center">
      <a href="/home" class="btn btn-sm btn-info">Lainnya</a>
    </div>
    <!-- /.box-footer -->


<!-- /.script -->
<script>
    function handleAdd(event) {
        const card = event.target.closest('.card1')
        card.classList.add('add-active')
    }

    function plusLess(event, type) {
        const card = event.target.closest('.card1')
        const input = card.querySelector('input')
        let oldVal = Number(input.value)
        if(type == 'less') {
            if(oldVal == 1) {
                card.classList.remove('add-active')
                return
            }
            input.value = oldVal -= 1
        } else {
            input.value = oldVal += 1
        }
    }
</script>

@endsection