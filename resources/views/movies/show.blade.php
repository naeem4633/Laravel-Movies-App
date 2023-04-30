@extends('layouts.main')

@section('content')

    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
                <img src="{{'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}" alt="parasite" class="w-64 md:w-96">
            </div>    
                <div class="md:ml-24">
                    <h2 class="text-4xl font-semibold">{{$movie['title']}}</h2>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm">
                        <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 5.173l2.335 4.817 5.305.732-3.861 3.71.942 5.27-4.721-2.524-4.721 2.525.942-5.27-3.861-3.71 5.305-.733 2.335-4.817zm0-4.586l-3.668 7.568-8.332 1.151 6.064 5.828-1.48 8.279 7.416-3.967 7.416 3.966-1.48-8.279 6.064-5.827-8.332-1.15-3.668-7.569z"/></svg></span>
                        <span class="ml-1">{{$movie['vote_average']}}</span>
                        <span class="mx-2">|</span>
                        <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y')}}</span>
                        <span class="mx-2">|</span>
                        <span>
                            @foreach ($movie['genres'] as $genre)
                                {{$genre['name']}} @if(!$loop->last), @endif
                            @endforeach
                        </span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{$movie['overview']}}
                </p>
                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured cast</h4>
                    <div class="flex mt-4">
                        @foreach($movie['credits']['crew'] as $crew)
                            @if($loop->index < 2)
                            <div class="mr-8">
                                <div>{{$crew['name']}}</div>
                                <div class="text-sm text-gray-400">{{$crew['job']}}</div>
                            </div>
                            @else
                                @break
                            @endif    
                        @endforeach
                        
                    </div>

                    <div x-data="{isOpen: false}">
                        @if(count($movie['videos']['results']) > 0)
                    <div class="mt-12">
                        <button
                        @click= "isOpen=true" 
                        class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 512 512"><path fill-rule="nonzero" d="M255.99 0c70.68 0 134.7 28.66 181.02 74.98C483.33 121.3 512 185.31 512 256c0 70.68-28.67 134.69-74.99 181.01C390.69 483.33 326.67 512 255.99 512S121.3 483.33 74.98 437.01C28.66 390.69 0 326.68 0 256c0-70.67 28.66-134.7 74.98-181.02C121.3 28.66 185.31 0 255.99 0zm77.4 269.81c13.75-8.88 13.7-18.77 0-26.63l-110.27-76.77c-11.19-7.04-22.89-2.9-22.58 11.72l.44 154.47c.96 15.86 10.02 20.21 23.37 12.87l109.04-75.66zm79.35-170.56c-40.1-40.1-95.54-64.92-156.75-64.92-61.21 0-116.63 24.82-156.74 64.92-40.1 40.11-64.92 95.54-64.92 156.75 0 61.22 24.82 116.64 64.92 156.74 40.11 40.11 95.53 64.93 156.74 64.93 61.21 0 116.65-24.82 156.75-64.93 40.11-40.1 64.93-95.52 64.93-156.74 0-61.22-24.82-116.64-64.93-156.75z"/></svg>
                            <span class="ml-2">Play Trailer</span>
                        </button>
                    </div>
                    @endif

                    <div style="background-color: rgba(0, 0, 0, .5);"
                    class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                    x-show = isOpen>
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isOpen=false" class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                </div>
                                <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16 ">
            <h2 class="text-4xl font-semibold">Cast</h2>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16">
        @foreach($movie['credits']['cast'] as $cast)
            @if($loop->index < 5)
                <div class="mt-8">
                    <a href="{{route('actors.show', $cast['id'])}}">
                        <img src="{{'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']}}" alt="actor" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="{{route('actors.show', $cast['id'])}}" class="text-lg mt-2 hover:text-gray:300">
                            {{$cast['name']}}
                        </a>
                        <div class="text-gray-400 text-sm">
                            {{$cast['character']}}
                        </div>
                    </div>
                </div>
                @else
                    @break
            @endif
        @endforeach
    </div>

    <div class="movie-images">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font semibold">Images</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    @foreach($movie['images']['backdrops'] as $image)
                        @if($loop->index < 9)
                            <div class="mt-8">
                                <a href="#">
                                    <img src="{{'https://tmdb.org/t/p/w500/'.$image['file_path']}}" alt="image" class="hover:opacity-75 transition ease-in-out duration-150">
                                </a>
                            </div>
                            @else
                                @break
                        @endif
                    @endforeach
                </div>
        </div>
    </div>

@endsection