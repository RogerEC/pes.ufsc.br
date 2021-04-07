<?php
namespace App;

use App\DataSanitizer;
use DateTime;
use DateTimeZone;

class DataValidator 
{
    private $dataSanitizer;

    public function __construct()
    {
        $this->dataSanitizer = new DataSanitizer;
    }

    public function validateInt($int)
    {
        $clearInt = $this->dataSanitizer->sanitizeInt($int);
        return filter_var($clearInt, FILTER_VALIDATE_INT);
    }

    public function validatePostLinks($post)
    {
        $data = $this->dataSanitizer->sanitizePostLinks($post);

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
}