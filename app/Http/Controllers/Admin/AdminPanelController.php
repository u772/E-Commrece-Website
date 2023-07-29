<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Brands;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPanelController extends Controller
{
    public function view(){
        $total_user= User::all()->count();
        $total_brands= Brands::all()->count();
        $total_products= Product::all()->count();
        return view('admin.pages.index',compact('total_user','total_products','total_brands'))->with('Welcome','Welcome to the Dashboard');
    }
    public function form_view(){
        return view('admin.pages.form');
    }

    public function allusers(){
        $user=User::all();
        return view('admin.pages.users.list',compact('user'));
    }

    public function removeuser(Request $request,$id){
        $user=User::findOrFail($id);
       

        $user->delete();
        Alert::warning('Deleted', 'Deleted  Successfully');
        return redirect()->back();
      }
   
    // public function  table_view(){
    //     return view('admin.pages.datatable.datatable');
    // }
   

    // public function querry_table(){
    //     return view('admin.pages.datatable.jquerrytable');
    // }
}
