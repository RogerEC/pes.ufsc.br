<?php 
// Controlador para o acesso ao site. Login, Logout, Recuperação de senha
namespace App\Controller;

use App\Page;
use Router\Request;
use App\Authenticator;

class Access {
    
    // exibe a página de login
    public function showLoginPage($errorData = [])
    {
        if(!Authenticator::checkLogin()){
            
            Page::render('@public/login.html', $errorData);

        }else{
            
            $url = Authenticator::getUserURL();
            
            if($url === "401"){
                Page::showErrorHttpPage($url);
            } else {
                header("Location: $url");
                exit();
            }
        }
    }

    // checa se os dados de login estão corretos e redireciona para a 
    // página de usuário específica a depender do perfil do usuário logado
    public function checkLogin()
    {
        $request = new Request();
        
        $user = strtolower(trim($request->__get("user")));
        $password = $request->__get("password");
        
        $callback = Authenticator::makeLogin($user, $password);

        if($callback['loginStatus'] === true) {
            
            $url = Authenticator::getUserURL();
            
            if($url === "401"){
                Page::showErrorHttpPage($url);
            } else {
                header("Location: $url");
                exit();
            }
            
        } else {
            $this->showLoginPage($callback);
        }
    }

    public function makeLogout()
    {
        Authenticator::makeLogout();
        header("Location: /login");
        exit();
    }

    //exibe a página para recuperação de senha
    public function showRecoverPasswordPage()
    {
        echo "Recuperação de senha";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // realiza a validação do código de email
    public function showValidationPage($user, $code)
    {
        echo "Validação de e-mail <br>";
        echo "user: ".$user."   |   code: ".$code;
        echo "<br><a href='/'>Voltar ao início</a>";
    }
}