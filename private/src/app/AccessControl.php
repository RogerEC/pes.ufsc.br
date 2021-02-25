<?php 
// classe responsável por gerenciar o Login do Usuário
namespace App;

use Database\Database;

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
        if($user === 'rogerec'){
            if($password === '213465'){
                $_SESSION['userId'] = 1;
                $_SESSION['userType'] = 'G';
                return true;
            }else{
                $this->makeLogout();
                return ["wrongPassword", $user];
            }
        } else {
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




