<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SliderImage;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function view(){
        return view('admin.pages.slider.create');
    }

    
   public function show(){
    $slider=Slider::with('sliderImages')->get();
    return view('admin.pages.slider.list',compact('slider'));
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'heading' => 'required|string',
            'image' => 'nullable',
           
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
    
    
        $slider = Slider::create([
            'title' => $request->input('title'),
            'heading' => $request->input('heading'),
          
        
        ]);
    
        if ($request->hasFile('image')) {
            $uploadPath = 'uploads/slider/';
            $i = 1;
    
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;
    
                $slider->sliderImages()->create([
                    'slider_id' => $slider->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
    
        Alert::success('Added', 'Data Added Successfully');
        return redirect()->route('slider-list');
    }


    public function delete(Request $request, $id){
        
        $slideritem=slider::findOrFail($id);
       
        if($slideritem->sliderImages){
            foreach($slideritem->sliderImages as $image){
                if(File::exists($image->image)){
                    File::delete($image->image);
                 }
            }
            $slideritem->delete();
            Alert::warning('Deleted', 'Deleted  Successfully');
             return redirect()->back();
            
        }
    
      }

      public function edit( $id){
        $slider=Slider::findOrFail($id);
        return view('admin.pages.slider.edit',compact('slider'));
    
     }


     public function update(Request $request, $id)
     {
          $validator = Validator::make($request->all(), [
             'title' => 'required|string',
             'heading' => 'required|string',
             'image' => 'nullable',
            
         ]);
     
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
     
         $slider = Slider::findOrFail($id);
     
     
     
         $slider->update([
            
             'title' => $request->input('title'),
             'heading' => $request->input('heading'),
         ]);
     
         if ($request->hasFile('image')) {
            $uploadPath = 'uploads/slider/';
            $i = 1;
    
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;
    
                $slider->sliderImages()->create([
                    'slider_id' => $slider->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
    
        Alert::success('Added', 'Data Added Successfully');
        return redirect()->route('slider-list');
     }


     public function destroyimage(Request $request, $id){
        $sliderImages=SliderImage::findOrFail($id);
         if(File::exists($sliderImages->image)){
            File::delete($sliderImages->image);
         }
         $sliderImages->delete();
         Alert::warning('Removed', ' Image Removed   Successfully');
         return redirect()->back();
    
      }
}
