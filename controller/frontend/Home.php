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

    	if($comment->isValid($_POST['message']) AND $comment->isValid($_POST['authorId']) AND $comment->isValid($_POST['chapterId']))
    	{
    		$commentManager = new CommentManager();
            $commentId = $commentManager->addComment($comment);

            $chapterManager = new ChapterManager();
            $chapterManager->changeCommentNumber($comment->getChapterId(), (1));

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$commentId);
    	}
    	else
    	{
    		$myView = new View('404');
            $myView->render();
    	}
    }    

    public function deleteComment($params)
    {
    	extract($params);

    	$num = -1;

    	$commentManager = new CommentManager();
    	$commentManager->deleteComment($commentId);

    	$chapterManager = new ChapterManager();
    	$chapterManager->changeCommentNumber($chapterId, $num);

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

    	if($comment->isValid($_POST['message']) AND $comment->isValid($_POST['chapterId']) AND $comment->isValid($_POST['id']))
    	{
    		$commentManager = new CommentManager();
            $commentManager->updateComment($comment);

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$comment->getId());
    	}
    	else
    	{
    		$myView = new View('404');
            $myView->render();
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

    	$elements = ['chapter' => $chapter, 'comments' => $comments];

    	$myView = new View('chapter');
		$myView->render($elements);
    }

    public function showChapters($params)
    {
    	$chapterManager = new ChapterManager();
    	$chapters = $chapterManager->getAllChapters();    	

    	$elements = ['chapters' => $chapters];

    	$myView = new View('chapters');
		$myView->render($elements);
    }

    public function showHome($params)
    {
		$chapterManager = new ChapterManager();
		$chapter = $chapterManager->getLastChapter();
		$chapters = $chapterManager->getAllChapters();

		$elements = ['chapter' => $chapter, 'chapters' => $chapters];

		$myView = new View('home');
		$myView->render($elements);		
    }    
}
	
