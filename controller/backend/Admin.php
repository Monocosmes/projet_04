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
            'chapterNumber' => $_POST['chapterNumber'],
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'published' => $_POST['published']
        ]);

        if($chapter->isValid($_POST['chapterNumber']) AND $chapter->isValid($_POST['title']) AND $chapter->isValid($_POST['content']) AND $chapter->isValid($_POST['author']))
    	{
    		$chapterManager = new ChapterManager();
            $chapterId = $chapterManager->addChapter($chapter);

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$chapterId);
    	}
    	else
    	{
    		$router = new Router('404');
            $router->renderController();
    	}    	
    }    

    public function deleteChapter($params)
    {
        extract($params);

        $chapterManager = new ChapterManager();
        $chapterManager->deleteChapter($chapterId);

        $commentManager = new CommentManager();
        $commentManager->deleteComment($chapterId);

        $myView = new View();
        $myView->redirect('home.html');
    }

    public function showDashboard($params)
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->getReportedComments();

        $elements = ['comments' => $comments];

        $myView = new View('admin/dashboard');
        $myView->render($elements);
    }

    public function showEditPage($params)
    {
        extract($params);

        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($chapterId);

        $elements = ['chapter' => $chapter];

        $myView = new View('admin/editChapter');
        $myView->render($elements);
    }

    public function showWriteChapter($params)
    {
    	$myView = new View('admin/writeChapter');
        $myView->render();
    }    

    public function updateChapter($params)
    {
        extract($params);

        $chapter = new Chapter
        ([
            'id' => $chapterId,
            'authorId' => $_POST['author'],
            'chapterNumber' => $_POST['chapterNumber'],
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'published' => $_POST['published']
        ]);

        $chapterManager = new ChapterManager();
        $chapterManager->updateChapter($chapter);

        $myView = new View();
        $myView->redirect('chapter.html/chapterId/'.$chapter->getId());
    }
}