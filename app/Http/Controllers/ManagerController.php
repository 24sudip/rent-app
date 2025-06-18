<?php

namespace App\Http\Controllers;

use App\Models\{Package, PaymentPackage};
use App\Models\PackageOrder;
use App\Models\PropertyCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{Hash, Auth, File};
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function ManagerDashboard() {
        return view('manager.manager-dashboard');
    }

    public function ManagerLogin() {
        return view('manager.manager-login');
    }

    public function ManagerRegister() {
        return view('manager.manager-register', [
            'property_categories' => PropertyCategory::get(['id','name'])
        ]);
    }

    public function ManagerStore(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'unique:'.User::class],
            'property_category_id' => ['required','numeric'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        if ($request->hasFile('profile_photo')) {
            // if ($hero && File::exists(public_path($hero->image))) {
            //     File::delete(public_path($hero->image));
            // }
            $image = $request->file('profile_photo');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads/profile-photo'), $imageName);
            $imagePath = "/uploads/profile-photo/". $imageName;
        }
        $user = User::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'email' => $request->email,
            'phone' => $request->phone,
            'property_category_id' => $request->property_category_id,
            'role' => 'manager',
            'password' => Hash::make($request->password),
            'profile_photo' => isset($imagePath) ? $imagePath : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        // '/dashboard'
        return redirect(RouteServiceProvider::MANAGER);
    }

    public function ManagerLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Manager Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/manager/login')->with($notification);
    }

    public function ManagerProfile(Request $request) {
        return view('manager.manager-profile', [
            'user' => $request->user(),
        ]);
    }

    public function ManagerProfileUpdate(Request $request) {
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
            'message' => 'Manager Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ManagerBuyPackage() {
        return view('manager.buy-package', [
            'packages'=>Package::where('status', 1)->get(['id','name','price','maximum_post','duration','short_description'])
        ]);
    }

    public function ManagerSubscribe(Request $request, $package_id) {
        $package = Package::findOrFail($package_id);
        $package_order = PackageOrder::where('user_id', Auth::id())->first();
        if (!$package_order) {
            if ($package->type == 'Free') {
                $expired_at = Carbon::now()->addDays($package->duration);
                PackageOrder::create([
                    'user_id'=>Auth::id(),
                    'package_id'=>$package->id,
                    'expired_at'=>$expired_at,
                    'invoice_no'=>'RNT'. mt_rand('10000000','99999999'),
                    'order_date'=>now()->format('d F Y'),
                    'order_month'=>now()->format('F'),
                    'order_year'=>now()->format('Y'),
                ]);
                $notification = array(
                    'message' => 'You Have Subscribed Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            } else {
                $user = Auth::user();
                $payment_package = PaymentPackage::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'phone'=>$user->phone,
                    'address'=>$user->address,
                    'total_amount'=>$package->price,
                    'package_id'=>$package->id,
                    'invoice_no'=>'RNT'. mt_rand('10000000','99999999'),
                    'order_date'=>now()->format('d F Y'),
                    'order_month'=>now()->format('F'),
                    'order_year'=>now()->format('Y'),
                ]);
                $expired_at = Carbon::now()->addDays($package->duration);
                PackageOrder::create([
                    'payment_id'=>$payment_package->id,
                    'user_id'=>Auth::id(),
                    'package_id'=>$package->id,
                    'expired_at'=>$expired_at,
                    'invoice_no'=>$payment_package->invoice_no,
                    'order_date'=>now()->format('d F Y'),
                    'order_month'=>now()->format('F'),
                    'order_year'=>now()->format('Y'),
                    'status' => 0
                ]);
                $notification = array(
                    'message' => 'You Have Subscribed Successfully',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            }
        } elseif($package_order->package->type == 'Premium' && $package->type == 'Free') {
            $notification = array(
                'message' => 'Only Beginner Can Use Free Package',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } elseif($package_order->package->type == 'Free' && $package->type == 'Free') {
            $notification = array(
                'message' => 'You Have Already Subscribed Free Package',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } elseif($package_order->payment_id == 0 || $package_order->status == 1) {
            $user = Auth::user();
            $payment_package = PaymentPackage::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'phone'=>$user->phone,
                'address'=>$user->address,
                'total_amount'=>$package->price,
                'package_id'=>$package->id,
                'invoice_no'=>'RNT'. mt_rand('10000000','99999999'),
                'order_date'=>now()->format('d F Y'),
                'order_month'=>now()->format('F'),
                'order_year'=>now()->format('Y'),
            ]);
            $expired_at = Carbon::now()->addDays($package->duration);
            $package_order->update([
                'payment_id'=>$payment_package->id,
                'user_id'=>Auth::id(),
                'package_id'=>$package->id,
                'expired_at'=>$expired_at,
                'invoice_no'=>$payment_package->invoice_no,
                'order_date'=>now()->format('d F Y'),
                'order_month'=>now()->format('F'),
                'order_year'=>now()->format('Y'),
                'status' => 0
            ]);
            $notification = array(
                'message' => 'You Have Subscribed Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Previous Payment Is Not Confirmed By Admin Yet',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
