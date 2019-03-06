<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author H.M. van Dijk
 */

require_once './controller/controller.php';
require_once './controller/Service.php';

class ServiceController implements Controller{
    
    const NODATA = null;
    private $httpError = array(
        'status' => 400,
        'message' => "Bad request."
    );
    
    private $httpRequest = array('GET','POST','PUT','DELETE','PATCH'); 
    private $service = self::NODATA;
    private $url;

    function __construct($method, $url) {
        $this->url = $url;
        
        $switch = 0;
        $loop = TRUE;
        while($loop){
            if ($this->httpRequest[$switch] === $method){
                $loop = FALSE;
            }
            else{
                $switch++;              
            }
            $loop = $switch < sizeof($this->httpRequest) && $loop;        
        }
        if ($switch < sizeof($this->httpRequest)){
            $this->service = $switch + 1;
        }
    }
    
    function isServiceGevondenInURL(){
        return $this->service <> self::NODATA;
    }  
    
    function getService(){
        if ($this->url->isResourceIndexAvailable()){
            switch ($this->url->getResourceIndex()){
                case 1:
                    require_once './controller/KlussenFactory.php';
                    $factory = new KlussenFactory();
                    break;
                case 2 :
                    require_once './controller/PersonenFactory.php';
                    $factory = new PersonenFactory();                
                    break;
                default :
                    $this->service = self::NODATA;
                    //require_once './controller/UnknownResource.php';            
                    return;// new UnknownResource();
            }
            return $factory->getService($this->service, $this->url);
        }        
    }
}
