<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Package;
use App\Models\UserPremium;
use Illuminate\Support\Carbon;

class WebHookController extends Controller
{
    public function handler(Request $request) {

        \Midtrans\Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        $status = '';

        if ($transactionStatus == 'capture'){
            if ($fraudStatus == 'challenge'){

                // TODO set transaction status on your database to 'challenge'
                // and response with 200 OK

                $status = 'challenge';

            } else if ($fraudStatus == 'accept'){

                // TODO set transaction status on your database to 'success'
                // and response with 200 OK

                $status = 'success';

            }
        } else if ($transactionStatus == 'settlement'){

            // TODO set transaction status on your database to 'success'
            // and response with 200 OK

            $status = 'success';

        } else if ($transactionStatus == 'cancel' ||
          $transactionStatus == 'deny' ||
          $transactionStatus == 'expire'){

          // TODO set transaction status on your database to 'failure'
          // and response with 200 OK

          $status = 'failure';

        } else if ($transactionStatus == 'pending'){

          // TODO set transaction status on your database to 'pending' / waiting payment
          // and response with 200 OK

          $status = 'pending';
          
        }

        $transaction = Transaction::where('transaction_code', $orderId)->first();
        $package = Package::find($transaction->package_id);

        if($status === 'success') {

            // user premium data
            $userPremium = UserPremium::where('user_id', $transaction->user_id)->first();

            // check if user premium data has exists, make renewal subscription
            if($userPremium) {

                // renewal subscription
                $endOfSubscription = $userPremium->end_of_subscription;
                $date = Carbon::createFromFormat('Y-m-d', $endOfSubscription); // change format data from string to date carbon
                $newEndOfSubscription = $date->addDays($package->max_days)->format('Y-m-d'); // add new end subscription & change format to string again

                // dd($newEndOfSubscription);

                $userPremium->update([
                    'package_id' => $transaction->package_id,
                    'end_of_subscription' => $newEndOfSubscription
                ]);

            } else {

                // if user premium data not exsist, create new subscription
                UserPremium::create([
                    'package_id' => $package->id,
                    'user_id' => $transaction->user_id,
                    'end_of_subscription' => Carbon::now()->addDays($package->max_days)
                ]);
            }

        }

        $transaction->update([
            'status' => $status
        ]);

        return response()->json(null);

    }
}
