<?php
namespace App;

class DataSanitizer
{
    // higieniza os dados de entrada para um inteiro
    public static function sanitizeInt($int)
    {
        return (isset($int) && !empty($int))? filter_var(trim($int), FILTER_SANITIZE_NUMBER_INT):null;
    }

    // higieniza os dados de entrada do post para adição/edição de links
    public static function sanitizePostLinks($post)
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

    // higieniza os dados de entrada do post para edição do perfil de usuário
    public static function sanitizeUserProfileData($post)
    {
        $data = array();

        $data['idUser'] = (isset($post['idUser']) && !empty($post['idUser']))? filter_var(trim($post['idUser']), FILTER_SANITIZE_NUMBER_INT):null;
        $data['name'] = (isset($post['name']) && !empty($post['name']))? filter_var(trim($post['name']), FILTER_SANITIZE_STRING):null;
        $data['lastName'] = (isset($post['lastName']) && !empty($post['lastName']))? filter_var(trim($post['lastName']), FILTER_SANITIZE_STRING):null;
        $data['photoFile'] = (isset($post['photoFile']) && !empty($post['photoFile']))? filter_var(trim($post['photoFile']), FILTER_SANITIZE_STRING):null;
        $data['email'] = (isset($post['email']) && !empty($post['email']))? filter_var(trim($post['email']), FILTER_SANITIZE_EMAIL):null;

        $data['validationStatus'] = true;
        $data['errorMessage'] = array();

        return (object)$data;
    }
}
