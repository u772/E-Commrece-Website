<?php

namespace App\Http\Controllers\CozaStore;

use Stripe;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function view()
    {
        $categories = Categories::all();
        $products = Product::paginate(9); // Display 9 products per page
        $brands = Brands::all();
        $slider = Slider::with('sliderImages')->get();

        return view('cozastore.store.index', compact('slider', 'categories', 'brands', 'products'));
    }




    public function collections_view()
    {
        $category = Categories::all();
        return view('cozastore.store.categories.category', compact('category'));
    }

    public function products($slug)
    {
        $category = Categories::where('slug', $slug)->with('brands')->first();

        if ($category) {
            $products = $category->product()->paginate(12);

            return view('cozastore.store.products.product', compact('products', 'category'));
        } else {
            return redirect()->back();
        }
    }


    //new code to filter products
    // public function products($slug)
    // {
    //     $category = Categories::where('slug', $slug)->with(['brands' => function ($query) use ($slug) {
    //         if (request()->brand) {
    //             $categoryId = Categories::whereSlug($slug)->value('id');
    //             $query->where('slug', request()->brand)->where('category_id', $categoryId);
    //         }
    //     }, 'brands.products'])->first();
    //     // dd($category);
    //     if ($category) {
    //         $products = $category->product;

    //         return view('cozastore.store.products.product', compact('products', 'category'));
    //     } else {
    //         return redirect()->back();
    //     }
    // }



    public function addwishlist($productsitem)
    {
        // dd($productsitem);
        if (Auth::id()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productsitem)->exists()) {
                // Alert::warning('', 'Item already added to wishlist');
                return redirect()->back()->with('warning', 'Item already added to wishlist ');
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productsitem,
                ]);
                // Alert::success('', 'Item added to wishlist');
                return redirect()->back()->with('message', 'Item added to wishlist ');
            }
        } else {
            Alert::warning('', 'Please login first');
            return redirect('login');
        }
    }

    // public function productsview(string $slug, string $product_slug){
    //     $category = Categories::where('slug', $slug)->first();

    //     if ($category) {
    //         $products = $category->product()->where('slug', $product_slug)->first();
    //         if ($products) {
    //             return view('cozastore.store.products.view', compact('products', 'category'));
    //         }else
    //         return redirect()->back();
    //         {

    //         }

    //     } else {
    //         return redirect()->back();
    //     }
    // }

    //     public function productsview(string $slug, string $product_slug)
    // {
    //     $category = Categories::where('slug', $slug)->first();

    //     if ($category) {
    //         $products = $category->product()->where('slug', $product_slug)->first();
    //         if ($products) {
    //             return view('cozastore.store.products.view', compact('products', 'category'));
    //         } else {
    //             return redirect()->back();
    //         }
    //     } else {
    //         return redirect()->back();
    //     }
    // }


    public function productsview($slug, $product_slug)
    {

        $category = Categories::where('slug', $slug)->first();
        if ($category) {


            $product = $category->product()->where('slug', $product_slug)->first();
            if ($product) {


                return view('cozastore.store.products.view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function store(Request $request, $id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::with('productImages')->find($id);

            $existingCart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCart) {
                $existingCart->quantity += $request->input('quantity');
                $cart = $existingCart; // Assign the existing cart to the $cart variable
            } else {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $product->id;
                $cart->quantity = $request->input('quantity');
                $cart->image = $product->productImages->first()->image;
            }

            // Calculate and store the total amount for the cart item
            $cart->total = $cart->quantity * $product->selling_price;
            $cart->save();

            // Decrease the quantity of the product from the products table
            $product->quantity -= $request->input('quantity');
            $product->save();

            // Check if the product is still available
            if ($product->quantity <= 0) {
                Alert::warning('', '');
                return redirect()->back()->with('warning', 'Product is not available.');
            }


            return redirect()->back()->with('message', 'Product added to cart successfully.');
        } else {
            return redirect()->route('user-login')->with('warning', 'Please login first.');
        }
    }

    public function viewCart()
    {
        if (Auth::id()) {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->paginate(5);
            return view('cozastore.store.cart.cart', compact('cart'));
        } else {
            return redirect()->route('user-login');
        }
    }

    public function delete($id)
    {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message', 'Product Deleted  from cart successfully.');
    }




    public function cashOrder()
    {
        $user = Auth::user();
        $userId = $user->id;
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->count() > 0) {
            foreach ($cartItems as $cartItem) {
                $order = new Order();
                $order->email = $user->email;
                $order->name = $cartItem->product->name;
                $order->brand = $cartItem->product->brand;
                $order->selling_price = $cartItem->product->selling_price * $cartItem->quantity;
                $order->quantity = $cartItem->quantity;
                $order->product_id = $cartItem->product_id;
                $order->user_id = $userId;

                $order->payment_status = 'cash on delivery';
                $order->delivery_status = 'processing';

                // Retrieve the image from the product's first image in the productImages relationship
                $image = $cartItem->product->productImages->first()->image;
                $order->image = $image;

                $order->save();

                // Update the quantity in the Product table
                $product = Product::find($cartItem->product_id);
                $product->quantity -= $cartItem->quantity;
                $product->save();


                $cartItem->save();
                $cartItem->delete();
            }

            return redirect()->back()->with('message', 'We have received your order. We will contact you soon.');
        } else {
            return redirect()->back()->with('warning', 'Your cart is empty.');
        }
    }


    public function stripe($total)
    {
        return view('cozastore.store.stripe.stripe', compact('total'));
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalprice * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for payment"
        ]);

        $user = Auth::user();
        $userId = $user->id;
        $cartItems = Cart::where('user_id', '=', $userId)->get();

        if ($cartItems->count() > 0) {
            foreach ($cartItems as $cartItem) {
                $order = new Order();
                $order->email = $user->email;
                $order->name = $cartItem->product->name;
                $order->brand = $cartItem->product->brand;
                $order->selling_price = $cartItem->product->selling_price * $cartItem->quantity;
                $order->quantity = $cartItem->quantity;
                $order->product_id = $cartItem->product_id;
                $order->user_id = $userId;

                $order->payment_status = 'paid';
                $order->delivery_status = 'processing';

                // Retrieve the image from the product's first image in the productImages relationship
                $image = $cartItem->product->productImages->first()->image;
                $order->image = $image;

                $order->save();

                // Update the quantity in the Product table
                $product = Product::find($cartItem->product_id);
                $product->quantity -= $cartItem->quantity;
                $product->save();

                $cartItem->delete();
            }

            return redirect('show_cart')->with('message', 'Payment Successful, You will recieve Your order in 3 days');
        } else {
            return redirect()->back()->with('warning', 'Your cart is empty.');
        }
    }
















    public function blog_view()
    {
        return view('cozastore.store.blog');
    }

    public function about_view()
    {
        return view('cozastore.store.about');
    }
    public function contact_view()
    {
        return view('cozastore.store.contact');
    }
}
