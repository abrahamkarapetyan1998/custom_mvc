<?php
/**
 * Class Router - handles routing of requests to appropriate handlers.
 */
class Router {
    /**
     * @var array $routes - array of all available routes.
     */
    private $routes = array();

    /**
     * Adds a new route to the Router.
     *
     * @param string $method - HTTP method for the route.
     * @param string $url - URL for the route.
     * @param mixed $handler - Handler for the route (can be a callable function or a string in the format "Class@method").
     */
    public function addRoute(string $method, string $url, $handler): void {
        $this->routes[] = array(
            'method' => $method,
            'url' => $url,
            'handler' => $handler
        );
    }

    /**
     * Dispatches the request to the appropriate handler.
     *
     * @return mixed - Returns the response from the handler.
     * @throws Exception - Throws exception if route handler is invalid.
     */
    public function dispatch() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['url'] === $path) {
                $handler = $route['handler'];
                if (is_string($handler)) {
                    $handler = explode('@', $handler);
                    $class = $handler[0];
                    $method = $handler[1];
                    $controller = new $class();
                    return $controller->$method();
                } else if (is_callable($handler)) {
                    return $handler();
                } else if (is_string($handler) && file_exists($handler)) {
                    return view($handler);
                } else {
                    throw new Exception('Invalid route handler');
                }
            }
        }
        http_response_code(404);
        return '404 Page Not Found';
    }
}

/**
 * Renders the specified view file.
 *
 * @param string $file - Name of the view file to render.
 * @return void
 */
function view(string $file): void {
    ob_start();
    $viewsPath = __DIR__ . '/../views/';
    require $viewsPath . $file;
}