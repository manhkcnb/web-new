
<div class="row">
  <div class="col-xs-16">
    <!-- Carousel -->
    <div class="owl-slider">

      <div class="item"> 
        <!-- ============================ -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
          <!-- Indicators -->
          <ol class="carousel-indicators">
            @php
            $slides = DB::table("slide")->where("display","=","1")->get(); // Lấy danh sách bản ghi từ bảng "slide"
            @endphp
            @foreach ($slides as $key => $slide)
            <li data-target="#myCarousel" data-slide-to="{{ $key }}" @if ($key == 0) class="active" @endif></li>
            @endforeach
          </ol>
          
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            @foreach ($slides as $key => $slide)
            <div class="item @if ($key == 0) active @endif"> 
              <img style="width: 1140px;height: 550px; margin:auto;" src="{{ asset('upload/slide/' . $slide->photo) }}" alt="{{ $slide->name }}"> 
            </div>
            @endforeach
          </div>
          
          <!-- Left and right controls --> 
        </div>
        <!-- ============================ --> 
      </div>
    </div>
    <!-- end Carousel --> 
  
  </div>
</div>
<!-- /slide -->
