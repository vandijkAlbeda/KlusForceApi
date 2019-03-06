<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnknownResource
 *
 * @author H.M
 */
class UnknownResource extends Service{
    
    function startService(){
        echo "UnknownResource gestart";;        
        //TODO Generate exception! This method should never be used formally
    }
    
    public function getResponseJsonData() {
        return json_encode($this->httpError);        
    }
}
