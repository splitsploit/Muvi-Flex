<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index() {
        $movies = Movie::all();

        return view('admin.movies.index', compact('movies'));
    }

    public function create() {
        return view('admin.movies.create');
    }

    public function edit($id) {
        // $movies = Movie::find($id);

        $movies = Movie::where('id', $id)->first();

        return view('admin.movies.edit', compact('movies'));
    }

    public function update(Request $request, $id) {
        $data = $request->except('_token'); // get all request data, except token
        $request->validate([
            'title' => 'required|string',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'small_thumbnail' => 'image|mimes:jpg,jpeg,png',
            'large_thumbnail' => 'image|mimes:jpg,jpeg,png',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'featured' => 'required',
        ]);

        $movies = Movie::find($id);

        if($request->small_thumbnail) {
            // save new image
            $smallThumbnail = $request->small_thumbnail;
            $originalSmallThumbnailName = Str::random(10).'-'.$smallThumbnail->getClientOriginalName();
            $smallThumbnail->storeAs('public/thumbnail/', $originalSmallThumbnailName);
            $data['small_thumbnail'] = $originalSmallThumbnailName;

            // delete old image
            Storage::delete('public/thumbnail/'.$movies->small_thumbnail);
        }

        if($request->large_thumbnail) {
            // save new image
            $largeThumbnail = $request->large_thumbnail;
            $originallargeThumbnailName = Str::random(10).'-'.$largeThumbnail->getClientOriginalName();
            $largeThumbnail->storeAs('public/thumbnail/', $originallargeThumbnailName);
            $data['large_thumbnail'] = $originallargeThumbnailName;

            // delete old image
            Storage::delete('public/thumbnail/'.$movies->large_thumbnail);
        }

        $movies->update($data);

        return redirect()->back();
    }

    public function store(Request $request) {
        // dd($request->all());
        // $data = $request->except('_token');
        // dd($data);
        
        $data = $request->except('_token'); // get all request data, except token
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

        // k8tZjtbdo7-filename.jpg
        $originalSmallThumbnailName = Str::random(10).'-'.$smallThumbnail->getClientOriginalName();
        $originalLargeThumbnailName = Str::random(10).'-'.$largeThumbnail->getClientOriginalName();

        $smallThumbnail->storeAs('public/thumbnail', $originalSmallThumbnailName);
        $largeThumbnail->storeAs('public/thumbnail', $originalLargeThumbnailName);

        $data['small_thumbnail'] = $originalSmallThumbnailName;
        $data['large_thumbnail'] = $originalLargeThumbnailName;

        Movie::create($data);
        
        return redirect()->back();
    }

    public function destroy($id) {
        Movie::find($id)->delete();

        return redirect()->route('movie.index')->with('success', 'Successfully Delete Movie!');
    }

}
