<?php

use App\Http\Controllers\CategoriaGastoController;
use App\Http\Controllers\CosechaController;
use App\Http\Controllers\dashboarController;
use App\Http\Controllers\EstadosCosechaController;
use App\Http\Controllers\FincaController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\InvernaderoController;
use App\Http\Controllers\MantenimientoInvernaderoController;
use App\Http\Controllers\TiposCultivoController;
use Illuminate\Support\Facades\Route;


#routes de dashboard
Route::get('/',[dashboarController::class,'welcome'])->name('welcome');

#routes de finca

Route::get('/Fincas/admin',[FincaController::class,'admin'])->name('Fincas.admin');
Route::get('/Fincas/index',[FincaController::class,'index'])->name('Fincas.index');
Route::get('/Fincas/create',[FincaController::class,'create'])->name('Fincas.create');
Route::post('/Fincas/store',[FincaController::class,'store'])->name('Fincas.store');
Route::post('/Fincas/destroy/{id}',[FincaController::class,'destroy'])->name('Fincas.destroy');
Route::get('/Fincas/edit/{id}',[FincaController::class,'edit'])->name('Fincas.edit');
Route::post('/Fincas/update/{id}',[FincaController::class,'update'])->name('Fincas.update');


# routes de invernadero
Route::get('/Invernaderos/index/{idfinca}',[InvernaderoController::class,'index'])->name('Invernaderos.index');
Route::get('/Invernaderos/create/{idfinca}',[InvernaderoController::class,'create'])->name('Invernaderos.create');
Route::post('/Invernaderos/store',[InvernaderoController::class,'store'])->name('Invernaderos.store');
Route::post('/Invernaderos/destroy/{id}',[InvernaderoController::class,'destroy'])->name('Invernaderos.destroy');
Route::get('/Invernaderos/edit/{idfinca}',[InvernaderoController::class,'edit'])->name('Invernaderos.edit');
Route::post('/Invernaderos/update/{id}',[InvernaderoController::class,'update'])->name('Invernaderos.update');


#routes de categoria gastos
Route::get('/CategoriaGastos/index',[CategoriaGastoController::class,'index'])->name('CategoriaGastos.index');
Route::get('/CategoriaGastos/create',[CategoriaGastoController::class,'create'])->name('CategoriaGastos.create');
Route::post('/CategoriaGastos/store',[CategoriaGastoController::class,'store'])->name('CategoriaGastos.store');
Route::post('/CategoriaGastos/destroy/{id}',[CategoriaGastoController::class,'destroy'])->name('CategoriaGastos.destroy');
Route::get('/CategoriaGastos/edit/{id}',[CategoriaGastoController::class,'edit'])->name('CategoriaGastos.edit');
Route::post('/CategoriaGastos/update/{id}',[CategoriaGastoController::class,'update'])->name('CategoriaGastos.update');

#routes de Tipos Cultivos
Route::get('/TiposCultivos/index',[TiposCultivoController::class,'index'])->name('TiposCultivos.index');
Route::get('/TiposCultivos/create',[TiposCultivoController::class,'create'])->name('TiposCultivos.create');
Route::post('/TiposCultivos/store',[TiposCultivoController::class,'store'])->name('TiposCultivos.store');
Route::post('/TiposCultivos/destroy/{id}',[TiposCultivoController::class,'destroy'])->name('TiposCultivos.destroy');
Route::get('/TiposCultivos/edit/{id}',[TiposCultivoController::class,'edit'])->name('TiposCultivos.edit');
Route::post('/TiposCultivos/update/{id}',[TiposCultivoController::class,'update'])->name('TiposCultivos.update');

#routes de mantenimineto invernaderos
Route::get('/MantenimientoInverndero/index/{idinvernadero}',[MantenimientoInvernaderoController::class,'index'])->name('MantenimientoInverndero.index');
Route::get('/MantenimientoInverndero/create/{idinvernadero}',[MantenimientoInvernaderoController::class,'create'])->name('MantenimientoInverndero.create');
Route::post('/MantenimientoInverndero/store',[MantenimientoInvernaderoController::class,'store'])->name('MantenimientoInverndero.store');
Route::post('/MantenimientoInverndero/destroy/{id}',[MantenimientoInvernaderoController::class,'destroy'])->name('MantenimientoInverndero.destroy');
Route::get('/MantenimientoInverndero/edit/{idinvernadero}',[MantenimientoInvernaderoController::class,'edit'])->name('MantenimientoInverndero.edit');
Route::post('/MantenimientoInverndero/update/{id}',[MantenimientoInvernaderoController::class,'update'])->name('MantenimientoInverndero.update');

#routes de estados de la cosecha
Route::get('/EstadosCosecha/index',[EstadosCosechaController::class,'index'])->name('EstadosCosecha.index');
Route::get('/EstadosCosecha/create',[EstadosCosechaController::class,'create'])->name('EstadosCosecha.create');
Route::post('/EstadosCosecha/store',[EstadosCosechaController::class,'store'])->name('EstadosCosecha.store');
Route::post('/EstadosCosecha/destroy/{id}',[EstadosCosechaController::class,'destroy'])->name('EstadosCosecha.destroy');
Route::get('/EstadosCosecha/edit/{id}',[EstadosCosechaController::class,'edit'])->name('EstadosCosecha.edit');
Route::post('/EstadosCosecha/update/{id}',[EstadosCosechaController::class,'update'])->name('EstadosCosecha.update');

#routes de cosecha
Route::get('/Cosechas/index/{idinvernadero}',[CosechaController::class,'index'])->name('Cosechas.index');
Route::get('/Cosechas/create',[CosechaController::class,'create'])->name('Cosechas.create');
Route::post('/Cosechas/store',[CosechaController::class,'store'])->name('Cosechas.store');
Route::post('/Cosechas/destroy/{id}',[CosechaController::class,'destroy'])->name('Cosechas.destroy');
Route::get('/Cosechas/edit/{id}',[CosechaController::class,'edit'])->name('Cosechas.edit');
Route::post('/Cosechas/update/{id}',[CosechaController::class,'update'])->name('Cosechas.update');

#routes de ingresos
Route::get('/Ingresos/index',[IngresoController::class,'index'])->name('Ingresos.index');
Route::get('/Ingresos/create',[IngresoController::class,'create'])->name('Ingresos.create');
Route::post('/Ingresos/store',[IngresoController::class,'store'])->name('Ingresos.store');
Route::post('/Ingresos/destroy/{id}',[IngresoController::class,'destroy'])->name('Ingresos.destroy');
Route::get('/Ingresos/edit/{id}',[IngresoController::class,'edit'])->name('Ingresos.edit');
Route::post('/Ingresos/update/{id}',[IngresoController::class,'update'])->name('Ingresos.update');

#routes de Gastos
Route::get('/Gastos/index',[GastosController::class,'index'])->name('Gastos.index');
Route::get('/Gastos/create',[GastosController::class,'create'])->name('Gastos.create');
Route::post('/Gastos/store',[GastosController::class,'store'])->name('Gastos.store');
Route::post('/Gastos/destroy/{id}',[GastosController::class,'destroy'])->name('Gastos.destroy');
Route::get('/Gastos/edit/{id}',[GastosController::class,'edit'])->name('Gastos.edit');
Route::post('/Gastos/update/{id}',[GastosController::class,'update'])->name('Gastos.update');
