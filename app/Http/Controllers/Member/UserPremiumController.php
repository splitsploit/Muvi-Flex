<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPremium;
use Illuminate\Support\Facades\Auth;

class UserPremiumController extends Controller
{
    public function index() {

        // get user id
        $userId = Auth::user()->id;

        // get package name that user subscribe
        $userPremium = UserPremium::with('package')->where('user_id', $userId)->first();

        // dd($userPremium);

        return view('member.subscription', ['user_premium' => $userPremium]);
    }
}
