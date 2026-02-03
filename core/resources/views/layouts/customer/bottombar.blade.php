<style>
    .bar-container {
        position: fixed;
        background-color: rgb(240, 240, 240);
        right: 0px;
        left: 0px;
        bottom: 0px;
        height: 70px;
        z-index: 10;
        display: none;
    }

    .bar {
        background-color: rgb(240, 240, 240);
        height: 70px;
        position: relative;
        /* top: 18px; */
        /* margin-left: 20px;  */
        /* margin-right: 20px; */
        display: flex;
        /* border-radius: 30px; */
        justify-content: space-around;
        align-items: center;
        /* box-shadow: 2px 4px 4px 4px rgb(205, 202, 202); */
        padding-left: 10px;
        padding-right: 10px;
    }

    .bar-icon {
        display: flex;
        align-items: center;
    }

    .bar-icon a {
        color: rgb(130, 128, 128);
        display: flex;
        flex-direction: column;
        padding: 0px;
        margin: 0px;
        font-size: 13px;
    }

    @media screen and (max-width: 850px) {
        .bar-container {
            display: block;
        }
    }
</style>

<div class="bar-container">
    <div class="bar">
        <div class="bar-icon">
            <a class="{{\Route::currentRouteName() == 'shop.index'?'text-primary':''}}" href="{{ route('shop.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span>Home</span>
            </a>
        </div>
        <div class="bar-icon">
            <a class="{{\Route::currentRouteName() == 'shop.list'?'text-primary':''}}" href="{{ route('shop.list')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
                <span>Shop</span>
            </a>
        </div>

        <div class="bar-icon">
            <a class="{{(\Route::currentRouteName() == 'shop.cart' || \Route::currentRouteName() == 'shop.checkout')?'text-primary':''}}" href="{{ route('shop.cart')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                </svg>
                <span>Cart</span>
            </a>
        </div>

    
        <div class="bar-icon">
            <a class="{{\Route::currentRouteName() == 'customer.wishlist'?'text-primary':''}}" href="{{ route('customer.wishlist')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <span>Wishs</span>
            </a>
        </div>
    </div>
</div>