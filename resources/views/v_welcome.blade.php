@extends ('layouts.v_app')
@section('title','')
<style>
    .card1 {
        box-shadow: 0px 18px 30px 8px rgba(0,0,0,.05);
        padding: 15px;
        border-radius: 1.5rem;
        width: 260px;
        min-width: 260px;
        position: relative;
        margin: 10px 15px;
        background: #fff;
        scroll-snap-align: center;
        transition: all .25s ease;
        border: 2px solid #fff;
        display: grid;
        place-content: center;
        grid-template-columns: fit-content(auto) fit-content(auto) 1fr;
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
        right: 0px;
        top: 0px;
        margin: 30px;
        font-size: 1.2rem;
    }
    .con-image{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 200px;
        border-radius: 30px;
        background: #f5f5f5;
    }
    .con-image .img{
        width: 250px;
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
        opacity: .5;
        font-size: 0.8rem;
    }
    .con-text h3{
        padding: 5px 0px;
    }
    .con-price {
        width: 100%;
        text-align: center;
        font-weight: bold;
        padding: 10px;
        font-size: 1.1rem;
        padding-top: 0px;
    } 
    .add {
        width: 100%;
        padding: 15px;
        background: linear-gradient(130deg, #fdc527 0%, #fea01a 100%);
        border: 0px;
        border-radius: 20px;
        color: #fff;
        font-weight: bold;
        font-size: 18px;        
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
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .25s ease;         
    }
</style>
@section('content')
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{asset('template/')}}/dist/img/photo1.png" style="height: 950px;object-fit: cover;object-position: 50% 80%;" alt="First slide">

                    <div class="carousel-caption" >
                      <div style="transform: translateY(-400%)">
                        <strong><p style="font-size: 30px">KOPKAR JAPERNOSA</p></strong> 
                        <p style="font-size: 16px">(JAYA PERSADA EKONOMI SEJAHTERA)</p> 
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{asset('template/')}}/dist/img/photo2.png" style="height: 950px;object-fit: cover;object-position: 60% 80%;" alt="Second slide">

                    <div class="carousel-caption">
                      <div style="transform: translateY(-400%)">
                        <strong><p style="font-size: 30px">WANA MART</p></strong> 
                        <p style="font-size: 16px">(BELANJA SELALU UNTUNG)</p> 
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{asset('template/')}}/dist/img/photo3.jpg" style="height: 950px;object-fit: cover;object-position: 60% 50%;" alt="Third slide">

                    <div class="carousel-caption">
                      <div style="transform: translateY(-400%)">
                        <strong><p style="font-size: 30px">JAPERNOSA WATER</p></strong> 
                        <p style="font-size: 16px">(AIR MINUM SEHAT & BERKUALITAS)</p> 
                      </div>
                    </div>
                  </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
            </div>
            
      <!-- <div class="row">
        <div class="card"><center>
          <div class="col-sm-4">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('template/shoes2.png')}}" alt="">
                </div>
                <div class="con-text">
                    <h3>Training Shoes</h3>
                    <p>Tidak ada </p>
                </div>
                <div class="con-price">
                    Rp. 129.344        
                </div>
                <div class="con-btn">
                    <a href="/home" class="add btn-block">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('logo.png')}}" alt="">
                </div>
                <div class="con-text">
                    <h3>Training Shoes</h3>
                    <p>The Nike Suasdfasdlfaldfladfadfafafdfafa</p>
                </div>
                <div class="con-price">
                    129.344        
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
        <div class="col-sm-4">
            <div class="card1">
                <div class="con-star">
                    <i class="fa fa-star"></i>
                </div>
                <div class="con-image">
                    <img class="img" src="{{asset('template/gitar.png')}}" alt="">
                </div>
                <div class="con-text">
                    <h3>Gitar Akustik</h3>
                    <p>The Nike Suasdfasdlfaldfladfadfafafdfafa</p>
                </div>
                <div class="con-price">
                    129.344        
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
    </div> -->
<script>
    (function() {
 
 // store the slider in a local variable
 var $window = $(window),
     flexslider = { vars:{} };

 // tiny helper function to add breakpoints
 function getGridSize() {
   return (window.innerWidth < 400) ? 2 :
          (window.innerWidth < 400) ? 3 : 4;
 }

 $(function() {
   SyntaxHighlighter.all();
 });

 $window.load(function() {
   $('.flexslider').flexslider({
     animation: "slide",
     animationLoop: false,
     itemWidth: 70,
     itemMargin: 5,
     minItems: getGridSize(), // use function to pull in initial value
     maxItems: getGridSize() // use function to pull in initial value
   });
 });

 // check grid size on resize event
 $window.resize(function() {
   var gridSize = getGridSize();

   flexslider.vars.minItems = gridSize;
   flexslider.vars.maxItems = gridSize;
 });
}());
</script>


  <!-- Syntax Highlighter -->
  <script type="text/javascript" src="{{asset('template/flexslider/woocommerce-FlexSlider-690832b/demo/')}}js/shCore.js"></script>
  <script type="text/javascript" src="{{asset('template/flexslider/woocommerce-FlexSlider-690832b/demo/')}}js/shBrushXml.js"></script>
  <script type="text/javascript" src="{{asset('template/flexslider/woocommerce-FlexSlider-690832b/demo/')}}js/shBrushJScript.js"></script>

  <!-- Optional FlexSlider Additions -->
  <script src="{{asset('template/flexslider/woocommerce-FlexSlider-690832b/demo/')}}js/jquery.easing.js"></script>
  <script src="{{asset('template/flexslider/woocommerce-FlexSlider-690832b/demo/')}}js/jquery.mousewheel.js"></script>
  <!-- <script defer src="js/demo.js"></script> -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if (Session::has('success'))
  <script>
  swal("Selamat !","{!! session::get('success') !!}","success",{
    button:"OK",
  })
  </script>
@endif
@endsection