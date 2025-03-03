<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Ordenes;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('cart/add', [App\Http\Livewire\Ordenes::class, 'add'])->name('add');
Route::get('cart/checkout', [App\Http\Livewire\Ordenes::class, 'checkout'])->name('checkout');
Route::get('cart/clear', [App\Http\Livewire\Ordenes::class, 'clear'])->name('clear');
Route::get('cart/pedir', [App\Http\Livewire\Ordenes::class, 'pedir'])->name('pedir');
Route::post('cart/removeitem', [App\Http\Livewire\Ordenes::class, 'removeItem'])->name('removeitem');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home/mis_pedidos', [App\Http\Controllers\HomeController::class, 'misPedidos'])->name('mis_pedidos');
Route::get('home/detalle_pedido/{ordenId}', [App\Http\Controllers\HomeController::class, 'detallePedido'])->name('detalle_pedido');


//Route Hooks - Do not delete//
	Route::view('pedido', 'livewire.pedido.index')->middleware('auth');
	Route::view('orden', 'livewire.orden.index')->middleware('auth');
	Route::view('producto', 'livewire.producto.index')->middleware('auth');
	Route::get('/livewire/producto', [App\Http\Livewire\Productos::class, 'report'])->name('livewire.producto.report');

