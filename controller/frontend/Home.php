<?php

/**
 * summary
 */
class Home
{
    public function showHome()
    {
		$chapterManager = new ChapterManager();
		$chapter = $chapterManager->getLastChapter();
		$chapters = $chapterManager->getAllChapters();

		$myView = new View('home');
		$myView->render($chapter, $chapters);		
    }

    public function showChapters()
    {
    	$chapterManager = new ChapterManager();
    	$chapters = $chapterManager->getAllChapters();

    	$myView = new View('chapters');
		$myView->render(null, $chapters);
    }
}
	
