<main class="w-full">


    <section class="sm:h-[150px] h-32 bg-primary-default flex flex-col justify-end py-10  items-center -z-10  w-full relative">


        </div>
        <!-- search bar  -->
        <div class="flex gap-3  absolute -bottom-5  -translate-x-1/2 left-1/2 w-[70%] sm:w-auto">
            <div class="bg-primary-50 sm:w-[500px] w-full  rounded relative  ">
                <input class="w-full bg-primary-50 rounded px-14" type="text" placeholder="What are You Looking For?">
                <div class="absolute top-2 left-4">
                    <img src="{{ asset('customer/icons/search-normal.svg') }}" alt="" srcset="">
                </div>
                <div class="absolute top-2 right-4">
                    <img class="sm:hidden block" src="{{ asset('customer/icons/search-normal.svg') }}" alt="" srcset="">

                </div>
            </div>

        </div>
    </section>
    <section class="max-w-[1520px] mx-auto mt-10 px-4 ">
        <div class="flex flex-row gap-10 px-4 justify-between items-center w-full  ">
            <button id="openModal" class="w-20  hidden aspect-square rounded-full border border-secondary-default sm:flex relative justify-center items-center">
                <div class="w-3 h-3 rounded-full bg-secondary-default "></div>
                <p class="absolute top-1/2 left-14 px-2  inline-block text-start transform  -translate-y-1/2 flex-nowrap  text-secondary-default bg-white">
                    Filter
                </p>
            </button>
            <div class=" sticky top-0 text-primary-default flex  xl:justify-center  flex-row items-center gap-5 md:gap-10 w-full self-center overflow-hidden overflow-x-auto py-3 hideScrollbar">
                <!-- @foreach ($menus as $menu)
                <p class=" {{$menu->id==$filters['main_category_id']?'text-primary-default':''}} text-secondary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-600 hover:border border-secondary-default px-3 rounded-md py-1">{{ $menu->name }}</p>
                @endforeach -->

                @foreach($subCategorys as $subCategory)
                <p
                    wire:click="subcategory({{ $subCategory->id }})"
                    class="shrink-0 flex cursor-pointer tracking-wider font-bold capitalize text-xl px-3 rounded-md py-1
               {{ $filters['sub_category_id'] == $subCategory->id ? 'text-secondary-default border border-secondary-default' : 'text-primary-default hover:text-secondary-default hover:border border-secondary-default' }}">
                    {{ $subCategory->name }}
                </p>
                @endforeach
                <!-- <ul>
                    @foreach($subCategorys as $subCategory)
                    <li wire:click="subcategory({{ $subCategory->id }})" class="cursor-pointer">
                        {{ $subCategory->name }}
                    </li>
                    @endforeach
                </ul> -->
                <!-- <p class=" shrink-0 flexflex cursor-default text-primary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-default hover:border border-secondary-default px-3 rounded-md py-1">
                    Back bags
                </p>
                <p class=" shrink-0 flex  cursor-default text-primary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-default hover:border border-secondary-default px-3 rounded-md py-1">
                    Spices
                </p>
                <p class="shrink-0  flex cursor-default text-primary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-default hover:border border-secondary-default px-3 rounded-md py-1">
                    Habesha libs
                </p>
                <p class="shrink-0 flex  cursor-default text-primary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-default hover:border border-secondary-default px-3 rounded-md py-1">
                    Shoes
                </p> -->
                <!-- <p class="shrink-0 flex  cursor-default text-primary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-default hover:border border-secondary-default px-3 rounded-md py-1">
                    Shoes
                </p>
                <p class=" shrink-0 flex cursor-default text-primary-default tracking-wider font-bold capitalize text-xl hover:text-secondary-default hover:border border-secondary-default px-3 rounded-md py-1">
                    Shoes
                </p> -->
            </div>
        </div>
    </section>
    <section class="my-10 max-w-[1520px] mx-auto  grid w-full justify-center items-center px-4">
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4 sm:gap-4 md:gap-14 lg:grid-cols-3 xl:grid-cols-4 xl:gap-6 2xl:gap-12 mb-20">
            @foreach($products as $product)
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg  flex flex-shrink-0 flex-col bg-gray-200/50">
                <a href="{{ route('shop.product-single', $product->id)}}" class="w-full aspect-square">
                    <img class="w-full aspect-square rounded-l-md h-full object-cover" src="{{ asset('storage/'.$product->photos[0])}}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        {{ $product->name }}
                    </h3>
                    <h2 class="text-xl font-bold ">
                        ${{ $product->price }}
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            {{$product->supporting_name}}
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                <img class="w-full aspect-square object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/2.jpg') }}" alt="">
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                <a href="{{ route('shop.product-single', 1)}}" class="w-full aspect-square">
                    <img class="w-full  object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/1.jpg') }}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                <a href="{{ route('shop.product-single', 1)}}" class="w-full aspect-square">
                    <img class="w-full  object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/4.jpg') }}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                <a href="{{ route('shop.product-single', 1)}}" class="w-full aspect-square">
                    <img class="w-full  object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/5.jpg') }}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                <a href="{{ route('shop.product-single', 1)}}" class="w-full aspect-square">
                    <img class="w-full aspect-square  object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/7.jpg') }}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50 ">
                <a href="{{ route('shop.product-single', 1)}}" class="w-full aspect-square ">
                    <img class="w-full aspect-square  object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/8.jpg') }}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[313px] h-[431px] border border-[#D9D0d0] rounded-lg flex flex-shrink-0 flex-col bg-gray-200/50">
                <a href="{{ route('shop.product-single', 1)}}" class="w-full aspect-square">
                    <img class="w-full aspect-square  object-cover rounded-t-lg" src="{{ asset('customer/images/product-single/9.jpg') }}" alt="">

                </a>
                <div class="flex flex-col gap-0 m-2 ">
                    <h3 class=" text-lg ">
                        Back to school bags
                    </h3>
                    <h2 class="text-xl font-bold ">
                        $ 5000
                    </h2>
                    <div class="flex justify-between items-center">
                        <h1 class="self-start text-secondary-default">
                            Bags
                        </h1>
                        <div class="bg-primary-default w-20 h-10 rounded-md flex items-center justify-center">
                            <img class="" src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div> -->



        </div>

        <!-- Trigger button for the modal -->
        <!-- Trigger button for the modal -->
        <!-- <button type="button" wire:click="openModal" class="btn btn-primary">
            Open Filters
        </button> -->

        <!-- Modal Structure -->
        <!-- <div id="filterModal" class="fixed z-10 inset-0 overflow-y-auto {{ $isModalOpen ? '' : 'hidden' }}"> -->
        <!-- Modal content -->
        <!-- <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"> -->
        <!-- Background overlay -->
        <!-- <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div> -->

        <!-- Centering the modal contents -->
        <!-- <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Filter Products
                                </h3>
                                <div class="mt-2"> -->

        <!-- Subcategory Dropdown -->
        <!-- <div class="mb-4">
                                        <label for="sub_category" class="block text-sm font-medium text-gray-700">Subcategory</label>
                                        <select wire:model="filters.sub_category_id" id="sub_category" class="form-select mt-1 block w-full">
                                            <option value="">Select Subcategory</option>
                                            @foreach($subCategorys as $subCategory)
                                            <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> -->

        <!-- Price Range Inputs -->
        <!-- <div class="mb-4">
                                        <label for="priceMin" class="block text-sm font-medium text-gray-700">Min Price</label>
                                        <input type="number" wire:model="price_filter.priceMin" id="priceMin" class="form-control mb-2 w-full" placeholder="Min Price">

                                        <label for="priceMax" class="block text-sm font-medium text-gray-700">Max Price</label>
                                        <input type="number" wire:model="price_filter.priceMax" id="priceMax" class="form-control mb-2 w-full" placeholder="Max Price">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> -->

        <!-- <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="applyFilters" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                            Apply
                        </button>
                        <button type="button" wire:click="closeModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div> -->
        <!-- </div>
            </div>
        </div> -->

    </section>

    <section id="modal" class=" modal hidden fixed top-0 left-0 w-[100%] h-[100%] bg-black bg-opacity-50 z-20 flex justify-center transition-all ease-in-out duration-300 items-center">
        <div class=" bg-white w-full h-full py-5 sm:pt-0  sm:rounded-xl sm:w-auto sm:h-auto shadow-lg transition-all ease-in-out duration-300 z-20 relative px-4 sm:px-0">
            <div class="w-full p-5 flex flex-row justify-between items-center">
                <button id="closeModal">
                    <img src="{{ asset('customer/icons/close-circle.svg') }}" alt="" srcset="">
                </button>
                <p class="font-semibold text-lg"> Filter</p>
                <button class="bg-primary-default text-white rounded px-3 py-1">Apply</button>
            </div>
            <div class="w-full flex flex-col gap-5">
                <!-- categories  -->
                <div class="w-full flex flex-col gap-5">

                    <div class="w-full border-[0.5px] relative mt-3">
                        <p class="text-sm absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-2">
                            Categories
                        </p>
                    </div>
                    <div id="categoryOptions" class="w-full grid grid-cols-4 sm:grid-cols-6 gap-5 sm:px-10 px-4">
                        @foreach ($menus as $menu)
                        <div onclick="selectCategory('{{$menu->name}}')" class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>{{ $menu->name }}</p>
                        </div>
                        @endforeach
                        <!-- <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>back bags</p>
                        </div>
                        <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>spices</p>
                        </div>
                        <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>crafts</p>
                        </div>
                        <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>Habesha clothes</p>
                        </div>
                        <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>shoes</p>
                        </div> -->
                        <!-- <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>bags</p>
                        </div>
                        <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>bags</p>
                        </div>
                        <div class="px-6 py-1 flex flex-col items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/bag-2.svg') }}" alt="" srcset="">
                            </div>
                            <p>bags</p>
                        </div> -->
                    </div>
                </div>

                <div class="w-full flex flex-col gap-5">
                    <div class="w-full border-[0.5px] relative mt-3">
                        <p class="text-sm absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-2">
                            Price
                        </p>
                    </div>
                    <div class="sm:px-10 px-4 mt-2">

                        <div class="slider">
                            <div class="progress"></div>
                        </div>
                        <div class="range-input">
                            <input wire:model.blur="price_filter.priceMin" type="range" class="range-min" min="10" max="5000" step="10">
                            <input wire:model.blur="price_filter.priceMax" type="range" class="range-max" min="10" max="5000" step="10">
                        </div>

                        <div class="price-input w-full flex justify-between ">
                            <div class="w-full flex flex-col  justify-center field">
                                <p class="self-start">Min</p>
                                <input class="border-none py-0 px-0 w-20" value="{{$price_filter['priceMin']}}" id="minval" type="text">
                            </div>

                            <div class="w-full flex flex-col justify-center field">
                                <p class="self-end">Max</p>
                                <input class="border-none text-end py-0 px-0 w-20 self-end" value="{{$price_filter['priceMax']}}" id="maxval" type="text">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="w-full flex flex-col gap-5">
                    <div class="w-full border-[0.5px] relative mt-3">
                        <p class="text-sm absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-2">
                            Rating
                        </p>
                    </div>
                    <div class="grid grid-cols-3 gap-2 px-4 sm:px-10 mt-3">
                        @for($i = 1; $i <= 5; $i++) <!-- <div class=" py-2 flex flex-row items-center justify-center border rounded  bg-secondary-50"> -->
                            <!-- <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div> -->
                            <div onclick="selectRating({{$i}})">
                                @for ($j = 1; $j <= $i; $j++) &#9733; <!-- Unicode character for filled star -->
                                    @endfor
                                    @for ($j = $i + 1; $j <= 5; $j++) &#9734; <!-- Unicode character for empty star -->
                                        @endfor
                                        {{$i}} star{{$i > 1 ? 's' : ''}}
                            </div>
                            @endfor
                    </div>
                    <!-- <div class="  flex flex-row gap-2 items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class=" flex flex-row gap-2 items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="flex flex-row gap-2 items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                        </div>
                        <div class="  py-2 px-1 flex flex-row gap-2 items-center justify-center border rounded  bg-secondary-50">
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                            <div>
                                <img src="{{ asset('customer/icons/star.svg') }}" alt="" srcset="">
                            </div>
                        </div> -->
                </div>
            </div>
        </div>
        </div>
    </section>
    <script>

    </script>

    <script>
        var modal = document.getElementById("modal");

        // Get the button that opens the modal
        var btn = document.getElementById("openModal");

        // Get the <span> element that closes the modal
        var span = document.getElementById("closeModal");

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.classList.remove("hidden");
            modal.classList.add("block");
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.classList.add("hidden");
            modal.classList.remove("block");
        }

        // Also, close the modal if the user clicks anywhere outside of the modal content
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }
        }



        function selectCategory(category) {
            console.log(category);
            selectedCategory = category;
            highlightSelectedCategory();
            console.log(selectedCategory);
        }

        function highlightSelectedCategory() {
            console.log(selectedCategory);
            const categoryDivs = document.querySelectorAll('#categoryOptions div');
            categoryDivs.forEach(div => {
                if (div.textContent.trim() === selectedCategory.trim()) {
                    div.classList.add('selected');
                } else {
                    div.classList.remove('selected');
                }
            });
        }
        var products = @json($products);
        console.log(
            products.data
        )
    </script>
</main>


<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }


    .selected {
        background-color: #f0f0f0;
        /* Change to desired color */
        /* Add any other styling properties as needed */
    }

    .slider {
        height: 10px;
        position: relative;
        width: 100%;
        background: #ddd;
        border-radius: 5px;
    }

    .slider .progress {
        height: 100%;
        position: absolute;
        top: 0px;
        border-radius: 5px;
        background-color: #09403a;
    }

    .range-input {
        position: relative;


    }

    .range-input input {
        position: absolute;
        width: 100%;
        height: 8px;
        top: -9px;
        background: none;
        pointer-events: none;
        -webkit-appearance: none;
        -moz-appearance: none;

    }

    input[type="range"]::-webkit-slider-thumb {
        height: 20px;
        width: 20px;
        border-radius: 50%;
        border: 0.5px solid #8e702b;
        background: white;
        pointer-events: auto;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    input[type="range"]::-moz-range-thumb {
        height: 20px;
        width: 20px;
        border: 0.5px solid #8e702b;
        border-radius: 50%;
        background: white;
        pointer-events: auto;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);

        -webkit-appearance: none;
        -moz-appearance: none;
    }
</style>