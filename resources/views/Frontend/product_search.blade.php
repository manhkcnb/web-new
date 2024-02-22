@extends("frontend.layout_shop")
@section("do-du-lieu-vao-layout")
<div class="special-collection">
  <div class="tabs-container">
    <div class="row" style="margin-top:10px;">
      <div class="head-tabs head-tab1 col-lg-12">
        <h2>Tìm kiếm từ {{number_format($fromPrice)}} đến {{number_format($toPrice)}}</h2>
      </div>
      <div class="col-lg-3 pull-right text-right">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <div class="tabs-content row">
    <div id="content-tabb1" class="content-tab content-tab-proindex" style="display:none">
      <div class="clearfix">
        @foreach($data as $row)
        <!-- box product -->
        <div class="col-xs-6 col-md-3 col-sm-6 ">
          <div class="product-grid" id="product-1168979" style="height: 370px; overflow: hidden;border-radius:3% 3%">
            <div class="image"> <a href="#"><img style="height:142px" style="height:142px"
                  src="{{ asset('upload/products/'.$row->photo) }}" title="{{ $row->name }}" alt="{{ $row->name }}"
                  class="img-responsive"></a> </div>
            <div class="info">
              <h3 class="name"><a href="{{ url('products/detail/'.$row->id) }}">{{ $row->name }}</a></h3>
              <p class="price-box"> <span class="special-price"> <span class="price product-price"
                    style="text-decoration:line-through;"> {{ number_format($row->price) }}</span> ₫ </span> </p>
              <p class="price-box"> <span class="special-price"> <span class="price product-price"> {{
                    number_format($row->price - ($row->price * $row->discount)/100) }} </span>₫ </span> </p>
              <p class="price-box">
                <a href="{{ url('products/rating/'.$row->id.'/1') }}"><img
                    src="{{ asset('frontend/images/star.jpg') }}"></a>
                <a href="{{ url('products/rating/'.$row->id.'/2') }}"><img
                    src="{{ asset('frontend/images/star.jpg') }}"></a>
                <a href="{{ url('products/rating/'.$row->id.'/3') }}"><img
                    src="{{ asset('frontend/images/star.jpg') }}"></a>
                <a href="{{ url('products/rating/'.$row->id.'/4') }}"><img
                    src="{{ asset('frontend/images/star.jpg') }}"></a>
                <a href="{{ url('products/rating/'.$row->id.'/5') }}"><img
                    src="{{ asset('frontend/images/star.jpg') }}"></a>
              </p>
              <div class="action-btn">
                <form>
                  @if($row->quantity!=0)
                  <a href="{{ url('cart/buy/'.$row->id) }}" class="button">Add to Cart</a>
                  <!-- rating -->
                  @else
                  <p style="color: red">Đã hết hàng</p>
                  @endif
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- end box product -->
        @endforeach
        <!-- paging -->
        <div style="clear: both;"></div>
        <div style="margin-top: -50px;"
          class="&#x70;&#x61;&#x67;&#x69;&#x6E;&#x61;&#x74;&#x69;&#x6F;&#x6E;&#x2D;&#x63;&#x6F;&#x6E;&#x74;&#x61;&#x69;&#x6E;&#x65;&#x72;">
          {{ $data->render() }}
        </div>
        <!-- end paging -->
      </div>
    </div>
  </div>
</div>
@endsection