<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function create() {
        return view('admin.movies.create');
    }

    public function store(Request $request) {
        // dd($request->all());
        // $data = $request->except('_token');
        // dd($data);

        $request->validate([
            'title' => 'required|string',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'small_thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'large_thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'featured' => 'required',
        ]);
    }
}
