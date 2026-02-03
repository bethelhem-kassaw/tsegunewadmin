<div class="main-wrapper">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@section('title') - Shippment Adress  @endsection
    <!-- breadcrumb -->
    @include('customer-shop.blocks.breadcrumb', ['page' => 'Shipping information'])
    <!-- /breadcrumb -->
   
    <!-- shipping method -->
    <section class="section">
        <div class="container">
            <div class="row p-2" style="border-radius: 6px;">
            <div class="col-md-8">
                <div class="inner-wrapper card" style="border-radius:4px;">
                    <!-- navbar -->
                    <div class="justify-content-between nav mb-5">
                        <div class="text-center d-inline-block nav-item {{ $page=='shippment'?'active':''}}">
                            <i class="ti-truck d-block mb-2"></i>
                            <span class="d-block h4">Shipping Adress</span>
                        </div>
                        <div  class="text-center d-inline-block nav-item {{ $page=='payment'?'active':''}}">
                            <i class="ti-wallet d-block mb-2"></i>
                            <span class="d-block h4">Payment Method</span>
                        </div>
                        <div class="text-center d-inline-block nav-item {{ $page=='review'?'active':''}}">
                            <i class="ti-eye d-block mb-2"></i>
                            <span class="d-block h4">Review</span>
                        </div>
                    </div>
                    @if($page == 'shippment')
                        @livewire('shippment-component')
                    @elseif($page == 'payment')
                        @livewire('payment-component', ['shippmentAdress' => $shippmentAdress])
                    @elseif($page == 'review')
                        @livewire('review-component', ['shippmentAdress' => $shippmentAdress, 'paymentDetail' => $paymentDetail])
                    @endif
                </div>
            </div>
            <div class="col-md-4 card" style="border-radius:4px;padding-top:6px">
                <div class="p-2">
                    <h4>Order Summery</h4>
                    <ul class="list-unstyled">
                        <li class="d-flex justify-content-between">
                            <span>Subtotal</span>
                            <span>${{ cartTotal()['discounted'] }}</span>
                        </li>
                        @if($shippmentAdress)
                        <li class="d-flex justify-content-between">
                            <span>Shipping & Handling</span>
                            <span>${{ $shippmentAdress['shippmentMethod']['price'] }}</span>
                        </li>
                        @endif
                        <li class="d-flex justify-content-between">
                            <span>Estimated Tax</span>
                            <span>$0.00</span>
                        </li>
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <strong>USD ${{$shippmentAdress?$shippmentAdress['shippmentMethod']['price'] + cartTotal()['discounted']:cartTotal()['discounted']}}</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

