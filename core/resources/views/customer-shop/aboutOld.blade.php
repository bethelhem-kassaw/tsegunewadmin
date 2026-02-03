<x-customer-layout>
    <!-- about -->
    @section('title') - About Us  @endsection
    <section class="section">
        <div class="container">
            <div class="row" style="border-radius: 6px;padding:10px;">
            <div class="col-md-6">
                <!-- image circle background -->
                <div class="about-img-bg"></div>
                <img class="img-fluid mb-4 mb-md-0" style="height:600px;margin-left:auto;margin-right:auto;" src="{{ asset('customer/images/about/about_img.jpg')}}" alt="product-img">
            </div>
            <div class="col-md-6">
                <h2 class="section-title">About KA'GERBET</h2>
                <p class="mb-4">KA’GERBET is an online shopping destination for children, men and women’s Ethiopian cultural clothing, Ethiopian Coffee, Art and Accessories. Our products makes it possible for you to choose from the finest selection of Ethiopian most sought-after designer brands, Coffee Roasters, Digital Artists and Craftsmen. We pride ourselves on creating a collection of high end products that can represent our country on the international level. Our expert team of Designers and Roast Masters scours the country each season to bring you the most exquisite selection of traditional fashion and a cup of excellence. With our weekly new arrivals we make it effortless for you to put your hands on the multi-variety Ethiopian cultural clothes and freshly roasted 100% Premium Arabica coffee. </p>
                <ul class="pl-0">
                <li class="d-flex">
                    <i class="ti-check mr-3 mt-1"></i>
                    <div>
                    <h4>Free Roasted Coffee</h4>
                    <p>Premium Roasted Ethiopian coffees are free. Claim them now!</p>
                    </div>
                </li>
                <li class="d-flex">
                    <i class="ti-check mr-3 mt-1"></i>
                    <div>
                    <h4>Best Delivery</h4>
                    <p>Free Shipping On All Addis Ababa Orders, 15-18 Days fast delivery across the world</p>
                    </div>
                </li>
                </ul>
            </div>
            </div>
        </div>
        </section>
        <!-- /about -->

        <!-- about 2 -->
        <section class="section">
        <div class="container">
            <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="section-title">Our Goal</h2>
                <p class="mb-4">Is becoming the local brand that represent our culture on the international level through providing high-end Fashion and Coffee Products, and break the stereotype of always being at the receiving end.</p>
            </div>
            </div>
        </div>
    </section>
    <!-- /about 2 -->

    <!-- /ልዩ የክረምት ሽያጭ -->
    <section class="section overlay cta" data-background="{{ asset('customer/images/backgrounds/cta.jpg')}}">
        <div class="container">
            <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-white mb-2">ልዩ የክረምት ሽያጭ</h1>
                <p class="text-white mb-4">Take 25% off all Clothing products. Discount applied at checkout.</p>
                <a href="{{ route('shop.list')}}" class="btn btn-light">shop now</a>
            </div>
            </div>
        </div>
    </section>
</x-customer-layout>