<?php 
// Classe responsável por criar as páginas e entregar ao controlador
namespace App;

class Page
{
    private $description;
    private $keywords;
    private $title;
    private $robots = "none";
    private $classBody;
    private $classMain;
    private $includeFooter = true;
    private $includeNavbar = true;
    private $main = [];
    private $scriptsCSS = ["bootstrap.min.css", "style.css"];
    private $scriptsJS = ["jquery.min.js", "bootstrap.bundle.min.js"];

    public function setDescription($string)
    {
        $this->description = $string;
    }

    public function setKeywords($string)
    {
        $this->keywords = $string;
    }

    public function setTitle($string)
    {
        $this->title = $string;
    }

    public function setRobots($string)
    {
        $this->robots = $string;
    }

    public function setClassBody($string)
    {
        $this->classBody = $string;
    }

    public function setClassMain($string)
    {
        $this->classMain = $string;
    }

    public function notIndludeNavbar()
    {
        $this->includeNavbar = false;
    }

    public function notIncludeFooter()
    {
        $this->includeFooter = false;
    }

    public function includeFileAtMain($fileName)
    {
        $this->main[] = $fileName;
    }

    public function includeScriptCSS($fileName)
    {
        $this->scriptsCSS[] = $fileName;
    }

    public function includeScriptJS($fileName)
    {
        $this->scriptsJS[] = $fileName;
    }

    public function renderPage()
    {
        require_once DIR_PAGES . 'base.php';
    }
}
