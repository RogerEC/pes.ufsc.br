<?php
    // Arquivo que armazena todas as rotas do site
    use Router\Route as Route;

    Route::get('/', 'Controller@showHomePage');

    Route::get('/links', 'Controller@showLinksPage');

    Route::get(['set' => '/error/{code}', 'as' => 'pageError'], 'Controller@showErrorPage');

    Route::get('/login', 'Controller@showLoginPage');

    Route::post('/login', 'Controller@checkLogin');

    Route::get('/logout', 'Controller@makeLogout');

    Route::get('/area-restrita', 'Controller@showRestrictedAreaPage');

    Route::get('/recuperar-senha', 'Controller@showRecoverPasswordPage');

    Route::get('/validar/{user}/{code}', 'Controller@showValidationPage');

    Route::get('/processo-seletivo', 'Controller@showPSsPage');
    
    Route::get('/processo-seletivo/{department}', 'Controller@showHomePSPage');

    Route::post('/processo-seletivo/{department}', 'Controller@checkSubscriptionPS');
    
    Route::get('/processo-seletivo/{department}/inscricao', 'Controller@showSubscriptionPSPage');

    Route::post('/processo-seletivo/{department}/inscricao', 'Controller@saveSubscriptionPS');
    
    Route::get('/contato', 'Controller@showContactPage');
    
    Route::get('/hall-da-fama', 'Controller@showHallOfFamePage');

    Route::get('/sobre-nos/quem-somos', 'Controller@showWhoWeArePage');

    Route::get('/sobre-nos/nossa-equipe', 'Controller@showOurTeamPage');

    Route::get('/sobre-nos/nossa-historia', 'Controller@showOurStoryPage');

    Route::get('/sobre-nos', 'Controller@showAboutUsPage');

    Route::get('/usuario/{userType}', 'Controller@showUserPage');

    Route::get('/usuario/{userType}/{subPage}', 'Controller@showUserSubPage');

    Route::get('/candidato/{userType}', 'Controller@showCandidatePage');

    Route::get('/candidato/{userType}/{subPage}', 'Controller@showCandidateSubPage');

    //Route::get('', '');

    //Route::get('', '');

    //Route::get('', '');
