<?php

namespace App\Http\Controllers\API;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index(Request $request) {

        $search = $request->query('search');

        $movies = Movie::where('title', 'like', '%' . $search . '%')->orderBy('featured', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        
        return response()->json($movies);
    }
}
