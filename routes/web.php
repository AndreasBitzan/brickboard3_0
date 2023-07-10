<?php

use App\Http\Controllers\TopicController;
use App\Models\Messageboard;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;

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

Route::localized(function () {
    Route::get('/', function () {
        return view('landing-page');
    })->name('home');
});

// Route::get('/', function () {
//     return view('landing-page');
// })->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::localized(function () {
        Route::get('/forum/{messageboard:slug}/'.Lang::uri('neues-thema'), function (Messageboard $messageboard) {
            return view('create-topic')->with(['messageboard' => $messageboard]);
        })->name('forum.create-topic');
    });
});

Route::localized(function () {
    Route::prefix('/forum')->group(function () {
        Route::get('/', function () {
            return view('forum');
        })->name('forum.overview');
        Route::get('/{messageboard:slug}', function (Messageboard $messageboard) {
            return view('forum-detail')->with(['messageboard' => $messageboard]);
        })->name('forum.detail');
        Route::get('/{messageboard:slug}/{topic:slug}', [TopicController::class, 'show'])->name('topic.detail');
    });
});

Route::localized(function () {
    Route::get('/'.Lang::uri('mitglieder'), function () {
        return view('members');
    })->name('members');
});

Route::localized(function () {
    Route::get('/'.Lang::uri('profil').'/{user:slug}', function (User $user) {
        return view('user-profile')->with(['user' => $user]);
    })->name('user.profile');
});

Route::fallback(\CodeZero\LocalizedRoutes\Controllers\FallbackController::class);
