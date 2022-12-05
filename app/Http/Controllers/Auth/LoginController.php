<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RewardHistories;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        try {
            $crds = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            try {
                $a = $this->username();
                $user = User::select($this->username())->where($this->username(), "=", $request->username)->get();
                if (!empty($user->first()->$a)) {
                    if (Auth::attempt([$this->username() => $request->username, 'password' => $request->password])) {
                        $request->session()->regenerate();
                        if (Auth::user()->role->role == 'Admin' || Auth::user()->role->role == 'Owner' || Auth::user()->role->role == 'Toko') {
                            return redirect()->route('admin');
                        } elseif (Auth::user()->role->role == 'Users') {
                            RewardHistories::where('expired_at', '<=', Carbon::today())->update([
                                "status" => "Expired",
                                "updated_at" => date('Y-m-d H:i:s')
                            ]);
                            return redirect()->route('dashboard');
                        }
                    } else {
                        return back()->withErrors(['loginError' => "Maaf! Password anda salah mohon coba lagi."])->withInput();
                    }
                } else {
                    return back()->withErrors(['loginError' => "Maaf! Email atau Username yang anda masukkan tidak terdaftar."])->withInput();
                }
            } catch (\Exception $a) {
                return back()->withErrors(['sistemLoginError' => $a->getMessage()])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['loginError' => 'Maaf! Email atau Password masih kosong.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function username()
    {
        $login = request()->input('email');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }
}
