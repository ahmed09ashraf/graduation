<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
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



// Displaying the reservation form
Route::get('/', [StudentController::class, 'index'])->name('reservations.index');

// Submitting the reservation form
Route::post('/', [StudentController::class, 'store'])->name('reservations.store');


// New routes for edit, update, and delete
Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('reservations.edit');
Route::put('/update/{id}', [StudentController::class, 'update'])->name('reservations.update');
Route::delete('/delete/{id}', [StudentController::class, 'delete'])->name('reservations.delete');

Route::get('/departments/{college}', [StudentController::class, 'getDepartments'])->name('get.departments');


// Admin dashboard and management
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Routes for colleges
Route::get('/admin/colleges', [AdminController::class, 'colleges'])->name('admin.colleges');
Route::post('/admin/colleges', [AdminController::class, 'storeColleges'])->name('admin.colleges.store');
Route::delete('/admin/colleges/{id}', [AdminController::class, 'deleteCollege'])->name('admin.colleges.delete');

// Routes for departments
Route::get('/admin/departments', [AdminController::class, 'departments'])->name('admin.departments');
Route::post('/admin/departments', [AdminController::class, 'storeDepartments'])->name('admin.departments.store');
Route::delete('/admin/departments/{id}', [AdminController::class, 'deleteDepartment'])->name('admin.departments.delete');

// Routes for uniforms
Route::get('/admin/uniforms', [AdminController::class, 'uniforms'])->name('admin.uniforms');
Route::post('/admin/uniforms', [AdminController::class, 'storeUniforms'])->name('admin.uniforms.store');
Route::delete('/admin/uniforms/{id}', [AdminController::class, 'deleteUniform'])->name('admin.uniforms.delete');
