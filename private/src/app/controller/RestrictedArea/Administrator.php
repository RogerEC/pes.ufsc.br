<?php 
// Controlador para área restrita ao administrador do sistema
namespace App\Controller\RestrictedArea; 

use App\Controller\RestrictedArea;

class Administrator extends RestrictedArea {
    
    public function teste(){
        echo "Teste funcionou";
    }
}