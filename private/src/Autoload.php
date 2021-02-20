<?php
// Função de autoload para as clases do sistema
function autoLoader($class)
{
    // pega o Namespace\Classe e manipula a string para gerar o path
    $pathParts = explode('\\', $class);
    $className = array_pop($pathParts);
    $dirClass = strtolower(implode('/', $pathParts)) . '/';
    
    // Diretorio onde ficam as classes
    $base_dir = __DIR__ . '/';
    
    // cria o path para o arquivo a ser incluído
    $file = $base_dir . $dirClass . $className . '.php';

    // Verifica se o arquivo existe, se existir então inclui ele 
    if (is_file($file)) {
        require_once $file;
    }
}

spl_autoload_register('autoLoader');

// Inclusão de arquivos estáticos de configuração
require_once __DIR__ . '/helpers/helper_routes.php';
require_once __DIR__ . '/../config/settings.php';