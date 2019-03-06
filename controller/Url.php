<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArgumentSearcher
 *
 * @author H.M
 */
class Url {
    const NODATA = null;
    const NO_RESOURCE = -1;
    
    private $url_database = 0;
    private $url_resource = 2;
    private $url_id= 3;
    private $resources = array( "klussen" => 1, "personen" => 2);
    
    private $resourceIndex = self::NO_RESOURCE;
    private $resourceId = self::NODATA;
    private $uri_fields;

    function __construct($urlArguments) {
        $this->extractPathValues($urlArguments);
    }
    
    private function extractPathValues($urlArguments){
        $this->uri_fields = explode('/', trim($urlArguments, '/'));
        $this->url_database = $this->uri_fields[$this->url_database];
        switch (sizeof($this->uri_fields)){
            case 3:
                $this->setUrlResourceIndex($this->uri_fields);
                break;
            case 4:
                $this->setUrlResourceIndex($this->uri_fields);               
                $this->resourceId = $this->uri_fields[$this->url_id];
                break;                
        }
    }
    
    private function setUrlResourceIndex($uri_fields){
        if (isset($this->resources[$uri_fields[$this->url_resource]])){
            $this->resourceIndex = $this->resources[$uri_fields[$this->url_resource]];
        }
    }

    function isResourceIndexAvailable(){
        return $this->resourceIndex <> self::NO_RESOURCE;
    }
    
    function getResourceIndex(){
        return $this->resourceIndex;
    }
    
    function isIdAvailable(){
        return $this->resourceId <> self::NODATA;
    }
    
    function getId(){
        return $this->resourceId;
    }
}
