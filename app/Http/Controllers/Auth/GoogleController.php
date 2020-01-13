<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Exception;
use App\Professor;
use Session;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    /*
     * Create a new controller instance.
     * @return void
     */

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Create a new controller instance.
     * @return void
     */
    public function handleGoogleCallback()
    {

        $emailvalidation = "/([a-zA-Z0-9]+)([\.{1}])?([a-zA-Z0-9]+)\@plaiaundi([\.])net/";

        try {
            $user = Socialite::driver('google')->user();
            $finduser = Professor::where('google_id', $user->id)->first();

            // if user is @plaiaundi.net system creates and logs the user
            if (preg_match($emailvalidation,  $user->email)) {

                //if DB has the user do login else create the user
                if ($finduser) {
                    Session::flush();
                    Auth::guard('professor')->login($finduser);
                    return redirect('/home');
                } else {
                    $newUser = Professor::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'avatar'=> $user->avatar,
                    ]);
                    Auth::login($newUser);
                    
                    return redirect('/home');
                }
            } else {
                return redirect('/');
             }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
