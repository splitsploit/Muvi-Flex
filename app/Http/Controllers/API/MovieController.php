<?php

namespace App\Http\Controllers\API;

use App\Models\Movie;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index(Request $request) {

        $params = $request->query('search');

        $movies = Movie::where('title', 'like', '%' . $params . '%')->orderBy('featured', 'DESC')->orderBy('created_at', 'DESC')->paginate(10);
        
        return response()->json($movies);
    }

    public function show(Request $request, $id) {

        $user = $request->get('user');

         // user premium check
        $userPremium = UserPremium::where('user_id', $user->id)->first();

        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json([
                'message' => 'Movie Not Found!'
            ], 404);
        }

        if($userPremium) {

            // get end of subscription value
            $endOfSubscription = $userPremium->end_of_subscription;

            // make end of subscription to be a date format. Not an string
            $date = Carbon::createFromFormat('Y-m-d', $endOfSubscription);

            // valid subscription check
            $isValidSubscription = $date->greaterThan(now());

            // if valid subscription is true
            if($isValidSubscription) {
                return response()->json($movie);
            }

            return response()->json([
                'message' => 'You Dont Have Subscription Plan'
            ]);

        }

        // $movie = Movie::find($id);

        // if(! $movie) {
        //     return response()->json([
        //         'message' => 'Movie Not Found!'
        //     ], 404);
        // }

        // return response()->json($movie);

    }
}
