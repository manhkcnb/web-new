<!doctype html>
<!--[if !IE]><!-->
<html lang="vi">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta http-equiv="content-language" content="vi" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="robots" content="noodp,index,follow" />
<meta name='revisit-after' content='1 days' />
<meta name="keywords" content="">
<title>DKT Store</title>
<link rel="shortcut icon" href="{{ asset('frontend/100/047/633/themes/517833/assets/favicon221b.png?1481775169361') }}" type="image/x-icon" />
<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=vietnamese" rel="stylesheet"> -->
<link href='{{ asset("frontend/100/047/633/themes/517833/assets/font-awesome.min221b.css?1481775169361") }}' rel='stylesheet' type='text/css' />
<link href='{{ asset("frontend/100/047/633/themes/517833/assets/bootstrap.min221b.css?1481775169361") }}' rel='stylesheet' type='text/css' />
<link href='{{ asset("frontend/100/047/633/themes/517833/assets/owl.carousel221b.css?1481775169361") }}' rel='stylesheet' type='text/css' />
<link href='{{ asset("frontend/100/047/633/themes/517833/assets/responsive221b.css?1481775169361") }}' rel='stylesheet' type='text/css' />
<link href='{{ asset("frontend/100/047/633/themes/517833/assets/styles.scss221b.css?1481775169361") }}' rel='stylesheet' type='text/css' />
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/jquery.min221b.js?1481775169361") }}' type='text/javascript'></script>
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/bootstrap.min221b.js?1481775169361") }}' type='text/javascript'></script>
<script src='{{ asset("frontend/assets/themes_support/api.jquerya87f.js?4' type='text/javascript") }}'></script>
<link href='{{ asset("frontend/100/047/633/themes/517833/assets/bw-statistics-style221b.css?1481775169361") }}' rel='stylesheet' type='text/css' />
</head>
<body class="index">
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/648dece0cc26a871b0232a0f/1h356ak5b';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!-- header -->
@include("frontend.header")
<!-- end header -->
<div class="content">
  <div class="container">
    <div class="row">
      <!-- left -->
      <div class="col-xs-12 col-md-3"> 
        <!-- box search -->
        <div class="panel panel-default" style="margin-top:15px;">
          <div class="panel-heading"> Tìm theo mức giá </div>
          <div class="panel-body" style="padding:0px; margin:0px;">
            <ul class="list-group" style="border:0px;padding:0px; margin:0px;">
              <li class="list-group-item" style="border:0px;">Giá từ &nbsp;&nbsp;
                <input type="number" min="0" value="0" id="fromPrice" class="form-control" />
              </li>
              <li class="list-group-item" style="border:0px;">Đến &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="number" min="0" value="0" id="toPrice" class="form-control"/>
              </li>
              <li class="list-group-item" style="border:0px; text-align:center">
                <input type="button" class="btn btn-warning" value="Tìm mức giá" onclick="location.href = '{{ asset('products/searchPrice') }}?fromPrice='+ document.getElementById('fromPrice').value + '&toPrice=' + document.getElementById('toPrice').value;" />
              </li>
            </ul>
          </div>
        </div>
        <!-- end box search -->
        <!-- hot news -->
       
        <!-- end hot news -->
        <!-- end support -->
        <div class="online_support block" style="margin-top:10px;">
          <div class="new_title">
            <h2>Hỗ trợ trực tuyến</h2>
          </div>
          <div class="block-content">
            <div class="sp_1">
              <p>Tư vấn bán hàng 1</p>
              <p>Mrs. Dung: (04) 3786 8904</p>
            </div>
            <div class="sp_1">
              <p>Tư vấn bán hàng 2</p>
              <p>Mr. Tuấn: (04) 3786 8904</p>
            </div>
            <div class="sp_1">
              <p>Email liên hệ</p>
              <p>support@mail.com</p>
            </div>
          </div>
        </div>
        <!-- end support online -->          
        
         
        <!-- adv --> 
        <img src="{{ asset('frontend/images/banner03d5.jpg') }}"> 
        <!-- end adv --> 
        
      </div>
      <!-- /left -->
      <!-- right -->
      <div class="col-xs-12 col-md-9"> 
        <!-- main -->
        
        @yield("do-du-lieu-vao-layout")
        
        <!-- end main --> 
      </div>
      <!-- /right -->
    </div>
    <!-- adv -->
    <div class="widebanner"> <a href="#"><img src="frontend/100/047/633/themes/517833/assets/widebanner221b.jpg?1481775169361" alt="#" class="img-responsive"></a> </div>
    <!-- end adv --> 
    
  </div>
</div>
<div class="privacy">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-4">
        <div class="image"> <img src="{{ asset('frontend/100/047/633/themes/517833/assets/ico-service-1221b.png?1481775169361') }}" alt="Giao hàng miễn phí" title="Giao hàng miễn phí" class="img-responsive"> </div>
        <div class="info">
          <h3>Giao hàng miễn phí</h3>
          <p>Miễn phí giao hàng trong nội thành Hà Nội</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="image"> <img src="{{ asset('frontend/100/047/633/themes/517833/assets/ico-service-2221b.png?1481775169361') }}" class="img-responsive" alt="Khuyến mại" title="Khuyến mại"> </div>
        <div class="info">
          <h3>Khuyến mại</h3>
          <p>Khuyến mại sản phẩm nếu đơn hàng trên 1.000.000đ</p>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4">
        <div class="image"> <img src="{{ asset('frontend/100/047/633/themes/517833/assets/ico-service-3221b.png?1481775169361') }}" class="img-responsive" alt="Hoàn trả lại tiền" title="Hoàn trả lại tiền"> </div>
        <div class="info">
          <h3>Hoàn trả lại tiền</h3>
          <p>Nếu sản phẩm không đảm bảo chất lượng hoặc sản phẩm không đúng miêu tả</p>
        </div>
      </div>
    </div>
  </div>
</div>
<footer id="footer">
  <div class="top-footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-3">
          <h3>Về chúng tôi</h3>
          <ul class="list-unstyled">
            <li><a href="index.html">Trang chủ</a></li>
            <li><a href="gioi-thieu">Giới thiệu</a></li>

            <li><a href="gioi-thieu">Liên hệ</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h3>Hướng dẫn</h3>
          <ul class="list-unstyled">
            <li><a href="huo-ng-da-n-mua-ha-ng">Hướng dẫn mua hàng</a></li>
            <li><a href="huong-dan">Giao nhận và thanh toán</a></li>
            <li><a href="do-i-tra-va-ba-o-ha-nh">Đổi trả và bảo hành</a></li>
            <li><a href="account/register">Đăng ký thành viên</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h3>Chính sách</h3>
          <ul class="list-unstyled">
            <li><a href="chinh-sach">Chính sách thanh toán</a></li>
            <li><a href="chi-nh-sa-ch-va-n-chuye-n">Chính sách vận chuyển</a></li>
            <li><a href="chi-nh-sa-ch-do-i-tra">Chính sách đổi trả</a></li>
            <li><a href="chi-nh-sa-ch-ba-o-ha-nh">Chính sách bảo hành</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3">
          <h3>Điều khoản</h3>
          <ul class="list-unstyled">
            <li><a href="dieu-khoan">Điều khoản sử dụng</a></li>
            <li><a href="die-u-khoa-n-giao-di-ch">Điều khoản giao dịch</a></li>
            <li><a href="di-ch-vu-tie-n-i-ch">Dịch vụ tiện ích</a></li>
            <li><a href="quye-n-so-hu-u-tri-tue">Quyền sở hữu trí tuệ</a></li>
          </ul>
        </div>
      </div>
      <div class="payments-method"> <img src="{{ asset('frontend/100/047/633/themes/517833/assets/payments-method221b.png?1481775169361') }}" alt="Phương thức thanh toán" title="Phương thức thanh toán"> </div>
    </div>
  </div>
  <div class="bottom-footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-5"> © Bản quyền DKT Store</div>
        <div class="col-xs-12 col-sm-7">
          <ul class="list-unstyled">
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Giới thiệu</a></li>

            <li><a href="#">Liên hệ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/owl.carousel.min221b.js?1481775169361") }}' type='text/javascript'></script> 
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/responsive-menu221b.js?1481775169361") }}' type='text/javascript'></script> 
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/elevate-zoom221b.js?1481775169361") }}' type='text/javascript'></script> 
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/main221b.js?1481775169361") }}' type='text/javascript'></script> 
<script src='{{ asset("frontend/100/047/633/themes/517833/assets/ajax-cart221b.js?1481775169361") }}' type='text/javascript'></script>
</body>
</html>