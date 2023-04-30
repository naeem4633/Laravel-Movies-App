<?php

namespace App\Http\Controllers;

use App\Models\MoviesViewModel;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index(){
        $popularMovies = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/popular')
        ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/movie/list')
        ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });

        return view('movies.index', [
            'popularMovies' => $popularMovies,
            'genres' => $genres,
        ]);
    }

    public function show($id){
        $movie = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/movie/'.$id. '?append_to_response=credits,videos,images')
        ->json();

        return view('movies.show', [
            'movie' => $movie,
        ]);
    }
}