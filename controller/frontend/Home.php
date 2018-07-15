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
    		'author' => $_POST['author'],
    		'message' => $_POST['message'],
    		'authorIp' => $_POST['authorIp']    		
    	]);

    	if($comment->isContentValid($_POST['message']) AND $comment->isAuthorValid($_POST['author']))
    	{
    		$commentManager = new CommentManager();
            $commentId = $commentManager->addComment($comment);

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$commentId);
    	}
    	else
    	{
    		$myView = new View('404');
            $myView->render();
    	}
    }

    public function showHome($params)
    {
		$chapterManager = new ChapterManager();
		$chapter = $chapterManager->getLastChapter();
		$chapters = $chapterManager->getAllChapters();

		$myView = new View('home');
		$myView->render($chapter, $chapters);		
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
}
	
