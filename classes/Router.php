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
        'addComment' => ['controller' => 'Home', 'method' => 'addComment'],
        'reportComment' => ['controller' => 'Home', 'method' => 'reportComment'],
        'writeChapter.html' => ['controller' => 'Admin', 'method' => 'showWriteChapter'],
        'addChapter' => ['controller' => 'Admin', 'method' => 'addChapter'],
        'addUser' => ['controller' => 'Admin', 'method' => 'addUser'],
        'signin' => ['controller' => 'Admin', 'method' => 'signin'],
        'signoff' => ['controller' => 'Admin', 'method' => 'signoff'],
        'signin.html' => ['controller' => 'Admin', 'method' => 'showSigninPage'],
        'dashboard.html' => ['controller' => 'Admin', 'method' => 'showDashboard'],
    ];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getParams()
    {
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