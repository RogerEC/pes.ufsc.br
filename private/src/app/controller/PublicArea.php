<?php 
// Controlador para área pública
namespace App\Controller;

use App\Page;
use Database\SelectDB;
use Router\Request;

use App\PageRender;

use Twig\Loader;
use Twig;
class PublicArea extends General {
    
    // exibe a página inicial do site
    public function showHomePage()
    {   
        $page = new PageRender;
        $page->render('@public/homepage.html');
    }

    // exibe a página com resumo de links para redirecionamento
    public function showLinksPage()
    {
        $select = new SelectDB;
        $links = $select->getActiveLinks();

        $page = new PageRender;
        $page->render('@public/links.html', ['links' => $links]);
    }

    // exibe a página de contato
    public function showContactPage()
    {
        $page = new Page;
        $page->setTitle("Contato - Cursinho PES");
        $page->setRobots("index, follow");
        $page->setDescription("Formulário de contato por e-mail com o Cursinho PES.");
        $page->setClassBody("bg-links");
        //$page->notIncludeFooter();
        //$page->notIndludeNavbar();
        $page->includeScriptCSS("contact.css");
        $page->includeFileAtMain("pages/contact.php");
        $page->renderPage();
    }

    // envia o e-mail de contato com os dados recebidos do formulário de contato no site
    public function sendContactEmail()
    {
        // apenas para os testes, é apresentada as informações coletadas do forms na tela.
        $request = new Request;
        // pega os dados do forms
        $name = trim($request->__get('name'));
        $senderEmail = trim($request->__get('email'));
        $phone = trim($request->__get('phone'));
        if(empty($request->__get('subject'))){
            $error = "SubjectEmpty";
        }else{
            $subject = explode('|', trim($request->__get('subject')))[0];
            $recipientEmail = explode('|', trim($request->__get('subject')))[1] . "@pes.ufsc.br";
        }
        $message = trim($request->__get('message'));

        // imprime os dados na tela
        echo "Dados recebidos do formulário de contato<br><br>";
        echo "<b>Nome:</b> ".$name."<br>";
        echo "<b>E-mail:</b> ".$senderEmail."<br>";
        echo "<b>Telefone:</b> ".$phone."<br>";
        if(isset($error)){
            echo "Assunto vazio!<br>";
        }else{
            echo "<b>Assunto:</b> ".$subject."<br>";
            echo "<b>Destinatário:</b> ".$recipientEmail."<br>";
        }
        echo "<b>Menssagem:</b> ".$message."<br><br>";
        echo "<a href='/'>Voltar ao site</a>";
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

}