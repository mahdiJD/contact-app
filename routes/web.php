<?php

//use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;

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

//Route::get('/', function () {
////    Debugbar::info("Info");
////    Debugbar::error("Info");
//    $html="
//    <a href='" .\route('contact.create'). "'>contact</a>
//    ";
//    // <a href='" .\route('blog.id' , ['id'=>21]). "'>contact</a>
//    return $html;
//});

//Route::prefix('admin/')->group(function () {
//    Route::get('/contact', function () {
//        return '<h1> contact page </h1>';
//    })->name("contact.index");
//
//    Route::get('/contact/create', function () {
//        return '<h1> creat contact page </h1>';
//    })->name("contact.create");
//
////    Route::get('blog/{id?}', function ($id = null) {
////        if (!$id) return '<h1> blog list </h1>';
////        return '<h1> blog list number: ' . $id . ' </h1>';
////    })->name("blog.id");
//});

//$comPage = false;
//Route::get('com/{id}',function ($id){
////    $GLOBALS['comPage']=false;
//    global $comPage;
//    $comPage=false;
//    return '<h1> com list number: '. $id .' </h1>';
//})->where(['id'=>'[0-9]+']);

//if ($comPage) {
//    Route::get('com/{id}', function ($id) {
//        return '<h1> com list number: ' . $id . ' </h1>';
//    })->where(['id' => '[a-zA-Z]+']);
//}

//Route::get('root/{id}',function ($id){
//    return '<h1> com list number: '. $id .' </h1>';
//})->whereAlpha('id');
//
//Route::resource('/blog' , PostController::class);
//
//Route::get('/home',\App\Http\Controllers\HomeController::class);


Route::get('/', [ContactController::class,'welcome']);

Route::controller(ContactController::class)->prefix('admin')->group(function () {
    Route::get('/contact','index')->name('contact.index');

    Route::get('/contact/create', 'create')->name('contact.create');

    Route::get('/contact/{id}', 'show' )->whereNumber('id')->name('contact.show');//{id?}

    Route::post('/contact/','store')->name('contact.store');

    Route::get('/contact/{id?}/edit','edit')->name('contact.edit');

    Route::put('/contact/{id?}','update')->name('contact.update');

    Route::delete('/contact/{id?}','destroy')->name('contact.destroy');

    Route::delete('/contact/{id?}','destroy')->name('contact.destroy');

    Route::delete('/contact/{id?}/restore','restore')->name('contact.restore');

    Route::delete('/contact/{id?}/force-delete','forceDelete')->name('contact.force-delete');
});
