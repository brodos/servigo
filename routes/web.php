<?php

Route::get('/locale', function() {
	dd(App::getLocale());
});
// Homepage
Route::get('/', 'HomeController@index')->name('home');

// Static pages
Route::get('/ajutor', 'StaticController@help')->name('help');

// Auth::routes();

// Authentication
Route::get('/autentificare', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/autentificare', 'Auth\LoginController@login');
Route::get('/iesire', 'Auth\LoginController@logout')->name('logout');

// Registration
Route::get('/inregistrare', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/inregistrare', 'Auth\RegisterController@register');	

// Reset password
Route::get('parola/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('parola/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('parola/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('parola/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email verification
Route::get('email/verifica', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verifica/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/retrimite', 'Auth\VerificationController@resend')->name('verification.resend');

// Public profile
Route::get('/p/{slug_name}', 'ProfilesController@show')->name('public-profile');
// Search
Route::get('/anunturi/{category?}/{county?}', 'SearchController@show')->name('search.show');

Route::get('/anunt/{project}', 'ProjectsController@show')->name('project.show');
Route::get('/anunt/{project}/trimite-oferta', 'User\ProposalsController@create')->name('user-proposal.create')->middleware('auth', 'verified');
Route::post('/anunt/{project}/trimite-oferta', 'User\ProposalsController@store')->name('user-proposal.store')->middleware('auth', 'verified');

Route::post('/anunt/{project}/favorita', 'User\FavoriteProjectsController@store')->name('user-project.favorite')->middleware('auth', 'verified');
Route::delete('/anunt/{project}/favorita', 'User\FavoriteProjectsController@destroy')->name('user-project.unfavorite')->middleware('auth', 'verified');

// Authenticated user routes
Route::middleware('auth', 'verified')->namespace('User')->prefix('/contul-meu')->group(function () {

	Route::get('/adauga-anunt', 'ProjectsController@create')->name('user-project.create');
	Route::post('/adauga-anunt', 'ProjectsController@store')->name('user-project.store');

	Route::get('/anunturi', 'ProjectsController@index')->name('user-project.index');
	
	Route::get('/anunturi/{project}', 'ProjectsController@show')->name('user-project.show');
	Route::get('/anunturi/{project}/modifica', 'ProjectsController@edit')->name('user-project.edit');
	Route::put('/anunturi/{project}', 'ProjectsController@update')->name('user-project.update');
	Route::delete('/anunturi/{project}', 'ProjectsController@destroy')->name('user-project.destroy');

	Route::get('/anunturi/{project}/oferte', 'ProjectProposalsController@index')->name('user-project-proposals.index');
	Route::get('/anunturi/{project}/oferta/{proposal}', 'ProjectProposalsController@show')->name('user-project-proposals.show');
	Route::patch('/anunturi/{project}/oferta/{proposal}', 'AcceptProposalsController@store')->name('user-project-proposals.accept');
	Route::delete('/anunturi/{project}/oferta/{proposal}', 'AcceptProposalsController@update')->name('user-project-proposals.unaccept');
	Route::get('/anunturi/{project}/oferte-favorite', 'FavoriteProposalsController@index')->name('user-project-favorites.index');
	Route::get('/anunturi/{project}/mesaje', 'ProjectConversationsController@index')->name('user-project-conversations.index');
	Route::get('/anunturi/{project}/mesaje/{conversation}', 'ProjectConversationsController@show')->name('user-project-conversations.show');
	Route::get('/anunturi/{project}/promovare', 'ProjectPromoteController@show')->name('user-project-promote.show');

	Route::get('/oferte', 'ProposalsController@index')->name('user-proposal.index');
	Route::get('/oferte/{proposal}', 'ProposalsController@show')->name('user-proposal.show');
	Route::get('/oferte/{proposal}/modifica', 'ProposalsController@edit')->name('user-proposal.edit');
	Route::put('/oferte/{proposal}', 'ProposalsController@update')->name('user-proposal.update');
	Route::post('/oferte/{proposal}/favorita', 'FavoriteProposalsController@store')->name('user-proposal.favorite');
	Route::delete('/oferte/{proposal}/favorita', 'FavoriteProposalsController@destroy')->name('user-proposal.unfavorite');
	Route::patch('/oferte/{proposal}/ascunde', 'DismissProposalsController@update')->name('user-proposal.dismiss');
	Route::patch('/oferte/{proposal}/retrage', 'WithdrawProposalsController@update')->name('user-proposal.withdraw');
	Route::patch('/oferte/{proposal}/confirma', 'ConfirmProposalsController@store')->name('user-proposal.confirm');
	

	Route::get('/favorite', 'FavoritesController@index')->name('user-favorite.index');
	
	Route::get('/mesaje', 'ConversationsController@index')->name('user-conversation.index');
	Route::get('/mesaje/{project}/{proposal}', 'ConversationsController@store')->name('user-conversation.store');
	Route::get('/mesaje/{conversation}', 'ConversationsController@show')->name('user-conversation.show');
	Route::post('/mesaje/{conversation}', 'MessageController@store')->name('user-message.store');

	// Profil
	Route::get('/profil', 'ProfileController@show')->name('user-profile.show');
	Route::get('/profil/modifica', 'ProfileController@edit')->name('user-profile.edit');
	Route::put('/profil', 'ProfileController@update')->name('user-profile.update');
	Route::put('/profil/media', 'ProfileMediaController@store')->name('user-profile-media.store');
	Route::delete('/profil/media/{media}', 'ProfileMediaController@destroy')->name('user-profile-media.destroy');
	
	Route::get('/setari', 'AccountController@edit')->name('user-account.edit');

});


/*

*/
// Client routes
/*
Route::middleware(['auth', 'can:client'])->namespace('Client')->group(function() {

	Route::get('/proiecte', 'ProjectsController@index')->name('client-projects.index');
	Route::get('/proiecte/ciorne', 'DraftProjectsController@index')->name('client-draft-projects.index');
	Route::get('/proiect/creaza', 'ProjectsController@create')->name('client-projects.create');
	Route::post('/proiect/creaza', 'ProjectsController@store')->name('client-projects.store');
	Route::get('/proiect/{project}', 'ProjectsController@show')->name('client-projects.show');
	Route::get('/proiect/{project}/modifica', 'ProjectsController@edit')->name('client-projects.edit');
	Route::patch('/proiect/{project}/modifica', 'ProjectsController@update')->name('client-projects.update');
	Route::delete('/proiect/{project}/sterge', 'ProjectsController@destroy')->name('client-projects.destroy');
	Route::get('/proiect/{project}/oferta/{proposal}', 'ProposalsController@show')->name('client-proposal.show');

	Route::post('/proiect/{project}/oferta/{proposal}/salveaza', 'ProposalsActionController@save')->name('client-save-proposal');
	Route::post('/proiect/{project}/oferta/{proposal}/accepta', 'ProposalsActionController@accept')->name('client-accept-proposal');
	Route::post('/proiect/{project}/oferta/{proposal}/elimina', 'ProposalsActionController@dismiss')->name('client-dismiss-proposal');
	Route::post('/proiect/{project}/oferta/{proposal}/citest', 'ProposalsActionController@read')->name('client-read-proposal');

	Route::get('/acorda-calificativ/{project}', 'FeedbackController@create')->name('client-feedback.create');
	Route::post('/acorda-calificativ/{project}', 'FeedbackController@store')->name('client-feedback.store');

	Route::post('/trimite-mesaj/{project}', 'MessagesController@store')->name('client-message.store');
});
*/
// Contractor routes
/*
Route::middleware(['auth','can:contractor'])->namespace('Contractor')->prefix('c')->group(function() {
	Route::get('/oferte', 'ProposalsController@index')->name('contractor-proposals.index');
	Route::get('/cauta/proiecte', 'SearchController@show')->name('contractor-search-projects.show');
	Route::get('/proiect/{project}', 'ProjectsController@show')->name('contractor-projects.show');
	Route::get('/proiect/{project}/oferta/creaza', 'ProposalsController@create')->name('contractor-proposals.create');
	Route::post('/proiect/{project}/oferta/creaza', 'ProposalsController@store')->name('contractor-proposals.store');
	Route::get('/proiect/{project}/oferta/{proposal}', 'ProposalsController@show')->name('contractor-proposals.show');
	Route::patch('/proiect/{project}/oferta/{proposal}/confirma', 'ProposalsController@update')->name('contractor-proposals.confirm');
	Route::post('/proiect/{project}/oferta/{proposal}/retrage', 'ProposalsController@destroy')->name('contractor-proposals.destroy');
	
	Route::get('/proiecte-in-desfasurare', 'OngoingProjectsController@index')->name('contractor-ongoing-projects.index');
	Route::get('/proiecte-in-desfasurare/{project}', 'OngoingProjectsController@show')->name('contractor-ongoing-projects.show');

	Route::get('/proiecte-finalizate', 'CompletedProjectsController@index')->name('contractor-completed-projects.index');
	Route::get('/proiecte-finalizate/{project}', 'CompletedProjectsController@show')->name('contractor-completed-projects.show');

	Route::get('/acorda-calificativ/{project}', 'FeedbackController@create')->name('contractor-feedback.create');
	Route::post('/acorda-calificativ/{project}', 'FeedbackController@store')->name('contractor-feedback.store');
	Route::get('/calificativ/{project}/raspuns', 'FeedbackController@reply')->name('contractor-feedback.reply');
	Route::post('/calificativ/{project}/raspuns', 'FeedbackController@storeReply')->name('contractor-feedback.storeReply');

	Route::get('/mesaje', 'MessagesController@index')->name('contractor-messages.index');
	Route::get('/mesaje/{project}', 'MessagesController@show')->name('contractor-messages.show');
	Route::post('/mesaje/{project}', 'MessagesController@store')->name('contractor-messages.store');
});
*/