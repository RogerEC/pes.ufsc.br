<?php 
namespace App;

use Twig\Loader;
use Twig;

class PageRender {

    private $loader;
    private $viewer;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(DIR_TEMPLATES);
        $this->loader->addPath(DIR_TEMPLATES.'components/', 'components');
        $this->loader->addPath(DIR_TEMPLATES.'public/', 'public');
        $this->loader->addPath(DIR_TEMPLATES.'restricted/', 'restricted');
        $this->loader->addPath(DIR_TEMPLATES.'selection-processes/', 'selection-processes');
        $this->loader->addPath(DIR_TEMPLATES.'restricted/candidate/', 'candidate');
        $this->loader->addPath(DIR_TEMPLATES.'restricted/user', 'user');
        $this->viewer = new \Twig\Environment($this->loader, ['cache' => false,]);
    }

    public function render($pageName, $parameters = [])
    {
        $template = $this->viewer->load($pageName);
        echo $template->render($parameters);
        return;
    }
}