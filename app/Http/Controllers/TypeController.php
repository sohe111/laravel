<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use Brian2694\Toastr\Facades\Toastr;

class TypeController extends Controller
{
    public function index()
    {
    	 $types = Type::all();
    	return view('backend.type.type',compact('types'));
    }
       public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:types|max:100'
        ]);
        try{
            $type = new Type();
            $type->name = $request->name;
            $result = $type->save();
            if($result):
                Toastr::success('Oparation Success','Success');
                return redirect()->back();
	        else:
	        	Toastr::error('Operation failed','failed');
	            return redirect()->back();
            endif;  
        }
        catch(exception $e){
            Toastr::error('Operation failed','failed');
	            return redirect()->back();
        }
    }
     public function edit($id){
        $type = Type::findOrFail($id);
        $types = Type::all();
        return view('backend.type.type',compact('types','type'));
    }
      public function update(Request $request){
        $request->validate([
            'name' => 'required|unique:types|max:100'
        ]);
        try{
            $type = new Type();
            $type->name = $request->name;
            $result = $type->save();
            if($result):
                Toastr::success('Oparation Success','Success');
                return redirect()->back();
	        else:
	        	Toastr::error('Operation failed','failed');
	            return redirect()->back();
            endif;  
        }
        catch(exception $e){
            Toastr::error('Operation failed','failed');
	            return redirect()->back();
        }
    }
      public function delete($id){
        $result = Type::Destroy($id);
        if($result):
            Toastr::success('Oparation Success','Success');
            return redirect()->back();
        else:
            Toastr::error('Operation failed','failed');
            return redirect()->back();
        endif;  
    }
}
