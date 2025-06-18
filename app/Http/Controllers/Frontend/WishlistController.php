<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function AddToWishList(Request $request, $property_id) {
        if (Auth::check()) {
            $exists = Wishlist::where(['user_id' => Auth::id(),'property_id' => $property_id])->first();
            if (!$exists) {
                Wishlist::create([
                    'user_id'=>Auth::id(),
                    'property_id'=>$property_id
                ]);
                return response()->json(['success'=>'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error'=>'This Property Is Already In Your Wishlist']);
            }
        } else {
            return response()->json(['error'=>'At First Login Your Account']);
        }
    }

    public function UserWishlist() {
        return view('rent-frontend.user-dashboard.wishlist', [
            'wishlists' => Wishlist::with('property')->where('user_id', Auth::id())->latest()->get()
        ]);
    }

    public function UserWishlistDestroy($id) {
        $wishlist = Wishlist::where('user_id', Auth::id())->where('id', $id)->first();
        $wishlist->delete();
        $notification = array(
            'message' => 'Wishlist Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
