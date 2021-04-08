<?php
    // Arquivo que armazena todas as rotas do site
use Router\Route as Route;

Route::get('/', 'PublicArea@showHomePage');

    Route::get('/links', 'PublicArea@showLinksPage');

    Route::get(['set' => '/error/{code}', 'as' => 'pageError'], 'General@showErrorPage');

    Route::get('/login', 'Access@showLoginPage');

    Route::post('/login', 'Access@checkLogin');

    Route::post('/logout', 'Access@makeLogout');

    Route::get('/recuperar-senha', 'Access@showRecoverPasswordPage');

    Route::get('/validar/{user}/{code}', 'Access@showValidationPage');

    Route::get('/processo-seletivo', 'SelectionProcesses@showPSsPage');
    
    Route::get('/processo-seletivo/{department}', 'SelectionProcesses@showHomePSPage');

    Route::post('/processo-seletivo/{department}', 'SelectionProcesses@checkSubscriptionPS');
    
    Route::get('/processo-seletivo/{department}/inscricao', 'SelectionProcesses@showSubscriptionPSPage');

    Route::post('/processo-seletivo/{department}/inscricao', 'SelectionProcesses@saveSubscriptionPS');
    
    Route::get('/contato', 'PublicArea@showContactPage');

    Route::post('/contato', 'PublicArea@sendContactEmail');
    
    Route::get('/hall-da-fama', 'PublicArea@showHallOfFamePage');

    Route::get('/sobre-nos/quem-somos', 'PublicArea@showWhoWeArePage');

    Route::get('/sobre-nos/nossa-equipe', 'PublicArea@showOurTeamPage');

    Route::get('/sobre-nos/nossa-historia', 'PublicArea@showOurStoryPage');

    Route::get('/sobre-nos', 'PublicArea@showAboutUsPage');

    Route::get('/usuario/{userType}', 'RestrictedArea@showUserPage');

    Route::get('/usuario/{userType}/{subPage}', 'RestrictedArea@showUserSubPage');

    Route::get('/candidato/{userType}', 'RestrictedArea@showCandidatePage');

    Route::get('/candidato/{userType}/{subPage}', 'RestrictedArea@showCandidateSubPage');

    Route::post(['set' => '/usuario/gestor/links/save', 'namespace' => 'App\\Controller\\RestrictedArea\\'], 'Users@saveLinks');

    Route::post(['set' => '/usuario/gestor/links/edit', 'namespace' => 'App\\Controller\\RestrictedArea\\'], 'Users@editLinks');

    Route::post(['set' => '/usuario/gestor/links/delete', 'namespace' => 'App\\Controller\\RestrictedArea\\'], 'Users@deleteLinks');

    //Route::get('', '');
