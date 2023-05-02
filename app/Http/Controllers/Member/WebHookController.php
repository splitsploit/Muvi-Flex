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

        if($status === 'success') {
            
            $transaction = Transaction::where('transaction_code', $orderId)->first();
            $package = Package::find($transaction->package_id);

            UserPremium::create([
                'package_id' => $package->id,
                'user_id' => $transaction->user_id,
                'end_of_subscription' => Carbon::now()->addDays($package->max_days)
            ]);

        }

        return response()->json(null);

    }
}
