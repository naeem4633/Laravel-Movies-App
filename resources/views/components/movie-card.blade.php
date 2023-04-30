<div class="mt-8">
    <a href="{{route('movies.show', $movie['id'])}}">
        <img src="{{'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="poster" class="hover:opacity-75 transition ease-in-out duration-150">
    </a>
    <div class="mt-2">
        <a href="{{route('movies.show', $movie['id'])}}" class="text-lg mt-2 hover:text-gray:300">
            {{$movie['title']}}
        </a>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.173l2.335 4.817 5.305.732-3.861 3.71.942 5.27-4.721-2.524-4.721 2.525.942-5.27-3.861-3.71 5.305-.733 2.335-4.817zm0-4.586l-3.668 7.568-8.332 1.151 6.064 5.828-1.48 8.279 7.416-3.967 7.416 3.966-1.48-8.279 6.064-5.827-8.332-1.15-3.668-7.569z"/></svg></span>
            <span class="ml-1">{{$movie['vote_average']}}</span>
            <span class="mx-2">|</span>
            <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')}}</span>
        </div>
        <div class="text-gray-400 text-sm">
            @foreach ($movie['genre_ids'] as $genre)
                {{$genres->get($genre)}} @if(!$loop->last), @endif
            @endforeach
        </div>
    </div>
</div>