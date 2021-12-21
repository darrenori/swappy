<?php

class Router {


    /**
     * indicated wether the route has been successfully handled.
     */
    private $handled = false;

    function __construct() {}

    /**
    * handle get routes/requests
    * 
    * @var $route string the route to handle.
    * @var $view string the view to render.
    */
    public function get($route, $view)
    {
        $route = "/swapproj" . $route;

        $uri = $_SERVER['REQUEST_URI'];
        
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            return false;
        }
        $value = 0; 
        
        if(!strpos($route,"?")){ 
            if($route!="/swapproj/"){ 

                //use the $route parameter and replace "/" for regex to read properly. 
                $regexroute = str_replace('/','(\/)',$route);
        
                /*
                
                /  \i        -> is to check for pattern
                             -> we are checking GET parameter
                             -> for example ?ans=five in "../wordhere?ans=five" 
                
                */
                $regexroute ="/". $regexroute . "(\?)(.*)(\=)(.*)/i";
        
                //Uncomment these to commands to debug
                // echo $regexroute;
                // echo "<br>";
                // echo $uri;
                // echo "<br>";
            
        
                $value = preg_match($regexroute,$uri);


                //Uncomment these to commands to debug
                // echo $value;
                // echo "<br><br><br>";
            }
           
        }        

        

        if ( ($uri === $route) || ($uri == $route . "/" && $uri!='/swapproj//') || $value == 1 ) {
            $this->handled = true;
            return include_once (views . $view);
        }
    }

    
    public function post($route, $view)
    {

    

        $route = "/swapproj" . $route;
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return false;
        }

        

        $uri = $_SERVER['REQUEST_URI'];

        
        // echo $uri;
        // echo '<br>';
        // echo $route;
        // echo '<br>';

        if ($uri === $route) {
            $this->handled = true;
            return include_once (views . $view);
        }
    }



    function pictures($route,$view){
        $uri = $_SERVER['REQUEST_URI'];
        $route = "/swapproj" . $route;

        
        if($uri==$route){
            $this->handled = true;
            header('Content-Type: image/png');
            return include_once (views . $view);
        }
        
        
    }


    /**
     * handle non-existing routes.
     */
    function __destruct() 
    {
        if (!$this->handled) {
            return include_once(views . '404.html');
        }
    }

}