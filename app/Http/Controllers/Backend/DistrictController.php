<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    public function DistrictAll() {
        return view('admin.district.index', [
            'districts' => District::with('division')->orderBy('id','desc')->get()
        ]);
    }
}
