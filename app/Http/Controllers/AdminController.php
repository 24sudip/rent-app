<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Property, PackageOrder};
// use Illuminate\Support\Facades\Auth;
use App\Helpers\Toastr;

class AdminController extends Controller
{
    public function PropertyStatusAll() {
        return view('admin.property.status', [
            'properties' => Property::with(['upazila','district','rooms'])->latest()->get()
        ]);
    }

    public function PropertyStatusActive($id) {
        Property::find($id)->update([
            'status'=>1
        ]);
        Toastr::success('Status Updated Successfully.');
        return redirect()->back();
    }

    public function PropertyStatusInactive($id) {
        Property::find($id)->update([
            'status'=>0
        ]);
        Toastr::success('Status Updated Successfully.');
        return redirect()->back();
    }

    public function PackageOrderAll() {
        return view('admin.package-order.index', [
            'package_orders' => PackageOrder::with('package')->latest()->get()
        ]);
    }

    public function PackageOrderConfirm($id) {
        PackageOrder::find($id)->update([
            'status'=>1
        ]);
        Toastr::success('Package Order Confirmed Successfully.');
        return redirect()->back();
    }

    public function PackageOrderWithdraw($id) {
        PackageOrder::find($id)->update([
            'status'=>0
        ]);
        Toastr::success('Package Order Withdrawn Successfully.');
        return redirect()->back();
    }
}
