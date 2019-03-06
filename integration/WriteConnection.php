<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of writeConnection
 *
 * @author H.M. van Dijk
 */

class writeConnection extends mysqli{
    private $db_user = "root";//writeUser";
    private $db_password = "";//#login#";
    private $db_name = "klusforce";    

    private $con_Established;
    private $con_ErrorObj;
    //private $result;  

    public function __construct(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->con_Established = FALSE;
        try{
            parent::__construct("localhost",$this->db_user,$this->db_password,$this->db_name);
            $this->con_Established = TRUE;
        } catch (Exception $e) {
            $this->con_ErrorObj = $e;
        }
    }
    
    public function isInsert($sqlInsertStatement){
        $check = FALSE;
        try{
            parent::query($sqlInsertStatement);
            $check = "TRUE";
        } catch (mysqli_sql_exception $ex) {
            $this->con_ErrorObj = $ex;            
        }
        return $check;        
    }

    public function isUpdate($sqlStatement){
        $check = FALSE;
        try{
            parent::query($sqlStatement);
            if ($this->affected_rows == 1){
                $check = "TRUE";                
            }
        } catch (mysqli_sql_exception $ex) {
            $this->con_ErrorObj = $ex;            
        }
        return $check;        
    }
    
    function isConnected(){
        return $this->con_Established;
    }
    
    function getErrorMessage(){
        return $this->con_ErrorObj->getMessage();
    }    
}
