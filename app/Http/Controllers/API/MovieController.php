<?php

namespace App\Http\Controllers\API;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index(Request $request) {

        $movies = Movie::orderBy('featured', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        
        return response()->json($movies);
    }
}
