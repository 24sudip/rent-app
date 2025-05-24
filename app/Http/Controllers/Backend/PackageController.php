<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Helpers\Toastr;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function PackageAll()
    {
        return view('backend.package.index', [
            'packages' => Package::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function PackageCreate()
    {
        return view('backend.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function PackageStore(Request $request)
    {
        $fields = $request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'maximum_post'=>'required|numeric',
            'duration'=>'required|numeric',
            'short_description'=>'required',
            'status'=>'required',
            'type'=>'required',
        ]);
        Package::create($fields);
        Toastr::success('Package Created Successfully.');
        return redirect()->route('admin.package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function PackageEdit($id)
    {
        return view('backend.package.edit', [
            'package' => Package::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function PackageUpdate(Request $request, $id)
    {
        $fields = $request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'maximum_post'=>'required|numeric',
            'duration'=>'required|numeric',
            'short_description'=>'required|string|max:255',
            'status'=>'required',
            'type'=>'required',
        ]);
        Package::find($id)->update($fields);
        Toastr::success('Package Updated Successfully.');
        return redirect()->route('admin.package.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function PackageDelete($id)
    {
        Package::findOrFail($id)->delete();
    }
}
