<?php

namespace Modules\Painel\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:aduser')->except('logout');
        $this->redirectTo = route('painel.email.index');
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        //        bcrypt('teste');
        //       dd(Hash::make('Aun1rede201820'));
        return view('painel::auth.login');
    }

    protected function guard()
    {
        return Auth::guard('aduser');
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    public function logout(Request $request)
    {
        Auth::guard('aduser')->logout();
        return redirect()->route('painel.auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->status) {
            Auth::guard('aduser')->logout();
            return back()->with(
                'warning',
                'Sua conta ainda não está ativada. Solicite ao administrador a ativação'
            );
        }
        return redirect()->intended($this->redirectPath());
    }
}
