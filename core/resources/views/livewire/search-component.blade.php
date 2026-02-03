<div class="md:w-[70%] lg:w-[50%] w-[90%] mx-auto my-6 flex flex-col gap-5">
    <div class="relative w-full">
        <input wire:model.live="query" wire:keydown.enter="search" class="search-box py-3 rounded-full w-full px-3  focus:ring-secondary-default" placeholder="Search products">
        <button wire:click="search" class="search-icon absolute top-3 right-4"><img src="{{ asset('customer/icons/search-normal.svg') }}" alt="" srcset=""></button>

    </div>
    <div id="suggestions w-full border border-red-500 bg-white">
        @foreach ($suggestions as $suggestion)
        <div class="bg-white w-full p-2 rounded-md cursor-pointer" onclick="fillValue( '{{$suggestion->name}}' )" value="{{$suggestion->name}}">{{ $suggestion->name }}</div>
        @endforeach
    </div>
</div>

<script>
    function fillValue(name) {
        let search = document.getElementById('search');
        let suggestions = document.getElementById('suggestions');
        search.value = name;
        suggestions.style.display = "none";

        search.dispatchEvent(new Event('input'))
    }
</script>