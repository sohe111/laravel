<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Designation;
use Brian2694\Toastr\Facades\Toastr;

class DesignationController extends Controller
{
  public function index()
  {
  	$designations = Designation::all();
  	return view('backend.designation.designation', compact('designations'));
  }
   public function store(Request $request){
        $request->validate([
            'title' => 'required|unique:designations|max:100'
        ]);
        try {
	        $field = new Designation();
	        $field->title = $request->title;
	        $result = $field->save();
	        
	        if($result):
	        	Toastr::success('Oparation Success','Success');
                return redirect()->back();
	        else:
	        	Toastr::error('Operation failed','failed');
	            return redirect()->back();
	        endif;

        } catch (Exception $e) {
        	Toastr::error('Operation failed','failed');
	            return redirect()->back();
        } 
    }
     public function edit($id){
        $designation =  Designation::findOrFail($id);
        $designations = Designation::all();

        return view('backend.designation.designation',compact('designation', 'designations'));
    }
      public function update(Request $request){
        $request->validate([
            'title' =>  'required|max:100|unique:designations,title,'.$request->id
        ]);
        $field =  Designation::findOrFail($request->id);
        $field->title = $request->title;
        $result = $field->save();
        if($result):
            Toastr::success('Oparation Success','Success');
            return redirect('designation');
        else:
            Toastr::error('Operation failed','failed');
            return redirect()->back();
        endif;
    }
      public function delete($id){
        $result = Designation::destroy($id);
        if($result):
        	Toastr::success('Oparation Success','Success');
            return redirect()->back();
        else:
        	Toastr::error('Oparation failed','failed');
            return redirect()->back();
        endif;
    }
}
