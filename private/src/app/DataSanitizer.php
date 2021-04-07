<?php
namespace App;

class DataSanitizer
{

    public function sanitizeInt($int)
    {
        return (isset($int) && !empty($int))? filter_var(trim($int), FILTER_SANITIZE_NUMBER_INT):null;
    }

    public function sanitizePostLinks($post)
    {
        $data = array();
        
        $data['idLinks'] = (isset($post['idLinks']) && !empty($post['idLinks']))? filter_var(trim($post['idLinks']), FILTER_SANITIZE_NUMBER_INT):null;
        $data['order'] = (isset($post['order']) && !empty($post['order']))? filter_var(trim($post['order']), FILTER_SANITIZE_NUMBER_INT):null;
        $data['status'] = (isset($post['status']))? true:false;
        $data['permanentLink'] = (isset($post['permanentLink']))? true:false;
        $data['url'] = (isset($post['url']) && !empty($post['url']))? filter_var(trim($post['url']), FILTER_SANITIZE_URL):null;
        $data['name'] = (isset($post['name']) && !empty($post['name']))? filter_var(trim($post['name']), FILTER_SANITIZE_STRING):null;
        
        $data['expirationDatetime'] = (!$data['permanentLink'] && isset($post['expirationDatetime']) && !empty($post['expirationDatetime']))? filter_var(trim($post['expirationDatetime']), FILTER_SANITIZE_STRING):null;

        $data['validationStatus'] = true;
        $data['errorMessage'] = array();

        return (object)$data;
    }
}
