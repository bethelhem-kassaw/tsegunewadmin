<div class="cart ">
    <div id="cartOpen" onclick="openCart()" class="cart-btn relative">

        <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
        <span class="text-xs font-extrabold absolute text-red-700 -top-1 right-0">@if($cart_size){{ $cart_size }}@else @endif</span>
    </div>
    <div id="cartWrapper" class=" hidden cart-wrapper text-white absolute top-16 my-2 right-5 w-[300px] z-50 h-auto py-5 border border-gray-600 flex justify-start items-center flex-col bg-primary-default rounded-md">
        <div class="w-full flex justify-end px-3">
            <img onclick="openCart()" class="" src="{{ asset('customer/icons/close-white.svg') }}" alt="" srcset="">

        </div>

        @if($cart_size)
        <ul class="pl-0 mb-3 flex flex-col w-full ">
            @foreach($carts as $cart)
            <li wire:key="{{ $cart['id'] }}" class="flex  justify-between items-center  w-[300px] px-3 border-b border-gray-600 py-3">
                <div class="flex gap-3">
                    <img class="w-10 h-10  rounded-full" src="{{ asset('storage/'.json_decode($cart['photos'])[0])}}" alt="product-img">
                    <div class="mx-3 text-sm">
                        <h6>{{$cart['name']}}</h6>
                        <span>{{ $cart['quantity'] }}</span> X <span>${{$cart['price']}}</span>
                    </div>
                </div>


                <img wire:click="remove({{ $cart['id'] }})" class="" src="{{ asset('customer/icons/close-white.svg') }}" alt="" srcset="">
            </li>
            @endforeach
        </ul>
        <div class="mb-3 px-3 flex justify-between w-full">
            <span>Cart Total</span>
            <span class="float-right">${{cartTotal()['discounted']}}</span>
        </div>
        <div class="  w-full justify-between items-center px-3 flex ">
            <a href="{{ route('shop.cart')}}" class=" text-secondary-200">view cart</a>
            <a href="{{ route('shop.checkout')}}" class=" rounded-full border px-3 py-1 border-secondary-200">check out</a>
        </div>
        @else
        <h4 class="w-full py-4 justify-center flex">Your cart is empty!</h4>
        @endif
    </div>
</div>



<!-- Shopping Cart Dropdown -->

<script>
    function openCart() {
        document.getElementById("cartWrapper").classList.toggle("hidden");
    }
</script>