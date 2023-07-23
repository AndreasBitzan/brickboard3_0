<?php

use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
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
            if (4 == $messageboard->id) {
                return view('create-brickfilm')->with(['messageboard' => $messageboard]);
            }

            return view('create-topic')->with(['messageboard' => $messageboard]);
        })->name('forum.create-topic');

        Route::get('/forum/'.Lang::uri('neuer-brickfilm'), function () {
            return view('create-brickfilm')->with(['messageboard' => Messageboard::find(4)]);
        })->name('forum.create-movie');

        Route::get('/'.Lang::uri('private-nachrichten'), function () {
            return view('private-messages');
        })->name('private-messages');

        Route::get('/'.Lang::uri('private-nachrichten').'/'.Lang::uri('neue-nachricht'), function () {
            return view('private-message-create');
        })->name('private-messages.create');
    });
    Route::get('/search-user', [UserController::class, 'search'])->name('user.search');
});

Route::localized(function () {
    Route::prefix('/forum')->group(function () {
        Route::get('/', function () {
            return view('forum');
        })->name('forum.overview');

        Route::get('/'.Lang::uri('filmvorstellungen'), function () {
            $messageboard = Messageboard::find(4);

            return view('brickfilms')->with(['messageboard' => $messageboard]);
        })->name('forum.brickfilms');

        Route::get('/{messageboard:slug}', function (Messageboard $messageboard) {
            return view('forum-detail')->with(['messageboard' => $messageboard]);
        })->name('forum.detail');

        Route::get('/{messageboard:slug}/{topic:slug}', [TopicController::class, 'show'])->name('topic.detail');
        Route::get('/{messageboard:slug}/{topic:slug}/'.Lang::uri('bearbeiten'), [TopicController::class, 'edit'])->name('topic.edit');
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
