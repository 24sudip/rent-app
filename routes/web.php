<?php

use App\Http\Controllers\{ProfileController, AdminController, ManagerController};
use Illuminate\Support\Facades\{Route, Auth};
// use Illuminate\Http\Request;

use App\Http\Controllers\Frontend\{AuthController, InvitationController, UserController, MessageController};
use App\Http\Controllers\Frontend\{FrontendController, SubscriptionController, WishlistController};
use App\Http\Controllers\Backend\{PropertyCategoryController, PropertyController, MultiImageController, PackageController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/clear/filter', [FrontendController::class, 'ClearFilter'])->name('clear.filter');
Route::get('/property/details/{id}', [FrontendController::class, 'PropertyDetails'])->name('property.details');
Route::post('/search/location', [FrontendController::class, 'SearchLocation'])->name('search.location');
Route::post('/filter/location', [FrontendController::class, 'FilterLocation'])->name('filter.location');
Route::post('/filter/room-type', [FrontendController::class, 'FilterRoomType'])->name('filter.room-type');
Route::post('/filter/resident', [FrontendController::class, 'FilterResident'])->name('filter.resident');


Route::middleware('guest')->group(function () {
    // Admin
    Route::get('/admin/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/admin/login-submit', [AuthController::class, 'login_submit'])->name('admin.loginSubmit');
    // Route::get('/user/register', [AuthController::class, 'register'])->name('user.register');
    // Route::post('/user/register-submit', [AuthController::class, 'registerSubmit'])->name('user.registerSubmit');

    // Manager
    Route::get('/manager/login', [ManagerController::class, 'ManagerLogin'])->name('manager.login');
    Route::get('/manager/register', [ManagerController::class, 'ManagerRegister'])->name('manager.register');
    Route::post('/manager/store', [ManagerController::class, 'ManagerStore'])->name('manager.store');
});

// Previous Project
Route::group(['prefix'=>'user', 'middleware' => ['auth', 'ensure.profile.updated']], function () {
    // Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('profile-edit', [UserController::class, 'profileEdit'])->name('user.profileEdit');
    Route::post('profile-edit-submit', [UserController::class, 'profileEditSubmit'])->name('user.profileEdit.submit');
    Route::post('images/upload', [UserController::class, 'imageUpload'])->name('user.imageUpload');
    Route::post('/image/delete', [UserController::class, 'deleteImage'])->name('user.imageDelete');
    Route::get('chat/list', [UserController::class, 'chatList'])->name('user.chat.list');
    Route::get('plan', [UserController::class, 'userPlan'])->name('user.plan');
    Route::get('setting', [UserController::class, 'setting'])->name('user.setting');
    Route::post('update-setting', [UserController::class, 'updateSetting'])->name('user.updateSetting');


    Route::get('invitations', [InvitationController::class, 'invitations'])->name('user.invitations');
    Route::post('send-invitation', [InvitationController::class, 'sendInvitation'])->name('send.invitation');
    Route::post('cancel-invitation', [InvitationController::class, 'cancelInvitation'])->name('cancel.invitation');
    Route::post('accept-invitation', [InvitationController::class, 'acceptInvitation'])->name('accept.invitation');
    Route::post('deny-invitation', [InvitationController::class, 'denyInvitation'])->name('deny.invitation');

    Route::post('profile/{userId}/like', [UserController::class, 'like'])->name('profile.like');


    Route::post('chat-now', [MessageController::class, 'chatNow'])->name('user.chatnow');
    Route::post('chat-send', [MessageController::class, 'sendMessage'])->name('user.chat.send');
    Route::get('chat/messages', [MessageController::class, 'getMessages'])->name('chat.getMessages');

    Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('user.subscribe');
});
// Route::get('/test', function () {
//     Auth::logout();
//     request()->session()->invalidate();
//     request()->session()->regenerateToken();
//     return redirect('/');
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// User Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','roles:user','verified'])->name('dashboard');

Route::middleware(['auth','roles:user'])->group(function () {
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'ProfileUpdate'])->name('profile.update');
    Route::get('/user/logout', [ProfileController::class, 'UserLogout'])->name('user.logout');
    // wishlist
    Route::controller(WishlistController::class)->prefix('/user/wishlist')->name('user.wishlist.')
    ->group(function () {
        Route::get('/all', 'UserWishlist')->name('index');
        Route::get('/destroy/{id}', 'UserWishlistDestroy')->name('destroy');
    });
});

// Admin Route
Route::middleware(['auth','roles:admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

Route::prefix('/admin')->as('admin.')->middleware(['auth','roles:admin'])->group(function () {
    // Category Of Property
    Route::controller(PropertyCategoryController::class)->prefix('/property-category')->name('property-category.')
    ->group(function () {
        Route::get('/all', 'PropertyCategoryAll')->name('index');
        Route::get('/create', 'PropertyCategoryCreate')->name('create');
        Route::post('/store', 'PropertyCategoryStore')->name('store');
        Route::get('/edit/{id}', 'PropertyCategoryEdit')->name('edit');
        Route::put('/update/{id}', 'PropertyCategoryUpdate')->name('update');
        Route::delete('/delete/{id}', 'PropertyCategoryDelete')->name('delete');
    });
    // Package
    Route::controller(PackageController::class)->prefix('/package')->name('package.')
    ->group(function () {
        Route::get('/all', 'PackageAll')->name('index');
        Route::get('/create', 'PackageCreate')->name('create');
        Route::post('/store', 'PackageStore')->name('store');
        Route::get('/edit/{id}', 'PackageEdit')->name('edit');
        Route::put('/update/{id}', 'PackageUpdate')->name('update');
        Route::delete('/delete/{id}', 'PackageDelete')->name('delete');
    });
});
Route::prefix('/admin')->as('admin.')->middleware(['auth','roles:admin'])->group(function () {
    // Status Of Property
    Route::controller(AdminController::class)->prefix('/property-status')->name('property-status.')->group(function () {
        Route::get('/all', 'PropertyStatusAll')->name('index');
        Route::get('/active/{id}', 'PropertyStatusActive')->name('active');
        Route::get('/inactive/{id}', 'PropertyStatusInactive')->name('inactive');
    });
    // Package Order
    Route::controller(AdminController::class)->prefix('/package-order')->name('package-order.')->group(function () {
        Route::get('/all', 'PackageOrderAll')->name('index');
        Route::get('/confirm/{id}', 'PackageOrderConfirm')->name('confirm');
        Route::get('/withdraw/{id}', 'PackageOrderWithdraw')->name('withdraw');
    });
});

Route::middleware(['auth','roles:manager'])->group(function () {
    Route::get('/manager/dashboard', [ManagerController::class, 'ManagerDashboard'])->name('manager.dashboard');
    Route::get('/manager/logout', [ManagerController::class, 'ManagerLogout'])->name('manager.logout');
    Route::get('/manager/profile', [ManagerController::class, 'ManagerProfile'])->name('manager.profile');
    Route::post('/manager/profile/update', [ManagerController::class, 'ManagerProfileUpdate'])->name('manager.profile.update');

    Route::get('/manager/buy/package', [ManagerController::class, 'ManagerBuyPackage'])->name('manager.buy.package');
    Route::post('/manager/subscribe/{package_id}', [ManagerController::class, 'ManagerSubscribe'])->name('manager.subscribe');
});
Route::prefix('/manager')->as('manager.')->middleware(['auth','roles:manager'])->group(function () {
    // Property
    Route::controller(PropertyController::class)->prefix('/property')->name('property.')
    ->group(function () {
        Route::get('/all', 'PropertyAll')->name('index');
        Route::get('/create', 'PropertyCreate')->name('create');
        Route::post('/store', 'PropertyStore')->name('store');
        Route::get('/show/{id}', 'PropertyShow')->name('show');
        Route::get('/edit/{id}', 'PropertyEdit')->name('edit');
        Route::put('/update/{id}', 'PropertyUpdate')->name('update');
        Route::get('/delete/{id}', 'PropertyDelete')->name('delete');

        Route::put('/room/update/{property_id}', 'RoomUpdate')->name('room.update');
        Route::put('/common/update/{property_id}', 'CommonUpdate')->name('common.update');
        Route::put('/amenity/update/{property_id}', 'AmenityUpdate')->name('amenity.update');
        Route::put('/service/update/{property_id}', 'ServiceUpdate')->name('service.update');
        Route::put('/rent-package/update/{property_id}', 'RentPackagesUpdate')->name('rent-package.update');
        Route::put('/rent-term/update/{property_id}', 'RentTermUpdate')->name('rent-term.update');
        Route::put('/rules/update/{property_id}', 'PropertyRulesUpdate')->name('rules.update');
    });
    // Multi Image
    Route::controller(MultiImageController::class)->prefix('/multi-image')->name('multi-image.')
    ->group(function () {
        Route::post('/store', 'MultiImageStore')->name('store');
        Route::post('/update', 'MultiImageUpdate')->name('update');
        Route::get('/delete/{id}', 'MultiImageDelete')->name('delete');
    });
});
Route::get('/district/ajax/{division_id}', [PropertyController::class, 'GetDistrict']);
Route::get('/upazilla/ajax/{district_id}', [PropertyController::class, 'GetUpazilla']);

// Wishlist add route
Route::post('/add-to-wishList/{property_id}', [WishlistController::class, 'AddToWishList']);

require __DIR__.'/auth.php';

