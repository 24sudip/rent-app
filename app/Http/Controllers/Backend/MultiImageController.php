<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MultiImage;
use Illuminate\Support\Facades\File;

class MultiImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function MultiImageStore(Request $request)
    {
        $request->validate([
            'multi_img'=>'required|image'
        ]);
        $property_id = $request->property_id;
        $img = $request->file('multi_img');
        $imageName = rand().$img->getClientOriginalName();
        $img->move(public_path('/uploads/property-photo'), $imageName);
        $imagePath = "/uploads/property-photo/". $imageName;
        MultiImage::create([
            'property_id'=>$property_id,
            'photo_name' => $imagePath,
        ]);
        $notification = array(
            'message' => 'Property Multi Image Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function MultiImageUpdate(Request $request)
    {
        $imgs = $request->multi_img;
        if (!$imgs) {
            $notification = array(
                'message' => 'Please Select Image First',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            File::delete(public_path($imgDel->photo_name));
            $imageName = rand().$img->getClientOriginalName();
            $img->move(public_path('/uploads/property-photo'), $imageName);
            $imagePath = "/uploads/property-photo/". $imageName;
            MultiImage::where('id', $id)->update([
                'photo_name' => $imagePath,
            ]);
        }
        $notification = array(
            'message' => 'Property Multi Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function MultiImageDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        File::delete(public_path($oldImg->photo_name));
        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Property Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
