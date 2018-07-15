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
        'chapter.html' => ['controller' => 'Home', 'method' => 'showChapter'],
        'writeChapter.html' => ['controller' => 'Admin', 'method' => 'showWriteChapter'],
        'addChapter' => ['controller' => 'Admin', 'method' => 'addChapter'],
        'addComment' => ['controller' => 'Home', 'method' => 'addComment'],
    ];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getParams()
    {
        //echo $this->request; exit;

        $elements = explode('/', $this->request);
        unset($elements[0]);

        for($i = 1; $i < count($elements); $i++)
        {
            $params[$elements[$i]] = $elements[$i + 1];
            $i++;
        }

        if(!isset($params))
        {
            $params = null;
        }

        return $params;
    }

    public function getRoute()
    {
        $elements = explode('/', $this->request);

        return $elements[0];
    }

    public function renderController()
    {
        $route = $this->getRoute();
        $params = $this->getParams();

        if(key_exists($route, $this->routes))
        {
            $controller = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            $currentController = new $controller();
            $currentController->$method($params);
        }
        else
        {
            $myView = new View('404');
            $myView->render();    
        }
    }
}