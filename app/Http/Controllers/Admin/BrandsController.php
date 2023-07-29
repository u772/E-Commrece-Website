<?php

namespace App\Http\Controllers\Admin;


use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BrandsController extends Controller
{
    public function view(){
        $category=Categories::get();
    
        return view('admin.pages.brands.create',compact('category'));
    }


    public function show(){
     
        $brand=Brands::all();
        return view('admin.pages.brands.list',compact('brand'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $slug = Str::slug($request->input('name'));
    
        $brand = Brands::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'category_id' => $request->input('category_id'),
        ]);
    
        Alert::success('Added', 'Brand Added Successfully');
        return redirect()->route('brand-list');
    }


      public function delete(Request $request,$id){
        $brands=Brands::findOrFail($id);
       

        $brands->delete();
        Alert::warning('Deleted', 'Deleted  Successfully');
        return redirect()->back();
      }



      public  function edit($id){
        $brand=Brands::findOrFail($id);
        $category=Categories::all();
        return view('admin.pages.brands.edit',compact('brand','category'));

    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $brand = Brands::findOrFail($id);
    
        $slug = Str::slug($request->input('name'));
    
        $brand->update([
            'name' => $request->input('name'),
            'slug' => $slug,
            'category_id' => $request->input('category_id'),
        ]);
    
        Alert::success('Updated', 'Brand Updated Successfully');
        return redirect()->route('brand-list');
    }
    


    

  
}
