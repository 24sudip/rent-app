<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\Toastr;


class AuthController extends Controller
{
    public function login(){
        return view('frontend.auth.login');
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        // $credentials['role'] = 'admin';
        $remember = $request->has('remember');
        // guard('user')->
        if (Auth::attempt($credentials, $remember)) {
            if ($request->ajax()) {
                return response()->json(['success' => true], 200);
            }

            return redirect()->intended('/admin/dashboard');
        }

        if ($request->ajax()) {
            return response()->json([
                'errors' => [
                    'email' => ['The provided credentials do not match our records.'],
                ]
            ], 422);
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email', 'remember'));
    }

    public function register(){
        return view('frontend.auth.register');
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'password' => 'required|string|min:6',
            'agree' => 'accepted',
        ]);

        $slug = Str::slug($request->name);
        $userExist = User::where('slug', $slug)->count();
        if($userExist){
            $slug = $slug . '-' . $userExist+1;
        }

        $user = new User();
        $user->name = $request->name;
        $user->slug = $slug;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->role = 'admin';
        $user->save();

        // guard('user')->
        Auth::login($user);

        return redirect()->intended('/admin/dashboard');
    }

    public function logout(Request $request)
    {
        // guard('user')->
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Toastr::success('You have been successfully logged out.');
        return redirect()->route('admin.login');
    }

    
}
