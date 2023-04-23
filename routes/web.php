<?php

use App\Http\Controllers\AdminAuthorController;
use App\Http\Controllers\AdminBooksController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardLoanController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\DevelopersListController;
use App\Http\Controllers\LoanRequestsController;
use App\Http\Controllers\SiteController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SiteController::class, "index"])->name("home")->middleware("verified");
Route::get('/books', [SiteController::class, "books"])->name("books")->middleware(["auth","verified"]);
Route::get('/books/{books:slug}', [SiteController::class, "book"])->name("books")->middleware(["auth","verified"]);
Route::get('/categories', [SiteController::class, "categories"])->name("categories")->middleware(["auth","verified"]);
Route::get('/developers', [SiteController::class, "developers"])->name("developers")->middleware(["auth","verified"]);

Route::post('/books/{books:slug}', [SiteController::class, "likes"])->name("books");
Route::post("/books/{books:slug}/comment", [SiteController::class, "comments"])->middleware(["auth","verified"]);

Route::resource('/dashboard/loan', DashboardLoanController::class)->middleware(["auth","verified"]);
Route::resource('/dashboard/profile', DashboardProfileController::class);
Route::resource('/dashboard/categories', AdminCategoryController::class)->except("show")->middleware("isAdmin");
Route::resource('/dashboard/books', AdminBooksController::class)->middleware("isAdmin");
Route::resource('/dashboard/authors', AdminAuthorController::class)->except("show")->middleware("isAdmin");
Route::resource('/dashboard/developers', DevelopersListController::class)->middleware("isAdmin");

Route::get('/dashboard/requests', [LoanRequestsController::class, "index"])->middleware("isAdmin");
Route::get('/dashboard/requests/{loans:id}/accept', [LoanRequestsController::class, "accept"])->middleware("isAdmin");
Route::get('/dashboard/requests/{loans:id}/reject', [LoanRequestsController::class, "reject"])->middleware("isAdmin");
Route::get('/dashboard/requests/{loans:id}/cancel', [LoanRequestsController::class, "cancel"])->middleware("isAdmin");
Route::get('/dashboard/requests/{loans:id}/done', [LoanRequestsController::class, "done"])->middleware("isAdmin");

Auth::routes(['verify' => true]);