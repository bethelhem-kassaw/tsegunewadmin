<div class="main-wrapper">
    <!-- breadcrumb -->
    @section('title') - Cart detail  @endsection
    @include('customer-shop.blocks.breadcrumb', ['page' => 'Cart'])
    <!-- /breadcrumb -->
    <div class="section">
        <div class="cart shopping">
            <div class="container">
                <div class="row pb-4" style="border-radius: 6px;margin-top:-24px">
                    <div class="col-md-10 mx-auto">
                        <div class="block">
                            <div class="product-list">

                                <div class="table-responsive">
                                    <table class="table cart-table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Image</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($carts as $cart)
                                            <tr>
                                                <td>
                                                    <button wire:click="removeCart({{$cart['id']}})" class="product-remove border-0">&times;</button>
                                                </td>
                                                <td>
                                                    <img width="60px" class="img-fluid" src="{{ asset('storage/'.json_decode($cart['photos'])[0]) }}" alt="product-img" />
                                                </td>
                                                <td>
                                                    <div class="product-info">
                                                        <a href="#">{{$cart['name']}}</a>
                                                    </div>
                                                </td>
                                                <td>${{$cart['price']}}

                                                </td>
                                                <td>
                                                    <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                        <span class="input-group-btn input-group-prepend"><button wire:click="decrement({{$cart['id']}})" class="btn btn-primary bootstrap-touchspin-down" type="button">-</button></span>
                                                        <input wire:model.blur="cart.{{$cart['id']}}.quantity" type="text" class="form-control" value="{{$cart['quantity']}}">
                                                        <span class="input-group-btn input-group-append"><button wire:click="increment({{$cart['id']}})" class="btn btn-primary bootstrap-touchspin-up" type="button">+</button></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if(isset($cart['promo_discount']) && $cart['promo_discount'] != 0 )
                                                    <s class="text-color ml-2">${{$cart['price'] * $cart['quantity']}}</s>
                                                    <b class="text-primary">${{($cart['price'] - $cart['promo_discount'])* $cart['quantity']}}</b>
                                                    @else
                                                    ${{$cart['price'] * $cart['quantity']}}
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="d-flex flex-column flex-md-row align-items-center">
                                    <input wire:model.live="promocode" type="text" class="form-control text-md-left text-center mb-3 mb-md-0" name="coupon" id="coupon" placeholder="I have a discout coupon">

                                    <button wire:click="applyCupon" class="btn btn-outline-primary ml-md-3 w-100 mb-3 mb-md-0">Apply Coupon</button>
                                </div>
                                @error('promocode')
                                <span style="color:red">{{ $message }}</span>
                                @enderror
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        @php($total = cartTotal())
                                        <ul class="list-unstyled text-right">
                                            <li>Grand Total <span class="d-inline-block w-100px">
                                                    @if($total['total'] > $total['discounted'])
                                                    <s class="text-color ml-2">${{$total['total']}}</s>
                                                    <b class="text-primary">${{ $total['discounted'] }}</b>
                                                    @else
                                                    ${{ $total['discounted'] }}
                                                    @endif
                                                </span></li>
                                            <li>Vat <span class="d-inline-block w-100px">$0.00</span></li>
                                            <li>Total <span class="d-inline-block w-100px">${{ $total['discounted'] }}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('shop.checkout') }}" class="btn btn-primary float-right">Checkout</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>