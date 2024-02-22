<!-- header -->
<header id="header">
<!-- top header -->
<div class="top-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6"> <span><i class="fa fa-phone"></i> (04) 6674 2332</span> <span><i class="fa fa-envelope-o"></i> <a href="mailto:support@mail.com">support@mail.com</a></span> </div>
      
      @if(session()->get('customer_email'))
          @php
          $customer_email = session()->get('customer_email');
          //có thể dùng cách khác: $customer_email = Sesion::get('customer_email');
          $namek=DB::table("users")->where("email","=",$customer_email)->select("name")->first(); 
          $name=$namek->name; 
          @endphp
          <div class="col-xs-12 col-sm-6 col-md-6 customer"> <a href="#">Xin chào {{ $name }}</a>&nbsp; &nbsp;<a href="{{ url('customers/logout') }}">Đăng xuất</a> </div>
        
      @else
      <div class="col-xs-12 col-sm-6 col-md-6 customer"> <a href="{{ url('customers/login') }}">Đăng nhập</a>&nbsp; &nbsp;<a href="{{ url('customers/register') }}">Đăng ký</a> </div>
      @endif

    </div>
  </div>
</div>
<!-- end top header --> 
<!-- middle header -->
<div class="mid-header">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 logo "> <a><img style="width:200px;height:100px" src="{{ asset("upload/1.png") }}"></a> </div>
    <div class="col-xs-12 col-sm-12 col-md-6 header-search"> 
      <!--<form method="post" id="frm" action="">-->
      <div style="margin-top:25px;">
        <input type="text" onkeyup="ajaxSearch();" onkeypress="searchForm(event);" value="" placeholder="Nhập từ khóa tìm kiếm..." id="key" class="input-control">
        <button style="margin-top:5px;" type="submit"> <i class="fa fa-search" onclick="location.href='{{ url('products/search') }}?key='+document.getElementById('key').value;"></i> </button>
      </div>
      <!--</form>--> 
      <div class="search-result">
        <ul>
        </ul>
      </div>
    </div>
    <style type="text/css">
      .header-search{position: relative;}
      .search-result{position: absolute; z-index: 10; visibility: hidden;}
      .search-result ul{padding:0px; margin:0px; list-style: none; width: 550px; background: white; max-height: 200px; overflow: scroll;}
      .search-result ul li{border-bottom: 1px solid #dddddd; display: flex;}
      .search-result img{width: 40px;}
    </style>
    <script type="text/javascript">
      function searchForm(event){
        //nếu là phím enter thì sẽ di chuyển đến trang tìm kiếm
        if(event.which == 13)
          location.href = '{{ url('products/search') }}?key='+document.getElementById('key').value;
      }
      //kiểm tra xem jquery đã được load vào trang hay chưa
      /*$(document).ready(function(){
        alert('ok');
      });*/
      function ajaxSearch(){
        let key = document.getElementById('key').value;
        if(key != ''){
          //hiển thị search result
          $(".search-result").attr('style','visibility:visible');
          //---
          $.ajax({
            url: "{{ url('products/ajax-search') }}?key="+key,
            success: function( result ) {
              //clear content trong thẻ ul
              $('.search-result ul').empty();
              $('.search-result ul').append(result);
            }
          });
          //---
        }else
          $(".search-result").attr('style','visibility:hidden');
      }
    </script>
<?php 
  //load file Cart.php vào đây để sử dụng
  use App\Http\ShoppingCart\Cart;
 ?>
    <div class="col-xs-12 col-sm-12 col-md-3 mini-cart">
      <div class="wrapper-mini-cart"> <span class="icon"><i class="fa fa-shopping-cart"></i></span> <a href="cart"> <span class="mini-cart-count"> {{ Cart::cartNumber() }} </span> sản phẩm <i class="fa fa-caret-down"></i></a>
        <div class="content-mini-cart">
          <div class="has-items">
          @if(Cart::cartNumber() > 0)
            <ul class="list-unstyled">
            @php
              $cart = Cart::cartList();
            @endphp            
              @foreach($cart as $product)
                <li class="clearfix" id="item-1853038">
                  <div class="image"> <a href="{{ url('products/detail/'.$product['id']) }}"> <img alt="{{ $product['name'] }}" src="{{ asset('upload/products/'.$product['photo']) }}" title="{{ $product['name'] }}" class="img-responsive"> </a> </div>
                  <div class="info">
                    <h3><a href="{{ url('products/detail/'.$product['id']) }}">{{ $product['name'] }}</a></h3>
                    <p>{{ $product['quantity'] }} x {{ number_format($product['price']) }}₫</p>
                  </div>
                  <div> <a href="{{ url('cart/remove/'.$product['id']) }}"> <i class="fa fa-times"></i></a> </div>
                </li>
              @endforeach            
            </ul>
            <a href="{{ url('cart') }}" class="button">Chi tiết</a> </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end middle header --> 
<!-- bottom header -->
<div class="bottom-header">
  <div class="container">
    <div class="clearfix">
      <ul class="main-nav hidden-xs hidden-sm list-unstyled">
        <li class="active"><a href="{{ asset('') }}">Trang chủ</a></li>
        <li class="has-submenu"> <a href="#"> <span>Sản phẩm</span><i class="fa fa-caret-down" style="margin-left: 5px;"></i> </a>
          <ul class="list-unstyled level1">
          @php
            $categories = DB::table("categories")->where("parent_id","=",0)->orderBy("id","desc")->get();
          @endphp
          @foreach($categories as $row)
            <li><a href="{{ url('products/category/'.$row->id) }}">{{ $row->name }}</a></li>
            <!-- lấy các danh mục con -->
            @php
              $subCategories = DB::table("categories")->where("parent_id","=",$row->id)->orderBy("id","desc")->get();
            @endphp
            @foreach($subCategories as $subRow)
              <li style="padding-left:20px;"><a href="{{ url('products/category/'.$subRow->id) }}">{{ $subRow->name }}</a></li>
            @endforeach
          @endforeach
          </ul>
        </li>
        <li ><a href="{{ asset('cart') }}">Giỏ hàng</a></li>

        <li><a href="{{ asset('contact') }}">Liên hệ</a></li>
      </ul>
      <a href="javascript:void(0);" class="toggle-main-menu hidden-md hidden-lg"> <i class="fa fa-bars"></i> </a>
      <!-- responsive -->
      <ul class="list-unstyled mobile-main-menu hidden-md hidden-lg" style="display:none">
        <li class="active"><a href="index.php">Trang chủ</a></li>
        <li><a href="#">Giới thiệu</a></li>
        <li><a href="#">Tin tức</a></li>
        <li><a href="#">Liên hệ</a></li>
      </ul>
      <!-- /responsive -->
    </div>
  </div>
</div>
<!-- end bottom header -->
</header>
<!-- end header -->