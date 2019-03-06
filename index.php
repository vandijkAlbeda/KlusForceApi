<?php
    if(isVersionInHttpHeader()){
        require_once "./controller/ServiceController.php";
        require_once "./controller/Url.php";
        
        $url = new Url($_SERVER['REQUEST_URI']);
        $controller = new ServiceController($_SERVER['REQUEST_METHOD'], $url);

        $doorgaan = $url ->isResourceIndexAvailable()
                    &&
                    $controller ->isServiceGevondenInURL();
                
        if ($doorgaan){
            $controller = $controller->getService();
            $controller->startService();        
            echo $controller->getResponseJsonData();
        }
        else{
            http_response_code(405);
            echo "Incomplete request (2 - No Service found). <br />".
            "Please read the documentation of this api. <br />";            
        }
    }
    else{
        http_response_code(401);
        echo "Incomplete request (1). <br />".
        "Please read the documentation of this api. <br />";
    }
    
    function isVersionInHttpHeader(){
        if (isset($_SERVER['CONTENT_TYPE'])){
            return TRUE;
        }
        else{
            return FALSE; 
        } 
    }
?>
