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

    // sava os dados do post de alteração de links
    public function saveUser()
    {
        $request = new Request;

        $cleanData = DataValidator::validateUserData($request->all());

        if($cleanData->validationStatus){
            $result = InsertDB::addNewUser($cleanData);
            if($result === true){
                header('Location: /usuario/gestor/users');
            }else{
                echo "Erro no banco ao salvar dados<br>";
                echo var_dump($result);
                echo "<br><a href='/usuario/gestor/users'>Clique aqui </a> para voltar a página anterior.";
            }
            exit();
        }else {
            echo "Erro ao salvar dados<br>";
            echo var_dump($cleanData->errorMessage);
            echo "<br><a href='/usuario/gestor/users'>Clique aqui </a> para voltar a página anterior.";
        }
    }

    // realiza a edição dos dados do usuário
    public function editUser()
    {
        $request = new Request;

        $cleanData = DataValidator::validateUserData($request->all());

        if($cleanData->validationStatus){
            UpdateDB::updateUser($cleanData);
            header('Location: /usuario/gestor/users');
            exit();
        }else {
            echo "Erro ao editar os dados do usuário<br>";
            echo var_dump($cleanData->errorMessage);
            echo "<br><a href='/usuario/gestor/users'>Clique aqui </a> para voltar";
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

    // deleta o usuário da base de dados
    public function deleteUser()
    {
        $request = new Request;

        $cleanIdLink = DataValidator::validateInt($request->__get('idUser'));
        
        if($cleanIdLink !== false){
            
            if(DeleteDB::deleteUser($cleanIdLink) == 1){
                // delata os arquivos de imagem associados ao usuário de existirem;
                unlink(DIR_PUBLIC_HTML.'assets/img/users/'.strval($cleanIdLink).'.png');
                unlink(DIR_PUBLIC_HTML.'assets/img/users/'.strval($cleanIdLink).'.jpg');
                unlink(DIR_PUBLIC_HTML.'assets/img/users/'.strval($cleanIdLink).'.jpge');
                echo true;
                return;
            }
        }
        echo false;
    }

    public function editProfile($userType){

        if($userType === 'professor' || $userType === 'gestor' || $userType === 'aluno'){
            $request = new Request;

            $cleanData = DataValidator::validateUserProfileData($request->all());

            // verifica se os dados são válidos
            if($cleanData->validationStatus){

                // verifica se foi feito upload do arquivo de imagem
                if($request->hasFile('profileImage')) {

                    //verifica se o arquivo está dentro dos parametros
                    $validateImage = DataValidator::validateImageFiles($request->file('profileImage'));
                    // se o arquivo for válido
                    if($validateImage->validationStatus){
                        if($request->file('profileImage')['error'] === 4){
                            $updateResult = UpdateDB::updateUserProfile($cleanData, $cleanData->photoFile);
                        
                            // realiza o upload do arquivo para a pasta especifica
                        }else if (move_uploaded_file($request->file('profileImage')['tmp_name'], DIR_PUBLIC_HTML . '/assets/img/users/' . strval($cleanData->idUser) . "." . $validateImage->extension)){
                            $updateResult = UpdateDB::updateUserProfile($cleanData, strval($cleanData->idUser) . "." . $validateImage->extension);
                        } else {
                            echo "Erro ao gravar arquivo de imagem";
                        }
                    }else{
                        echo "Arquivo de imagem inválido";
                    }
                }else {
                    echo "AQUI 01";
                    $updateResult = UpdateDB::updateUserProfile($cleanData, $cleanData->photoFile);
                }
                
                // verifica se ouve sucesso em atualizar os dados
                if($updateResult === true){
                    header("Location: /usuario/$userType/profile");
                    exit();
                }else if($updateResult === "ERROR-000") {
                    echo "Erro ao gravar no banco 01";
                }else if ($updateResult === "ERROR-001"){
                    echo "Erro ao gravar no banco 02";
                } else {
                    echo "Erro desconhecido";
                }
            }else {
                echo "Erro ao editar dados de perfil<br>";
                echo var_dump($cleanData->errorMessage);
                echo "<br><a href='/usuario/$userType/profile'>Clique aqui </a> para voltar";
            }
        } else {
            echo "Tipo de usuário não definido!";
        }

        
    }
}