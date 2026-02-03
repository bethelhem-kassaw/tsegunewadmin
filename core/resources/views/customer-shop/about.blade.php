<x-customer-layout>
    <!-- about -->
    @section('title') - About Us @endsection

    <main class="bg-primary-default pt-24 px-4">

    </main>
    <section class=" bg-primary-default px-4 md:px-14 pb-40">
        <p class="text-[100px] md:text-[100px] lg:text-[150px] xl:text-[200px] pt-4 leading-[100px] md:leading-[150px] font-bold text-gray-600/50">
            OUR STORY
        </p>
        <div class="flex flex-col md:flex-row items-center gap-5  max-w-7xl mx-auto mt-10">
            <div class="order-2 md:order-1 md:w-1/2 w-[90%]  flex justify-center ">
                @include('layouts.customer.slider')
            </div>
            <div class="order-1 md:order-2 md:w-1/2 w-[90%] ">
                <div class="flex gap-2 items-end">
                    <div class="w-2 h-14 bg-secondary-default rounded-full"></div>
                    <img class="w-16" src="{{ asset('customer/images/Logo/mainLogo.svg') }}" alt="" srcset="">
                </div>
                <p class=" text-secondary-50 my-4 ">
                    Our exporting company/ EZKE focuses on delivering high-quality products to our international clients. And mainly to spread the taste, story and beauty of Ethiopian culture.
                    The goods we provides are modern yet unique and cultural; this aids in enhancing our understanding of ETHIOPIA.
                    With a commitment to excellence and customer satisfaction, we strive to provide efficient and reliable export services. Our team is dedicated to ensuring that every shipment is handled with care and precision to meet the unique needs of our clients. We are your trusted partner for all your exporting needs.
                </p>
            </div>
        </div>
    </section>

</x-customer-layout>