<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\SucursalController;

Route::resource('sucursales', SucursalController::class)
    ->parameters([
        'sucursales' => 'sucursal'
    ]);

use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);

use App\Http\Controllers\ClienteController;

Route::resource('clientes', ClienteController::class);

use App\Http\Controllers\PremioController;

Route::resource('premios', PremioController::class);

use App\Http\Controllers\MovimientoPuntoController;

Route::resource('movimientos', MovimientoPuntoController::class);

Route::post('/canjear', [MovimientoPuntoController::class, 'canjear'])->name('canjear');

Route::get('/movimientos/crear/{token}', [MovimientoPuntoController::class, 'crearDesdeQR']);

use App\Http\Controllers\WalletController;

Route::get('/ayuda/{token}', [WalletController::class, 'ayuda'])->name('ayuda');

Route::get('/privacidad/{token}', [WalletController::class, 'privacidad'])->name('privacidad');
Route::get('/terminos/{token}', [WalletController::class, 'terminos'])->name('terminos');

Route::get('/cliente/{token}', [WalletController::class, 'show'])
    ->name('wallet.show');

Route::get('/perfil/{token}', [WalletController::class, 'perfil'])->name('perfil');

Route::get('/test-twilio', [MovimientoPuntoController::class, 'testTwilio']);

Route::get('/validar-cliente/{token}', function ($token) {
    $cliente = \App\Models\Cliente::where('token', $token)->first();
    return response()->json($cliente);
});

require __DIR__.'/auth.php';
