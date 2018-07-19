<?php

/**
 * summary
 */
class Router
{
    private $request;
    private $routes =
    [
        'addComment'        => ['controller' => 'Home', 'method' => 'addComment'],
        'chapter.html'      => ['controller' => 'Home', 'method' => 'showChapter'],
        'chapters.html'     => ['controller' => 'Home', 'method' => 'showChapters'],
        'home.html'         => ['controller' => 'Home', 'method' => 'showHome'],
        'reportComment'     => ['controller' => 'Home', 'method' => 'reportComment'],
        'signin'            => ['controller' => 'Home', 'method' => 'signin'],
        'signin.html'       => ['controller' => 'Home', 'method' => 'showSigninPage'],
        'signup'            => ['controller' => 'Home', 'method' => 'addUser'],
        'signup.html'       => ['controller' => 'Home', 'method' => 'showSignupPage'],
        'signoff'           => ['controller' => 'Home', 'method' => 'signoff'],
        'addChapter'        => ['controller' => 'Admin', 'method' => 'addChapter'],
        'dashboard.html'    => ['controller' => 'Admin', 'method' => 'showDashboard'],
        'deleteChapter'     => ['controller' => 'Admin', 'method' => 'deleteChapter'],
        'editChapter.html'  => ['controller' => 'Admin', 'method' => 'showEditPage'],
        'updateChapter'     => ['controller' => 'Admin', 'method' => 'updateChapter'],
        'writeChapter.html' => ['controller' => 'Admin', 'method' => 'showWriteChapter'],
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

        if($this->routes[$route]['controller'] === 'Admin' AND (!isset($_SESSION['rank']) OR $_SESSION['rank'] < 4))
        {
            $myView = new View();
            $myView->redirect('home.html');
            //exit;
        }
        
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