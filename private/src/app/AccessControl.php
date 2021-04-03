<?php 
// classe responsável por gerenciar e controlar o acesso as páginas privadas que requerem login do usuário
namespace App;

use Database\SelectDB;
use Database\UpdateDB;

class AccessControl
{
    // Verifica se o usuário está logado
    public function checkLogin()
    {
        return (isset($_SESSION['userId']) && !empty($_SESSION['userId']))? true:false;
    }

    // Pega o id do usuário caso ele esteja logado ou retorna null caso contrário
    public function getUserID()
    {
        if ($this->checkLogin()) {
            return $_SESSION['userId'];
        } else {
            return null;
        }
    }

    // verifica se o usuário é usuário (true) ou candidato (false)
    public function isUser() 
    {
        if(!$this->checkLogin()) {
            $this->makeLogout();
            return "401";
        }
        return ($this->getUserType() === 'G' || $this->getUserType() === 'GP'
        || $this->getUserType() === 'A' || $this->getUserType() === 'P')? true:false;
    }

    // retorna o departamento do usuário dependendo do seu tipo
    public function getDepartment()
    {
        if(!$this->checkLogin()) {
            $this->makeLogout();
            return "401";
        }
        switch($this->getUserType()){
            case 'G':
            case 'GP':
            case 'CG':
                $departament = 'gestor';
                break;
            case 'A':
            case 'CA':
                $departament = 'aluno';
                break;
            case 'CP':
            case 'P':
                $departament = 'professor';
                break;
            case 'MH':
                $departament = 'membro-honorario';
                break;
            case 'ADMIN':
                $departament = 'administrador';
                break;
            default:
                $departament = "401";
                $this->makeLogout();
        }
        return $departament;
    }

    // retorna a URL para a página restrita inicial específica dependendo do tipo de usuário
    public function getUserURL() {
        if ($this->checkLogin()) {
            switch($this->getUserType()){
                case 'G':
                case 'GP':
                    $url = '/usuario/gestor';
                    break;
                case 'A':
                    $url = '/usuario/aluno';
                    break;
                case 'P':
                    $url = '/usuario/professor';
                    break;
                case 'MH':
                    $url = '/usuario/membro-honorario';
                    break;
                case 'ADMIN':
                    $url = '/area-51/administrador';
                    break;
                case 'CA':
                    $url = '/candidato/aluno';
                    break;
                case 'CG':
                    $url = '/candidato/gestor';
                    break;
                case 'CP':
                    $url = '/candidato/professor';
                    break;
                default:
                    $url = "401";
                    $this->makeLogout();
            }
            return $url;
        } else {
            $this->makeLogout();
            return "401";
        }
    }

    // Pega o typo do usuário caso esteja logado ou retorna null caso contrário
    public function getUserType()
    {
        if ($this->checkLogin()) {
            return $_SESSION['userType'];
        } else {
            return null;
        }
    }

    // Verifica se os dados de login estão corretos e se sim, loga o usuário ou retorna erro.
    public function makeLogin($user, $password)
    {
        $select = new SelectDB;
        $userLoginData = $select->getUserLoginData($user);

        if(!empty($userLoginData)) {
            
            // verifica se a senha informada corresponde ao hash armazenado
            if( password_verify($password, $userLoginData->passwordHash) ) {
                
                // verifica se é necessário atualizar o hash armazenado
                if (password_needs_rehash($userLoginData->passwordHash, PASSWORD_DEFAULT)) {
                    
                    // se for necessário atualizar, gera o novo hash e realiza um update no banco
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $update = new UpdateDB;
                    $update->updatePasswordHash($userLoginData->idUser, $newHash);
                }
                //efetua o login do usuário persistindo seu id e tipo
                $_SESSION['userId'] = $userLoginData->idUser;
                $_SESSION['userType'] = $userLoginData->type;
                
                return true;

            } else {
                // caso a senha não corresponda ao hash, informa o erro de senha
                $this->makeLogout();
                return ["wrongPassword", $user];
            }
        } else {
            // caso a consulta do banco volte vazia, informa que o usuário não foi encontrado
            $this->makeLogout();
            return ["userNotFound", $user];
        }
    }

    // Destrói a sessão, deslogando o usuário do sistema.
    public function makeLogout()
    {
        $_SESSION = array();

        if(ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time()-42000, $params['path'],
            $params['domain'], $params['secure'], $params["httponly"]);
        }

        session_destroy();
    }
}




