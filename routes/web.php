<?php

use App\Http\Controllers\agendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotulensiController;
use App\Http\Controllers\AccessRightController;
use App\Http\Controllers\TodoController;
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

// Rute untuk halaman beranda
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/profile/page', [UserManagementController::class, 'myProfile'])->name('user.profile.page');

    //Edit Profile User
    Route::get('/profile/edit', [UserManagementController::class, 'editProfile'])->name('edit.profile');
    Route::put('/profile/edit/update', [UserManagementController::class, 'updateProfile'])->name('update.profile');
    Route::get('change/password', [UserManagementController::class, 'changePasswordView'])->name('change/password');
    Route::post('change/password', [UserManagementController::class, 'changePassword'])->name('change/password.submit');

    //Konfirmasi Agenda
    Route::post('/agenda/confirm/{agenda}', [agendaController::class, 'confirm'])->name('agenda.confirm');
    Route::delete('/agenda/{agenda}', [agendaController::class, 'destroy'])->name('agenda.destroy');

    //store bersama
    Route::post('users/store', [UserManagementController::class, 'store'])->name('user.store');

    //agenda rapat
    Route::get('agenda/create', [agendaController::class, 'agendaCreate'])->name('agenda.create');
    Route::get('agenda/view', [agendaController::class, 'myAgendas'])->name('agenda.view');
    Route::post('agenda/store', [agendaController::class, 'agendaStore'])->name('agenda.store');
    Route::get('agenda/{agenda}/edit', [agendaController::class, 'agendaEdit'])->name('agenda.edit');
    Route::put('agenda/{agenda}', [agendaController::class, 'agendaUpdate'])->name('agenda.update');
    Route::get('/agenda/{agenda}', [agendaController::class, 'agendaShow'])->name('agenda.show');
    Route::get('/get-employees/{faculty}', [agendaController::class, 'getEmployeesByFaculty'])->name('agenda.employeefaculty');
    Route::get('/agenda/send-reminder/{agenda}',[agendaController::class, 'sendReminderEmail'])->name('agenda.sendReminder');


    //NotulensiRapat
    Route::get('/notulensi/create/{id}', [NotulensiController::class, 'create'])->name('notulensi.create');
    Route::get('/notulensi/view', [NotulensiController::class, 'view'])->name('notulensi.view');
    Route::post('/notulensi', [NotulensiController::class, 'store'])->name('notulensi.store');
    Route::get('/notulensi/{id}', [NotulensiController::class, 'show'])->name('notulensi.show');
    Route::get('/notulensi/{id}/edit', [NotulensiController::class, 'edit'])->name('notulensi.edit');
    Route::put('/notulensi/{id}', [NotulensiController::class, 'update'])->name('notulensi.update');

    //TodoList
    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::get('/todo/send-reminder/{todo}', [TodoController::class, 'sendReminderEmail'])->name('todo.send-reminder');


    //khusus admin
    Route::middleware(['CekUserLogin:admin'])->group(function () {
        Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserManagementController::class, 'userCreate'])->name('users.create');
        Route::get('users/edit/{username}', [UserManagementController::class, 'userEdit'])->name('users.edit');
        Route::put('users/update/{username}', [UserManagementController::class, 'userUpdate'])->name('users.update');
        Route::delete('users/delete/{username}', [UserManagementController::class, 'userDelete'])->name('users.destroy');

        //hak akses//
        Route::get('/access_rights', [AccessRightController::class, 'index'])->name('access_rights.index');
        Route::get('/access_rights/create', [AccessRightController::class, 'create'])->name('access_rights.create');
        Route::post('/access_rights', [AccessRightController::class, 'store'])->name('access_rights.store');
        Route::get('/access_rights/{accessRight}/edit', [AccessRightController::class, 'edit'])->name('access_rights.edit');
        Route::put('/access_rights/{accessRight}', [AccessRightController::class, 'update'])->name('access_rights.update');
        Route::delete('/access_rights/{accessRight}', [AccessRightController::class, 'destroy'])->name('access_rights.destroy');
    });
});
