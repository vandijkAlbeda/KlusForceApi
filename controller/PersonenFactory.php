<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of KlantenFactory
 *
 * @author H.M
 */
class PersonenFactory {
    
    public function getService($service){
        switch ($service) {
            case 1:
//                require_once './controller/KlusOverzichtService.php';              
//                return new KlusOverzichtService();
            case 2:
//                require_once './controller/KlusToevoegService.php'; 
//                return new KlusToevoegService();                
            case 3:
//                require_once './controller/KlusStatusUpdateService.php';
//                return new KlusStatusUpdateService();                
            case 4:
//                require_once './controller/KlusApproveService.php'; 
//                return new KlusApproveService();
            case 5:
//                require_once './controller/KlusStatusUpdateService.php';
//                return new KlusStatusUpdateService();                             
            default :
//                require_once './controller/UnknownService.php';
//                return new UnknownService();
        }
    }
}
