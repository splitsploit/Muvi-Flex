<?php

namespace App\Http\Controllers\Member;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PricingController extends Controller
{
    public function index()
    {
        $standardPackage = Package::where('name', 'standard')->first();
        $goldPackage = Package::where('name', 'gold')->first();

        return view('member.pricing', [
            'standard' => $standardPackage,
            'gold' => $goldPackage
        ]);
    }
}
