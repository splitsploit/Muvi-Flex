<?php

namespace App\Http\Controllers\Member;

use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
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

            $endOfSubscription = $userPremium->end_of_subscription;

            $date = Carbon::createFromFormat('Y-m-d', $endOfSubscription);

            $isValidSubscription = $date->greaterThan(now());
            // dd($isValidSubscription);

            if($isValidSubscription) {
                return view('member.movie-watching');
            }
            return redirect()->route('member.pricing');  
        }
    }
}
