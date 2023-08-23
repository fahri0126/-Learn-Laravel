<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUnitController;
use App\Http\Controllers\DashboardProdukController;
use App\Http\Controllers\DashboardKategoriController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::group(['middleware' => ['auth', 'admin:2']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/produk', DashboardProdukController::class)->names('dashboardProduk');
    Route::resource('/dashboard/kategori', DashboardKategoriController::class)->names('dashboardKategori')->except('show');
    Route::resource('/dashboard/unit', DashboardUnitController::class)->names('dashboardUnit')->except('show');
});
