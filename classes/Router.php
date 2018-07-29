<?php

/**
 * summary
 */
class Router
{
    private $request;
    private $routes =
    [
        'addComment'            => ['controller' => 'Home', 'method' => 'addComment'],
        'chapter.html'          => ['controller' => 'Home', 'method' => 'showChapter'],
        'chapters.html'         => ['controller' => 'Home', 'method' => 'showChapters'],
        'contact.html'          => ['controller' => 'Home', 'method' => 'showContact'],
        'deleteComment'         => ['controller' => 'Home', 'method' => 'deleteComment'],
        'editComment'           => ['controller' => 'Home', 'method' => 'editComment'],
        'editProfile'           => ['controller' => 'Home', 'method' => 'showEditProfile'],
        'home.html'             => ['controller' => 'Home', 'method' => 'showHome'],
        'profile'               => ['controller' => 'Home', 'method' => 'showProfile'],
        'reportComment'         => ['controller' => 'Home', 'method' => 'reportComment'],
        'updateProfile'         => ['controller' => 'Home', 'method' => 'updateProfile'],        
        'deleteAccount'         => ['controller' => 'Entry', 'method' => 'deleteAccount'],
        'signin'                => ['controller' => 'Entry', 'method' => 'signin'],
        'signin.html'           => ['controller' => 'Entry', 'method' => 'showSigninPage'],
        'signup'                => ['controller' => 'Entry', 'method' => 'signup'],
        'signup.html'           => ['controller' => 'Entry', 'method' => 'showSignupPage'],
        'signoff'               => ['controller' => 'Entry', 'method' => 'signoff'],
        'addChapter'            => ['controller' => 'Admin', 'method' => 'addChapter'],
        'addModerationMessage'  => ['controller' => 'Admin', 'method' => 'addModerationMessage'],
        'dashboard.html'        => ['controller' => 'Admin', 'method' => 'showDashboard'],
        'deleteChapter'         => ['controller' => 'Admin', 'method' => 'deleteChapter'],
        'editChapter.html'      => ['controller' => 'Admin', 'method' => 'showEditPage'],
        'lockAccount'           => ['controller' => 'Admin', 'method' => 'lockAccount'],
        'moderate'              => ['controller' => 'Admin', 'method' => 'moderate'],
        'publishChapter'        => ['controller' => 'Admin', 'method' => 'publishChapter'],
        'reportedComments.html' => ['controller' => 'Admin', 'method' => 'showReportedComments'],
        'savedPages.html'       => ['controller' => 'Admin', 'method' => 'showSavedPages'],
        'unlockAccount'         => ['controller' => 'Admin', 'method' => 'unlockAccount'],
        'unreportComment'       => ['controller' => 'Admin', 'method' => 'unreportComment'],
        'updateChapter'         => ['controller' => 'Admin', 'method' => 'updateChapter'],
        'writeChapter.html'     => ['controller' => 'Admin', 'method' => 'showWriteChapter'],
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

        if(isset($this->routes[$route]) AND $this->routes[$route]['controller'] === 'Admin' AND (!isset($_SESSION['rank']) OR $_SESSION['rank'] < 4))
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
            $home = new Home();
            $home->show404Page($params);
        }
    }
}