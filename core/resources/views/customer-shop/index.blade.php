<x-customer-layout>
    <main class=" w-full bg-primary-50">
        <section class=" w-full bg-primary-default pt-24">
            <!-- mobile and tab view  -->
            <!-- <div class=" md:hidden h-full w-full flex flex-col items-center justify-center gap-10 transition-all ease-in-out duration-300">
                <h1 class="text-secondary-200 font-prociono text-3xl leading-relaxed ">
                    LUXURY PRODUCTS <br />
                    THAT EVERY<br /> ONE CAN
                    AFFORD
                </h1>
                @include('layouts.customer.slider')

            </div> -->

            <!-- above md view  -->
            <div class=" md:flex md:flex-row flex-col  max-w-[1520px] mx-auto h-full w-full    gap-4 px-4 transition-all ease-in-out duration-300">
                <div class="lg:w-2/3 md:w-1/2 w-full flex flex-col justify-between md:mb-0 mb-5">
                    <h1 class="md:flex hidden text-secondary-200 font-prociono text-4xl font-bold uppercase tracking-widest  leading-relaxed md:my-20 px-10">
                        Quality <br /> with armored <br /> delivery

                    </h1>
                    <h1 class="md:hidden  text-secondary-200 uppercase font-prociono text-4xl font-bold text-center  leading-relaxed mt-10 px-10">
                        Quality <br />
                        with armored delivery
                    </h1>
                    <div class="w-full hidden md:flex gap-2   justify-around">
                        <div class="flex flex-col justify-around">
                            <div class="w-20 aspect-square rounded-full border border-secondary-default flex relative justify-center items-center ">
                                <div class="w-3 h-3 rounded-full bg-secondary-default "></div>
                                <p class="absolute top-1/2 left-14 transform w-32 -translate-y-1/2 flex-nowrap  text-secondary-default bg-primary-default">
                                    Discover More
                                </p>
                            </div>
                            <div class="flex flex-col gap-2 mt-10">
                                <h3 class=" text-xl text-secondary-default font-prociono">
                                    NEW <span class="text-secondary-200">COLLECTION</span>
                                </h3>
                                <p class=" text-secondary-200 text-sm transition-all ease-in-out duration-300 font-thin">
                                    Experience the captivating <br /> essence of our new collection.
                                </p>
                            </div>

                        </div>
                        <div class="self-center  w-96 aspect-square rounded-t-full bg-white transition-all ease-in-out duration-300">
                            <img class="w-full h-full object-cover rounded-t-full" src="{{ asset('customer/images/product-single/3.jpg') }}" alt="" srcset="">
                        </div>

                    </div>
                </div>
                <div class="md:w-1/3 w-full flex flex-col items-center md:items-start justify-center">
                    @include('layouts.customer.slider')
                    <p class="text-secondary-200 font-thin text-sm w-full mt-10 hidden md:flex">
                        Discover the vibrant colors and rich heritage of Ethiopia at our exclusive e-commerce shop. Immerse yourself in traditional handwoven textiles, intricate handicrafts, and
                        exquisite Ethiopian jewelry. With every purchase, you support local artisans and embrace the essence of Ethiopian culture. </p>
                </div>
            </div>
        </section>

        <!-- rich text with image  -->
        <section class="max-w-[1520px] px-4 mt-10 pb-20 mx-auto flex md:flex-row gap-4 lg:gap-10  flex-col transition-all ease-in-out duration-300  ">
            <div class="md:order-2 order-1 flex flex-col  gap-4 transition-all ease-in-out duration-300 w-full md:w-1/2 ">
                <div class="flex flex-row gap-1 transition-all ease-in-out duration-300 ">
                    <div class="sm:h-20 h-16 w-3 bg-secondary-default transition-all ease-in-out duration-300 "></div>
                    <img class="h-5 self-end object-cover transition-all ease-in-out duration-300 " src="{{ asset('customer/images/Logo/mainLogo.svg') }}" alt="" srcset="">
                </div>
                <h1 class=" text-3xl lg:w-[70%] text-center md:text-start w-full font-bold transition-all ease-in-out duration-300">
                    habesha kemis
                </h1>
                <p class="lg:w-[80%] w-full text-center md:text-start">
                    Step into the world of Ethiopian elegance with our stunning collection of traditional clothing. Each meticulously crafted habesha kemis showcases vibrant colors, intricate patterns, and exquisite handwoven fabric, representing the rich cultural heritage of Ethiopia. Designed with impeccable attention to detail, our dresses for women and tunics for men are more than just garments; they are a celebration of artistry and a symbol of cultural pride. Experience the beauty and grace of Ethiopian tradition with our timeless and captivating traditional clothing pieces. </p>
                <a href="{{ route('shop.list') }}" class="hidden md:block lg:w-1/3  md:w-1/2 text-center  border border-secondary-default  rounded-md px-8 py-2 text-secondary-default font-semibold transition-all ease-in-out duration-300">
                    Shop Now
                </a>
            </div>
            <div class="md:order-1 order-2 transition-all ease-in-out duration-300 w-full md:w-1/2 ml-4   flex justify-center ">
                <div class=" w-[90%] sm:w-[70%] md:w-[95%] lg:w-[70%] aspect-square  border border-secondary-default p-5 relative">
                    <div class="w-full h-full  border border-secondary-default">
                    </div>
                    <img class=" w-full aspect-square object-cover absolute top-[10%] -left-10" src="{{ asset('customer/images/product-single/7.jpg') }}" alt="" srcset="">

                </div>

            </div>
            <button class="block md:hidden order-3 mt-10 border border-secondary-default w-1/2 rounded-md px-8 py-2 text-secondary-default font-semibold self-center">
                Shop Now
            </button>
        </section>

        <!-- collections  -->
        @include('customer-shop.blocks.top-collections')
        <!-- <section class=" w-full bg-primary-default py-24 ">
            <div class="max-w-[1520px] mx-auto flex flex-col pt-10 px-4">
                <h1 class="text-secondary-200 font-prociono text-4xl font-bold tracking-wider leading-relaxed ">
                    What Are You <br /> <span class="pl-16">
                        Waiting For?
                    </span>
                </h1>
                <p class="md:w-1/2 sm:w-[80%] w-full my-3 text-secondary-200">
                    Embrace the allure of Ethiopian culture and shop our exclusive collection now - there's no better time to indulge in the beauty and craftsmanship of traditional Ethiopian treasures. </p>
                <div class=" w-full overflow-hidden overflow-x-auto flex flex-col mt-5">
                    <div class="self-end flex gap-3 items-center">
                        <div>
                            <img class=" invert" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                        </div>
                        <div class="w-3 h-3 rounded-full bg-secondary-default">

                        </div>
                        <div class="w-4 h-4 rounded-full bg-secondary-default">

                        </div>
                        <div class="w-3 h-3 rounded-full bg-secondary-default">

                        </div>
                        <div>
                            <img class=" invert" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                        </div>

                    </div>
                    <div class="flex gap-4 w-full mt-3 overflow-hidden overflow-x-auto scroll-smooth  pb-3 rounded-lg  ">
                        <div class="w-[316px] h-[402px] border rounded-lg flex flex-shrink-0 flex-col relative">
                            <img class="w-full h-full rounded-lg object-cover" src="{{ asset('customer/images/product-single/2.jpg') }}" alt="" srcset="">
                            <div class="absolute bottom-0 left-0  bg-transparent/20   h-[95px] w-full z-10 flex justify-between items-center px-8">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-2xl text-secondary-50 font-bold flex-nowrap leading-tight">
                                        Coming Soon
                                    </h1>
                                    <p class="text-secondary-50 ">
                                        # items
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center">
                                    <img class="" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="w-[316px] h-[402px] border rounded-lg flex flex-shrink-0 flex-col  relative">
                            <img class="w-full h-full rounded-lg object-cover" src="{{ asset('customer/images/product-single/8.jpg') }}" alt="" srcset="">
                            <div class="absolute bottom-0 left-0  bg-transparent/20   h-[95px] w-full z-10 flex justify-between items-center px-8">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-2xl text-secondary-50 font-bold ">
                                        Coming Soon
                                    </h1>
                                    <p class="text-secondary-50 ">
                                        # items
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center">
                                    <img class="" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="w-[316px] h-[402px] border rounded-lg flex flex-shrink-0 flex-col  relative">
                            <img class="w-full h-full rounded-lg object-cover" src="{{ asset('customer/images/product-single/maedPic.png') }}" alt="" srcset="">
                            <div class="absolute bottom-0 left-0  bg-transparent/20   h-[95px] w-full z-10 flex justify-between items-center px-8">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-2xl text-secondary-50 font-bold ">
                                        Coming Soon
                                    </h1>
                                    <p class="text-secondary-50 ">
                                        #items
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center">
                                    <img class="" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="w-[316px] h-[402px] border rounded-lg flex flex-shrink-0 flex-col  relative">
                            <img class="w-full h-full rounded-lg object-cover" src="{{ asset('customer/images/product-single/5.jpg') }}" alt="" srcset="">
                            <div class="absolute bottom-0 left-0  bg-transparent/20   h-[95px] w-full z-10 flex justify-between items-center px-8">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-2xl text-secondary-50 font-bold ">
                                        Coming Soon
                                    </h1>
                                    <p class="text-secondary-50 ">
                                        #items
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center">
                                    <img class="" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="w-[316px] h-[402px] border rounded-lg flex flex-shrink-0 flex-col  relative">
                            <img class="w-full h-full rounded-lg object-cover" src="{{ asset('customer/images/product-single/3.jpg') }}" alt="" srcset="">
                            <div class="absolute bottom-0 left-0  bg-transparent/20   h-[95px] w-full z-10 flex justify-between items-center px-8">
                                <div class="flex flex-col gap-2">
                                    <h1 class="text-2xl text-secondary-50 font-bold ">
                                        Coming Soon
                                    </h1>
                                    <p class="text-secondary-50 ">
                                        #items
                                    </p>
                                </div>
                                <div class="w-12 h-12 rounded-full bg-secondary-50 flex items-center justify-center">
                                    <img class="" src="{{ asset('customer/icons/arrow-right.svg') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section> -->
        <!-- New Arrivals  -->
        <section class=" max-w-[1520px] px-4  pt-20 mx-auto flex flex-col ">
            <div class="flex flex-col w-full gap-3 items-center">
                <h1 class="text-primary-default text-4xl font-bold ">
                    New Arrivals
                </h1>
                <p class="lg:w-1/2 w-[90%] text-center">
                    Introducing our latest arrivals, curated with care to bring you the finest selection of Ethiopian-inspired products. Discover the captivating allure of our new collection and be among the first to experience the essence of Ethiopian culture. Don't miss out - explore our new arrivals today! </p>
            </div>

            <div class="w-full flex gap-4 overflow-hidden overflow-x-auto my-10">
                <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                    <img class="w-full aspect-square object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/1.jpg') }}" alt="">
                    <div class="flex flex-col gap-1 m-2 ">
                        <h3 class=" text-lg ">
                            Coming Soon
                        </h3>
                        <h2 class="text-xl font-bold ">
                            $ ****
                        </h2>
                        <div class="flex justify-between items-center">
                            <h1>
                                Coming soon
                            </h1>
                            <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                    <img class="w-full aspect-square object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/8.jpg') }}" alt="">
                    <div class="flex flex-col gap-1 m-2 ">
                        <h3 class=" text-lg ">
                            Coming Soon
                        </h3>
                        <h2 class="text-xl font-bold ">
                            $ ****
                        </h2>
                        <div class="flex justify-between items-start">
                            <h1>
                                coming soon ...
                            </h1>
                            <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                    <img class="w-full aspect-square object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/5.jpg') }}" alt="">
                    <div class="flex flex-col gap-1 m-2 ">
                        <h3 class=" text-lg ">
                            Coming soon...
                        </h3>
                        <h2 class="text-xl font-bold ">
                            $ ****
                        </h2>
                        <div class="flex justify-between items-start">
                            <h1>
                                Coming soon
                            </h1>
                            <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                    <img class="w-full aspect-square object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/maedPic.png') }}" alt="">
                    <div class="flex flex-col gap-1 m-2 ">
                        <h3 class=" text-lg ">
                            Coming soon...
                        </h3>
                        <h2 class="text-xl font-bold ">
                            $ ****
                        </h2>
                        <div class="flex justify-between items-start">
                            <h1>
                                Coming soon
                            </h1>
                            <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- image  -->
        <section class="max-w-7xl px-4 mt-10 pb-20 mx-auto ">
            <div class="grid grid-cols-3 sm:gap-4 gap-2   ">
                <div class=" col-span-2 rounded-l-md h-[400px] sm:h-[416px]  bg-gray-200/50">
                    <img class="w-full rounded-l-md h-full object-contain" src="{{ asset('customer/images/product-single/7.jpg') }}" alt="" srcset="">
                </div>
                <div class="col-span-1  flex flex-col sm:gap-4 gap-2 h-[400px]  ">
                    <div class="rounded-md h-1/2 bg-gray-200/50">
                        <img class="w-full rounded-tr-md h-full object-contain" src="{{ asset('customer/images/product-single/2.jpg') }}" alt="" srcset="">
                    </div>
                    <div class="rounded-md h-1/2">
                        <img class="w-full rounded-br-md h-full object-cover" src="{{ asset('customer/images/product-single/5.jpg') }}" alt="" srcset="">
                    </div>
                </div>
            </div>
        </section>

    </main>
</x-customer-layout>