<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen = false">
    <input wire:model.debouce.500ms="search" type="text" class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-1
    focus:outline-none focus:shadow-outine" placeholder="Search"
    @focus="isOpen = true"
    @keydown.escape.window="isOpen = false"
    @keydown.shift.tab="isOpen = false">

    @if(strlen($search >= 2))
        <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" 
        x-show.transition.opacity="isOpen">
            @if($searchResults->count() > 0)
                <ul>
                    @foreach($searchResults as $result)
                    <li class="border-b border-gray-700">
                        <a href="{{route('movies.show', $result['id'])}}" class="block hover:bg-gray-700 px-3 py-3 flex items-center">
                        <img src="https://image.tmdb.org/t/p/w92/{{$result['poster_path']}}" alt="poster" class="w-8">
                        <span class="ml-4">{{$result['title']}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results</div>
            @endif
        </div>
    @endif
</div>