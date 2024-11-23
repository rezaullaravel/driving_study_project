<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\Admin\ChapterController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\LicencetypeController;

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




//user login and registration
Route::get('/',[AuthController::class,'loginForm']);
Route::post('/login-post',[AuthController::class,'postLogin'])->name('user.login');
Route::get('/register',[AuthController::class,'registerForm']);
Route::post('/post-register',[AuthController::class,'postRegister'])->name('user.register');

/**================ admin all route start ============================*/
Route::middleware(['check'])->group(function(){
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('user.dashboard');
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');


    //user
    Route::get('/users',[UserController::class,'usesrs'])->name('users');
    Route::get('/user-create',[UserController::class,'create'])->name('user.create');
    Route::post('/user-store',[UserController::class,'store'])->name('user.store');
    Route::get('/user-edit/{id}',[UserController::class,'edit'])->name('user.edit');
    Route::post('/user-update/{id}',[UserController::class,'update'])->name('user.update');
    Route::get('/user-delete/{id}',[UserController::class,'delete'])->name('user.delete');

    //roles
    Route::get('/roles',[RoleController::class,'roles'])->name('roles');
    Route::get('/role-create',[RoleController::class,'roleCreate'])->name('role.create');
    Route::post('/role-store',[RoleController::class,'roleStore'])->name('role.store');
    Route::get('/role/edit/{id}',[RoleController::class,'roleEdit'])->name('role.edit');
    Route::get('/role/delete/{id}',[RoleController::class,'roleDelete'])->name('role.delete');
    Route::post('/role-permission/store/{id}',[RoleController::class,'rolePermissionStore'])->name('role.permission.store');


    //licence type
    Route::get('/licence-type-list',[LicencetypeController::class,'index'])->name('licencetype.index');
    Route::get('/licence-type-create',[LicencetypeController::class,'create'])->name('licencetype.create');
    Route::post('/licence-type-store',[LicencetypeController::class,'store'])->name('licencetype.store');
    Route::get('/licence-type-edit/{id}',[LicencetypeController::class,'edit'])->name('licencetype.edit');
    Route::post('/licence-type-update/{id}',[LicencetypeController::class,'update'])->name('licencetype.update');
    Route::get('/licence-type-delete/{id}',[LicencetypeController::class,'delete'])->name('licencetype.delete');


    //chapter
    Route::get('/chapter-list',[ChapterController::class,'index'])->name('chapter.index');
    Route::get('/chapter-create',[ChapterController::class,'create'])->name('chapter.create');
    Route::post('/chapter-store',[ChapterController::class,'store'])->name('chapter.store');
    Route::get('/chapter-edit/{id}',[ChapterController::class,'edit'])->name('chapter.edit');
    Route::post('/chapter-update/{id}',[ChapterController::class,'update'])->name('chapter.update');
    Route::get('/chapter-delete/{id}',[ChapterController::class,'delete'])->name('chapter.delete');
    Route::get('/chapter-group-create/{id}',[ChapterController::class,'createChapterGroup'])->name('chapter-group.create');
    Route::post('/chapter-group-store',[ChapterController::class,'storeChapterGroup'])->name('chapter.group.store');


    //book
    Route::get('/book-list',[BookController::class,'index'])->name('book.index');
    Route::get('/book-create',[BookController::class,'create'])->name('book.create');
    Route::post('/book-store',[BookController::class,'store'])->name('book.store');
    Route::get('/book-edit/{id}',[BookController::class,'edit'])->name('book.edit');
    Route::post('/book-update/{id}',[BookController::class,'update'])->name('book.update');
    Route::get('/book-details/{id}',[BookController::class,'details'])->name('book.details');
    Route::get('/book-delete/{id}',[BookController::class,'delete'])->name('book.delete');

    //global route
    Route::get('/language/chapter/ajax/{language_id}',[BookController::class,'chapterAutoSelect']);



    //questions
    Route::get('/questions',[QuestionController::class,'index'])->name('question.index');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('question.create');
    Route::post('/questions/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/questions/edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('/questions/update/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::get('/questions/view/{id}', [QuestionController::class, 'view'])->name('question.view');
    Route::get('/questions/delete/{id}', [QuestionController::class, 'delete'])->name('question.delete');
    //ajax route
    Route::get('/questions/get-book-details', [QuestionController::class, 'getBookDetails'])->name('question.getBookDetails');



    //package
    Route::get('/packages',[PackageController::class,'index'])->name('package.index');
    Route::get('/package-create',[PackageController::class,'create'])->name('package.create');
    Route::post('/package-store',[PackageController::class,'store'])->name('package.store');
    Route::get('/package-edit/{id}',[PackageController::class,'edit'])->name('package.edit');
    Route::post('/package-update/{id}',[PackageController::class,'update'])->name('package.update');
    Route::get('/package-view/{id}',[PackageController::class,'view'])->name('package.view');
    Route::get('/package-delete/{id}',[PackageController::class,'delete'])->name('package.delete');



    //profile
    Route::get('/profile',[UserProfileController::class,'index']);
    Route::post('/profile-update',[UserProfileController::class,'updateProfile'])->name('profile.update');

    //password
    Route::get('/password',[UserProfileController::class,'password']);
    Route::post('/password-update/{id}',[UserProfileController::class,'passwordUpdate'])->name('password.update');
});
