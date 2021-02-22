<?php
// Classe responsável por atender as requisições do cliente e enviar as páginas/respostas

namespace App;

use App\Page;
class Controller
{
    public function showErrorPage($code){
        require __DIR__."/../view/pages/error.php";
    }

    public function showHomePage(){
        $page = new Page;
        $page->setTitle("Cursinho Projeto Educação Solidária");
        $page->setRobots("index, follow");
        $page->setKeywords("Curso pré-vestibular; UFSC; Cursinho PES; Projeto Educação Solidária");
        $page->setDescription("Curso pré-vestibular social da Universidade Federal de Santa Catarina, Campus Araranguá, destinado a estudantes da rede pública de ensino da cidade de Araranguá, SC.");
        $page->setClassMain("h-100");
        $page->includeFileAtMain("pages/home.php");
        $page->renderPage();
    }

    public function showLinksPage(){
        $page = new Page;
        $page->setTitle("Links - Cursinho PES");
        $page->setRobots("index, follow");
        $page->setKeywords("Curso pré-vestibular; UFSC; Cursinho PES; Projeto Educação Solidária");
        $page->setDescription("Links para as redes sociais do Cursinho Projeto Educação Solidária, curso pré vestibular social da UFSC Campus Araranguá-SC.");
        $page->setClassBody("bg-links");
        $page->notIncludeFooter();
        $page->notIndludeNavbar();
        //$page->includeFileAtMain("pages/home.php");
        $page->renderPage();
    }
}
