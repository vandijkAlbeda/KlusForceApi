<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnknownService
 *
 * @author H.M. van Dijk
 */
class UnknownService extends Service{
    
    function startService(){
        echo "UnknownService gestart";;        
        //TODO Generate exception! This method should never be used formally
    }
    
    public function getResponseJsonData() {
        return json_encode($this->httpError);        
    }
}
