<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatYouSetting;
use Illuminate\Support\Facades\File;
use App\Helpers\Toastr;

class SettingController extends Controller
{
    public function WhatYouSetting() {
        return view('backend.what-you-setting.edit', [
            'what_you_setting'=>WhatYouSetting::first()
        ]);
    }

    public function WhatYouSettingUp(Request $request, $id) {
        $request->validate([
            'title'=>'required|string|max:255',
            'sub_title'=>'required|string|max:255',
            'video'=>'nullable|mimes:mp4,webm'
        ]);
        $what_you_setting = WhatYouSetting::first();
        if ($request->hasFile('video')) {
            if ($what_you_setting && File::exists(public_path($what_you_setting->video))) {
                File::delete(public_path($what_you_setting->video));
            }
            $image = $request->file('video');
            $imageName = rand().$image->getClientOriginalName();
            $image->move(public_path('/uploads/what-you-setting'), $imageName);
            $imagePath = "/uploads/what-you-setting/". $imageName;
        }
        WhatYouSetting::updateOrCreate(
            ['id'=>$id],
            [
                'title'=>$request->title,
                'sub_title'=>$request->sub_title,
                'video'=>isset($imagePath) ? $imagePath : $what_you_setting->video,
            ]
        );
        Toastr::success('WhatYou Setting Uploaded Successfully.');
        return redirect()->back();
    }
}
