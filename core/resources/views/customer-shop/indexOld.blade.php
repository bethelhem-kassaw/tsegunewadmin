<x-customer-layout>
<!-- main wrapper -->
<div class="main-wrapper">
@section('title') - Home  @endsection
<section class="section bg-gray hero-area">
  <div class="container">
    <div class="hero-slider">
      
      <!-- Start the slide  -->
      @foreach($sliders as $slider)
      <div class="slider-item">
        <div class="row">
          <div class="col-lg-6 align-self-center text-center text-md-left mb-4 mb-lg-0 d-sm-none d-md-block d-lg-block">
            <h3 data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in="0" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">{{ $slider->category }}</h3>
            <!-- Start Title -->
            <h1 data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".2" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">{{ $slider->name }}</h1> 
            <!-- end title -->
            <!-- Start Subtitle -->
            <h3 class="mb-4" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".4" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">{{ $slider->offer }}</h3>
            <!-- end subtitle -->
            <!-- Start description -->
            <p class="mb-4" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".6" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">{{ $slider->description }}</p>
            <!-- end description -->
            <!-- Start button -->
            <a href="{{ route('shop.list')}}" class="btn btn-primary" data-duration-in=".5" data-animation-in="fadeInLeft" data-delay-in=".8" data-animation-out="fadeOutLeft" data-delay-out="5" data-duration-out=".3">shop now</a>
            <!-- end button -->
          </div>
          <!-- Start slide image -->
          <div class="col-lg-6 text-center text-md-left">
            <!-- background letter -->
            <div class="bg-letter">
              <span data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1.2" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
                C 
              </span>
              <!-- Slide image -->
              <img class="img-fluid d-unset" src="{{ asset('storage/'.$slider->path) }}" alt="converse" data-duration-in=".5" data-animation-in="fadeInRight" data-delay-in="1" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-out=".3">
            </div>
          </div>
          <!-- end slide image  -->
        </div>
      </div> <!-- end slider item -->
      @endforeach
    </div>
  </div>
</section>
<!-- /hero area -->

<!-- categories -->
@include('customer-shop.blocks.top-categories', ['categories' => $categories])
<!-- /categories -->

<section class="section overlay cta" data-background="customer/images/backgrounds/cta.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1 class="text-white mb-2">End of Season Sale</h1>
        <p class="text-white mb-4">Take 25% off all sweaters and knits. Discount applied at checkout.</p>
        <a href="{{ route('shop.list') }}" class="btn btn-light">shop now</a>
      </div>
    </div>
  </div>
</section>

@include('customer-shop.blocks.top-collections')

<div id="quickView" class="quickview">
  <div class="row w-100">
    <div class="col-lg-6 col-md-6 mb-5 mb-md-0 pl-5 pt-4 pt-lg-0 pl-lg-0">
      <img src="customer/images/feature/product.png" alt="product-img" class="img-fluid">
    </div>
    <div class="col-lg-5 col-md-6 text-center text-md-left align-self-center pl-5">
      <h3 class="mb-lg-2 mb-2">Woven Crop Cami</h3>
      <span class="mb-lg-4 mb-3 h5">$90.00</span>
      <p class="mb-lg-4 mb-3 text-gray">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. sed ut perspic atis unde omnis iste natus</p>
      <form action="#">
        <select class="form-control w-100 mb-2" name="color">
          <option value="brown">Brown Color</option>
          <option value="gray">Gray Color</option>
          <option value="black">Black Color</option>
        </select>
        <select class="form-control w-100 mb-3" name="size">
          <option value="small">Small Size</option>
          <option value="medium">Medium Size</option>
          <option value="large">Large Size</option>
        </select>
        <button class="btn btn-primary w-100 mb-lg-4 mb-3">add to cart</button>
      </form>
      <ul class="list-inline social-icon-alt">
        <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="ti-vimeo-alt"></i></a></li>
        <li class="list-inline-item"><a href="#"><i class="ti-google"></i></a></li>
      </ul>
    </div>
  </div>
</div>
<!-- collection -->

<!-- /collection -->

<!-- deal -->
@if ( $dealofday ) @include('customer-shop.blocks.dealof-day', ['dealofday' => $dealofday]) @endif
<!-- /deal -->


<!-- service -->
<section class="section-sm border-top">
  <div class="container">
    <div class="row">
      <!-- service item -->
      <div class=" col-md-3 col-sm-4 col-6 mb-4 mb-lg-0">
        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
          <i class="ti-truck icon-lg mr-4 mb-3 mb-sm-0"></i>
          <div class="text-center text-sm-left">
            <h4>Free Shipping</h4>
            <p class="mb-0 text-gray">Free shipping all across Ethiopia</p>
          </div>
        </div>
      </div>
      <!-- service item -->
      <div class=" col-md-3 col-sm-4 col-6 col-sm-6 mb-4 mb-lg-0">
        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
          <i class="ti-shield icon-lg mr-4 mb-3 mb-sm-0"></i>
          <div class="text-center text-sm-left">
            <h4>Secure Payment</h4>
            <p class="mb-0 text-gray">We ensure secure payment with PEV</p>
          </div>
        </div>
      </div>
      <!-- service item -->
      <div class=" col-md-3 col-sm-4 col-6 col-sm-6 mb-4 mb-lg-0">
        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
          <i class="ti-timer icon-lg mr-4 mb-3 mb-sm-0"></i>
          <div class="text-center text-sm-left">
            <h4>Support 24/7</h4>
            <p class="mb-0 text-gray">Contact us 24 hours a day, 7 days a week</p>
          </div>
        </div>
      </div>
      <!-- service item -->
      <div class=" col-md-3 col-sm-4 col-6  col-sm-6 mb-4 mb-lg-0">
        <div class="d-flex flex-sm-row flex-column align-items-center align-items-sm-start">
          <i class="ti-reload icon-lg mr-4 mb-3 mb-sm-0"></i>
          <div class="text-center text-sm-left">
            <h4>Live Tracking</h4>
            <p class="mb-0 text-gray">Track your order status through our integrated order tracking system</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /service -->

<!-- newsletter -->
<section class="section bg-gray">
  @livewire('subscriber')
</section>
<!-- /newsletter -->
@if($popup)
<!-- Newsletter Modal -->
<div class="modal fade subscription-modal" id="subscriptionModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <!-- modal content start -->
    <div class="modal-content">
      <!-- container start -->
      <div class="container-fluid">
        <div class="row">
            <!-- close button -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          <div class="col-lg-6 px-0">
            <!-- newsletter image -->
            <div class="image">
              <img style="height: 400px;" src="{{asset('storage/'.$popup->path)}}" alt="products" class="img-fluid w-100 rounded-left">
            </div>
          </div>
          <div class="col-lg-6 align-self-center p-5">
            <!-- Content start -->
            <div class="text-center align-self-center">
              <h3 class="mb-lg-5 mb-4">{{$popup->title}}</h3>
              <h4>{{ $popup->description }}</h4>
              <h2 class="mb-lg-5 mb-4">{{ $popup->offer }}</h2>
              <!-- newsletter form -->
              <div class="form">
                <a href="{{ route('shop.product-single', $popup->product_id) }}"  class="btn btn-primary w-100" type="submit">Get it now</a>
              </div>
            </div>
            <!-- Content end -->
          </div>
        </div>
      </div>
      <!-- container end -->
    </div>
    <!-- modal content end -->
  </div>
</div>
@endif
<!-- /Newsletter Modal -->
</x-customer-layout>