<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KlusAproveService
 *
 * @author H.M
 */
require_once './integration/WriteConnection.php';


class KlusApproveService extends Service{
    
    const DB_STATUS_APPROVED_VALUE = 2;
    const ARG_id_IN_URL = "id";
    
    private $db_id_klus;
    
    function __construct() {
        $this->responsedata = $this->httpError;
    }
    
    function startService(){
        parent::addServiceToDefaultResponse('KlusApproveService');
        $this->responsedata = $this->defaultRespsonse;          
//        if ($this->AreArgumentsAllRead()){
//            $this->getSqlStatement();
//            $this->updateStatusInTableKlus();
//        }
    }
    
    function getResponseJsonData(){ 
        return json_encode($this->responseData);
    }

    private function AreArgumentsAllRead(){
//        $objUrl = new Url($this->urlArguments);
//        if ($objUrl->isArgumentFoundInURL(self::ARG_id_IN_URL)){
//            $this->db_id_klus = $objUrl->getArgumentValue();
//            return TRUE;          
//        }
//        $objUrl = null;        
//        return FALSE;
    }
    
    private function updateStatusInTableKlus(){
        $sqlStatement = $this->getSqlStatement();
        $db = new WriteConnection();     
        if ($db->isConnected()){
            if ($db->isUpdate($sqlStatement)){                    
                $this->defaultRespsonse['message'] = "query executed";
                $this->responseData = $this->defaultRespsonse;                 
            }
//            else{
//                echo $db->getErrorMessage();       
//            }
        }
//        else{
//            echo $db->getErrorMessage();            
//        }
    }
    
    private function getSqlStatement(){
        return "UPDATE klus "
        . " SET klus_status = ".SELF::DB_STATUS_APPROVED_VALUE
        . " WHERE id_klus = '". $this->db_id_klus."'";
    }
}
