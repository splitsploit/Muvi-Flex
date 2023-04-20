<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPremium;
use Illuminate\Support\Facades\Auth;

class Moviecontroller extends Controller
{
    public function show($id) {
        return view('member.movie-detail');
    }

    public function watch($id) {
        $userId = Auth::user()->id;

        // dd($userId);
        
        $userPremium = UserPremium::where('user_id', $userId)->first();

        if($userPremium) {
            return view('member.movie-watching');
        }

        return redirect()->route('member.pricing');
    }
}
