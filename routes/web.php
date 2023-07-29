<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\CozaStore\CartController;
use App\Http\Controllers\CozaStore\HomeController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\CozaProductsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CozaStore\ProductsController;
use App\Http\Controllers\CozaStore\WishlistController;
use App\Http\Controllers\Authentication\LoginContoller;
use App\Http\Controllers\CozaStore\Auth\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\CozaStore\Auth\SignUpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// cache clear Routes
Route::get('/clear-cache', function () {
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    Artisan::call('cache:clear');

    return "Cache cleared successfully.";
});

//Login Route

Route::controller(LoginContoller::class)->group(function () {
    Route::get('/admin/login', 'adminLogin_view')->name('adminlogin.view');
    Route::post('/admin/login', 'adminAuthenticate')->name('admin.login');
});
Route::controller(LogoutController::class)->group(function () {
    Route::get('/admin/logout', 'adminlogout')->name('logout');
});


//Admin Routes
Route::middleware(['auth', 'redirect.only.admins'])->group(function () {
    Route::controller(AdminPanelController::class)->group(function () {
        Route::get('dashboard', 'view')->name('dashboard');
        Route::get('/form', 'form_view')->name('form');
        Route::get('/users', 'allusers')->name('users');
        Route::get('remove/{id}', 'removeuser')->name('remove');
        // Route::get('/data_table', 'table_view')->name('table');
        // Route::get('/jquery_table', 'querry_table')->name('jquerytable');
    });



    //Category Routes 
    //    Route::prefix('category')->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('create', 'view')->name('create');
        Route::post('/store', 'store')->name('store.category');
        Route::get('/list', 'show')->name('list');
        Route::get('delete/{id}', 'destroy')->name('delete');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::put('update/{id}', 'update')->name('update');
    });

    // });
    //Brand Routes
    Route::prefix('brand')->as('brand-')->group(function () {
        Route::controller(BrandsController::class)->group(function () {
            Route::get('/create', 'view')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/list', 'show')->name('list');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('edit/{id}', 'edit')->name('edit');
            Route::put('update/{id}', 'update')->name('update');
        });
    });
    //Products Routes

    Route::prefix('product')->as('product-')->group(function () {
        Route::controller(CozaProductsController::class)->group(function () {
            Route::get('/create', 'view')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/list', 'show')->name('list');
            Route::get('delete/{id}', 'destroy')->name('delete');
            Route::get('edit/{id}', 'edit')->name('edit');
            // Route::put('update/{id}', 'update')->name('update');
            Route::get('delete_image/{id}', 'destroyimage')->name('delete_image');
        });
    });

    Route::put('product-update/{id}', [CozaProductsController::class, 'update'])->name('product-update');

    //Slider Routes
    Route::prefix('slider')->as('slider-')->group(function () {
        Route::controller(SliderController::class)->group(function () {
            Route::get('/create', 'view')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/list', 'show')->name('list');
            Route::get('delete/{id}', 'delete')->name('delete');
            Route::get('edit/{id}', 'edit')->name('edit');
            // Route::put('update/{id}', 'update')->name('update');
            Route::get('delete_image/{id}', 'destroyimage')->name('delete_image');
        });
    });

    Route::put('slider-update/{id}', [SliderController::class, 'update'])->name('slider-update');

    Route::prefix('order')->as('order-')->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::get('/list', 'show')->name('list');
            Route::get('delivered/{id}','delivered')->name('delivered');
        }); 
    });
});

Route::prefix('user')->as('user-')->group(function () {
    Route::controller(SignUpController::class)->group(function () {
        Route::get('/signup', 'view')->name('signup');
        Route::post('/register', 'store')->name('register');
    });
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'userLogin')->name('login');
        Route::post('/login', 'userAuthenticate')->name('login');
    });
    Route::controller(LogoutController::class)->group(function () {
        Route::get('/logout', 'userLogout')->name('logout');
    });



     

    
});






//Frontend Routes
Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'view')->name('home');
    Route::get('/blog', 'blog_view')->name('blog');
    Route::get('/about_us', 'about_view')->name('about');
    Route::get('/contact', 'contact_view')->name('contact');
    Route::get('/collections', 'collections_view')->name('collections');
    // Route::get('/collections{slug}', 'products');

    //add product to wishlist
    Route::get('add_wishlist/{id}','addwishlist')->name('add_wishlist');
    Route::post('add_cart/{id}','store')->name('add_cart');
    Route::get('show_cart','viewCart')->name('show_cart');
    Route::get('delete_cart/{id}','delete')->name('delete_cart');

    Route::get('cash_order','cashorder')->name('cash_order');
    
    Route::get('/stripe/{total}','stripe');
    Route::post('stripe/{totalprice}', 'stripePost')->name('stripe.post');
});


Route::get('/collections/{slug}', [HomeController::class, 'products']);
Route::get('/collections/{slug}/{product_slug}', [HomeController::class, 'productsview']);
// Route::controller(ProductsController::class)->group(function () {
//     Route::get('/our_products', 'view')->name('product');
// });
// Route::controller(CartController::class)->group(function () {
//     Route::get('/shoping_cart', 'view')->name('cart');
// });


//wishlistcontroller routes
Route::controller(WishlistController::class)->group(function () {
    Route::get('wishlist','view')->name('wishlist');
    Route::get('delete_wishlist/{id}','delete')->name('delete_wishlist');
});

