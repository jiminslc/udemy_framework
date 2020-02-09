<?php 

/**
 * Router
 * 
 * PHP version 7.2
 */
class Router
{
    /**
     * Associative array of routes (the routing table)
     * @var array
     */
    protected $routes = [];
    
    /**
     * Parameter from the matched route
     * @var array
     */
    protected $params = [];
    

    /**
     * Add a route to the routing table
     * 
     * @param string $route   The route URL
     * @param array  $param   Parameters (controller, action, etc.)
     * 
     * @return void
     */
    public function add($route, $params = [])
    {
        $route0 = $route;
        
        // Convert the route to a regular expression: escape forward slashes
        $route1 = $route = preg_replace('/\//', '\\/',  $route);
        
        // Convert variables e.g.{controller]
        $route2 = $route = preg_replace('/\{([a-z-]+)\}/', '(?P<\1>[a-z-]+)', $route);
        
        // Add start and end delimiters, and case insensitive flag
        $route3 = $route = '/^' . $route . '$/i';
        
        if (0) {
            echo $route0 . '<br />';
            echo $route1 . '<br />';
            echo $route2 . '<br />';
            echo $route3 . '<br />';
            die;
        }
        
        $this->routes[$route] = $params;
        
    } //end function: add.
    
    
    /**
     * Get all the routes from the routing table
     * 
     * #return array
     */
    public function getRoutes()
    {
        return $this->routes;
    }
    
    
    /**
     * Match the route to the routes in the routing table., setting the $parmas
     * property if a route is found.
     * 
     * @param string  $url   The route URL
     * 
     * @return boolean   true if a match found, false otherwise
     */
    public function match($url)
    {  //echo '<pre>';var_dump($this->routes);echo '</pre>';die;
//         foreach ($this->routes as $route => $params) {
//             if ($url == $route) {
//                 $this->params = $params;
//                 return true;
//             }
//         }
 
        // Match to the fixed URL format /controller/action
        //$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";
        
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                // Get names capture group values
                //$params = [];
                
                foreach($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                
                $this->params = $params;
                return true;
            }
        }

        return false;
    }
    
    
    /**
     * Get the currently matched parameters
     * 
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    
    
   
     
} //end class: