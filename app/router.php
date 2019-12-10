<?php
class Router {
    private static $_routes = [],
        $_defaultConfig  = [
            'method' => 'GET'
        ];
    public static function getRoutes() {
        return self::$_routes;
    }

    public static function route($url) {
        $checkedRoute = self::checkRoute($url);
        if(is_callable($checkedRoute['action'])) {
            call_user_func_array($checkedRoute['action'], $checkedRoute['params']);
        }
        if ($checkedRoute !== false) {
            $urlParts = explode('.', $checkedRoute['action']);
            $controllerName =  str_replace('Controller', '', $urlParts[0]);
            $actionName = (isset($urlParts[1]) ? $urlParts[1] : 'index') . 'Action';
            $params = $checkedRoute['params'];
            $controllerClassName = 'App\\Controllers\\'. ucfirst($controllerName) . 'Controller';
            $ctrl = new $controllerClassName();
            if (method_exists($ctrl, $actionName)) {
                call_user_func_array(array($ctrl, $actionName), $params);
            } else {
                echo "action does not exist";
            }
        } else {
            echo "page not found";
        }
    }

    public static function register($route, $routeAction, $config = []) {
        $config = self::getConfig($config);
        preg_match_all('/^([^{]+)\//', $route, $matches);
        $rParams = [];
        $rName = isset($matches[1][0]) ? $matches[1][0] : $route;
        if($rName !== $route) {
            preg_match_all('/\/{([^\}]+)}/U', $route, $matches);
            $rParams = $matches[1];
        }
        $config['action'] = $routeAction;
        $config['params'] = $rParams;
        $config['name'] = $rName;
        self::$_routes[] = $config;
    }

    private static function checkRoute($url) {
        foreach (self::$_routes as $conf) {
            $name = $conf['name'];
            $filteredParams = self::removeArbitraryParams($conf['params']);
            $urlname = rtrim(substr($url, 0, strlen($name . '/')), '/');
            if($name === ($urlname !== '' ? $urlname : '/')) {
                if ($_SERVER['REQUEST_METHOD'] == $conf['method']) {
                    $urlParts = explode("/", trim(substr($url, strlen($name)), '/'));
                    clearArray($urlParts);
                    if ($name == '/' || count($conf['params']) >= count($urlParts)) {
                        foreach ($urlParts as $index => $value) {
                            if ($urlParts[$index])
                                $filteredParams[$index] = $urlParts[$index];
                        }
                        $conf['params'] = $filteredParams;
                        return $conf;
                    }
                }
            }
        }
        return false;
    }

    private static function removeArbitraryParams($params) {
        $params2 = [];
        foreach ($params as $key => $value) {
            if($value[0] === "?") {
                return $params2;
            }
            $params2[] = $value;
        }
        return [];
    }

    private static function getConfig($config) {
        $ret = self::$_defaultConfig;
        foreach ($config as $cName => $cVal) {
            $ret[$cName] = $cVal;
        }
        return $ret;
    }
}