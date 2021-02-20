<?php
    $descricao = "";
    switch($code){
        case 400:
            $nome = "Requisição Inválida";
            break;
        case 401:
            $nome = "Não autorizado";
            $descricao = "É necessário realizar o login para prosseguir.";
            break;
        case 402:
            $nome = "Pagamento necessário";
            break;
        case 403:
            $nome = "Acesso negado";
            $descricao = "Você não tem permissão para acessar essa página.";
            break;
        case 404:
            $nome = "Página não encontrada";
            $descricao = "A página solicitada não foi encontrada no servidor.";
            break;
        case 405:
            $nome = "Método não permitido";
            break;
        case 406:
            $nome = "Não aceito";
            break;
        case 407:
            $nome = "Autenticação de Proxy Necessária";
            break;
        case 408:
            $nome = "Tempo de solicitação esgotado";
            break;
        case 409:
            $nome = "Conflito";
            break;
        case 410:
            $nome = "Perdido";
            break;
        case 411:
            $nome = "Duração necessária";
            break;
        case 412:
            $nome = "Falha de pré-condição";
            break;
        case 413:
            $nome = "Solicitação da entidade muito extensa";
            break;
        case 414:
            $nome = "Solicitação de URL muito Longa";
            break;
        case 415:
            $nome = "Tipo de mídia não suportado";
            break;
        case 416:
            $nome = "Solicitação de faixa não satisfatória";
            break;
        case 417:
            $nome = "Falha na expectativa";
            break;
        case 418:
            $nome = "Eu sou um bule de chá!";
            $descricao = "Por ser um bule de chá, eu não posso preparar café!";
            break;
        case 500:
            $nome = "Erro interno do servidor";
            break;
        case 501:
            $nome = "Não implementado";
            break;
        case 502:
            $nome = "Porta de entrada ruim";
            break;
        case 503:
            $nome = "Serviço indisponível";
            break;
        case 504:
            $nome = "Tempo limite da Porta de Entrada";
            break;
        case 505:
            $nome = "Versão HTTP não suportada";
            break;
        default:
            $nome = "Erro desconhecido";
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php require_once(DIR_COMPONENTS . 'head.php');?>
        <!-- Título da página -->
        <title>Erro <?php echo $code; ?></title>
    </head>
    <body>
        <main class="container text-center mt-5"><!--Conteúdo da página-->
            <h1 >Erro <?php echo $code; ?> - <?php echo $nome; ?></h1>
            <?php
                if($descricao!=""){
                    echo "<p class='mt-4 mb-4'>$descricao</p>\n";
                }
            ?>
            <p><b><a href="/">Clique aqui</a></b> para voltar a página inicial.</p>
        </main><!--/Conteúdo da página-->
        <!--Javascript-->
        <script src="/assets/js/jquery.min.js"></script>
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
