<style>
    .dots {

        margin-top: 10px;
    }

    .dot {
        height: 9px;
        width: 9px;
        background-color: white;
        border-radius: 50%;
        margin: 6px 5px;
        cursor: pointer;
        transition: transform 0.5s ease-in-out;
        animation-duration: 200s;
    }

    .dot.active {
        background-color: gray;
        width: 12px;
        height: 12px;




    }
</style>



<main>
    @section('title') - Product details @endsection
    @include('customer-shop.blocks.breadcrumb', ['page' => 'Single Product'])

    <section class="max-w-7xl mx-4 sm:mx-14 mb-10 ">
        <div class="flex flex-col md:flex-row gap-10 w-full">
            <!-- image  -->
            <div class="md:h-[600px]  flex md:flex-row gap-3 relative group ">
                <div class=" absolute md:relative bottom-0 left-0 w-full md:w-auto md:h-full overflow-hidden flex md:flex-col flex-row gap-3 overflow-x-auto md:overflow-x-hidden overflow-y-hidden md:overflow-y-auto scroll-p-0 md:pr-3">

                    <div class=" shrink-0 border border-secondary-default w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center">
                        <img class="h-full w-full  object-cover" src="{{ asset('customer/images/product-single/7.jpg') }}" alt="" srcset="">

                    </div>
                    <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center">
                        ....
                    </div>
                    <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center">
                        ....
                    </div>
                    <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center">
                        ....
                    </div>
                    <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center"> ....</div>
                    <!-- <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center"> ....</div> -->
                    <!-- <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center"> ....</div> -->
                    <!-- <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center"> ....</div> -->
                    <!-- <div class="shrink-0  border w-20 h-20 rounded bg-secondary-50/40 flex items-center justify-center"> ....</div> -->
                </div>
                <div class="border h-full  relative overflow-hidden">
                    <div id="slides" class=" slides h-full  rounded-lg  flex  relative  duration-500 transition-transform 100s ease-in-out delay-200">
                        <img class=" slide h-full min-w-full rounded-lg object-cover" src="{{ asset('storage/'.$product->photos[0])}}" alt="" srcset="">
                        <!-- @if(count($product->photos) >=2 )
                        <img class=" slide h-full min-w-full rounded-lg object-cover" src="{{ asset('customer/images/product-single/7.jpg') }}" alt="" srcset="">
                        @endif
                        @if(count($product->photos) >=3 )
                        <img class=" slide h-full min-w-full rounded-lg object-cover" src="{{ asset('storage/'.$product->photos[2])}}" alt="" srcset="">
                        @endif
                        @if(count($product->photos) >=4 )
                        <img class=" slide h-full min-w-full rounded-lg object-cover" src="{{ asset('storage/'.$product->photos[3])}}" alt="" srcset="">
                        @endif -->
                        <div class="md:hidden absolute top-3 right-3 p-2 rounded-full bg-white/80">
                            <img src="{{ asset('customer/icons/heart.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div class=" controls  absolute top-1/2 flex justify-between px-2 group w-full">
                        <div class="control-btn cursor-pointer  group-hover:block group-hover:bg-gray-400 rounded-full p-3" onclick="prevSlide()">
                            <svg class="rotate-180" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.91003 19.9201L15.43 13.4001C16.2 12.6301 16.2 11.3701 15.43 10.6001L8.91003 4.08008" stroke="#292D32" class=" stroke-white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="control-btn cursor-pointer  group-hover:bg-gray-400 rounded-full p-3" onclick="nextSlide()">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.91003 19.9201L15.43 13.4001C16.2 12.6301 16.2 11.3701 15.43 10.6001L8.91003 4.08008" stroke="#292D32" class=" stroke-white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </div>
                    </div>
                    <div class="dots flex items-center absolute bottom-3  left-1/2 z-10 duration-500 transition-transform 100s ease-in-out delay-200" id="dots-container"></div>

                </div>

            </div>
            <!-- product info -->
            <div class=" flex flex-col gap-3 relative">
                <div class="w-full  flex justify-between items-center">
                    <!-- <div class="flex flex-row gap-3 items-center">
                        <div class="w-10 h-10 bg-primary-default rounded-full"></div>
                        <p class=" font-poppins font-semibold">NIKE</p>
                    </div> -->
                    <p class="md:hidden text-3xl font-bold font-poppins">
                        ${{ $product->price }} @if($product->discount != 0) <s class="text-color ml-2">${{$product->discount + $product->price}}</s>@endif
                    </p>
                </div>

                <p class="font-semibold text-2xl font-poppins mt-2">
                    {{ $product->name }}
                </p>
                <p class="text-gray-500 font-poppins"> Bags</p>
                <div class="mt-3 flex flex-row gap-2 items-center">
                    <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                    <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                    <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                    <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                    <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                    <p class="text-xs font-poppins">/ 42 reviews</p>
                </div>
                <p class="my-4 text-3xl font-bold font-poppins">
                    ${{ $product->price }} @if($product->discount != 0) <s class="text-color ml-2">${{$product->discount + $product->price}}</s>@endif

                </p>
                <div>
                    <p class="font-medium">Choose Size</p>
                    <div class="flex flex-row gap-2 my-2">
                        <div class="w-16 rounded bg-gray-200 text-center">sm</div>
                        <div class="w-16 rounded bg-gray-200 text-center">XL</div>
                        <div class="w-16 rounded bg-gray-200 text-center">2XL</div>
                        <div class="w-16 rounded bg-gray-200 text-center">3XL</div>



                    </div>
                </div>
                <div class="md:my-4 flex flex-row gap-3 fixed bottom-16 md:bottom-0 justify-center bg-white md:bg-transparent py-4 md:py-0 left-0 w-full md:w-auto md:relative z-10">
                    <button class="flex gap-2 items-center bg-primary-default w-[80%] justify-center py-3 rounded-lg">
                        <img class="invert" src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        <p class="text-white text-base font-semibold">
                            Add to Cart
                        </p>
                    </button>
                    <button class="p-3 bg-gray-200 rounded">
                        <img src="{{ asset('customer/icons/heart.svg') }}" alt="" srcset="">

                    </button>
                </div>
                <!-- <div class="absolute top-0 w-full h-full bg-white flex items-center justify-center  text-primary-default text-3xl  z-30">
                    Coming Soon ...
                </div> -->
            </div>
        </div>
        <div class="w-full border-[0.5px] my-5"></div>
        <div class="w-full flex flex-col md:flex-row gap-10 divide-x">
            <div class="md:w-1/2 flex flex-col gap-2">
                <div class="flex flex-col gap-2">
                    <p class="font-semibold">
                        Description
                    </p>
                    <p class="font-poppins font-extralight ">
                        {{$product->description}}
                    </p>
                </div>
                <hr />
                <div class="relative">
                    @include('customer-shop.blocks.comments')
                    <div class="absolute top-0 w-full h-full bg-white flex items-center justify-center  text-primary-default text-3xl  z-30">
                        Coming Soon ...
                    </div>
                </div>
                <hr />

            </div>

            <div class="md:w-1/2 flex flex-col px-6 gap-3">
                <div class="flex flex-col gap-2">
                    <p>
                        Review this product
                    </p>
                    <div class="flex flex-row gap-3">
                        <button class="p-3 bg-gray-200 rounded">
                            <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">

                        </button>
                        <button class="p-3 bg-gray-200 rounded">
                            <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">

                        </button>
                        <button class="p-3 bg-gray-200 rounded">
                            <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">

                        </button>
                        <button class="p-3 bg-gray-200 rounded">
                            <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">

                        </button>
                        <button class="p-3 bg-gray-200 rounded">
                            <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">

                        </button>
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <p>Leave a comment</p>
                    <textarea class="p-3 rounded bg-gray-200" name="" id="" cols="20" rows="4"></textarea>
                </div>
                <button class="w-[70%] border rounded-lg border-primary-default text-primary-default text-center py-3">
                    Send a Review
                </button>
            </div>


        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const slidesContainer = document.getElementById("slides");
            const controls = document.querySelector(".controls");
            const dotsContainer = document.getElementById("dots-container");
            const numbers = document.querySelectorAll(".number");
            let currentIndex = 0;

            function showSlide(index) {
                const translateValue = -index * 100 + "%";
                slidesContainer.style.transform =
                    "translateX(" + translateValue + ")";
                updateDots(index);
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % slidesContainer.children.length;
                showSlide(currentIndex);
            }

            function prevSlide() {
                currentIndex =
                    (currentIndex - 1 + slidesContainer.children.length) %
                    slidesContainer.children.length;
                showSlide(currentIndex);
            }

            function goToSlide(index) {
                currentIndex = index;
                showSlide(currentIndex);
            }

            function updateDots(index) {
                const dots = dotsContainer.querySelectorAll('.dot');
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            }


            // Show controls only if there are more than one image
            if (slidesContainer.children.length > 1) {
                controls.style.display = "flex";
            }
            // Create dots for each slide
            for (let i = 0; i < slidesContainer.children.length; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            }

            // Attach event listeners after images have loaded
            controls
                .querySelector(".control-btn:nth-child(1)")
                .addEventListener("click", prevSlide);
            controls
                .querySelector(".control-btn:nth-child(2)")
                .addEventListener("click", nextSlide);
            numbers.forEach((number, index) => {
                number.addEventListener('click', () => goToSlide(index));
            });

            // Initial slide display
            showSlide(currentIndex);


        });
    </script>
</main>