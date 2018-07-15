<?php

/**
 * summary
 */
class Admin
{
    public function addChapter($params)
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

            $myView = new View();
            $myView->redirect('home.html/chapterId/'.$chapterId);
    	}
    	else
    	{
    		$router = new Router('404');
            $router->renderController();
    	}    	
    }

    public function showWriteChapter($params)
    {
    	$myView = new View('writeChapter');
        $myView->render();
    }
}