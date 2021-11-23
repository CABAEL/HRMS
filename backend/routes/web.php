<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\EmailController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', function (Request $request) {
    return view('/login');
})->middleware('role')->name('base');




Route::get('/test_func',[EmailController::class,'index']);

Route::POSt('/test_func_index',[EmailController::class,'date2Qtr']);

Route::get('/session',function(Request $request){
    return Auth::user();
});

Route::get('/test1',function(Request $request){
    return view('asd');
});
    
Route::post('login_post',[LoginController::class,'authenticate']);

Route::post('google_auth',[LoginController::class,'google_auth']);


Route::middleware(['auth'])->group(function(){

    Route::group([                                           
        'prefix' => 'admin',
        'as' => 'admin'
        ],function(){
        
        Route::get('/',function(Request $request){
            return redirect('admin/home');
        });

        Route::get('/home',function(Request $request){
            return view('template.admin.index');
        });

        Route::get('/deactivated_users',function(){
            return view('template.admin.deactivated_users');
        });

        Route::get('/logout',function(Request $request){
            return redirect(route('logout'));
        });

        Route::get('/users',function(){
            return view('template.admin.users');
        });

        Route::get('/activate_user/{id}',[UserController::class,'activate']);

        Route::put('/update_user_data/{id}',[UserController::class,'update']);

        Route::put('/confirm_deactivate/{id}',[UserController::class,'deactivateUser']);

        Route::delete('/confirm_delete/{id}',[UserController::class,'destroy']);

        Route::get('/user_list',[UserController::class,'index']);

        Route::get('/deactivated_list',[UserController::class,'deactivatedUser']);

        Route::get('/user_info/{id}',[UserController::class,'user_info']);

        Route::post('add_user',[UserController::class,'store']);
    
    });

    Route::group([
        'prefix' => 'hr_head',
        'as' => 'hr_head'
        ],function(){
        Route::get('/home',function(Request $request){
            //return "meron";
            return view('template.hr_head.index');
        });
    });

    
    Route::resource('user',UserController::class);

    Route::get('/logout',[LogoutController::class,'logout_user'])->name('logout');

});
    /*Route::post('/sendEmail',[EmailController::class,'send']);*/

Route::get('/invalidUser',function(){
    
    $data = [
        'status' => 'Invalid request.',
        'message' => 'Access denied.',
    ];

    //return response()->json($data);
    return redirect(route('base'));


})->name('invalidUser');










