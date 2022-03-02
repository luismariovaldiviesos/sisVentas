<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\DespachoController;
use App\Http\Livewire\RolesController;
use App\Http\Livewire\UsersController;
use App\Http\Livewire\PermisosController;
use App\Http\Livewire\AsignarController;
use App\Http\Livewire\EmpresaController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){

   // Route::get('/home', [App\Http\Livewire\PacientesController::class, 'countPaciente'])->name('home'); // ESTADISTICAS
   Route::get('home', [\App\Http\Controllers\DashController::class, 'data'])->name('dash');


   Route::get('roles', RolesController::class);
   Route::get('/usuarios', UsersController::class);
   Route::get('permisos', PermisosController::class);
   Route::get('asignar', AsignarController::class);
    Route::get('dash', [\App\Http\Controllers\DashController::class, 'data']);


    Route::get('empresa', EmpresaController::class);


});








