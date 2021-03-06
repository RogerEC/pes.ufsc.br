<?php
namespace App;

use App\DataSanitizer;
use DateTime;
use DateTimeZone;

class DataValidator 
{
    // retorna o inteiro se for válido, falso caso contrário
    public static function validateInt($int)
    {
        $clearInt = DataSanitizer::sanitizeInt($int);
        return filter_var($clearInt, FILTER_VALIDATE_INT);
    }

    // valida e retorna os dados higienizados do post para adicionar/editar links
    public static function validatePostLinks($post)
    {
        $data = DataSanitizer::sanitizePostLinks($post);

        $data->idLinks = filter_var($data->idLinks, FILTER_VALIDATE_INT);
        $data->order = filter_var($data->order, FILTER_VALIDATE_INT);
        if($data->idLinks === false || $data->order === false){ 
            $data->validationStatus = false;
            $data->errorMessage[] = "Erro interno ao processar a solicitação";
        }

        if(empty($data->name)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo nome.";
        }

        $data->url = filter_var($data->url, FILTER_VALIDATE_URL);
        if($data->url === false) {
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo url.";
        }

        if(!$data->permanentLink){
            if(empty($data->expirationDatetime)){
                $data->validationStatus = false;
                $data->errorMessage[] = "Link marcado como expirável, mas a data limite não foi informada.";
            }else{
                $timezone = new DateTimeZone('America/Sao_Paulo');
                $date = DateTime::createFromFormat('Y-m-d\TH:i', $data->expirationDatetime, $timezone);
            
                if ($date !== false && !array_sum($date->getLastErrors())){
                    $data->expirationDatetime = $date->format('Y-m-d H:i:s');
                }else {
                    $data->validationStatus = false;
                    $data->errorMessage[] = "Valor inválido no campo data.";
                }
            }
        }

        return $data;
    }

    // verifica se os dados de entrada na alteração de perfil são válidos
    public static function validateUserProfileData($post)
    {
        $data = DataSanitizer::sanitizeUserProfileData($post);

        $data->idUser = filter_var($data->idUser, FILTER_VALIDATE_INT);
        if($data->idUser == false) {
            $data->validationStatus = false;
            $data->errorMessage[] = "Erro interno ao processar a solicitação";
        }

        if(empty($data->photoFile)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Erro interno ao processar a solicitação.";
        }

        if(empty($data->name)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo nome.";
        }

        if(empty($data->lastName)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo sobrenome.";
        }

        $data->email = filter_var($data->email, FILTER_VALIDATE_EMAIL);
        if($data->email === false) {
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo e-mail.";
        }

        return $data;
    }

    // verifica se os dados de entrada na alteração de perfil são válidos
    public static function validateUserData($post)
    {
        $data = DataSanitizer::sanitizeUserData($post);

        $data->idUser = filter_var($data->idUser, FILTER_VALIDATE_INT);
        if($data->idUser == false) {
            $data->validationStatus = false;
            $data->errorMessage[] = "Erro interno ao processar a solicitação";
        }

        // verificação parcial do cpf, verifica o formato, não a validade do número.
        if(empty($data->cpf) || strlen($data->cpf) !== 11){
            $data->validationStatus = false;
            $data->errorMessage[] = "Número de cpf inválido.";
        }

        if(empty($data->name)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo nome.";
        }

        if(empty($data->username)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo usuário.";
        }

        if(empty($data->lastName)){
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo sobrenome.";
        }

        if(array_search($data->userType, ['A', 'G', 'P', 'GP', 'CA', 'CG', 'CP', 'MH', 'ADMIN']) === false){
            $data->validationStatus = false;
            $data->errorMessage[] = "Tipo de usuário não reconhecido";
        }

        $data->email = filter_var($data->email, FILTER_VALIDATE_EMAIL);
        if($data->email === false) {
            $data->validationStatus = false;
            $data->errorMessage[] = "Valor inválido no campo e-mail.";
        }

        return $data;
    }

    // valida os dados de uma imagem, tamanho máximo padrão 1MBi
    public static function validateImageFiles($file, $maxSize = 1048576)
    {
        $data['validationStatus'] = true;
        //$data['errorMessage'] = '';
        if($file != null  && $file['error'] === 0){
            $name = $file['name'];
            $data['extension'] = strtolower(end(explode('.', $name)));
            if(array_search($data['extension'], ['jpg', 'jpeg', 'png']) === false){
                $data['validationStatus'] = false;
                $data['errorMessage'] = 'Extensão do arquivo incompatível';
            }else if($file['size'] > $maxSize){
                $data['validationStatus'] = false;
                $data['errorMessage'] = 'Arquivo muito grande';
            }
        } else if ($file['error'] === 4) {
            $data['validationStatus'] = true;
        } else {
            $data['validationStatus'] = false;
        }

        return (object)$data;
    }
}