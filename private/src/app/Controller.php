<?php
// Classe responsável por atender as requisições do cliente e enviar as páginas/respostas

namespace App;

class Controller
{
    public function showPageError($code){
        require __DIR__."/../view/pages/error.php";
    }
}
