<?php

/**
 * This class displays every views. It also displays some elements in it as buttons or links.
 */
class View
{
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

		unset($_SESSION['moderate']);
    }

    public function redirect($route)
    {
    	header('Location: ' .HOST.$route);
    	exit;
    }

    public function displayComment($comment)
    {
    	if($comment->getModerated())
    	{
			if($_SESSION['rank'] > 3)
			{
				return '<span class="redText">'.$comment->getModerationMessage().'</span><div>'.$comment->getMessage().'</div>';
			}
			else
			{
				return '<span class="redText">'.$comment->getModerationMessage().'</span>';
			}
		}
		else
		{
			return '<div>'.$comment->getMessage().'</div>';
		}
    }

    public function editChapterButton($chapter)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3))
    	{
    		return '<a class="button" href="'.HOST.'editChapter.html/chapterId/'.$chapter->getId().'">Modifier</a>';
    	}
    }

    public function deleteChapterButton($chapter)
    {
    	if(isset($_SESSION['rank']) AND $_SESSION['rank'] > 3)
    	{
    		return '<a class="button" href="'.HOST.'deleteChapter/chapterId/'.$chapter->getId().'">Supprimer</a>';
    	}
    }

    public function publishChapter($chapter)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3))
    	{
    		if($chapter->getPublished())
    		{
    			return '<a class="button" href="'.HOST.'publishChapter/chapterId/'.$chapter->getId().'/publish/0">Dépublier</a>';
    		}
    		else
    		{
    			return '<a class="button" href="'.HOST.'publishChapter/chapterId/'.$chapter->getId().'/publish/1">Publier</a>';
    		}
    	}
    }

    public function previousChapterButton($chapter)
    {    	
    	$next = ($chapter->getPreviousChapterId() == $chapter->getId())?'id="nextChapter"':'';

    	return '<a '.$next.'  class="button" href="'.HOST.'chapter.html/chapterId/'.$chapter->getPreviousChapterId().'">Billet précédent</a>';    	
    }

    public function nextChapterButton($chapter)
    {
    	if($chapter->getNextChapterId() != $chapter->getId())
    	{
    		return '<a class="button" href="'.HOST. 'chapter.html/chapterId/'.$chapter->getNextChapterId().'">Billet suivant</a>';
    	}
    }

    public function editCommentButton($comment)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3) OR ($comment->getAuthorId() === $_SESSION['id'] AND !$comment->getModerated()))
    	{
    		return '<a class="button editCommentButton" id="'.$comment->getId().'" href="'.HOST.'editComment/chapterId/'.$comment->getChapterId().'/commentId/'.$comment->getId().'">Modifier</a>';
    	}
    }

    public function deleteCommentButton($comment)
    {
    	if((isset($_SESSION['rank']) AND $_SESSION['rank'] > 3) OR $comment->getAuthorId() === $_SESSION['id'])
    	{
    		return '<a class="button" href="'.HOST.'deleteComment/chapterId/'.$comment->getChapterId().'/commentId/'.$comment->getId().'">Supprimer</a>';
    	}
    }

    public function commentReported($comment)
    {
    	if($comment->getReported())
    	{
    		return '- <span class="redText">Ce commentaire a été signalé</span>';
    	}
    }

    public function reportComment($comment)
    {
    	if($_SESSION['isLogged'] AND $_SESSION['rank'] > 3 AND $comment->getReported())
    	{
    		return '<a class="button" href="'.HOST.'validComment/chapterId/'.$comment->getChapterId().'/commentId/'.$comment->getId().'">Commentaire conforme</a>';
    	}

    	if(!$comment->getModerated())
    	{
    		return '<a class="button" href="'.HOST.'reportComment/chapterId/'.$comment->getChapterId().'/commentId/'.$comment->getId().'">Signaler ce commentaire</a>';
    	}
    }

    public function dashboard()
    {
    	if($_SESSION['isLogged'] AND $_SESSION['rank'] > 3)
			return '<li><a class="whiteText" href="'.HOST.'dashboard.html">Tableau de bord</a></li>';
    }

    public function signLink()
    {
    	if($_SESSION['isLogged'])
			return '<li><a class="whiteText" href="'.HOST.htmlspecialchars($_SESSION['login']).'/'.$_SESSION['id'].'">'.htmlspecialchars($_SESSION['login']).'</a></li><li><a class="whiteText" href="'.HOST.'signoff">Déconnexion</a></li>';
		else
			return '<li><a class="whiteText" id="loginPopup" href="'.HOST.'signin.html">Connexion</a></li><li><a class="whiteText" href="'.HOST.'signup.html">S\'inscrire</a></li>';
    }
}