<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brands;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CozaProductsController extends Controller
{
    public function view(){
        $category=Categories::all();
        $brand=Brands::all();
        return view('admin.pages.product.create',compact('category','brand'));
   }

   public function show(){
    $products=Product::with('productImages')->get();
    return view('admin.pages.product.list',compact('products'));
}


   public function store(ProductRequest $request)
   {
       $validatedData = $request->validated();
       $category = Categories::findOrFail($validatedData['category_id']);
   
       $product = $category->product()->create([
           'category_id' => $validatedData['category_id'],
           'name' => $validatedData['name'],
           'slug' => Str::slug($validatedData['name']), // Generate slug from name
           'brand' => $validatedData['brand'],
           'small_description' => $validatedData['small_description'],
           'description' => $validatedData['description'],
           'original_price' => $validatedData['original_price'],
           'selling_price' => $validatedData['selling_price'],
           'quantity' => $validatedData['quantity'],
           'meta_title' => $validatedData['meta_title'],
           'meta_keyword' => $validatedData['meta_keyword'],
           'meta_description' => $validatedData['meta_description'],
       ]);
   
       if ($request->hasFile('image')) {
           $uploadPath = 'uploads/products/';
           $i = 1;
   
           foreach ($request->file('image') as $imageFile) {
               $extension = $imageFile->getClientOriginalExtension();
               $filename = time() . $i++ . '.' . $extension;
               $imageFile->move($uploadPath, $filename);
               $finalImagePathName = $uploadPath . $filename;
   
               $product->productImages()->create([
                   'product_id' => $product->id,
                   'image' => $finalImagePathName,
               ]);
           }
       }
   
    //    if ($request->colors) {
    //        foreach ($request->colors as $key => $color) {
    //            $product->productColors()->create([
    //                'product_id' => $product->id,
    //                'color_id' => $color,
    //                'quantity' => $request->colorquantity[$key],
    //            ]);
    //        }
    //    }
   
       Alert::success('ADDED', 'Product Added Successfully');
       return redirect()->route('product-list');
   }

   
   public function destroy(Request $request, $id){
        
    $products=Product::findOrFail($id);
   
    if($products->productImages){
        foreach($products->productImages as $image){
            if(File::exists($image->image)){
                File::delete($image->image);
             }
        }
        $products->delete();
        Alert::warning('Deleted', 'Deleted  Successfully');
         return redirect()->back();
        
    }

  }


  public function edit( $id){
    $category=Categories::all();
    $brand=Brands::all();
    $product=Product::findOrFail($id);
    return view('admin.pages.product.edit',compact('category','brand','product',));

 }

 
 public function update(ProductRequest $request, $id)
{
   
    $validatedData = $request->validated();
    $product = Product::findOrFail($id);

    $category = Categories::findOrFail($validatedData['category_id']);

    $product->update([
        'category_id' => $validatedData['category_id'],
        'name' => $validatedData['name'],
        'slug' => Str::slug($validatedData['name']),
        'brand' => $validatedData['brand'],
        'small_description' => $validatedData['small_description'],
        'description' => $validatedData['description'],
        'original_price' => $validatedData['original_price'],
        'selling_price' => $validatedData['selling_price'],
        'quantity' => $validatedData['quantity'],
        'meta_title' => $validatedData['meta_title'],
        'meta_keyword' => $validatedData['meta_keyword'],
        'meta_description' => $validatedData['meta_description'],
    ]);

   

    if ($request->hasFile('image')) {
        $uploadPath = 'uploads/products/';
        $i = 1;

        foreach ($request->file('image') as $imageFile) {
            $extension = $imageFile->getClientOriginalExtension();
            $filename = time() . $i++ . '.' . $extension;
            $imageFile->move($uploadPath, $filename);
            $finalImagePathName = $uploadPath . $filename;

            $product->productImages()->create([
                'product_id' => $product->id,
                'image' => $finalImagePathName,
            ]);
        }
    }

    // Update the colors and quantities if needed
    // if ($request->colors) {
    //     $product->productColors()->delete(); // Remove existing colors (optional)

    //     foreach ($request->colors as $key => $color) {
    //         $product->productColors()->create([
    //             'product_id' => $product->id,
    //             'color_id' => $color,
    //             'quantity' => $request->colorquantity[$key],
    //         ]);
    //     }
    // }

    Alert::success('UPDATED', 'Product Updated Successfully');
    return redirect()->route('product-list');
}


 public function destroyimage(Request $request, $id){
    $productimage=ProductImages::findOrFail($id);
     if(File::exists($productimage->image)){
        File::delete($productimage->image);
     }
     $productimage->delete();
     Alert::warning('Removed', ' Image Removed   Successfully');
     return redirect()->back();

  }
}
