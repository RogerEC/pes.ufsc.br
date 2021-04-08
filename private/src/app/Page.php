<?php 
namespace App;

use Twig\Loader;
use Twig;

class Page {

    private static $viewer;

    public function __construct()
    {
        $this->initTwig();
    }

    protected static function initTwig()
    {
        if(empty(self::$viewer)){
            $loader = new \Twig\Loader\FilesystemLoader(DIR_TEMPLATES);
            $loader->addPath(DIR_TEMPLATES.'components/', 'components');
            $loader->addPath(DIR_TEMPLATES.'public/', 'public');
            $loader->addPath(DIR_TEMPLATES.'restricted/', 'restricted');
            $loader->addPath(DIR_TEMPLATES.'selection-processes/', 'selection-processes');
            $loader->addPath(DIR_TEMPLATES.'restricted/candidate/', 'candidate');
            $loader->addPath(DIR_TEMPLATES.'restricted/user', 'user');
            self::$viewer = new \Twig\Environment($loader, ['cache' => false,]);
        }
        return self::$viewer;
    }

    public static function render($pageName, $parameters = [])
    {
        $template = self::initTwig()->load($pageName);
        echo $template->render($parameters);
        return;
    }

    public static function showErrorHttpPage($code)
    { 
        $parameters = self::getErrorHttpDescription($code);
        echo self::initTwig()->render('errorHttp.html', $parameters);
        return;
    }

    public static function showInternalErrorPage($code)
    {
        $parameters = self::getInternalErrorDescription($code);
        echo self::initTwig()->render('internalError.html', $parameters);
        return;
    }

    private static function getErrorHttpDescription($code)
    {

    }

    private static function getInternalErrorDescription($code)
    {
        
    }
}