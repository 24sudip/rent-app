<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\NormalImageUpload;
use App\Helpers\Toastr;
use App\Models\WhatYouItem;

class WhatYouController extends Controller
{
    use NormalImageUpload;

    public function WhatYouAll() {
        return view('backend.what-you-item.index', [
            'what_you_items'=>WhatYouItem::latest()->get()
        ]);
    }

    public function WhatYouCreate() {
        return view('backend.what-you-item.create');
    }

    public function WhatYouStore(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,svg,webp,gif',
        ]);
        $data = $request->all();
        $data['photo'] = $this->uploadImage($request, 'photo', 'what_you-', 'what-you');
        WhatYouItem::create($data);
        Toastr::success('WhatYou Item Created Successfully.');
        return redirect()->route('admin.what-you-item.index');
    }

    public function WhatYouEdit($id) {
        return view('backend.what-you-item.edit', [
            'what_you_item'=>WhatYouItem::findOrFail($id)
        ]);
    }

    public function WhatYouUpdate(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,svg,webp,gif',
        ]);
        $data = $request->all();
        $what_you_item = WhatYouItem::find($id);
        if($request->hasFile('photo')){
            $data['photo'] = $this->updateImage($request, $what_you_item->photo, 'photo', 'what_you-', 'what-you');
        }
        else{
            $data['photo'] = $what_you_item->photo;
        }
        $what_you_item->update($data);
        Toastr::success('WhatYou Item Updated Successfully.');
        return redirect()->route('admin.what-you-item.index');
    }

    public function WhatYouDelete($id) {
        $what_you_item = WhatYouItem::find($id);
        $this->deleteImage($what_you_item->photo);
        $what_you_item->delete();
        return true;
    }
}
