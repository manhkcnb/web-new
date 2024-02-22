@extends("frontend.layout_shop")
@section("do-du-lieu-vao-layout")
@php
	function getCategoryName($category_id){
		//->select("name") chỉ select cột có tên là name
		$record = DB::table("categories")->where("id","=",$category_id)->select("name")->first();
		return isset($record->name) ? $record->name : "";
	}
 //hàm lấy số sao
  function getStar($product_id,$star){
    $list_record = DB::table("rating")->where("product_id","=",$product_id)->where("star","=",$star)->get();
    return $list_record->Count();
  }
@endphp
<!-- <div class="product-detail" itemscope itemtype="http://schema.org/Product"> -->
  <div class="top">
    <div class="row">
      <div class="col-xs-12 col-md-6 product-image">
        <div class="featured-image"> 
          <img src="{{ asset('upload/products/'.$record->photo) }}" style="width: 100%;" class="img-responsive"/>
        </div>
      </div>
      <div class="col-xs-12 col-md-6 info">
        <h1 itemprop="name">{{ $record->name }}</h1>
        <p class="vendor"> Category:&nbsp; <span> {{ getCategoryName($record->category_id) }} </span></p>
        <p class="vendor"> Quantity:&nbsp; <span> {{ $record->quantity }} </span></p>
        <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price" style="text-decoration:line-through;"> {{ number_format($record->price) }}₫ </span></span></p>
        <p itemprop="price" class="price-box product-price-box"> <span class="special-price"> <span class="price product-price"> {{ number_format($record->price - ($record->price * $record->discount)/100) }}₫ </span></span></p>
      </p>
      @if($record->quantity!=0)
      <a href="{{ url('cart/buy/'.$record->id) }}" class="btn btn-primary">Cho vào giỏ hàng</a>
      <!-- rating -->
      @else
      <h3 style="color: red">Đã hết hàng</h3>
      @endif
      <div style="border:1px solid #dddddd; margin-top: 15px;">
        <h4 style="padding-left: 10px;">Rating</h4>
        <table style="width: 100%;">
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-primary">{{getStar($record->id,1)}}vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-warning">{{getStar($record->id,2)}}vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-danger">{{getStar($record->id,3)}}vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-info">{{getStar($record->id,4)}}vote</span></td>
          </tr>
          <tr>
            <td style="width: 80%; padding-left: 10px;"><img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"> <img src="{{ asset('frontend/images/star.jpg') }}"></td>
            <td><span class="label label-success">{{getStar($record->id,5)}}vote</span></td>
          </tr>
        </table>
        <br>
      </div>
      <!-- /rating -->
    </div>
  </div>
</div>
<div class="middle" style="margin-top:20px;">
  <!-- chi tiet -->
  <div id="description" class="limited">{!! $record->description !!}</div>
  <div id="content" class="limited">{!! $record->content !!}</div>
  <!-- chi tiet -->
  <button id="readMoreBtn" onclick="readMore()">Xem thêm</button>
</div>

<script>
function readMore() {
  var description = document.getElementById("description");
  var content = document.getElementById("content");
  var readMoreBtn = document.getElementById("readMoreBtn");

  if (description.classList.contains("limited")) {
    description.classList.remove("limited");
    content.classList.remove("limited");
    readMoreBtn.innerHTML = "Thu gọn";
  } else {
    description.classList.add("limited");
    content.classList.add("limited");
    readMoreBtn.innerHTML = "Xem thêm";
  }
}
</script>

<style>
.limited {
  max-height: 5em;
  overflow: hidden;
}
.comment-box {
  margin-top: 5px;
  padding: 20px;
  font-family: Arial, sans-serif;
}

.comment-box h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.comment-list {
  margin-bottom: 20px;
}

.comment {
  margin-bottom: 10px;
  font-size: 14px;
}

.comment-author {
  font-weight: bold;
  margin-right: 10px;
}



.comment-form textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  resize: vertical;
}

.comment-form button {
  padding: 8px 16px;
  background-color: #4caf50;
  color: white;
  border: none;
  cursor: pointer;
}

.comment-form button:hover {
  background-color: #45a049;
}
</style>

<div class="comment-box">
  <h3>Bình luận</h3>
  <div class="comment-list">
    <!-- Hiển thị danh sách các bình luận -->
    @php
    $comment =DB::table("comment")->where("product_id","=",$record->id)->get();
    @endphp
    @foreach($comment as $key)
    <div class="comment">
      <div class="comment-author">{{$key->user_name}}</div>
      <div class="comment-text">{{$key->content}}</div>
    </div>
    @endforeach
    <!-- Thêm các bình luận khác vào đây -->
  </div>
  <form class="comment-form" method="post" action="{{ url('comment/'.$record->id) }}">
    @csrf

    <textarea name="comment" placeholder="Viết bình luận của bạn"></textarea>
    <button type="submit">Gửi</button>
  </form>

</div>


@endsection