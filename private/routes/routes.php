<?php
    // Arquivo que armazena todas as rotas do site
    use Router\Route as Route;

    Route::get('/', function(){
        echo "Página inicial";
    });

    Route::get(['set' => '/error/{code}', 'as' => 'pageError'], 'Controller@showPageError');
