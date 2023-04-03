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
        
        $data = $request->except('_token');
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

        $smallThumbnail = $request->small_thumbnail;
        $largeThumbnail = $request->large_thumbnail;

        $originalSmallThumbnailName = $smallThumbnail->getClientOriginalName();
        $originalLargeThumbnailName = $largeThumbnail->getClientOriginalName();

        $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
        $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);

        $data['small_thumbnail'] = $originalSmallThumbnailName;
        $data['large_thumbnail'] = $originalLargeThumbnailName;

        dd($data);
    }
}
