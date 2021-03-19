<?php
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Post;
use App\Models\Categories;
use App\Core\Helpers\SlugHelper;
use SebastianBergmann\Environment\Console;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('posts/')->group(function () {
    Route::get('/', 'PostController@index')->name('post.index');
    Route::get('/{slug}.html', 'PostController@show')->name('post.show');
    Route::get('/new', 'PostController@create')->name('post.create');
    Route::post('/new', 'PostController@store')->name('post.store');

    Route::post('/published', 'PostController@storePublish')->name('post.store.publish');
    
    Route::get('/update/{post}.html', 'PostController@edit')->name('post.edit');
    Route::post('/update/{post}', 'PostController@update')->name('post.update');
    Route::get('/delete/{post}.html', 'PostController@destroy')->name('post.destroy');
    Route::get('/publish/{post}', 'PostController@publishPost')->name('post.publish');
    Route::get('/unpublish/{post}', 'PostController@unpublishPost')->name('post.unpublish');  
    
    Route::get('/up-point/{post}', 'PostController@upPoint')->name('post.up.point');
    Route::get('/down-point/{post}', 'PostController@downPoint')->name('post.down.point');

});
Route::get('/timepost/{post}', 'PostController@updateTimePost')->name('post.update.timepost');




Route::get('/c', 'CategoryController@index')->name('category.index');
Route::get('/c/{category}', 'CategoryController@show')->name('category.show');
Route::get('/c', 'CategoryController@store')->name('category.store');

Route::post('/comment', 'PostController@storeComment')->name('comment.store');
Route::get('/comment/{comment}', 'PostController@destroyComment')->name('comment.destroy');
Route::post('/comment/{comment}', 'PostController@updateComment')->name('comment.update');



Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::group(['prefix' => 'profile' ,'middleware' => ['auth']], function () {
    Route::get('/{profile}', 'ProfileController@index')->name('profile.index');
    Route::get('/update/{profile}', 'ProfileController@edit')->name('profile.edit');
    Route::post('/update/{profile}', 'ProfileController@update')->name('profile.update');

});



Auth::routes();


// Route::get('/test', 'ProfileController@test')->name('test');