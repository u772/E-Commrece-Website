<?php

namespace App\Http\Controllers\CozaStore;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class WishlistController extends Controller
{
    public function view(){

        if(Auth::id()){
            $id=Auth::user()->id;
        $wishlist=Wishlist::where('user_id',auth()->user()->id)->get();
        return view('cozastore.store.wishlist.wishlist',[
            'wishlist'=>$wishlist
        ]);

    }
    else{
        return redirect('login');
      }
    }


    public function delete($id){
       Wishlist::where('user_id',auth()->user()->id)->where('id',$id)->delete();
      
       return redirect()->back()->with('message', 'Item Removed from wishlist ');
    }
}
