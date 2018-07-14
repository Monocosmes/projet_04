<?php

/**
 * summary
 */
class Router
{
    private $request;
    private $routes =
    [
        'home.html' => ['controller' => 'Home', 'method' => 'showHome'],
        'chapters.html' => ['controller' => 'Home', 'method' => 'showChapters'],
        'writeChapter.html' => ['controller' => 'Admin', 'method' => 'showWriteChapter'],
        'addChapter' => ['controller' => 'Admin', 'method' => 'addChapter'],
    ];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function renderController()
    {
        $request = $this->request;

        if(key_exists($request, $this->routes))
        {
            $controller = $this->routes[$request]['controller'];
            $method = $this->routes[$request]['method'];

            $currentController = new $controller();
            $currentController->$method();
        }
        else
        {
            ob_start();
            require_once VIEW.'404.php';
            $content = ob_get_clean();
    
            $pageTitle = 'Page 404';
        
            require_once VIEW.'_template.php';    
        }
    }
}