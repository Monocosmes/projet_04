<?php

/**
 * summary
 */
class View
{
    /**
     * summary
     */
    private $page;

    public function __construct($page = [])
    {
        $this->page = $page;
    }

    public function render($chapter = [], $chapters = [], $comments = [])
    {
    	$page = $this->page;

    	ob_start();
    	
		require_once VIEW.$page.'.php';

		$content = ob_get_clean();

		require_once VIEW.'_template.php';
    }

    public function redirect($route)
    {
    	header('Location: ' .HOST.$route);
    	exit;
    }

    public function dashboard()
    {
    	if(isset($_SESSION['isLogged']) AND $_SESSION['isLogged'] AND $_SESSION['rank'] > 3)
			return '<li><a href="'.HOST.'dashboard.html">Tableau de bord</a></li><li><a href="'.HOST.'signoff">Déconnexion</a></li>';
		else
			return '<li><a href="'.HOST.'signin.html">Connexion</a></li>';
    }
}