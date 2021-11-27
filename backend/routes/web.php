<?php

use App\Http\Controllers\ApplicantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\JobVacancyController;
use GuzzleHttp\Middleware;

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

Route::get('/test', function (Request $request) {
    return Auth::user();
});

Route::get('/register', function (Request $request) {
    return view('register');
});

Route::get('/login', function (Request $request) {
    return view('/login');
})->middleware('role')->name('login');

Route::resource('/register/add_user',ApplicantController::class);

Route::post('login/login_post',[LoginController::class,'authenticate']);
Route::get('/logout',[LogoutController::class,'logout_user'])->name('logout');
//Route::post('login_post',[ 'as' => 'login', 'uses' => 'LoginController@authenticate']);

//Route::post('google_auth',[LoginController::class,'google_auth']);
Route::middleware(['auth','role'])->group(function(){

    Route::group([                                           
        'prefix' => 'admin',
        'as' => 'admin',
        ],function(){
        
        Route::get('/',function(Request $request){
            return redirect('admin/home');
        })->name('admin_home');

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
        'as' => 'hr_head',
        ],function(){

            Route::get('/',function(Request $request){
                return redirect('hr_head/home');
            })->name('hr_head_home');
    
            Route::get('/home',function(Request $request){
                return view('template.hr_head.index');
            });
    
            Route::get('/deactivated_users',function(){
                return view('template.hr_head.deactivated_users');
            });
    
            Route::get('/logout',function(Request $request){
                return redirect(route('logout'));
            });
    
            Route::get('/users',function(){
                return view('template.hr_head.users');
            });

            Route::get('/job_vacancies',function(){
                return view('template.hr_head.job_vacancies');
            });

            Route::get('/applicants',function(){
                return view('template.hr_head.applicant_list');
            });

            Route::get('/employees',function(){
                return view('template.hr_head.employee_list');
            });
    
            Route::get('/activate_user/{id}',[UserController::class,'activate']);

            Route::resource('/employee_list',UserController::class);
    
            Route::put('/update_user_data/{id}',[UserController::class,'update']);
    
            Route::put('/confirm_deactivate/{id}',[UserController::class,'deactivateUser']);
    
            Route::delete('/confirm_delete/{id}',[UserController::class,'destroy']);
    
            Route::get('/user_list',[UserController::class,'index']);
    
            Route::get('/deactivated_list',[UserController::class,'deactivatedUser']);
    
            Route::get('/user_info/{id}',[UserController::class,'user_info']);
    
            Route::post('add_user',[UserController::class,'store']);
        
            Route::resource('/job',JobVacancyController::class);

    });
    Route::group([
        'prefix' => 'applicant',
        'as' => 'hr_head',
        ],function(){
            
            Route::get('/logout',function(Request $request){
                return redirect(route('logout'));
            });

            Route::get('/',function(Request $request){
                return redirect('hr_head/home');
            })->name('hr_head_home');
    
            Route::get('/home',function(Request $request){
                return view('template.applicant.index');
            });

            Route::resource('/job',JobVacancyController::class);

            Route::post('/applicant_details',[ApplicantController::class,'applicantDetails']);
    });

    Route::resource('user',UserController::class);

});
    /*Route::post('/sendEmail',[EmailController::class,'send']);*/

/*Route::get('/invalidUser',function(){
    
    $data = [
        'status' => 'Invalid request.',
        'message' => 'Access denied.',
    ];

    //return response()->json($data);
    return redirect(route('base'));


})->name('invalidUser');*/










