<?php 
// Controlador para área restrita a usuários
namespace App\Controller\RestrictedArea;

use App\Controller\RestrictedArea;
use Router\Request;
use Database\UpdateDB;
use Database\InsertDB;
use Database\DeleteDB;
use App\DataValidator;
class Users extends RestrictedArea {
    
    // sava os dados do post de alteração de links
    public function saveLinks()
    {
        $request = new Request;

        $cleanData = DataValidator::validatePostLinks($request->all());

        if($cleanData->validationStatus){
            InsertDB::addNewLink($cleanData);
            header('Location: /usuario/gestor/links');
            exit();
        }else {
            echo "Erro ao salvar dados<br>";
            echo var_dump($cleanData->errorMessage);
            echo "<br><a href='/usuario/gestor/links'>Clique aqui </a> para voltar";
        }
    }

    public function editLinks()
    {
        $request = new Request;

        $cleanData = DataValidator::validatePostLinks($request->all());

        if($cleanData->validationStatus){
            UpdateDB::updateLinks($cleanData);
            header('Location: /usuario/gestor/links');
            exit();
        }else {
            echo "Erro ao editar dados<br>";
            echo var_dump($cleanData->errorMessage);
            echo "<br><a href='/usuario/gestor/links'>Clique aqui </a> para voltar";
        }
    }

    public function deleteLinks()
    {
        $request = new Request;

        $cleanIdLink = DataValidator::validateInt($request->__get('idLink'));
        
        if($cleanIdLink !== false){
            if(DeleteDB::deleteLink($cleanIdLink) == 1){
                echo true;
                return;
            }
        }
        echo false;
    }
}