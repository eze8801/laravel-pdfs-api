<?php

use App\Http\Controllers\PdfControlador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('pdfs', [PdfControlador::class, 'index']);
Route::get('pdfs/{id}', [PdfControlador::class, 'edit']);
Route::post('pdfs', [PdfControlador::class, 'store']);
Route::put('pdfs/{id}', [PdfControlador::class, 'update']);
Route::delete('pdfs/{id}', [PdfControlador::class, 'destroy']);
Route::get('pdfs/ref/{ref}', [PdfControlador::class, 'obtenerPorRef']);
