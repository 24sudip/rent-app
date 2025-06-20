<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\{User, Reserve};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\{Redirect, File};
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function ProfileUpdate(Request $request) {
        $fields = $request->all();
        $user = User::find(Auth::id());
        if ($request->hasFile('profile_photo')) {
            if (File::exists(public_path($user->profile_photo))) {
                File::delete(public_path($user->profile_photo));
            }
            $image = $request->file('profile_photo');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads/profile-photo'), $imageName);
            $imagePath = "/uploads/profile-photo/". $imageName;
        }
        $fields['profile_photo'] = isset($imagePath) ? $imagePath : $user->profile_photo;
        $user->update($fields);
        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function UserLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }
    public function UserReserveStore(Request $request) {
        // dd($request->all());
        $request->validate([
            'fullName'=>'required|string|max:255',
            'email'=>'required|email',
            'phone'=>'required',
            'sharingType'=>'required'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['date'] = Carbon::createFromFormat('Y-m-d', $request->date)->format("Y-m-d H:i:s");
        Reserve::create($data);
        $notification = array(
            'message' => 'Property Reserved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
    public function UserReserveAll() {
        return view('rent-frontend.user-dashboard.reserve', [
            'reserves' => Reserve::with('property')->where('user_id', Auth::id())->latest()->get()
        ]);
    }
}
