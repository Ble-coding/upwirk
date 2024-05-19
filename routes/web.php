<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\ProposalController;
// use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\ConversationController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/jobs', [EmploiController::class, 'index'])->name('jobs.index');


// Route::get('/home', [ProposalController::class, 'home'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', function( ){
    //     return view('home');
    // })->name('home');
    Route::get('/jobs/{emploi}', [EmploiController::class, 'show'])->name('jobs.show');
    Route::get('/home', [ProposalController::class, 'home'])->name('home');   

    Route::get('/conversations', [ConversationController::class, 'index'])->name('conversations.index');
    Route::get('/conversation/{conversation}', [ConversationController::class, 'show'])->name('conversation.show');

    Route::get('/confirmProposal/{proposal}', [ConversationController::class, 'store'])->name('confirm.proposal');
 
});

// Route::group(['middleware' => ['auth', 'proposal']], function () {
//     Route::get('/proposals/{emploi}', [ProposalController::class, 'show'])->name('proposals.submit');
//     // Route::get('/submit/{emploi}', [ProposalController::class, 'store'])->name('proposals.store');  
//     Route::post('/proposals/{jobId}', [ProposalController::class, 'store'])->name('proposals.submit.store');
// });

Route::group(['middleware' => ['auth', 'proposal']], function () {
    Route::get('/proposals/{emploi}', [ProposalController::class, 'show'])->name('proposals.submit');     
    Route::post('/proposals/{emploi}', [ProposalController::class, 'store'])->name('proposals.submit.store');
});

