<?php

namespace App\Http\Controllers;

use App\Notifications\SendPushNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kutia\Larafirebase\Facades\Larafirebase;

class FirebaseController extends Controller
{
    public function updateToken(Request $request){
        try{
            User::where('id', Auth::user()->id)->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        }catch(\Exception $e){
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }

    public function notification(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'message' => 'required'
        ]);

        try {
            $fcmTokens = User::whereNotNull('fcm_token')->where('id', 101)->pluck('fcm_token')->toArray();

            //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            auth()->user()->notify(new SendPushNotification($request->title,$request->message,$fcmTokens));

            /* or */

            Larafirebase::withTitle($request->title)
                ->withBody($request->message)
                ->sendMessage($fcmTokens);

            return redirect()->back()->with('message', 'Notification Sent Successfully!!');

        } catch (\Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Something goes wrong while sending notification.');
        }
    }

}
