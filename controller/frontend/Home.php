<?php

/**
 * summary
 */
class Home
{
    public function addComment($params)
    {
    	$comment = new Comment
    	([
    		'chapterId' => $_POST['chapterId'],
    		'authorId' => $_POST['authorId'],
    		'message' => $_POST['message'],
    	]);

    	if($comment->isContentValid($_POST['message']) AND $comment->isAuthorValid($_POST['authorId']))
    	{
    		$commentManager = new CommentManager();
            $commentId = $commentManager->addComment($comment);

            $chapterManager = new ChapterManager();
            $chapterManager->addCommentNumber($comment->getChapterId());

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$commentId);
    	}
    	else
    	{
    		$myView = new View('404');
            $myView->render();
    	}
    }

    public function addUser($params)
    {
        $user = new User
        ([
            'login' => $_POST['login'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);

        if($user->isPasswordsMatch($_POST['passwordMatch']))
        {	
        	$userManager = new UserManager();
        	$userId = $userManager->addUser($user);
        }
        else
        {
        	$myView = new View('entry/signup');
        	$myView->render(null, null, null, $user);
        }        
    }

    public function reportComment($params)
    {
    	extract($params);

    	$commentManager = new CommentManager();
    	$commentManager->reportComment($commentId);

    	$myView = new View();
    	$myView->redirect('chapter.html/chapterId/'.$chapterId);
    }    

    public function showChapter($params)
    {
    	extract($params);

    	$chapterManager = new ChapterManager();
    	$chapter = $chapterManager->getChapter($chapterId);

    	$commentManager = new CommentManager();
    	$comments = $commentManager->getAllComments($chapterId);

    	$myView = new View('chapter');
		$myView->render($chapter, null, $comments);
    }

    public function showChapters($params)
    {
    	$chapterManager = new ChapterManager();
    	$chapters = $chapterManager->getAllChapters();    	

    	$myView = new View('chapters');
		$myView->render(null, $chapters);
    }

    public function showHome($params)
    {
		$chapterManager = new ChapterManager();
		$chapter = $chapterManager->getLastChapter();
		$chapters = $chapterManager->getAllChapters();

		$myView = new View('home');
		$myView->render($chapter, $chapters);		
    }

    public function showSigninPage($params)
    {
        $myView = new View('entry/signin');
        $myView->render();
    }

    public function showSignupPage($params)
    {
    	$myView = new View('entry/signup');
        $myView->render();
    }

    public function signin($params)
    {
        $userManager = new UserManager();
        $user = new User(['login' => $_POST['login']]);

        if($user->isLoginValid())
        {
        	$user = $userManager->getUser($_POST['login']);

        	if($user->isPasswordValid($_POST['password']))
        	{
        	    session_start();
	
        	    $_SESSION['id'] = $user->getId();
        	    $_SESSION['login'] = $user->getLogin();
        	    $_SESSION['email'] = $user->getEmail();
        	    $_SESSION['rank'] = $user->getRank();
        	    $_SESSION['creationDate'] = $user->getCreationDateFr();
        	    $_SESSION['biography'] = $user->getBiography();
        	    $_SESSION['isLogged'] = true;
	
        	    $myView = new View();
        	    $myView->redirect('home.html');
        	}
        	else
        	{        		
        		$myView = new View('entry/signin');
        		$myView->render(null, null, null, $user);
        	}
        }
        else
        {
        	$myView = new View('entry/signin');
        	$myView->render(null, null, null, $user);
        }
    }

    public function signoff($params)
    {
        session_destroy();

        $myView = new View();
        $myView->redirect('home.html');
    }
}
	
