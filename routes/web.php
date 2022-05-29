<?php

use App\Models\AllShortenLinks;
use App\Models\GuestShortenLink;
use App\Models\ShortUrl;
use App\Models\User;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\GuestShortUrlController;
use App\Http\Controllers\GuestUrlClicks;
use App\Http\Controllers\Dashboard\MainDashboardController;
use Illuminate\Support\Facades\Http;

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


Route::view('/', 'home')->name('main');

Route::get('/short/{shortKey}', ShortUrlController::class);

Route::post('/shortener', [GuestShortUrlController::class, 'index'])->name('guest_shorturl');

Route::get('/url-total-clicks/{short_url?}', GuestUrlClicks::class)->name('total-clicks');

Route::view('/url-click-counter', 'url-click-counter')->name('url-counter');;

Route::view('/home' , 'laravel-main');

Route::group(['middleware' => ['auth' ,  'verified']], function () {

    Route::resource('dashboard' ,MainDashboardController::class)->parameters(
        [
            'dashboard' => 'url_key'
        ]);

});

Route::get('/test-api' , function () {


    $token = Http::withOptions(['verify' => false])->get('https://opentdb.com/api_token.php' , [
        'command' => 'request'
    ]);

    $token = json_decode($token)->token;
   $response =  Http::withOptions(['verify' => false])->get('https://opentdb.com/api.php' ,
       [
           'amount' => 10,
           'category' => 17,
           'difficulty' => 'easy',
           'type' => 'multiple',
           'token' => $token

       ]);

   $questions = json_decode($response);


   foreach($questions->results as $key => $question) {
       dd($question);
   }

});
Auth::routes(['verify' => true]);
Auth::routes();



