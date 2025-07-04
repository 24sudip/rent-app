<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'unique:'.User::class],
            'gender' => ['required'],
            'type' => ['required']
        ]);
        if ($request->hasFile('profile_photo')) {
            // if ($hero && File::exists(public_path($hero->image))) {
            //     File::delete(public_path($hero->image));
            // }
            $image = $request->file('profile_photo');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads/profile-photo'), $imageName);
            $imagePath = "/uploads/profile-photo/". $imageName;
            // dd($imagePath);
        }
        $user = User::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'type' => $request->type,
            'password' => Hash::make($request->password),
            'profile_photo' => isset($imagePath) ? $imagePath : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // '/dashboard'
        return redirect(RouteServiceProvider::HOME);
    }
}
