<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Ourteam;
// use App\Models\Service;
// use App\Models\Testimonial;
// use App\Models\Blog;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Toastr;
use App\Models\{Division, PropertyCategory, Property, Room, Upazila, WhatYouSetting, WhatYouItem, Reward, Passport};

class FrontendController extends Controller
{
    public function index() {
        return view('rent-frontend.index', [
            'property_categories'=>PropertyCategory::get(['id','name','category_photo']),
            'what_you_setting'=>WhatYouSetting::first(),
            'what_you_items'=>WhatYouItem::latest()->get(['id','photo','title','description']),
            // 'rewards'=>Reward::latest()->get(['id','photo','title','description']),
            // 'passport'
        ]);
    }

    public function CategoryProperties($id) {
        return view('rent-frontend.rent-category', [
            'properties'=>Property::with('multi_images','rooms')->where('property_category_id', $id)->get(),
            'property_category_id'=>$id,
            'divisions' => Division::get(['id','name'])
        ]);
    }

    public function AllUpazila() {
        $upazilas =  Upazila::with('district')->orderBy('name','asc')->get();
        return response()->json($upazilas);
    }

    public function UpazilaProperties($property_category_id, $upazilla_id) {
        return view('rent-frontend.upazilla-property', [
            'properties'=>Property::with('multi_images','rooms')->where('property_category_id', $property_category_id)
            ->where('upazilla_id', $upazilla_id)->get(),
            'property_category_id'=>$property_category_id,
            'divisions' => Division::get(['id','name'])
        ]);
    }

    public function SearchLocation(Request $request) {
        $request->validate([
            'category_id'=>'required'
        ]);
        $location = $request->location;
        $division_properties = [];
        $district_properties = [];
        $upazila_properties = [];
        $division_properties = Property::where('property_category_id', $request->category_id)
        ->where('status', 1)->with('division')
        ->whereHas('division', function ($q) use ($location) {
            $q->where('name','like','%'.$location.'%');
        })->get();
        $district_properties = Property::where('property_category_id', $request->category_id)
        ->where('status', 1)->with('district')
        ->whereHas('district', function ($q) use ($location) {
            $q->where('name','like','%'.$location.'%');
        })->get();
        $upazila_properties = Property::where('property_category_id', $request->category_id)
        ->where('status', 1)->with('upazila')
        ->whereHas('upazila', function ($q) use ($location) {
            $q->where('name','like','%'.$location.'%');
        })->get();
        // dd($division_properties->toArray(), $district_properties->toArray(), $upazila_properties->toArray());
        $all_properties = $division_properties->merge($district_properties)->merge($upazila_properties);
        $properties = $all_properties->unique('id');
        $divisions = Division::get(['id','name']);
        $property_category_id = $request->category_id;
        return view('rent-frontend.rent-category', compact('properties','divisions','property_category_id'));
        //  $properties
    }

    public function FilterLocation(Request $request) {
        $request->validate([
            'division_id'=>'required',
            'district_id'=>'required',
            'upazilla_id'=>'required',
        ]);
        $properties = Property::with('multi_images','rooms')->where(['division_id'=>$request->division_id,'district_id'=>$request->district_id,
        'upazilla_id'=>$request->upazilla_id,'status'=>1,'property_category_id'=>$request->property_category_id])->get();
        $divisions = Division::get(['id','name']);
        $property_category_id = $request->property_category_id;
        return view('rent-frontend.filter-property', compact('properties','divisions','property_category_id'));
    }

    public function FilterRoomType(Request $request) {
        $request->validate([
            'share_type'=>'required'
        ]);
        $rooms = Room::with('property')->where('share_type', $request->share_type)->get();
        $divisions = Division::get(['id','name']);
        $property_category_id = $request->property_category_id;
        return view('rent-frontend.filter-room-type', compact('rooms','divisions','property_category_id'));
    }

    public function FilterResident(Request $request) {
        $request->validate([
            'gender'=>'required',
            'resident_type'=>'required',
        ]);
        $divisions = Division::get(['id','name']);
        $properties = Property::with('multi_images','rooms')->where(['gender'=>$request->gender,'resident_type'=>$request->resident_type,'status'=>1,'property_category_id'=>$request->property_category_id])->get();
        $property_category_id = $request->property_category_id;
        return view('rent-frontend.filter-property', compact('properties','divisions','property_category_id'));
    }

    public function ClearFilter($property_category_id) {
        $divisions = Division::get(['id','name']);
        $properties = Property::with('rooms','multi_images')->where(['status'=>1,'property_category_id'=>$property_category_id])->latest()->limit(2)->get();
        return view('rent-frontend.filter-property', compact('properties','divisions','property_category_id'));
    }

    public function PropertyDetails($id) {
        return view('rent-frontend.property-details', [
            'property' => Property::findOrFail($id)
        ]);
    }
}
