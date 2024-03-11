<?php

//use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyControllers;
use App\Http\Controllers\TagControllers;
use App\Http\Controllers\ActivityControllers;

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
    Route::get('/contacts','index')->name('contacts.index');

    Route::get('/contacts/create', 'create')->name('contacts.create');

    Route::get('/contacts/{contact}', 'show' )->whereNumber('id')->name('contacts.show');//{id?}
//    Route::get('/contacts/{contact:email}','show')->name('contact.show');

    Route::post('/contacts/','store')->name('contacts.store');

    Route::get('/contacts/{contact?}/edit','edit')->name('contacts.edit');

    Route::put('/contacts/{contact?}','update')->name('contacts.update');

    Route::delete('/contacts/{contact?}','destroy')->name('contacts.destroy');

    Route::delete('/contacts/{contact?}','destroy')->name('contacts.destroy');

    Route::delete('/contacts/{contact?}/restore','restore')->name('contacts.restore')
        ->withTrashed();

    Route::delete('/contacts/{contact?}/force-delete','forceDelete')->name('contacts.force-delete')
        ->withTrashed();
});

Route::resources([
    '/companies' => CompanyControllers::class ,
    '/tags'      => TagControllers::class
]);

Route::resource('/activities',ActivityControllers::class)
    ->parameters([
        'activities' => 'active'
    ]);
