<?php
// Classe responsável por atender as requisições do cliente e enviar as páginas/respostas

namespace App;

use App\Page;
use App\AccessControl;
use Database\SelectDB;
use Router\Request;
class Controller
{
    private $accessControl;

    public function __construct()
    {
        $this->accessControl = new AccessControl;
    }

    // exibe a página de erros http
    public function showErrorPage($code)
    {
        require __DIR__."/../view/pages/error.php";
    }

    // exibe a página inicial do site
    public function showHomePage()
    {   
        $page = new Page;
        $page->setTitle("Cursinho Projeto Educação Solidária");
        $page->setRobots("index, follow");
        $page->setDescription("Curso pré-vestibular social da Universidade Federal de Santa Catarina, Campus Araranguá, destinado a estudantes da rede pública de ensino da cidade de Araranguá, SC.");
        $page->setClassMain("h-100");
        $page->includeFileAtMain("pages/home.php");
        $page->renderPage();
    }

    // exibe a página com resumo de links para redirecionamento
    public function showLinksPage()
    {
        $select = new SelectDB;
        $links = $select->getActiveLinks();

        $page = new Page;
        $page->setTitle("Links - Cursinho PES");
        $page->setRobots("index, follow");
        $page->setDescription("Links para as redes sociais do Cursinho Projeto Educação Solidária, curso pré vestibular social da UFSC Campus Araranguá-SC.");
        $page->setClassBody("bg-links");
        $page->notIncludeFooter();
        $page->notIndludeNavbar();
        $page->includeScriptCSS("links.css");
        $page->includeFileAtMain("pages/links.php");
        $page->renderPage($links);
    }

    // exibe a página de login
    public function showLoginPage($errorCode = null)
    {
        if(!$this->accessControl->checkLogin()){
            $page = new Page;
            $page->setTitle("Login - Cursinho PES");
            //$page->setRobots("index, follow");
            $page->setDescription("Página de Login para a área restrita do site do Cursinho PES, curso pré-vestibular social da UFSC Campus Araranguá-SC.");
            $page->setClassBody("bg-links text-center");
            $page->includeScriptCSS("login.css");
            $page->includeScriptJS("pages/login.js");
            $page->notIncludeFooter();
            $page->notIndludeNavbar();
            $page->includeFileAtMain("pages/login.php");
            $page->renderPage($errorCode);
        }else{
            
            $url = $this->accessControl->getUserURL();
            
            if($url === "401"){
                $this->showErrorPage($url);
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
        
        $statusLogin = $this->accessControl->makeLogin($user, $password);

        if($statusLogin === true) {
            
            $url = $this->accessControl->getUserURL();
            
            if($url === "401"){
                $this->showErrorPage($url);
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
        $this->accessControl->makeLogout();
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

    // Exibe a página com o resumo de links para os processos seletivos de cada departamento
    public function showPSsPage()
    {
        echo "Processos seletivos:";
        echo "<br><a href='/processo-seletivo/alunos'>Alunos</a>";
        echo "<br><a href='/processo-seletivo/gestores'>Gestores</a>";
        echo "<br><a href='/processo-seletivo/professores'>Professores</a>";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página inicial do processo seletivo de cada departamento
    public function showHomePSPage($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Processo seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            $this->showErrorPage("404");
        }
    }

    // checa os dados iniciais de inscrição antes de liberar acesso ao formulário de inscrição
    public function checkSubscriptionPS($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Processo seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            $this->showErrorPage("404");
        }
    }

    // Exibe a página com o formulário de inscrição no processo seletivo
    public function showSubscriptionPSPage($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Página de inscrição Processo Seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            $this->showErrorPage("404");
        }
    }

    // salva os dados do formulário de inscrição
    public function saveSubscriptionPS($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Página de inscrição Processo Seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            $this->showErrorPage("404");
        }
    }

    // exibe a página de contato
    public function showContactPage()
    {
        echo "Página de contato";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página Hall da fama
    public function showHallOfFamePage()
    {
        echo "Hall da Fama";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página quem somos nós
    public function showWhoWeArePage()
    {
        echo "Quem somos nós?";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página nossa equipe
    public function showOurTeamPage()
    {
        echo "Nossa equipe";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página nossa história
    public function showOurStoryPage()
    {
        echo "Nossa história";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página sobre nós
    public function showAboutUsPage()
    {
        echo "Sobre nós";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página para usuários logados
    public function showUserPage($userType)
    {
        $userType = strtolower($userType);
        if($userType === "aluno" || $userType === "gestor"
        || $userType === "professor") {

            $url = $this->accessControl->getUserURL();
            
            if ($url === "401") {
                $this->showErrorPage($url);
            } else if ($url === "/usuario/$userType") {
                
                $page = new Page;
                $page->setTitle("Área do $userType");
                //$page->setRobots('index, follow');
                $page->setDescription("Área restrita a membros do Cursinho Projeto Educação Solidária. Perfil de acesso: $userType do Cursinho PES.");
                $page->notIncludeFooter();
                $page->notIndludeNavbar();
                $page->includeFileAtMain('pages/logout.php');
                $page->renderPage();
            } else {
                header("Location: $url");
                exit();
            }
        }else{
            $this->showErrorPage("404");
        }
    }

    // exibe subpáginas específicas para usuários logados
    public function showUserSubPage($userType, $subPage)
    {
        $userType = strtolower($userType);
        if ($userType === "aluno" || $userType === "gestor"
        || $userType === "professor") {

            $url = $this->accessControl->getUserURL();
            
            if ($url === "401") {
                $this->showErrorPage($url);
            } else if ($url === "/usuario/$userType") {
                echo "Sub página <b>". $subPage ."</b> do usuário tipo ".$userType;
                echo "<br><a href='/'>Voltar ao início</a>";
            } else {
                header("Location: $url");
                exit();
            }
        } else {
            $this->showErrorPage("404");
        }
    }

    // exibe a página para candidatos logados
    public function showCandidatePage($userType)
    {
        $userType = strtolower($userType);
        if($userType === "aluno" || $userType === "gestor"
        || $userType === "professor") {

            $url = $this->accessControl->getUserURL();
            
            if ($url === "401") {
                $this->showErrorPage($url);
            } else if ($url === "/candidato/$userType") {
                echo "Página de candidato tipo ".$userType;
                echo "<br><a href='/'>Voltar ao início</a>";
            } else {
                header("Location: $url");
                exit();
            }
            
        }else{
            $this->showErrorPage("404");
        }
    }

    // exibe subpáginas específicas para candidatos logados
    public function showCandidateSubPage($userType, $subPage)
    {
        $userType = strtolower($userType);
        if($userType === "aluno" || $userType === "gestor"
        || $userType === "professor") {

            $url = $this->accessControl->getUserURL();
            
            if ($url === "401") {
                $this->showErrorPage($url);
            } else if ($url === "/candidato/$userType") {
                echo "Sub página <b>". $subPage ."</b> do candidato tipo ".$userType;
                echo "<br><a href='/'>Voltar ao início</a>";
            } else {
                header("Location: $url");
                exit();
            }
        }else{
            $this->showErrorPage("404");
        }
    }

    /*public function funcao_name()
    {
        echo "Recuperação de senha";
        echo "<br><a href='/'>Voltar ao início</a>";
    }*/

}
