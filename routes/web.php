<?php

use Illuminate\Support\Facades\Route;
//use App\Models\image;

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

Route::get('/home', function () {

    /* ORM
    $images = image::all();
    foreach ($images as $image) {
        echo $image->imagen_path ."<br>";
        echo $image->description ."<br>";
        echo $image->user->nick. " " .$image->user->surname ."<br>";

        if(count($image->comments) >= 1 ){
            echo '<h4>Comentarios</h4>';
            foreach ($image->comments as $comment) {
                echo $comment->user->nick. " " .$comment->user->surname ." : " ;
                echo $comment->content ."<br>";
            }
        }

        echo "Likes de la imagen: " .count($image->likes). "<br>";
        echo "<hr>";
    }
    die();
    */

    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// User--------

Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('user.config');
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
Route::get('/user/gente/{search?}', [\App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/user/profile/{id}', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
//  POST
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
//------------------------------------------------------------------------------------------------------------------------------------

// Image--------
//  GET
Route::get('/image/file/{filename}', [\App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/detail/{id}', [\App\Http\Controllers\ImageController::class, 'detalle'])->name('image.detail');
Route::get('/subir-imagen', [\App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::get('/image/delete/{id}', [\App\Http\Controllers\ImageController::class, 'delete'])->name('image.delete');
Route::get('/image/edit/{id}', [\App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
//  POST
Route::post('/image/save', [\App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::post('/image/update', [\App\Http\Controllers\ImageController::class, 'update'])->name('image.update');
//------------------------------------------------------------------------------------------------------------------------------------

// COMMENT-------
//  GET
Route::get('/comment/delete/{id}', [\App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');
//  POST
Route::post('/comment/save', [\App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');
//------------------------------------------------------------------------------------------------------------------------------------


// LIKE--------
// GET
Route::get('/like/{id}', [\App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/unlike/{id}', [\App\Http\Controllers\LikeController::class, 'unlike'])->name('like.delete');
Route::get('/likes', [\App\Http\Controllers\LikeController::class, 'index'])->name('like.index');






