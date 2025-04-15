<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller\AdminController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    // use App\Http\Controllers\Auth\Request;

    /**
     * Where to redirect users after login.
     *
     * @var string
      */
    // protected function login()
    // {
    //     $user = request()->user();
    //     $user = Auth::user();



    //     if ($user->role === 'admin')
    //         // Redirect to the admin dashboard
    //         return redirect()->route('admin.dashboard');

    //     return redirect()->route('home');  // Redirect to the home page for regular users
    // }
    // Assuming you have a user object and role attribute
    //         $user = auth()->user();

    //         if ($user->role == 'admin') {
    //             // Redirect to the admin dashboard
    //             return redirect()->route('admin.dashboard');
    //         }

    //         // Redirect to the home page for regular users
    //         return redirect()->route('home');

    // }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Get authenticated user
            $user = Auth::user();

            // Redirect based on role
            if ($user->role === 'admin') {
                // dd('test');
                return redirect()->to('/admin/dashboard'); // Admin dashboard
            } else {
                return redirect()->route('recipes.index'); // User dashboard
            }
        }
        return back()->withErrors(['email' => 'Invalid email or password']);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
