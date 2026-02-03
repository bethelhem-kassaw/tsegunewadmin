<div class="relative overflow-hidden w-[346px] h-[454px] rounded-tl-[102px] rounded-br-[102px] mb-5">
    <div id="slides" class="slides relative flex w-full h-full duration-500 transition-all 100s ease-in-out delay-200   ">
        <img class="slide  w-full h-full  object-cover   " src=" {{ asset('customer/images/product-single/9.jpg') }} " alt="" srcset="">
        <img class="slide h-full w-full   object-cover   " src=" {{ asset('customer/images/product-single/1.jpg') }} " alt="" srcset="">
        <img class="slide  w-full h-full  object-cover   " src=" {{ asset('customer/images/product-single/2.jpg') }} " alt="" srcset="">
        <img class="slide  w-full h-full  object-cover   " src=" {{ asset('customer/images/product-single/3.jpg') }} " alt="" srcset="">
        <img class="slide  w-full h-full  object-cover   " src=" {{ asset('customer/images/product-single/4.jpg') }} " alt="" srcset="">
        <img class="slide  w-full h-full  object-cover   " src=" {{ asset('customer/images/product-single/5.jpg') }} " alt="" srcset="">
        <img class="slide  w-full h-full  object-cover   " src=" {{ asset('customer/images/product-single/6.jpg') }} " alt="" srcset="">


    </div>
    <div class="controls  absolute top-1/2 flex justify-between px-2 group w-full">
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
    <div class="dots flex items-center   absolute bottom-3  left-1/2 -translate-x-1/2 z-10 duration-500 transition-all 100s ease-in-out delay-200" id="dots-container"></div>

    <script defer>
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
</div>

<style>
    .dots {

        margin-top: 10px;
    }

    .dot {
        height: 5px;
        width: 5px;
        background-color: white;
        border-radius: 50%;
        margin: 6px 5px;
        cursor: pointer;
        transition: transform 0.5s ease-in-out;
        animation-duration: 200s;
    }

    .dot.active {
        background-color: gray;
        width: 6px;
        height: 6px;




    }

    .slide[data-active] {
        opacity: 1;
    }
</style>