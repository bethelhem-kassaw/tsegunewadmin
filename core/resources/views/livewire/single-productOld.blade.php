<section>
<style>
    .my-grid {
        display:grid; 
        grid-template-columns:1fr 1fr 1fr 1fr;
    }
    @media screen and (max-width: 700px){
        .my-grid {
        display:grid; 
        grid-template-columns:1fr 1fr;
        }
    }
    @media screen and (max-width: 380px){
        .my-grid {
        display:grid; 
        grid-template-columns:1fr;
        }
    }
</style>
    <div class="main-wrapper">
    @section('title') - Product details  @endsection
        <!-- breadcrumb -->
        @include('customer-shop.blocks.breadcrumb', ['page' => 'Single Product'])
        <!-- product-single -->
        <section class="section">
            <div class="container">
                <div class="row p-3" style="margin-top:-40px;border-radius:6px">
                    <div class="col-lg-6 mb-4 mb-lg-0" style="padding-top:10px;padding-bottom: 15px;border-radius:4px">
                        <!-- product image slider -->
                        <div class="product-slider" >
                            <div data-image="{{ asset('storage/'.$product->photos[0])}}">
                                <img style="height:400px;margin-left:auto;margin-right:auto;display:block;" class="img-fluid image-zoom" src="{{ asset('storage/'.$product->photos[0]) }}" alt="product-img" data-zoom="{{ asset('storage/'.$product->photos[0]) }}">
                            </div>
                            @if(count($product->photos) >=2 )
                            <div data-image="{{ asset('storage/'.$product->photos[1]) }}">
                                <img style="height:400px;margin-left:auto;margin-right:auto;display:block;" class="img-fluid image-zoom" src="{{ asset('storage/'.$product->photos[1]) }}" alt="product-img" data-zoom="{{ asset('storage/'.$product->photos[1]) }}">
                            </div>
                            @endif
                            @if(count($product->photos) >=3 )
                            <div data-image="{{ asset('storage/'.$product->photos[2]) }}">
                                <img style="height:400px;margin-left:auto;margin-right:auto;display:block;" class="img-fluid image-zoom" src="{{ asset('storage/'.$product->photos[2]) }}" alt="product-img" data-zoom="{{ asset('storage/'.$product->photos[2]) }}">
                            </div>
                            @endif
                            @if(count($product->photos) >= 4 )
                            <div data-image="{{ asset('storage/'.$product->photos[3])}}">
                                <img style="height:400px;margin-left:auto;margin-right:auto;display:block;" class="img-fluid image-zoom" src="{{ asset('storage/'.$product->photos[3]) }}" alt="product-img" data-zoom="{{ asset('storage/'.$product->photos[3]) }}">
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- produt details -->
                    <div class="col-lg-6" style="padding-top:10px;padding-bottom:15px;border-radius:4px;">
                        <h2>{{ $product->name }}</h2>
                        <i class="ti-check-box text-{{ $product->instock?'success':'danger'}}"></i>
                        <span class="text-{{ $product->instock?'success':'danger'}}">{{ $product->instock?'Instock':'Outofstock'}}</span>
                        <ul class="list-inline mb-4">
                            <li class="list-inline-item mx-0"><a href="#" class="rated"><i class="ti-star"></i></a></li>
                            <li class="list-inline-item mx-0"><a href="#" class="rated"><i class="ti-star"></i></a></li>
                            <li class="list-inline-item mx-0"><a href="#" class="rated"><i class="ti-star"></i></a></li>
                            <li class="list-inline-item mx-0"><a href="#" class="rated"><i class="ti-star"></i></a></li>
                            <li class="list-inline-item mx-0"><a href="#" class="rated"><i class="ti-star"></i></a></li>
                            <li class="list-inline-item"><a href="#" class="text-gray ml-3">( 3 Reviews )</a></li>
                        </ul>
                        <h4 class="text-primary h3">${{ $product->price }} @if($product->discount != 0)<s class="text-color ml-2">${{$product->discount + $product->price}}</s>@endif</h4>
                        @if($product->discount != 0)
                        <h6 class="mb-4">You save: <span class="text-primary">${{$product->discount}} USD ({{ round(($product->discount)/($product->price + $product->discount)*100,2) }}%)</span></h6>
                        @endif
                        <div class="d-flex flex-column flex-sm-row justify-content-between mb-4">
                            <div>
                                <input wire:model.live="quantity" class="quantity mr-sm-2 mb-3 mb-sm-0" type="text" name="quantity">
                            </div>
                            @foreach ($product->attributes as $attribute)
                            <select name="{{ $attribute->name }}" id="{{ $attribute->name }}" onchange="specChanged('{{ $attribute->name }}')" class="form-control mx-sm-2 mb-3 mb-sm-0">
                                @php($values = explode(',' ,$attribute->pivot->values))
                                <option value="">{{ $attribute->name }}</option>
                                @foreach($values as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @endforeach
                        </div>
                        <button wire:click="toCart" class="btn btn-primary mb-4">Add to cart</button>
                        <h4 class="mb-3"><span class="text-primary">Harry up!</span> Sale ends in</h4>
                        <!-- syo-timer -->
                        <div class="syotimer dark">
                            <div id="sale-timer" data-year="2019" data-month="5" data-day="1" data-hour="1"></div>
                        </div>
                        <hr> 
                        <div class="payment-option border border-primary mt-5 mb-4">
                            <h5 class="bg-white">Guaranted Safe Checkout</h5>
                            <img class="img-fluid w-100 p-3" src="{{ asset('customer/images/payment-card/all-card.png')}}" alt="payment-card">
                        </div>
                        <h5 class="mb-3">4 Great Reason to Buy From Us</h5>
                        <div class="row">
                            <!-- service item -->
                            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                                <div class="d-flex">
                                    <i class="ti-truck icon-md mr-3"></i>
                                    <div class="align-items-center">
                                        <h6>Free shipping across Ethiopia</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- service item -->
                            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                                <div class="d-flex">
                                    <i class="ti-shield icon-md mr-3"></i>
                                    <div class="align-items-center">
                                        <h6>Secure Payment</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- service item -->
                            <div class="col-lg-3 col-6 mb-4 mb-lg-0">
                                <div class="d-flex">
                                    <i class="ti-money icon-md mr-3"></i>
                                    <div class="align-items-center">
                                        <h6>Lowest Price</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="padding-top:20px;border-radius:4px;">
                        <h3 class="mb-3">Product Description</h3>
                        <p class="text-gray mb-4">
                            {{$product->description}}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- /product-single -->

        <!-- related products -->
        @if(count($relatedProducts))
        <section class="section" style="margin-top:-80px">
            <div class="container">
                <div class="col-lg-12">
                        <h2 class="mb-4" style="margin-top:10px;font-weight:600">Related Products</h2>
                    </div>
                <div class="row my-grid" style="border-radius:6px">
                    
                    <!-- product -->
                    @foreach ($relatedProducts as $product)
                    <div class="mb-4  card" style="padding-top:10px;margin:10px;border-radius:4px;">
                        <div class="product text-center">
                            <div class="product-thumb">
                                <div class="overflow-hidden position-relative">
                                    <a href="{{ route('shop.product-single', $product->id )}}">
                                        <img class="img-fluid w-100 mb-1 img-first" style="border-bottom: solid 1px rgb(230, 230, 230);" src="{{ asset('storage/'.$product->photos[0])}}" alt="product-img">
                                        @if(count($product->photos) > 0)
                                        <img class="img-fluid w-100 mb-3 img-second" src="{{ asset('storage/'.$product->photos[1])}}" alt="product-img">
                                        @endif
                                    </a>
                                    <div class="btn-cart">
                                        <button wire:click="$dispatch('toCart', {{$product->id}})" class="btn btn-primary btn-sm">Add To Cart</button>
                                    </div>
                                </div>
                            </div>
                            <div class="product-info">
                                <h3 class="h5"><a class="text-color" href="{{ route('shop.product-single')}}">{{$product->name}}</a></h3>
                                <p class="h5">${{$product->price}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- //end of product -->
                </div>
            </div>
        </section>
        @endif
    </div>
    <script>
        function specChanged(name){
            let value = document.getElementById(name).value;
            Livewire.emit('specChanged', {name,value})
        }
    </script>
</section>