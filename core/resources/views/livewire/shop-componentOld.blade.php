<div>
    <!-- /shop -->
    <style>
        .my-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
        }

        @media screen and (max-width: 700px) {
            .my-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media screen and (max-width: 380px) {
            .my-grid {
                display: grid;
                grid-template-columns: 1fr;
            }
        }

        /* because of price filter */
        .wrapper {
            width: 280px;
        }


        .price-input {
            width: 80%;
            display: flex;
            margin: 25px 0 15px;
        }

        .price-input .field {
            display: flex;
            width: 100%;
            height: 25px;
            align-items: center;
        }

        .field input {
            width: 100%;
            height: 70%;
            outline: none;
            font-size: 18px;

            border-radius: 5px;
            text-align: center;
            border: 1px solid #999;
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .price-input .separator {
            width: 150px;
            display: flex;
            font-size: 19px;
            align-items: center;
            justify-content: center;
        }

        .slider {
            height: 5px;
            position: relative;
            width: 80%;
            background: #ddd;
            border-radius: 5px;
        }

        .slider .progress {
            height: 100%;
            position: absolute;
            border-radius: 5px;
            background-color: #ddd;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 80%;
            height: 5px;
            top: -24px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            height: 17px;
            width: 17px;
            border-radius: 0%;
            background: #ff4135;
            pointer-events: auto;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        input[type="range"]::-moz-range-thumb {
            height: 17px;
            width: 17px;
            border: none;
            border-radius: 50%;
            background: #ff4135;
            pointer-events: auto;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);

            -webkit-appearance: none;
            -moz-appearance: none;
        }
        .filter-by {
            color:rgb(0,0,0);
            font-weight:600;
        }

        /* end price filter */
    </style>
    @section('title') - Shop @endsection
    <section class="section">
        <div class="container" style="border-radius:6px;">
            <div class="mb-20" style="margin-left:-16px;border-radius:4px;padding-left:10px;padding-top:10px;">
                <div class="d-flex border">
                    <div class="border-right text-center rounded-md" style="display:flex;">
                        <button wire:click="$set('viewType', 'list')" class="pl-4 text-gray d-inline-block  border-0  {{$viewType=='list'?'text-primary':''}}"><i class="ti-view-list-alt"></i></button>
                        <button wire:click="$set('viewType', 'grid')" class="pr-4 text-gray d-inline-block border-0 {{$viewType=='grid'?'text-primary':''}}"><i class="ti-layout-grid3-alt"></i></button>
                    </div>
                    <div class="flex-basis-55 p-2 p-sm-4 align-self-sm-center">

                    </div>
                </div>
            </div>
            <!-- top bar -->
            <div class="row">
                <!-- sidebar -->
                <div class="d-none d-lg-block">
                    <!-- categories -->
                    <div class="mb-30" style="padding-right:15px; width:270px;border-radius:4px;padding-top:10px;">
                        <h3 class="text-underline mt-2 mb-4 filter-by" >Shop by Categories</h3>
                        <div style="cursor: pointer;">
                            @foreach ($menus as $menu)
                            <h4 style="font-size: 18px;font-weight:600" class="pl-2 {{$menu->id==$filters['main_category_id']?'text-primary':''}}" wire:click="mainCategory({{$menu->id}})">{{ $menu->name }}</h4>
                            <ul class="shop-list list-unstyled mb-3">
                                @foreach($menu->subCategory as $sub)
                                <li class="pl-3" style="padding-bottom:0px;margin:0px;">
                                    <p style="padding:0px;margin:0px;" wire:click="subcategory({{$sub->id}})" class="d-flex {{$sub->id==$filters['sub_category_id']?'text-primary':''}}">
                                        <span>{{ $sub->name }}</span>
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="wrapper">
                        <h3 class="filter-by">
                            Filter by Price
                        </h3>
                        <div class="pl-3">
                            <div class="price-input">
                                <div class="field">
                                    <input value="{{$price_filter['priceMin']}}" id="minval" type="text">
                                </div>
                                <div class="separator">-</div>
                                <div class="field">
                                    <input value="{{$price_filter['priceMax']}}" id="maxval" type="text">
                                </div>
                            </div>
                            <div class="slider">
                                <div class="progress"></div>
                            </div>
                            <div class="range-input">
                                <input wire:model.blur="price_filter.priceMin" type="range" class="range-min" min="10" max="5000" step="10">
                                <input wire:model.blur="price_filter.priceMax" type="range" class="range-max" min="10" max="5000" step="10">
                            </div>
                            <div>
                                <button wire:click="priceFilter" class="btn btn-sm rounded-4 btn-dark mt-3 mb-3" style="width:80%">Apply filter</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- product-list -->
                <div class="col-lg-9 mr-0">
                    @if($viewType == 'list')
                    <div>
                        @foreach($products as $product)
                        <div class="product pl-2 card mb-4" style="border-radius:4px;padding-top:8px;">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="product-thumb position-relative text-center">
                                        <div class="overflow-hidden position-relative">
                                            <a href="{{ route('shop.product-single', $product->id)}}">
                                                <img style="height: 380px;margin-left:auto;margin-right:auto;" class="img-fluid mb-3 img-first" src="{{ asset('storage/'.$product->photos[0])}}" alt="product-img">
                                                @if(count($product->photos) > 1)
                                                <img style="margin-left:auto;margin-right:auto;" class="img-fluid w-100 mb-3 img-second" src="{{ asset('storage/'.$product->photos[1])}}" alt="product-img">
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="product-info">
                                        <div class="product-info mb-4">
                                            <h3 class="mb-3"><a class="text-color" href="{{ route('shop.product-single', $product->id)}}">{{ $product->name }}</a></h3>
                                            <a href="{{ route('shop.product-single', $product->id)}}">{{$product->supporting_name}}</a>
                                            <p class="mb-3">{{ $product->description }}</p>
                                            <p class="h4">${{ $product->price }}</p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><button wire:click="wishlit({{$product->id}})" class="btn btn-dark btn-sm">Add To
                                                        Favorite</button></li>
                                                <li class="list-inline-item"><button wire:click="$dispatch('toCart' , {{$product->id}} )" class="btn btn-primary btn-sm">Add To cart</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- product label badge -->
                            @if($product->discount)
                            <div class="product-label sale">
                                -{{$product->discount}}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row rounded-sm my-grid" style="border: solid 1px rgba(230,230,230,0.4);margin-left:0px; border-radius:6px;">
                        @foreach($products as $product)
                        <!-- product -->
                        <div class="mb-4 mt-2 card rounded-md" style="solid 1px rgba(230,230,230,0.4); border-radius:4px;margin-top:6px;margin-left:8px;margin-right:8px;">
                            <div class="product text-center mb-2">
                                <div class="product-thumb">
                                    <div class="overflow-hidden position-relative">
                                        <a href="{{ route('shop.product-single', $product->id)}}">
                                            <img style="margin-left:auto;margin-right:auto;border-bottom:solid 1px rgb(230,230,230);" class="img-fluid mb-1 img-first" src="{{ asset('storage/'.$product->photos[0])}}" alt="product-img">
                                            @if(count($product->photos) > 1)
                                            <img style="margin-left:auto;margin-right:auto;" class="img-fluid mb-1 img-second" src="{{ asset('storage/'.$product->photos[1])}}" alt="product-img">
                                            @endif
                                        </a>
                                        <div class="btn-cart">
                                            <button wire:click="$dispatch('toCart' , {{$product->id}} )" class="btn btn-primary btn-sm">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <a class="h5" href="{{ route('shop.product-single', $product->id)}}">{{ $product->name }}</a>
                                    <p class="h5">${{$product->price}}</p>
                                </div>
                                <!-- product label badge -->
                                @if($product->discount)
                                <div class="product-label sale">
                                    -{{$product->discount}}
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- //end of product -->
                        <!-- product -->
                        @endforeach
                    </div>
                    @endif
                    <div class="col-12 mt-5" style="margin-bottom: 14px;">
                        <nav>
                            <ul class="pagination justify-content-center">
                                {{$products->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".slider .progress");
        let priceGap = 500;
        priceInput.forEach(input => {
            input.addEventListener("input", e => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if ((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
        rangeInput.forEach(input => {
            input.addEventListener("input", e => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);
                if ((maxVal - minVal) < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap
                        let element1 = document.getElementById('minval');
                        element1.dispatchEvent(new Event('input'));

                        let element2 = document.getElementById('maxval');
                        element2.dispatchEvent(new Event('input'));


                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });
    </script>
</div>