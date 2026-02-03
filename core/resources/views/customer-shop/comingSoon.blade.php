<x-customer-layout>
    <main class="h-[80vh] mt-24 w-full relative flex flex-col gap-2 lg:gap-4 items-center justify-center">
        <p class="text-3xl md:text-5xl lg:text-7xl font-semibold">Great Things are Coming Soon</p>
        <p class="md:text-xl lg:text-2xl">
            We are currently under construction
        </p>
        <a href="{{ route('shop.index')}}" class="rounded-full w-96 md:py-3 py-2 bg-primary-default mt-10">
            <div class="md:text-2xl text-xl font-title  text-white text-center">
                Back to Home
            </div>
        </a>
        <div class="absolute top-0 right-10 h-[400px] w-10 bg-primary-default rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-10 h-[400px] w-10 bg-primary-default rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 left-1/2 h-[250px] w-[200px] bg-secondary-default/40 rounded-full blur-3xl"></div>

        </div>
    </main>
</x-customer-layout>