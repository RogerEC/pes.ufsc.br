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
        $validator = new DataValidator;

        $cleanData = $validator->validatePostLinks($request->all());

        if($cleanData->validationStatus){
            $insertBD = new InsertDB;
            $insertBD->addNewLink($cleanData);
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
        $validator = new DataValidator;

        $cleanData = $validator->validatePostLinks($request->all());

        if($cleanData->validationStatus){
            $updateBD = new UpdateDB;
            $updateBD->updateLinks($cleanData);
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
        $validator = new DataValidator;

        $cleanIdLink = $validator->validateInt($request->__get('idLink'));
        
        if($cleanIdLink !== false){
            $deleteDB = new DeleteDB;
            if($deleteDB->deleteLink($cleanIdLink) == 1){
                echo true;
                return;
            }
        }
        echo false;
    }
}