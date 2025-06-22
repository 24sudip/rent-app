<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\{District, Upazila, Property, Room, Amenity, RentPackage, RentTerm, PropertyRule, MultiImage, PackageOrder};
use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Support\Facades\{Auth, File};
use PHPUnit\Framework\Constraint\Count;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function PropertyAll()
    {
        return view('backend.property.index', [
            'properties' => Property::with(['upazila','district','rooms'])->where('user_id', Auth::id())->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function PropertyCreate()
    {
        $package_order = PackageOrder::where('user_id', Auth::id())->first();
        if (!$package_order) {
            $notification = array(
                'message' => 'Please Subscribe A Free Package First',
                'alert-type' => 'error'
            );
            return redirect()->route('manager.buy.package')->with($notification);
        } elseif($package_order->expired_at < now()) {
            $notification = array(
                'message' => 'Your Subscribtion Has Already Expired',
                'alert-type' => 'error'
            );
            return redirect()->route('manager.buy.package')->with($notification);
        }
        $total_property = Property::where('user_id', Auth::id())->count();
        if ($total_property == $package_order->total_post) {
            $notification = array(
                'message' => 'You Have Already Reached Maximum Limit',
                'alert-type' => 'error'
            );
            return redirect()->route('manager.buy.package')->with($notification);
        }
        if ($package_order->status == 0) {
            $notification = array(
                'message' => 'Current Package Has Not Been Confirmed By Admin Yet',
                'alert-type' => 'error'
            );
            return redirect()->route('manager.buy.package')->with($notification);
        }
        return view('backend.property.create', [
            'divisions' => Division::get(['id','name'])
        ]);
    }

    public function GetUpazilla($district_id) {
        $upazilla = Upazila::where('district_id', $district_id)->orderBy('name','ASC')->get();
        return json_encode($upazilla);
    }

    public function GetDistrict($division_id) {
        $district = District::where('division_id', $division_id)->orderBy('name','ASC')->get();
        return json_encode($district);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function PropertyStore(Request $request)
    {
        $request->validate([
            'package_names.*'=>'required',
            'package_prices.*'=>'required',
            'term_names.*'=>'required',
            'term_descriptions.*'=>'required',
            'rules.*'=>'required',
            'title' => 'required|string|max:255',
            'about_property' => 'required',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'upazilla_id' => 'required|numeric',
            'gender'=>'required',
            'resident_type'=>'required',
            'address'=>'required',
            'map_embed_code'=>'required',
            'owner_name' => 'required|string|max:255',
            'about_owner' => 'required',
            'multi_img' => 'required|array',
            'multi_img.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'package_names.*.required'=>'Each Package Name field is required',
            'package_prices.*.required'=>'Each Package Price field is required',
            'term_names.*.required'=>'Each term-name field is required',
            'term_descriptions.*.required'=>'Each term-description field is required',
            'rules.*.required'=>'Each rule field is required'
        ]);
        $property = Property::create([
            'title' => $request->title,
            'about_property' => $request->about_property,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazilla_id' => $request->upazilla_id,
            'gender'=>$request->gender,
            'resident_type'=>$request->resident_type,
            'address'=>$request->address,
            'map_embed_code'=>$request->map_embed_code,
            'owner_name' => $request->owner_name,
            'about_owner' => $request->about_owner,
            'user_id' => Auth::id(),
            'property_category_id' => Auth::user()->property_category_id
        ]);
        // single sharing
        if ($request->single && $request->single_price && $request->single_tenant) {
            Room::create([
                'property_id' => $property->id,
                'share_type' => 'single',
                'price' => $request->single_price,
                'tenant' => $request->single_tenant
            ]);
        }
        // double sharing
        if ($request->double && $request->double_price && $request->double_tenant) {
            Room::create([
                'property_id' => $property->id,
                'share_type' => 'double',
                'price' => $request->double_price,
                'tenant' => $request->double_tenant
            ]);
        }
        // triple sharing
        if ($request->triple && $request->triple_price && $request->triple_tenant) {
            Room::create([
                'property_id' => $property->id,
                'share_type' => 'triple',
                'price' => $request->triple_price,
                'tenant' => $request->triple_tenant
            ]);
        }
        // common amenity
        $commons = Count($request->commons);
        if ($request->common_check) {
            if ($commons != NULL) {
                for ($i=0; $i < $commons; $i++) {
                    $common_item = new Amenity();
                    $common_item->property_id = $property->id;
                    $common_item->amenity_type = $request->common_check;
                    $common_item->amenity_name = $request->commons[$i];
                    $common_item->save();
                }
            }
        }
        // room amenity
        $rooms = Count($request->rooms);
        if ($request->room_check) {
            if ($rooms != NULL) {
                for ($i=0; $i < $rooms; $i++) {
                    $room_item = new Amenity();
                    $room_item->property_id = $property->id;
                    $room_item->amenity_type = $request->room_check;
                    $room_item->amenity_name = $request->rooms[$i];
                    $room_item->save();
                }
            }
        }
        // service amenity
        $services = Count($request->services);
        if ($request->service_check) {
            if ($services != NULL) {
                for ($i=0; $i < $services; $i++) {
                    $service_item = new Amenity();
                    $service_item->property_id = $property->id;
                    $service_item->amenity_type = $request->service_check;
                    $service_item->amenity_name = $request->services[$i];
                    $service_item->save();
                }
            }
        }
        // rent package
        $package_names = Count($request->package_names);
        // if ($package_names != NULL) {
        // }
        for ($i=0; $i < $package_names; $i++) {
            $rent_package = new RentPackage();
            $rent_package->property_id = $property->id;
            $rent_package->name = $request->package_names[$i];
            $rent_package->price = $request->package_prices[$i];
            $rent_package->save();
        }
        // rent term
        $term_names = Count($request->term_names);
        // if ($term_names != NULL) {
        // }
        for ($i=0; $i < $term_names; $i++) {
            $rent_term = new RentTerm();
            $rent_term->property_id = $property->id;
            $rent_term->name = $request->term_names[$i];
            $rent_term->description = $request->term_descriptions[$i];
            $rent_term->save();
        }
        // property rule
        $rules = Count($request->rules);
        // if ($rules != NULL) {
        // }
        for ($i=0; $i < $rules; $i++) {
            $property_rule = new PropertyRule();
            $property_rule->property_id = $property->id;
            $property_rule->rule_name = $request->rules[$i];
            $property_rule->save();
        }
        // Multi Image
        $images = $request->file('multi_img');
        foreach ($images as $image) {
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads/property-photo'), $imageName);
            $imagePath = "/uploads/property-photo/". $imageName;
            MultiImage::create([
                'property_id' => $property->id,
                'photo_name' => isset($imagePath) ? $imagePath : null,
            ]);
        }

        $notification = array(
            'message' => 'Property Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function PropertyShow($id)
    {
        return view('backend.property.show', [
            'property' => Property::findOrFail($id),
            'commons' => Amenity::where(['property_id'=>$id,'amenity_type'=>'common'])->get(),
            'rooms' => Amenity::where(['property_id'=>$id,'amenity_type'=>'room'])->get(),
            'services' => Amenity::where(['property_id'=>$id,'amenity_type'=>'service'])->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function PropertyEdit($id)
    {
        return view('backend.property.edit', [
            'divisions' => Division::get(['id','name']),
            'single' => Room::where(['property_id'=>$id,'share_type'=>'single'])->first(),
            'double' => Room::where(['property_id'=>$id,'share_type'=>'double'])->first(),
            'triple' => Room::where(['property_id'=>$id,'share_type'=>'triple'])->first(),
            'property' => Property::findOrFail($id),
            'commons' => Amenity::where(['property_id'=>$id,'amenity_type'=>'common'])->get(),
            'rooms' => Amenity::where(['property_id'=>$id,'amenity_type'=>'room'])->get(),
            'services' => Amenity::where(['property_id'=>$id,'amenity_type'=>'service'])->get(),
        ]);
    }

    public function RoomUpdate(Request $request, $property_id) {
        if ($request->single_price && $request->single_tenant) {
            $single = Room::where(['property_id'=>$property_id,'share_type'=>'single'])->first();
            if ($single) {
                $single->update([
                    'price'=>$request->single_price,
                    'tenant'=>$request->single_tenant
                ]);
            } else {
                Room::create([
                    'property_id' => $property_id,
                    'share_type' => 'single',
                    'price' => $request->single_price,
                    'tenant' => $request->single_tenant
                ]);
            }
        }
        if ($request->double_price && $request->double_tenant) {
            $double = Room::where(['property_id'=>$property_id,'share_type'=>'double'])->first();
            if ($double) {
                $double->update([
                    'price'=>$request->double_price,
                    'tenant'=>$request->double_tenant
                ]);
            } else {
                Room::create([
                    'property_id' => $property_id,
                    'share_type' => 'double',
                    'price'=>$request->double_price,
                    'tenant'=>$request->double_tenant
                ]);
            }
        }
        if ($request->triple_price && $request->triple_tenant) {
            $triple = Room::where(['property_id'=>$property_id,'share_type'=>'triple'])->first();
            if ($triple) {
                $triple->update([
                    'price'=>$request->triple_price,
                    'tenant'=>$request->triple_tenant
                ]);
            } else {
                Room::create([
                    'property_id' => $property_id,
                    'share_type' => 'triple',
                    'price'=>$request->triple_price,
                    'tenant'=>$request->triple_tenant
                ]);
            }
        }
        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    public function CommonUpdate(Request $request, $property_id) {
        $request->validate([
            'commons.*'=>'required|string|max:255'
        ],[
            'commons.*.required' => 'Each common-amenity field is required.',
            'commons.*.string' => 'Each common-amenity must be a valid string.',
            'commons.*.max' => 'Each common-amenity must not exceed 255 characters.',
        ]);
        Amenity::where(['property_id'=>$property_id,'amenity_type'=>'common'])->delete();
        $commons = Count($request->commons);
        for ($i=0; $i < $commons; $i++) {
            $common_item = new Amenity();
            $common_item->property_id = $property_id;
            $common_item->amenity_type = 'common';
            $common_item->amenity_name = $request->commons[$i];
            $common_item->save();
        }
        $notification = array(
            'message' => 'Common Amenity Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    public function AmenityUpdate(Request $request, $property_id) {
        $request->validate([
            'rooms.*'=>'required'
        ],[
            'rooms.*.required'=>'Each room-amenity field is required'
        ]);
        Amenity::where(['property_id'=>$property_id,'amenity_type'=>'room'])->delete();
        $rooms = Count($request->rooms);
        for ($i=0; $i < $rooms; $i++) {
            $room_item = new Amenity();
            $room_item->property_id = $property_id;
            $room_item->amenity_type = 'room';
            $room_item->amenity_name = $request->rooms[$i];
            $room_item->save();
        }
        $notification = array(
            'message' => 'Room Amenity Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    public function ServiceUpdate(Request $request, $property_id) {
        $request->validate([
            'services.*'=>'required'
        ],[
            'services.*.required'=>'Each service-amenity field is required'
        ]);
        Amenity::where(['property_id'=>$property_id,'amenity_type'=>'service'])->delete();
        $services = Count($request->services);
        for ($i=0; $i < $services; $i++) {
            $service_item = new Amenity();
            $service_item->property_id = $property_id;
            $service_item->amenity_type = 'service';
            $service_item->amenity_name = $request->services[$i];
            $service_item->save();
        }
        $notification = array(
            'message' => 'Service Amenity Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    public function RentPackagesUpdate(Request $request, $property_id) {
        $request->validate([
            'package_names.*'=>'required',
            'package_prices.*'=>'required'
        ],[
            'package_names.*.required'=>'Each Package Name field is required',
            'package_prices.*.required'=>'Each Package Price field is required'
        ]);
        RentPackage::where('property_id', $property_id)->delete();
        $package_names = Count($request->package_names);
        for ($i=0; $i < $package_names; $i++) {
            $rent_package = new RentPackage();
            $rent_package->property_id = $property_id;
            $rent_package->name = $request->package_names[$i];
            $rent_package->price = $request->package_prices[$i];
            $rent_package->save();
        }
        $notification = array(
            'message' => 'Rent Package Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    public function RentTermUpdate(Request $request, $property_id) {
        $request->validate([
            'term_names.*'=>'required',
            'term_descriptions.*'=>'required'
        ],[
            'term_names.*.required'=>'Each term-name field is required',
            'term_descriptions.*.required'=>'Each term-description field is required'
        ]);
        RentTerm::where('property_id', $property_id)->delete();
        $term_names = Count($request->term_names);
        for ($i=0; $i < $term_names; $i++) {
            $rent_term = new RentTerm();
            $rent_term->property_id = $property_id;
            $rent_term->name = $request->term_names[$i];
            $rent_term->description = $request->term_descriptions[$i];
            $rent_term->save();
        }
        $notification = array(
            'message' => 'Rent Term Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    public function PropertyRulesUpdate(Request $request, $property_id) {
        $request->validate([
            'rules.*'=>'required'
        ],[
            'rules.*.required'=>'Each rule field is required'
        ]);
        PropertyRule::where('property_id', $property_id)->delete();
        $rules = Count($request->rules);
        for ($i=0; $i < $rules; $i++) {
            $property_rule = new PropertyRule();
            $property_rule->property_id = $property_id;
            $property_rule->rule_name = $request->rules[$i];
            $property_rule->save();
        }
        $notification = array(
            'message' => 'Property Rule Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }
    /**
     * Update the specified resource in storage.
     */
    public function PropertyUpdate(Request $request, $id)
    {
        $fields = $request->validate([
            'title' => 'required|string|max:255',
            'about_property' => 'required|string|max:255',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'upazilla_id' => 'required|numeric',
            'gender'=>'required',
            'resident_type'=>'required',
            'address'=>'required',
            'map_embed_code'=>'required',
            'owner_name' => 'required|string|max:255',
            'about_owner' => 'required|string|max:255',
        ]);
        Property::find($id)->update($fields);
        $notification = array(
            'message' => 'Property Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.property.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function PropertyDelete($id)
    {
        $multi_images = MultiImage::where('property_id', $id)->get();
        foreach ($multi_images as $image) {
            if (File::exists(public_path($image->photo_name))) {
                File::delete(public_path($image->photo_name));
            }
        }
        MultiImage::where('property_id', $id)->delete();
        Room::where('property_id', $id)->delete();
        Amenity::where('property_id', $id)->delete();
        RentPackage::where('property_id', $id)->delete();
        RentTerm::where('property_id', $id)->delete();
        PropertyRule::where('property_id', $id)->delete();
        Property::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Property Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
