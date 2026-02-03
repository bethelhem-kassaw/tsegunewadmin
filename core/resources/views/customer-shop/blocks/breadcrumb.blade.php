<nav class="mt-24 mb-10 mx-4 sm:mx-14 max-w-7xl ">
    <div class="container">
        <ol class="flex gap-5 items-center ">


            <li class="breadcrumb-item text-gray-400"><a href="{{ route('shop.index')}}">Home</a></li>

            <div class="flex gap-2 items-center">
                <div class="w-2 h-2 rounded-full bg-gray-900"></div>
                <li class=" active:font-light active:text-primary-default active" aria-current="page">{{$page}}</li>

            </div>
        </ol>
    </div>
</nav>