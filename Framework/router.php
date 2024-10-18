<?php

namespace Framework;

class Router{
    protected $routes = [];

    /**
     * @param string $method
     * @param string $uri
     * @param string $action
     * @return void
     */
    private function registerRoute($method,$uri,$action){
        list($controller,$controllerMethod) = explode('@',$action);
        $this->routes[] = [
            'method' =>$method,
            'uri' =>$uri,
            'controller' =>$controller,
            'controllerMethod' =>$controllerMethod
        ];
    }
 

/**
 * get路由
 * @param string $uri
 * @param string $controller
 * @return void
 */
public function addGet($uri,$controller){
    $this->registerRoute('GET',$uri,$controller);
}

/**
 * post路由
 * @param string $uri
 * @param string $controller
 * @return void
 */
public function addPost($uri,$controller){
    $this->registerRoute('POST',$uri,$controller);
}

/**
 * put路由
 * @param string $uri
 * @param string $controller
 * @return void
 */
public function addPut($uri,$controller){
    $this->registerRoute('PUT',$uri,$controller);
}
/**
 * delete路由
 * @param string $uri
 * @param string $controller
 * @return void 
 */
public function addDelete($uri,$controller){
    $this->registerRoute('DELETE',$uri,$controller);
}
 

/**
 * 加载错误页面
 * @param int $httpCode
 * @return void
 */
public function error($httpCode = 404)
{
    http_response_code($httpCode);
    loadView("error/{$httpCode}");
    exit;
}


/**
 * 执行路由
 * @param string $uri
 * @return void
 */
public function route($uri) {

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    //拆分目前uri
    $uriSegments = explode('/',trim($uri,'/'));

    foreach($this->routes as $route) {
        //拆分路由uri
       $routeSegments = explode('/',trim($route['uri'],'/'));

       $match = false;

       //检查是否匹配
       if(count($uriSegments) === count($routeSegments) && strtoupper($route['method'] === $requestMethod)){
        $params = [];
        $match = true;
        for ($i = 0; $i<count($uriSegments);$i++){
            if($routeSegments[$i] !== $uriSegments[$i] && !preg_match('/\{(.+?)\}/',$routeSegments[$i])){
                $match = false;
                break;
            }

            if(preg_match('/\{(.+?)\}/',$routeSegments[$i],$matches)){
                $params[$matches[1]] = $uriSegments[$i];
            }
        }

       }
        if ($match) {
            $controller = 'App\\Controllers\\' . $route["controller"];
            $controllerMethod = $route['controllerMethod'];
            $controllerInstance = new $controller();
            $controllerInstance->$controllerMethod($params);
            return;
        }
    }

    ErrorController::notFound();
}


}