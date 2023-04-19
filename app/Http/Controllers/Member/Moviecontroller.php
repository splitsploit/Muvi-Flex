<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Moviecontroller extends Controller
{
    public function show() {
        return view('member.movie-detail');
    }
}
