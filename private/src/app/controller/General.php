<?php 
namespace App\Controller;

use App\AccessControl;
use App\PageRender;

class General {
    
    protected $accessControl;

    public function __construct()
    {
        $this->accessControl = new AccessControl;
    }

    // exibe a página de erros http
    public function showErrorPage($code)
    {
        require DIR_PAGES.'error.php';
    }
}
