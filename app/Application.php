<?php
namespace App;

class Application
{
    public static $routes = array();
    public static $methods = array();
    public static $callbacks = array();

    public static function __callStatic($method, $params)
    {
        $uri = strpos($params[0], '/') === 0 ? $params[0] : '/' . $params[0];
        $callback = $params[1];

        array_push(self::$routes, $uri);
        array_push(self::$methods, strtoupper($method));
        array_push(self::$callbacks, $callback);
    }


    public function run()
    {
        $found_route = false;

        $uri = parse_url($_SERVER['REQUEST_URI']);

        $query = isset($uri['query']) ? $uri['query'] : '';
        $uri = $uri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (!empty($query)) {
            parse_str($query, $_GET);
            $_REQUEST = $_GET;
        }

        self::$routes = preg_replace('/\/+/', '/', self::$routes);

        if (in_array($uri, self::$routes)) {

            $route_pos = array_keys(self::$routes, $uri);
            foreach ($route_pos as $route) {

                if (self::$methods[$route] == $method || self::$methods[$route] == 'ANY' ) {
                    $found_route = true;

                    // If route is not an object
                    if (!is_object(self::$callbacks[$route])) {

                        // Grab all parts based on a / separator
                        $parts = explode('/', self::$callbacks[$route]);

                        // Collect the last index of the array
                        $last = end($parts);

                        // Grab the controller name and method call
                        $segments = explode('@',$last);

                        // Instanitate controller
                        $controller = new $segments[0]();

                        // Call method
                        $controller->{$segments[1]}();
                    } else {
                        // Call closure
                        call_user_func(self::$callbacks[$route]);
                    }

                }

            }

        }

        if ($found_route == false) {
            header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
            echo '404';
        }
    }

}

Application::get('/build', 'App\Controllers\HomeController@buildFace');
Application::get('/', 'App\Controllers\HomeController@index');
