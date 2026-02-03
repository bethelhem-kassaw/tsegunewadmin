<x-customer-layout>
    <div class="main-wrapper">
    @section('title') - Counatc Us  @endsection
        <!-- breadcrumb -->
        @include('customer-shop.blocks.breadcrumb', ['page' => 'Contact'])
        <!-- /breadcrumb -->

        <!-- contact -->
        <section class="section">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- form -->
                    <div class="col-lg-7 mb-5 mb-lg-0 text-center text-md-left">
                        <h2 class="section-title">Contact Us</h2>
                        <form action="#" class="row">
                            <div class="col-md-6">
                                <input type="text" id="firstName" name="firstName" class="form-control mb-4 rounded-0" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" id="lastName" name="lastName" class="form-control mb-4 rounded-0" placeholder="Last Name" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" id="subject" name="subject" class="form-control mb-4 rounded-0" placeholder="Subject" required>
                            </div>
                            <div class="col-md-12">
                                <textarea name="message" id="message" class="form-control rounded-0 mb-4" placeholder="Message"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" value="send" class="btn btn-primary">Submit now</button>
                            </div>
                        </form>
                    </div>
                    <!-- contact item -->
                    <div class="col-lg-4">
                        <div class="d-flex mb-60">
                            <i class="ti-location-pin contact-icon"></i>
                            <div>
                                <h4>Our Location</h4>
                                <p class="text-gray">Addis ababa : 22, Hanan K Plaza</p>
                            </div>
                        </div>
                        <div class="d-flex mb-60">
                            <i class="ti-mobile contact-icon"></i>
                            <div>
                                <h4>Call Us Now</h4>
                                <p class="text-gray mb-0">+251 912 082791</p>
                                <p class="text-gray mb-0">+251 938 426291</p>
                            </div>
                        </div>
                        <div class="d-flex mb-60">
                            <i class="ti-email contact-icon"></i>
                            <div>
                                <h4>Write Us Now</h4>
                                <p class="text-gray mb-0">customerservice@shopkager.com</p>
                                <p class="text-gray mb-0">help@shopkager.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- google map -->
        <section class="">
            <!-- Google Map -->
            <iframe height="450" style="border:0;width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.5410571910825!2d38.78274203488769!3d9.014307399999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b85b4e0bb4a7f%3A0xc66d0d74337d4bb5!2zSGFuYW4gSyBQbGF6YSB8IEhheWFodWxldCB8IOGIgOGKk-GKlSDhiqwg4Y2V4YiL4YubIHwg4YiD4Yur4YiB4YiI4Ym1!5e0!3m2!1sen!2sus!4v1674136427438!5m2!1sen!2sus" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <!-- <div id="map_canvas" data-latitude="51.507351" data-longitude="-0.127758"></div> -->
        </section>
        <!-- /google map -->
</x-customer-layout>