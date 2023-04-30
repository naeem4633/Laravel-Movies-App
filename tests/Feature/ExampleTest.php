<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewMoviesText extends TestCase
{
    public function mainPageShowsCorrectInfo()
    {
        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
    }
}
