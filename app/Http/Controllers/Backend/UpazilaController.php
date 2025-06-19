<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Upazila;

class UpazilaController extends Controller
{
    public function UpazilaAll() {
        return view('admin.upazila.index', [
            'upazilas'=>Upazila::with('district')->orderBy('id','ASC')->get()
        ]);
    }

    public function UpazilaCreate() {
        return view('admin.upazila.create');
    }
}
