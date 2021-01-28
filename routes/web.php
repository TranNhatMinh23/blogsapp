<?php
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Profile;
use App\Models\Categories;
use App\Core\Helpers\SlugHelper;
use App\Http\Middleware\CheckLogin;

Route::get('/', 'HomeController@index')->name('home');


Route::prefix('posts/')->group(function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::get('/{slug}.html', 'PostController@show')->name('post.show');
    Route::get('/new', 'PostController@create')->name('post.create')->middleware('checkLogin');
    Route::post('/', 'PostController@store')->name('post.store');
    Route::get('/update/{post}.html', 'PostController@edit')->name('post.edit');
    Route::post('/update/{post}', 'PostController@update')->name('post.update');
    Route::get('/delete/{post}.html', 'PostController@destroy')->name('post.destroy');
});


Route::get('/categories', 'CategoryController@index')->name('category.index');
Route::get('/categories/{category}.html', 'CategoryController@show')->name('category.show');
Route::post('/categories', 'CategoryController@store')->name('category.store');
Route::post('/comment', 'PostController@storeComment')->name('comment.store');
Route::post('/comment/{comment}', 'PostController@destroy')->name('comment.destroy');


Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::group(['prefix' => 'profile' ,'middleware' => ['auth']], function () {
    Route::get('/update/{profile}', 'ProfileController@edit')->name('profile.edit');
    Route::post('/update/{profile}', 'ProfileController@update')->name('profile.update');
    Route::get('/{profile}', 'ProfileController@index')->name('profile.index');
});


Auth::routes();


Route::get('/test', function(){
    $chuoi = 'tôi là nguyễn 725 3 4 5 8 -=.,k minh trọng';
    echo slugify($chuoi);
});