<?php 
// Controlador para área restrita geral
namespace App\Controller;

use App\Page;
use App\Authenticator;
use Database\SelectDB;

class RestrictedArea {
    
    // exibe a página para usuários logados
    public function showUserPage($userType)
    {
        $userType = strtolower($userType);
        // verifica se o tipo de usuário é válido
        if($userType === "aluno" || $userType === "gestor"
        || $userType === "professor" || $userType === "membro-honorario") {
            
            // pega o link da área restrita específico para o usuário
            $url = Authenticator::getUserURL();
            
            if ($url === "401") { // verifica se o usuário está acessando a página correta
                Page::showErrorHttpPage($url);
            } else if ($url === "/usuario/$userType") {
                // renderiza a página se o usuário está acessando a página correta
                /*$page = new Page;
                $page->setTitle("Área do $userType");
                //$page->setRobots('index, follow');
                $page->setDescription("Área restrita a membros do Cursinho Projeto Educação Solidária. Perfil de acesso: $userType do Cursinho PES.");
                $page->notIncludeFooter();
                $page->notIndludeNavbar();
                $page->setClassMain("pt-0 w-100 h-100");
                $page->includeScriptCSS("no-scrollbar.css");*/
                if($userType === 'gestor'){
                    $linksSideBar = array((object) array('name' => 'Editar Links', 'url' => '/usuario/gestor/links'));
                    Page::render('@user/manager-home.html', ['linksSideBar' => $linksSideBar]);
                }else if($userType === 'professor'){
                    //$page->includeFileAtMain('pages/users/teachers.php');
                    //$page->renderPage();
                }else if($userType === 'aluno'){
                    //$page->includeFileAtMain('pages/users/students.php');
                    //$page->renderPage();
                }else{
                    // membro honorário page
                }
                
            } else {
                // redireciona o usuário para a página correta se ele estiver tentado acessar a página específica de um usuário de tipo diferente do dele
                header("Location: $url");
                exit();
            }
        }else{
            // mostra erro 404 caso o usuário tente acessar uma página de um setor que não existe
            Page::showErrorHttpPage("404");
        }
    }

    // exibe subpáginas específicas para usuários logados
    public function showUserSubPage($userType, $subPage)
    {
        $userType = strtolower($userType);
        if ($userType === "aluno" || $userType === "gestor"
        || $userType === "professor" || $userType === "membro-honorario") {

            $url = Authenticator::getUserURL();
            
            if ($url === "401") {
                Page::showErrorHttpPage($url);
            } else if ($url === "/usuario/$userType") {
                if($userType === 'gestor'){
                    if($subPage === "links"){
                        $links = SelectDB::getAllLinks();
                        $linksSideBar = array((object) array('name' => 'Editar Links', 'url' => '/usuario/gestor/links'));
                        Page::render('@user/links.html', ['linksSideBar' => $linksSideBar, 'links' => $links]);
                    }else{
                        Page::showErrorHttpPage("404");
                        exit();
                    }
                }else{
                    echo "Sub página <b>". $subPage ."</b> do usuário tipo ".$userType;
                    echo "<br><a href='/'>Voltar ao início</a>";
                }
            } else {
                header("Location: $url");
                exit();
            }
        } else {
            Page::showErrorHttpPage("404");
        }
    }

    // exibe a página para candidatos logados
    public function showCandidatePage($userType)
    {
        $userType = strtolower($userType);
        if($userType === "aluno" || $userType === "gestor"
        || $userType === "professor") {

            $url = Authenticator::getUserURL();
            
            if ($url === "401") {
                Page::showErrorHttpPage($url);
            } else if ($url === "/candidato/$userType") {
                
                /*$page = new Page;
                $page->setTitle("Área do candidato - $userType");
                //$page->setRobots('index, follow');
                $page->setDescription("Área restrita a candidatos a $userType do Cursinho Projeto Educação Solidária. Perfil de acesso: candidato $userType do Cursinho PES.");
                $page->notIncludeFooter();
                $page->notIndludeNavbar();
                $page->setClassMain("pt-0 w-100 h-100");
                $page->includeScriptCSS("no-scrollbar.css");*/
                if($userType === 'gestor'){
                    //$page->includeFileAtMain('pages/candidates/managers.php');
                }else if($userType === 'professor'){
                    //$page->includeFileAtMain('pages/candidates/teachers.php');
                }else{
                    //$page->includeFileAtMain('pages/candidates/students.php');
                }
                //$page->renderPage();
            } else {
                header("Location: $url");
                exit();
            }
            
        }else{
            Page::showErrorHttpPage("404");
        }
    }

    // exibe subpáginas específicas para candidatos logados
    public function showCandidateSubPage($userType, $subPage)
    {
        $userType = strtolower($userType);
        if($userType === "aluno" || $userType === "gestor"
        || $userType === "professor") {

            $url = Authenticator::getUserURL();
            
            if ($url === "401") {
                Page::showErrorHttpPage($url);
            } else if ($url === "/candidato/$userType") {
                echo "Sub página <b>". $subPage ."</b> do candidato tipo ".$userType;
                echo "<br><a href='/'>Voltar ao início</a>";
            } else {
                header("Location: $url");
                exit();
            }
        }else{
            Page::showErrorHttpPage("404");
        }
    }
}