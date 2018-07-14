<?php

/**
 * summary
 */
class Admin
{
    public function addChapter()
    {
    	$chapter = new Chapter
        ([
            'authorId' => $_POST['author'],
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'published' => $_POST['published']
        ]);

        if($chapter->isTitleValid($_POST['title']) AND $chapter->isContentValid($_POST['content']) AND $chapter->isAuthorValid($_POST['author']))
    	{
    		$chapterManager = new ChapterManager();
            $chapterId = $chapterManager->addChapter($chapter);

            $chapter = $chapterManager->getChapter($chapterId);

            $myView = new View('home');
            $myView->render($chapter);
    	}
    	else
    	{
    		$router = new Router('404');
            $router->renderController();
    	}    	
    }

    public function showWriteChapter()
    {
    	$myView = new View('writeChapter');
        $myView->render();
    }
}