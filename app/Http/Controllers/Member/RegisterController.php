<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index() {
        return view('member.register');
    }

    public function store(Request $request) {
        
        // $data = $request->all();
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // dd($data);

        $isEmailExist = User::where('email', $request->email)->exists();

        if($isEmailExist) {
            return back()->withErrors([
                'email' => 'This Email is Already Exists'
            ])->withInput();
        }
    }
}
