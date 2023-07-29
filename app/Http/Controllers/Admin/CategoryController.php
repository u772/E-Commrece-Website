<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class CategoryController extends Controller
{
    public function view(){
        return view('admin.pages.category.create');
    }

    public function show(){
        $category=Categories::all();
        return view('admin.pages.category.list',compact('category'));
    }

   

    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tittle' => 'required|string',
            'description' => 'nullable',
            'image' => 'required|mimes:jpg,jpeg,png',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $slug = Str::slug($request->input('tittle'));
    
        $category = Categories::create([
            'tittle' => $request->input('tittle'),
            'description' => $request->input('description'),
            'slug' => $slug,
            'meta_title' => $request->input('meta_title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
        ]);
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
    
            $file->move('uploads/category/', $filename);
    
            $category->image = $filename;
            $category->save();
        }
    
        Alert::success('Added', 'Data Added Successfully');
        return redirect('list');
    }
    

    public function destroy(Request $request,$id)
    {
        $del= $request->id;
        $catagory = Categories::find($del);
        $path='uploads/catagory/'.$catagory->image;
        if(File::exists($path)){
          File::delete($path);
        }
        $catagory->delete();
        Alert::warning('Deleted', 'Deleted  Successfully');
        return redirect()->back();
    }


    public function edit($id){
        $category=Categories::find($id);
        return view('admin.pages.category.edit',compact('category'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tittle' => 'required|string',
            'description' => 'nullable',
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'meta_title' => 'required|string',
            'meta_keyword' => 'required|string',
            'meta_description' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $category = Categories::findOrFail($id);
    
        $slug = Str::slug($request->input('tittle'));
    
        $category->tittle = $request->input('tittle');
        $category->description = $request->input('description');
        $category->slug = $slug;
        $category->meta_title = $request->input('meta_title');
        $category->meta_keyword = $request->input('meta_keyword');
        $category->meta_description = $request->input('meta_description');
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
    
            $file->move('uploads/category/', $filename);
    
            // Delete the previous image file if it exists
            if (!empty($category->image)) {
                $oldImagePath = 'uploads/category/' . $category->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            $category->image = $filename;
        }
    
        $category->save();
    
        Alert::success('Updated', 'Data Updated Successfully');
        return redirect('list');
    }
    
    
}
    


