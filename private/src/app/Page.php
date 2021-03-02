<?php 
// Classe responsável por criar as páginas e entregar ao controlador
namespace App;

class Page
{
    private $description;
    private $keywords = "Curso pré-vestibular; UFSC; Cursinho PES; Projeto Educação Solidária";
    private $title;
    private $robots = "none";
    private $classBody;
    private $classMain;
    private $includeFooter = true;
    private $includeNavbar = true;
    private $main = [];
    private $scriptsCSS = ["bootstrap.min.css", "style.css"];
    private $scriptsJS = ["libs/jquery.min.js", "libs/bootstrap.bundle.min.js", "pages/geral.js"];

    // seta uma descrição para a página
    public function setDescription($string)
    {
        $this->description = $string;
    }

    // seta palavras chave para a página
    public function setKeywords($string)
    {
        $this->keywords = $string;
    }

    // seta um title para a página
    public function setTitle($string)
    {
        $this->title = $string;
    }

    // seta o comportamento da página com relação aos robôs de indexização
    public function setRobots($string)
    {
        $this->robots = $string;
    }

    // seta classes para serem incluidas na tag body
    public function setClassBody($string)
    {
        $this->classBody = $string;
    }

    // seta classes para incluir na tag main
    public function setClassMain($string)
    {
        $this->classMain = $string;
    }

    // faz com que a barra de navegação não seja incluída
    public function notIndludeNavbar()
    {
        $this->includeNavbar = false;
    }

    // faz com que o footer padrão não seja incluido
    public function notIncludeFooter()
    {
        $this->includeFooter = false;
    }

    // incluir páginas/componentes ao main
    public function includeFileAtMain($fileName)
    {
        $this->main[] = $fileName;
    }

    // incluí scripts de CSS adicionais
    public function includeScriptCSS($fileName)
    {
        $this->scriptsCSS[] = $fileName;
    }

    // incluí scripts adicionais de js
    public function includeScriptJS($fileName)
    {
        $this->scriptsJS[] = $fileName;
    }

    // retorna a página renderizada
    public function renderPage($parameters = null)
    {
        require_once DIR_PAGES . 'base.php';
    }
}
