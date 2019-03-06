<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KlusOverzichtService
 *
 * @author H.M. van Dijk
 */

require_once './integration/ReadConnection.php';

class KlusOverzichtService extends Service{

    private $url;
    
    function __construct($url) {      
        $this->responsedata = $this->httpError;
        $this->url = $url;
    }
    
    function startService(){
        parent::addServiceToDefaultResponse('KlusOverzichtService');
        $this->responsedata = $this->defaultResponse;       

        if ($this->url->isIdAvailable()){
            $sqlPart = "SELECT * FROM Klus"
                . " WHERE id_klus = '".$this->url->getId()."'";
        }
        else{
            $sqlPart = "SELECT * FROM Klus";
        }       
        $this->getDatabaseData($sqlPart);        
    }
    
    function getResponseJsonData(){ 
        return json_encode($this->responseData);
    }
    
    private function getDatabaseData($sqlPart){
        $db = new ReadConnection();
        if ($db->isConnected()){
            $db->setExpectMoreRecords();
            if ($db->isFetched($sqlPart)){                    
                if ($db->hasExpectedResult()){
                    $this->responseData = $db->getData();                       
                }
                else{
                    $this->httpResponseCode = self::HTTP_BAD_REQUEST;
                    //$this->defaultResponse['message'] = "no type match";
                    //$this->responseData = $this->defaultRespsonse;                      
                }
            }
        }        
    }
}
