<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{PropertyCategory, Property};
use App\Http\Traits\NormalImageUpload;
use App\Helpers\Toastr;

class PropertyCategoryController extends Controller
{
    use NormalImageUpload;

    public function PropertyCategoryAll() {
        return view('backend.property-category.index', [
            'property_categories' => PropertyCategory::all()
        ]);
    }

    public function PropertyCategoryCreate() {
        return view('backend.property-category.create');
    }

    public function PropertyCategoryStore(Request $request) {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'category_photo' => 'required|image|mimes:jpeg,png,jpg,svg,webp,gif',
        ]);
        $data = $request->all();
        $data['category_photo'] = $this->uploadImage($request, 'category_photo', 'category_photo-', 'category-photo');
        PropertyCategory::create($data);
        Toastr::success('Category Created Successfully.');
        return redirect()->route('admin.property-category.index');
    }

    public function PropertyCategoryEdit($id) {
        return view('backend.property-category.edit', [
            'property_category' => PropertyCategory::findOrFail($id)
        ]);
    }

    public function PropertyCategoryUpdate(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_photo' => 'nullable|image|mimes:jpeg,png,jpg,svg,webp,gif',
        ]);
        $property_category = PropertyCategory::findOrFail($id);
        $data = $request->all();
        if($request->hasFile('category_photo')){
            $data['category_photo'] = $this->updateImage($request, $property_category->category_photo, 'category_photo', 'category_photo-', 'category-photo');
        }
        else{
            $data['category_photo'] = $property_category->category_photo;
        }
        $property_category->update($data);
        Toastr::success('Category Updated Successfully.');
        return redirect()->route('admin.property-category.index');
    }

    public function PropertyCategoryDelete($id) {
        $property_category = PropertyCategory::findOrFail($id);
        $hasItem = Property::where('property_category_id', $property_category->id)->count();
        if ($hasItem == 0) {
            $this->deleteImage($property_category->category_photo);
            $property_category->delete();
            return true;
        }
        return response(['status'=>'error']);
    }
}
