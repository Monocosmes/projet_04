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

    	if($comment->isValid($comment->getMessage()) AND $comment->isValid($comment->getAuthorId()) AND $comment->isValid($comment->getChapterId()))
    	{
    		$userManager = new UserManager();
            $user = $userManager->getUser($comment->getAuthorId());

            if(!$user->getIsLocked())
            {
                $commentManager = new CommentManager();
                $commentId = $commentManager->addComment($comment);
    
                $chapterManager = new ChapterManager();
                $chapterManager->changeCommentNumber($comment->getChapterId(), (1));
                
                $userManager->updateCommentPosted($comment->getAuthorId(), 1);
            }
            else
            {
                $myView = new View();
                $myView->redirect('signoff');
            }            
    	}
    	else
    	{
    		$_SESSION['content'] = $_POST['message'];    		
    	}

    	$myView = new View();
        $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$commentId);
    }    

    public function deleteComment($params)
    {
    	extract($params);

    	$num = -1;

    	$commentManager = new CommentManager();
    	$comment = $commentManager->getComment($commentId);
    	$commentManager->deleteComment($commentId);

    	$chapterManager = new ChapterManager();
    	$chapterManager->changeCommentNumber($chapterId, $num);

    	$userManager = new UserManager();
        $userManager->updateCommentPosted($comment->getAuthorId(), $num);

    	$myView = new View();
        $myView->redirect('chapter.html/chapterId/'.$chapterId);
    }

    public function editComment($params)
    {
    	$comment = new Comment
    	([
    		'id' => $_POST['id'],
    		'chapterId' => $_POST['chapterId'],
    		'message' => $_POST['message']
    	]);

    	if($comment->isValid($comment->getMessage()) AND $comment->isValid($comment->getChapterId()) AND $comment->isValid($comment->getId()))
    	{
    		$commentManager = new CommentManager();
            $commentManager->updateComment($comment);

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$comment->getId());
    	}
    	else
    	{
    		$myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId());
    	}
    }

    public function reportComment($params)
    {
    	extract($params);

    	$commentManager = new CommentManager();
    	$commentManager->reportComment($commentId, 1);

    	$myView = new View();
    	$myView->redirect('chapter.html/chapterId/'.$chapterId.'#c-'.$commentId);
    }

    public function show404Page($params)
    {
    	$footer = new Footer();
    	$elements = ['footer' => $footer];

    	$myView = new View('404');
		$myView->render($elements);
    }

    public function showChapter($params)
    {
    	extract($params);

    	$footer = new Footer();
    	$chapterManager = new ChapterManager();
    	$chapter = $chapterManager->getChapter($chapterId);

    	$moderationManager = new ModerationManager();
        $moderations = $moderationManager->getMessages();

        foreach($moderations as $moderation)
        {
            $_SESSION['moderate'][] = $moderation->getModerationMessage();
        }        

    	if($chapter)
		{
			$chapter->setNextChapterId();
			$chapter->setPreviousChapterId();
		}

    	$commentManager = new CommentManager();
    	$comments = $commentManager->getAllComments($chapterId);

    	$elements = ['chapter' => $chapter, 'comments' => $comments, 'footer' => $footer];

    	$myView = new View('chapter');
		$myView->render($elements);
    }

    public function showChapters($params)
    {
    	$footer = new Footer();
    	$chapterManager = new ChapterManager();

    	if($_SESSION['rank'] > 3)
    	{
    		$order = 'chapterNumber';
    		$where = null;
		}
		else
		{
			$order = 'chapterNumber';
			$where = 'WHERE published = 1';
		}


    	$chapters = $chapterManager->getAllChapters($order, $where);    	

    	$elements = ['chapters' => $chapters, 'footer' => $footer];

    	$myView = new View('chapters');
		$myView->render($elements);
    }

    public function showHome($params)
    {
		$footer = new Footer();
		$chapterManager = new ChapterManager();
		$userManager = new UserManager();
		$user = $userManager->getUser($_SESSION['id']);

		$order = 'chapter.creationDate DESC';
		$where = 'WHERE published = 1';

		$chapters = $chapterManager->getAllChapters($order, $where);

		$elements = ['user' => $user, 'chapters' => $chapters, 'footer' => $footer];

		$myView = new View('home');
		$myView->render($elements);
    }

    public function showProfile($params)
    {
        extract($params);

        $userData = (isset($userId))?(int) $userId:$userName;

        $footer = new Footer();
        $userManager = new UserManager();
        $user = $userManager->getUser($userData);

        $elements = ['user' => $user, 'footer' => $footer];

        $myView = new View('profile');
        $myView->render($elements);
    }
}
	
