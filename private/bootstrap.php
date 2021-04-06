<?php
    // Arquivo de inicialização do sistema
    error_reporting(E_ALL);
    ini_set('display_errors', true);
    ini_set('default_charset', 'utf-8');
     
    require __DIR__ . '/vendor/autoload.php';
     
    session_start();
     
    try {
     
        require __DIR__ . '/routes/routes.php';
     
    } catch(\Exception $e){
         
        echo $e->getMessage();
    }
?>