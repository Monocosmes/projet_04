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

    public function render($elements = [])
    {
    	$page = $this->page;
    	extract($elements);

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

    public function editChapterButton($chapter)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3) OR $chapter->getAuthorId() === $_SESSION['id'])
    	{
    		return '<a href="'.HOST.'editChapter.html/chapterId/'.$chapter->getId().'">Modifier</a>';
    	}
    }

    public function deleteChapterButton($chapter)
    {
    	if(isset($_SESSION['rank']) AND $_SESSION['rank'] > 3)
    	{
    		return '<a href="'.HOST.'deleteChapter/chapterId/'.$chapter->getId().'">Supprimer</a>';
    	}
    }

    public function editCommentButton($comment)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3) OR $comment->getAuthorId() === $_SESSION['id'])
    	{
    		return '<a class="editCommentButton" id="'.$comment->getId().'" href="'.HOST.'editComment/chapterId/'.$comment->getChapterId().'/commentId/'.$comment->getId().'">Modifier</a>';
    	}
    }

    public function deleteCommentButton($comment)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3) OR $comment->getAuthorId() === $_SESSION['id'])
    	{
    		return '<a href="'.HOST.'deleteComment/chapterId/'.$comment->getChapterId().'/commentId/'.$comment->getId().'">Supprimer</a>';
    	}
    }

    public function dashboard()
    {
    	if($_SESSION['isLogged'] AND $_SESSION['rank'] > 3)
			return '<li><a href="'.HOST.'dashboard.html">Tableau de bord</a></li>';
    }

    public function signLink()
    {
    	if($_SESSION['isLogged'])
			return '<li><a href="'.HOST.'signoff">Déconnexion</a></li>';
		else
			return '<li><a href="'.HOST.'signin.html">Connexion</a></li><li><a href="'.HOST.'signup.html">S\'inscrire</a></li>';
    }
}