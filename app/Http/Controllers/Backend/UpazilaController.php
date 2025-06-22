<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Upazila, District};
use App\Helpers\Toastr;

class UpazilaController extends Controller
{
    public function UpazilaAll() {
        return view('admin.upazila.index', [
            'upazilas'=>Upazila::with('district')->orderBy('id','DESC')->get()
        ]);
    }

    public function UpazilaCreate() {
        return view('admin.upazila.create', [
            'districts' => District::orderBy('name','asc')->get(['id','name'])
        ]);
    }

    public function UpazilaStore(Request $request) {
        // dd($request->all());
        $fields = $request->validate([
            'district_id'=>'required|numeric',
            'name'=>'required|string|max:25',
            'bn_name'=>'required|string|max:25',
            'url'=>'nullable|string|max:50'
        ]);
        Upazila::create($fields);
        Toastr::success('Upazila Created Successfully.');
        return redirect()->route('admin.upazila.index');
    }

    public function UpazilaEdit($id) {
        return view('admin.upazila.edit', [
            'upazila'=>Upazila::findOrFail($id),
            'districts' => District::orderBy('name','asc')->get(['id','name'])
        ]);
    }

    public function UpazilaUpdate(Request $request, $id) {
        $fields = $request->validate([
            'district_id'=>'required|numeric',
            'name'=>'required|string|max:25',
            'bn_name'=>'required|string|max:25',
            'url'=>'nullable|string|max:50'
        ]);
        Upazila::find($id)->update($fields);
        Toastr::success('Upazila Updated Successfully.');
        return redirect()->route('admin.upazila.index');
    }
}
