<?php 
// Controlador para o acesso ao site. Login, Logout, Recuperação de senha
namespace App\Controller;

use App\Page;
use Router\Request;
use App\Authenticator;

class Access {
    
    // exibe a página de login
    public function showLoginPage($errorCode = null)
    {
        if(!Authenticator::checkLogin()){
            /*$page = new Page;
            $page->setTitle("Login - Cursinho PES");
            //$page->setRobots("index, follow");
            $page->setDescription("Página de Login para a área restrita do site do Cursinho PES, curso pré-vestibular social da UFSC Campus Araranguá-SC.");
            $page->setClassBody("bg-links text-center");
            $page->includeScriptCSS("login.css");
            $page->includeScriptJS("pages/login.js");
            $page->notIncludeFooter();
            $page->notIndludeNavbar();
            $page->includeFileAtMain("pages/login.php");
            $page->renderPage($errorCode);*/
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
        
        $statusLogin = Authenticator::makeLogin($user, $password);

        if($statusLogin === true) {
            
            $url = Authenticator::getUserURL();
            
            if($url === "401"){
                Page::showErrorHttpPage($url);
            } else {
                header("Location: $url");
                exit();
            }
            
        } else {
            $this->showLoginPage($statusLogin);
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