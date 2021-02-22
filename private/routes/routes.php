<?php
    // Arquivo que armazena todas as rotas do site
    use Router\Route as Route;

    Route::get('/', 'Controller@showHomePage');

    Route::get('/links', 'Controller@showLinksPage');

    Route::get(['set' => '/error/{code}', 'as' => 'pageError'], 'Controller@showErrorPage');
