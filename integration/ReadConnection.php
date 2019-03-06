<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReadConnection
 * Deze klasse geeft een readconnection met de database.
 * We gebruiken mysqli
 *
 * @author H.M. van Dijk
 */
class ReadConnection extends mysqli {
    
    private $NO_RECORDS = null;
    private $ONE_RECORD = 1;
    private $MORE_RECORDS = 2;
    
    private $db_user = "readUser";
    private $db_password = "#login#";
    private $db_name = "klusforce";
    
    private $con_Established;
    private $con_ErrorObj;
    private $expectedResult;
    private $result;
    private $aantalRecords;
    
    public function __construct(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->con_Established = FALSE;         
        try{
            parent::__construct("localhost",
                                $this->db_user,
                                $this->db_password,
                                $this->db_name);
            $this->con_Established = TRUE;
        } catch (Exception $e) {
            $this->con_ErrorObj = $e;
        }           
    }
    
    public function isFetched($selectStatement){
        $check = FALSE;
        try{
            $result = parent::query($selectStatement);           
            $this->result = $result->fetch_all(MYSQLI_ASSOC);
            $this->aantalRecords = count($this->result);
            $check = TRUE;
        } catch (mysqli_sql_exception $ex) {
            $this->aantalRecords = 0;
            $this->con_ErrorObj = $ex;            
        }
        return $check;
    }
    
    public function getData(){
        return $this->result;
    }
    
    function isConnected(){
        return $this->con_Established;
    }
    
    function getErrorMessage(){
        return $this->con_ErrorObj->getMessage();
    }
    
    function setExpectNoRecords(){
        $this->expectedResult = $this->NO_RECORDS;
    }
    
    function setExpectOneRecord(){
        $this->expectedResult = $this->ONE_RECORD;        
    }
    
    function setExpectMoreRecords(){
        $this->expectedResult = $this->MORE_RECORDS;        
    }
    
    function hasExpectedResult(){
        if ($this->expectedResult == $this->MORE_RECORDS){
            return $this->aantalRecords > 0;}
        else{
            return $this->aantalRecords == $this->expectedResult;
        }
    }
}
