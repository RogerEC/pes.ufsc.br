<?php
namespace App;

class DataValidator 
{
    public function sanitizePostLinks($post)
    {
        $data = array();
        $data['idLinks'] = trim($post['idLinks']); 
    }
}