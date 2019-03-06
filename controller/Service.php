<?php

/*
 * De Controller interface bevat alle methode t.b.v. index.php
 */

/**
 * Description of MainController
 *
 * @author H.M. van Dijk
 */
abstract class Service {
    const HTTP_GOOD = 200;
    const HTTP_BAD_REQUEST = 405;
    
    protected $httpError = array( 'status' => 400,'message' => "Bad request.");
    protected $defaultResponse = array( 'status' => 0, 'message' => "Test Data");
    protected $responseData;
    protected $httpResponseCode = self::HTTP_GOOD;

    function addServiceToDefaultResponse($service){
        $myService = array('service' => $service, 'http' => $_SERVER['REQUEST_METHOD']);
        $this->responseData = array_merge($myService,$this->defaultResponse);      
    }
    
    function getHttpResponseCode(){
        return $this->httpResponseCode;
    }
    
    abstract function getResponseJsonData();
    abstract function startService();
}
