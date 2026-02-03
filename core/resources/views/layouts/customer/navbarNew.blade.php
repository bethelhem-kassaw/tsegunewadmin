<nav class="bg-transparent h-20 w-full overflow-x-hidden ">
    <div class="flex h-full flex-row justify-between items-center md:px-14  px-4 border-b border-gray-200">



        <!-- image logo -->
        <a href="{{ route('shop.index') }}">
            <img class=" w-20  object-cover" src="{{ asset('customer/images/Logo/mainLogo.svg') }}" alt="" srcset="">
        </a>
        <!-- menu items  -->
        <ul class="hidden lg:flex flex-row gap-7 text-primary-default ">
            <li>
                <a href="{{ route('shop.index') }}">
                    Home
                </a>
            </li>

            <li class="flex  items-center gap-2 group " x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a href="#0" :aria-expanded="open">
                    Collections
                </a>

                <button class="shrink-0 p-1" :aria-expanded="open" @click.prevent="open = !open">
                    <span class="sr-only">Show submenu for "Collections"</span>
                    <svg class="w-3 h-3 fill-slate-500" xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                        <path d="M10 2.586 11.414 4 6 9.414.586 4 2 2.586l4 4z" />
                    </svg>
                </button>
                <div class="invisible group-hover:visible absolute z-20 top-16 left-1/3 -translate-x-1/2 rounded-md border border-secondary-default  py-5 px-10 flex items-center  bg-secondary-50    mx-auto">
                    <div class="grid grid-cols-3 gap-4">
                        @foreach($menus as $menu)
                        <div class="col-span-1 ">
                            <div class="mx-3 mb-4 flex flex-col justify-center items-center gap-2">
                                <img class="w-10 h-10" src="{{ asset('storage/'.$menu->photos[0]) }}" alt="" srcset="">
                                <a href="{{ route('shop.list', $menu->id) }}" class="text-black font-bold hover:text-secondary-default">{{ $menu->name }}</a>
                            </div>
                            <ul class="pl-7">
                                @foreach($menu->subCategory as $sub)
                                <li class="flex gap-2 items-center">
                                    <img class="w-4 h-4" src="{{ asset('customer/icons/more-2.svg') }}" alt="" srcset="">
                                    <a href="{{ route('shop.shop-sub-list', [$menu->name, $sub->id])}}" class="text-gray-600 hover:text-secondary-default  ">{{ $sub->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </li>
            <li>
                <a href="{{ route('shop.list')}}">
                    Shop
                </a>
            </li>
            <li>
                <a href="/about">
                    About us
                </a>
            </li>
            <li>
                <a href="/commingsoon">
                    Contact
                </a>
            </li>
        </ul>

        <!-- icons  -->
        <ul class="flex flex-row gap-5 items-center ">
            <!-- whole seller  -->
            <!-- <li>
                <a href="/wholesale" class="hidden border border-secondary-default rounded-full  md:flex items-center px-2 gap-4 ">
                    <div class="w-7 h-7 rounded-full border my-1 border-secondary-default flex items-center justify-center">
                        <img class="w-5 h-5" src="{{ asset('customer/icons/shop-add.svg') }}" alt="" srcset="">
                    </div>
                    <p class="text-secondary-default">
                        Whole Seller?
                    </p>
                </a>
            </li> -->
            <!-- search button  -->
            <li class=" flex items-center">
                <button id="searchButton" onclick="toggleSearch(true)">
                    <img src="{{ asset('customer/icons/search-normal.svg') }}" alt="" srcset="">
                </button>

            </li>
            <!-- cart  -->
            <li>
                <div class="hidden md:flex">
                    @livewire('cart')
                </div>
            </li>
            <div id="searchArea" class="hidden serachArea absolute  top-0 left-0 py-10 flex items-center  bg-primary-default bg-opacity-90 z-40 w-full">

                @livewire('search-component')
                <div onclick="toggleSearch(false)" class="absolute top-3 right-5 cursor-pointer ">
                    <img class="  " src="{{ asset('customer/icons/close-white.svg') }}" alt="" srcset="">
                </div>
            </div>

            <div class="hidden lg:flex flex-row gap-5">
                @auth
                <li>
                    <div id="notificationButton" class="">
                        <img data-open onclick="toggleNotification()" src="{{ asset('customer/icons/notification-bing.svg') }}" alt="" srcset="">
                        <div id="notificationArea" class="hidden absolute top-20 right-8 z-10 border border-secondary-default bg-white  md:w-96 aspect-square rounded overflow-hidden overflow-y-auto">
                            @livewire('notification')
                        </div>
                    </div>

                </li>
                <li>
                    <!-- <a href="/comingSoon">
            <img src="{{ asset('customer/icons/heart.svg') }}" alt="" srcset="">
          </a> -->
                    @livewire('wishlist')
                </li>

                <li>
                    <a href="{{ route('customer.dashboard.index')}}">
                        <img src="{{ asset('customer/icons/profile.svg') }}" alt="" srcset="">
                    </a>
                </li>


                @endauth
                @guest
                <li>
                    <a class="text-primary-default font-bold text-lg" href="/login">Login</a>
                </li>
                @endguest
            </div>
            <!-- button for menu  -->
            <button class="lg:hidden" onclick="toggleNavbar(true)" id="openIcon">
                <img src="{{ asset('customer/icons/element-equal.svg') }}" alt="" srcset="">
            </button>
        </ul>

    </div>

</nav>
<div id="navbar" class=" hidden absolute inset-0 h-[92vh] bg-gray-500 bg-opacity-40  overflow-hidden z-10">
    <div class="flex z-10 lg:hidden flex-col gap-5    delay-300 -translate-x-100 transition-all  border shadow-md border-secondary-default bg-white w-2/3 md:w-1/2 rounded h-full">
        <!-- Mobile menu -->
        <div class=" border p-10 relative">
            <button onclick="toggleNavbar(false)" id="closeIcon" class="absolute top-5 right-5 cursor-pointer rounded-full w-8 aspect-square flex items-center justify-center">
                <img class="w-7 h-7" src="{{ asset('customer/icons/close-circle.svg') }}" alt="" srcset="">
            </button>

            <ul class="flex flex-col gap-7 text-primary-default">
                <li>
                    <a href="{{ route('shop.index') }}">
                        Home
                    </a>
                </li>
                <li class="relative">
                    <a id="collectionButton" onclick="toggleCollection()" class="cursor-pointer">
                        <div class="flex gap-2 items-center">
                            <p>Collections</p>
                            <button class="shrink-0 p-1" :aria-expanded="open" @click.prevent="open = !open">
                                <span class="sr-only">Show submenu for "Collections"</span>
                                <svg class="w-3 h-3 fill-slate-500" xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                    <path d="M10 2.586 11.414 4 6 9.414.586 4 2 2.586l4 4z" />
                                </svg>
                            </button>
                        </div>
                    </a>
                    <div id="collectionArea" class="hidden absolute  top-8 left-0 rounded-md  py-3 px-1 flex items-center  bg-secondary-50  z-10 w-full mx-auto">
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($menus as $menu)
                            <div class="col-span-1 ">
                                <div class=" mx-2 flex justify-between   rounded items-center">
                                    <a href="{{ route('shop.list', $menu->id) }}" class="text-black  font-bold hover:text-secondary-default">{{ $menu->name }}</a>
                                    <svg class="w-3 h-3 fill-slate-500  shrink-0" xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                        <path d="M10 2.586 11.414 4 6 9.414.586 4 2 2.586l4 4z" />
                                    </svg>
                                </div>
                                <ul class="pl-7">
                                    @foreach($menu->subCategory as $sub)
                                    <li>
                                        <a href="{{ route('shop.shop-sub-list', [$menu->name, $sub->id])}}" class="text-gray-600 hover:text-secondary-default  ">{{ $sub->name }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li>
                    <a href="{{ route('shop.list')}}">
                        Shop
                    </a>
                </li>
                <li>
                    <a href="/comingSoon">
                        About us
                    </a>
                </li>
                <li>
                    <a href="/contact">
                        Contact
                    </a>
                </li>
            </ul>
            <div class="border-[0.4px] border-gray-200 w-full mt-5"></div>
            <ul class="flex gap-5 mt-5 w-full">
                @auth
                <li>
                    <a href="notification">
                        <img data-open onclick="toggleNotification()" src="{{ asset('customer/icons/notification-bing.svg') }}" alt="" srcset="">
                    </a>
                </li>
                <li>
                    @livewire('wishlist')
                </li>
                <li>
                    <a>

                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.dashboard.index')}}">
                        <img src="{{ asset('customer/icons/profile.svg') }}" alt="" srcset="">
                    </a>
                </li>
                @endauth
                @guest


                <li>

                    <a class="text-primary-default font-bold text-lg" href="/login">Login</a>


                </li>
                @endguest
            </ul>
        </div>
    </div>
</div>

<script>
    function toggleNavbar(open) {
        var navbar = document.getElementById("navbar");
        var openIcon = document.getElementById("openIcon");
        var closeIcon = document.getElementById("closeIcon");


        if (open) {
            navbar.classList.remove("hidden");
            openIcon.classList.add("hidden");
            closeIcon.classList.remove("hidden");
        } else {
            navbar.classList.add("hidden");
            openIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");
        }
    }


    function toggleSearch(open) {
        var searchOpen = document.getElementById("searchButton");
        var searchArea = document.getElementById("searchArea");
        if (open) {
            searchArea.classList.remove("hidden")
        } else {
            searchArea.classList.add("hidden")
        }
    }


    function toggleNotification() {

        var notificationOpen = document.getElementById("notificationButton");
        var notificationArea = document.getElementById("notificationArea");
        if (notificationArea.classList.contains("hidden")) {
            // If hidden, remove the "hidden" class to show the notification area
            notificationArea.classList.remove("hidden");
            // Update the button to indicate that the notification area is open
            notificationButton.setAttribute("data-open", "true");
        } else {
            // If visible, add the "hidden" class to hide the notification area
            notificationArea.classList.add("hidden");
            // Update the button to indicate that the notification area is closed
            notificationButton.setAttribute("data-open", "false");
        }

    }

    function toggleCollection() {
        var collectionOpen = document.getElementById("collectionButton");
        var collectionArea = document.getElementById("collectionArea");
        if (collectionArea.classList.contains("hidden")) {
            // If hidden, remove the "hidden" class to show the collection area
            collectionArea.classList.remove("hidden");
            // Update the button to indicate that the collection area is open
            collectionButton.setAttribute("data-open", "true");
        } else {
            // If visible, add the "hidden" class to hide the collection area
            collectionArea.classList.add("hidden");
            // Update the button to indicate that the collection area is closed
            collectionButton.setAttribute("data-open", "false");
        }
    }
</script>