<?php

namespace App\Http\Controllers\Member;

use App\Models\Movie;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Moviecontroller extends Controller
{
    public function show($id) {

        // find / get movie by id
        $movie = Movie::find($id);

        return view('member.movie-detail', ['movie' => $movie]);
    }

    public function watch($id) {
        
        // get user id value
        $userId = Auth::user()->id;

        // dd($userId);

        // user premium check
        $userPremium = UserPremium::where('user_id', $userId)->first();

        // if user premium is true
        if($userPremium) {

            // get end of subscription value
            $endOfSubscription = $userPremium->end_of_subscription;

            // make end of subscription to be a date format. Not an string
            $date = Carbon::createFromFormat('Y-m-d', $endOfSubscription);

            // valid subscription check
            $isValidSubscription = $date->greaterThan(now());

            // if valid subscription is true
            if($isValidSubscription) {

                $movie = Movie::find($id);

                return view('member.movie-watching', ['movie' => $movie]);
            }

            // if valid subscription is false
            return redirect()->route('member.pricing')
            ->withErrors([
                'expired' => 'Maaf, Subscription Anda Sudah Habis. Silahkan Berlangganan Kembali'
            ]);  
        }
    }
}
