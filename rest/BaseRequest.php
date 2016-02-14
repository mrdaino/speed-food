<?php

/**
 * Created by PhpStorm.
 * User: lorenzodaneo
 * Date: 11/02/16
 * Time: 11:24
 */
namespace UniLunch;

use Tonic\Resource;
include __DIR__."/../vendor/peej/tonic/src/Tonic/Resource.php";

$toInclude = scandir("resources");
for($i=0;$i<count($toInclude);$i++){
    if(strpos($toInclude[$i],".php") !== false)
        include "resources/".$toInclude[$i];
}

/**
 * Class BaseRequest
 * @uri /base-request/:function
 * @uri /base-request/:function/:object
 */
class BaseRequest extends Resource{

    /**
     * @method GET
     * @param $function
     * @param $object
     * @provides application/json
     * @json
     */
    function executeGetJob($function,$object){
        return $this->$function(json_decode($object));
    }

    /**
     * @method POST
     * @param $function
     * @accepts application/x-www-form-urlencoded
     * @provides application/json
     * @json
     */
    function executePostJob($function){
        return $this->$function(json_decode($this->request->getData()));
    }

    function getRistoranti(){
        return DBConnector::getRistoranti();
    }

    function getProdotti($userId){
        return DBConnector::getProdottiByRistoranteId($userId);
    }

    function getIngredienti($userId){
        return DBConnector::getIngredientiByRistoranteId($userId);
    }

}