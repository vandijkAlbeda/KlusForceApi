<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateController
 *
 * @author H.M. van Dijk
 */
class KlusStatusUpdateService extends Service{

    function __construct() {
        //$this->obj_Url = $obj_Url;
    }
    
    function startService(){
        parent::addServiceToDefaultResponse('KlusStatusUpdateService');
        $this->responsedata = $this->defaultRespsonse;         
    }    
    
    function getResponseJsonData(){
        return json_encode($this->responseData);
    } 
}
