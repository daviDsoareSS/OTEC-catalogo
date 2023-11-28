<?php

use App\Http\Controllers\Adm\TesteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adm\LoginController;
use App\Http\Controllers\Adm\LogoutController;
use App\Http\Controllers\Adm\ForgotPasswordController;
use App\Http\Controllers\Adm\SitemapXmlController;
use App\Http\Controllers\Adm\LeadController;
use App\Http\Controllers\Adm\ContatoController;
use App\Http\Controllers\Adm\AcompanheController;
use App\Http\Controllers\Adm\ClientesController;
use App\Http\Controllers\Adm\PerfilController;
use App\Http\Controllers\Adm\MetatagsController;
use App\Models\AcompanheModel;

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

Route::prefix('adm')->group(function() {
    Route::group(['middleware' => ['guest']], function() {
        Route::get('/login', [LoginController::class, 'show'])->name('login.show');
        Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

        Route::get('/login/recuperar-senha', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forget.password-recovery');
        Route::post('forgot/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot.email');
        Route::get('forgot/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('forgot/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');


    });
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    });

    Route::middleware('auth.prefix')->group(function () {
        Route::get('/sitemap.xml', function () {
            return response()->file(public_path('sitemap.xml'));
        });

        Route::get('/', function() {
            $acompanhelist = AcompanheModel::count();
            return view('adm.home', compact('acompanhelist'));
        })->name('index');

        Route::get('/leads/selected', [LeadController::class, 'selected'])->name("leads.selected");
        Route::delete('/leads/destroy', [LeadController::class, 'destroy'])->name('leads.destroy');
        Route::resource('/leads', LeadController::class)->except(['destroy']);

        Route::get('/contato/selected', [ContatoController::class, 'selected'])->name("contato.selected");
        Route::delete('/contato/destroy', [ContatoController::class, 'destroy'])->name('contato.destroy');
        Route::resource('/contato', ContatoController::class)->except(['destroy']);

        Route::get('/acompanhe/selected', [AcompanheController::class, 'selected'])->name("acompanhe.selected");
        Route::get('/acompanhe/order', [AcompanheController::class, 'orderIndex'])->name('acompanhe.order');
        Route::post('/acompanhe/order', [AcompanheController::class, 'orderUpdate'])->name('acompanhe.order-update');
        Route::post('/acompanhe/ckeditor-upload', [AcompanheController::class, 'ckeditorUpload'])->name('acompanhe.ckeditor-upload');
        Route::delete('/acompanhe/destroy', [AcompanheController::class, 'destroy'])->name("acompanhe.destroy");
        Route::resource('/acompanhe', AcompanheController::class)->except(['destroy']);

        Route::get('/clientes/selected', [ClientesController::class, 'selected'])->name("clientes.selected");
        Route::delete('/clientes/destroy', [ClientesController::class, 'destroy'])->name('clientes.destroy');
        Route::resource('/clientes', ClientesController::class)->except(['destroy']);


        Route::delete('/metatags/destroy', [MetatagsController::class, 'destroy'])->name("metatags.destroy");
        Route::resource('/metatags', MetatagsController::class)->except(['destroy', 'show', 'create', 'edit']);


        Route::get('/seo', function() {
            return view('adm.seo.index');
        })->name('seo.index');

        Route::post('/seo/updateFile', [SitemapXmlController::class, 'updateFile'])->name('seo.update');

        Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
        Route::post('/perfil', [PerfilController::class, 'update'])->name('perfil.update');
        Route::get('/perfil/delete-image', [PerfilController::class, 'deleteImage'])->name('perfil.delete-image');
    });
});

Route::prefix('login')->group(function() {
    Route::view('/', 'login.login');
});

// AQUI VEM AS PÁGINAS DO SITE EM SI, ESSE MIDDLEWARE retorna a metatag cadastrada na ADM e retorna para as páginas
Route::group(['middleware' => 'metatags', 'name' => 'paginas'], function () {
    Route::view('/catalogo', 'pages.catalogo.index')->name('index');
    Route::view('/catalogo/a-empresa', 'pages.catalogo.a-empresa')->name('a-empresa');
    Route::view('/catalogo/produto', 'pages.catalogo.product')->name('produto');
    Route::view('/catalogo/contato', 'pages.catalogo.contato')->name('contato');
});
