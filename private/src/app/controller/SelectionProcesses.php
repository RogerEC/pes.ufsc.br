<?php 
// Controlador para área dos processos seletivos
namespace App\Controller;

use App\Page;
use Database\SelectDB;

class SelectionProcesses {
    
    // Exibe a página com o resumo de links para os processos seletivos de cada departamento
    public function showPSsPage()
    {
        echo "Processos seletivos:";
        echo "<br><a href='/processo-seletivo/alunos'>Alunos</a>";
        echo "<br><a href='/processo-seletivo/gestores'>Gestores</a>";
        echo "<br><a href='/processo-seletivo/professores'>Professores</a>";
        echo "<br><a href='/'>Voltar ao início</a>";
    }

    // exibe a página inicial do processo seletivo de cada departamento
    public function showHomePSPage($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Processo seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            Page::showErrorHttpPage("404");
        }
    }

    // checa os dados iniciais de inscrição antes de liberar acesso ao formulário de inscrição
    public function checkSubscriptionPS($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Processo seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            Page::showErrorHttpPage("404");
        }
    }

    // Exibe a página com o formulário de inscrição no processo seletivo
    public function showSubscriptionPSPage($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Página de inscrição Processo Seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            Page::showErrorHttpPage("404");
        }
    }

    // salva os dados do formulário de inscrição
    public function saveSubscriptionPS($department)
    {
        $department = strtolower($department);
        if($department === "alunos" || $department === "gestores"
        || $department === "professores") {
            echo "Página de inscrição Processo Seletivo de ".$department;
            echo "<br><a href='/'>Voltar ao início</a>";
        }else{
            Page::showErrorHttpPage("404");
        }
    }
}