<?php

namespace EVOS\Http\Controllers\Auth;

use Auth;
use Hash;
use EVOS\Http\Controllers\Controller;
use EVOS\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['getChangePassword', 'postChangePassword']);
        $this->middleware('auth')->only(['getChangePassword', 'postChangePassword']);
    }

    public function getChangePassword()
    {
        return view('auth.passwords.change');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->get('current_password'), $user->password)) {
            return redirect(action('Auth\PasswordController@getChangePassword'))
                ->withErrors(['Das eingegebene Passwort stimmt nicht mit dem gespeicherten überein!']);
        }

        $user->update(['password' => bcrypt($request->get('password'))]);

        return redirect(action('Auth\PasswordController@getChangePassword'))
            ->with('message', 'Passwort wurde geändert!');
    }
}
