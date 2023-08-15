<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;

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

// Route::get('/', function () {
//     return view(
//         'home',
//         [
//             'title' => 'Home | Fahri',
//             'navbar' => 'muh._.fahri'
//         ]
//     );
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/biodata', [BiodataController::class, 'index']);

Route::get('/pesan', [PesanController::class, 'index']);

Route::get('/produk', [ProdukController::class, 'index']);
// Route::get('produk/{id}/{kategori}', [ProdukController::class, 'show']);
// Route::get('produk/{id}', [ProdukController::class, 'abc']);

Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);

// Route::get('/login', [RegisterController::class, 'index']);
// Route::post('/login', [RegisterController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);