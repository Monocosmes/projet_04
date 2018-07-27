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
        
        if($chapter->isValid($chapter->getChapterNumber()) AND $chapter->isValid($chapter->getTitle()) AND $chapter->isValid($chapter->getContent()) AND $chapter->isValid($chapter->getAuthorId))
    	{
    		$chapterManager = new ChapterManager();
            $chapterId = $chapterManager->addChapter($chapter);

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$chapterId);
    	}
    	else
    	{  
            $_SESSION['chapterNumber'] = $_POST['chapterNumber'];
            $_SESSION['content'] = $_POST['content'];
            $_SESSION['title'] = $_POST['title'];

    		$myView = new View();
            $myView->redirect('writeChapter.html');
    	}    	
    }

    public function addModerationMessage($params)
    {
        $moderation = new Moderation(['moderationMessage' => $_POST['moderationMessage']]);

        if($moderation->isValid($moderation->getModerationMessage()))
        {
            $moderationManager = new ModerationManager();
            $moderationManager->addMessage($moderation);
    
            $_SESSION['message'] = 'Nouveau message de modération ajouté avec succés';    
        }
        
        $myView = new View();
        $myView->redirect('dashboard.html');        
    }    

    public function deleteChapter($params)
    {
        extract($params);

        $num = -1;

        $chapterManager = new ChapterManager();
        $chapterManager->deleteChapter($chapterId);

        $commentManager = new CommentManager();
        $comments = $commentManager->getAllComments($chapterId);

        $userManager = new UserManager();

        foreach($comments as $comment)
        {
            $userManager->updateCommentPosted($comment->getAuthorId() ,$num);
        }

        $commentManager->deleteChapterComments($chapterId);

        $myView = new View();
        $myView->redirect('home.html');
    }

    public function lockAccount($params)
    {
        extract($params);

        $userManager = new UserManager();
        $userManager->lockAccount($userId, 1);

        $myView = new View();
        $myView->redirect('profile/userId/'.$userId);
    }

    public function moderate($params)
    {
        $comment = new Comment
        ([
            'id' => $_POST['id'],
            'chapterId' => $_POST['chapterId'],
            'moderationId' => (int) $_POST['moderationId'],
        ]);

        if($comment->isValid($comment->getId()) AND $comment->isValid($comment->getChapterId()) AND $comment->isValid($comment->getModerationId()))
        {
            $num = 1;

            if($comment->getModerationId() == -1)
            {
                $num = 0;
            }

            $commentManager = new CommentManager();
            $commentManager->moderateComment($comment, $num);

            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId().'#c-'.$comment->getId());
        }
        else
        {
            $myView = new View();
            $myView->redirect('chapter.html/chapterId/'.$comment->getChapterId());
        }
    }

    public function publishChapter($params)
    {
        extract($params);

        $chapterManager = new ChapterManager();
        $chapterManager->publishChapter($chapterId, $publish);

        $myView = new View();
        $myView->redirect('chapter.html/chapterId/'.$chapterId);
    }

    public function showDashboard($params)
    {
        $footer = new Footer();
        $commentManager = new CommentManager();
        $comments = $commentManager->getReportedComments();

        $elements = ['comments' => $comments, 'footer' => $footer];

        $myView = new View('admin/dashboard');
        $myView->render($elements);
    }

    public function showEditPage($params)
    {
        extract($params);

        $footer = new Footer();
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getChapter($chapterId);

        $elements = ['chapter' => $chapter, 'footer' => $footer];

        $myView = new View('admin/editChapter');
        $myView->render($elements);
    }

    public function showReportedComments($params)
    {
        $footer = new Footer();        

        $commentManager = new CommentManager();
        $comments = $commentManager->getReportedComments();

        $elements = ['comments' => $comments, 'footer' => $footer];

        $myView = new View('admin/reportedComments');
        $myView->render($elements);
    }

    public function showSavedPages($params)
    {
        $footer = new Footer();

        $order = 'chapter.creationDate DESC';
        $where = 'WHERE published = 0';

        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getAllChapters($order, $where);

        $elements = ['chapters' => $chapters, 'footer' => $footer];

        $myView = new View('chapters');
        $myView->render($elements);
    }

    public function showWriteChapter($params)
    {
    	$footer = new Footer();

        $elements = ['footer' => $footer];

        $myView = new View('admin/writeChapter');
        $myView->render($elements);
    }

    public function unlockAccount($params)
    {
        extract($params);

        $userManager = new UserManager();
        $userManager->lockAccount($userId, 0);

        $myView = new View();
        $myView->redirect('profile/userId/'.$userId);
    }

    public function unreportComment($params)
    {
        extract($params);

        $commentManager = new CommentManager();
        $commentManager->reportComment($commentId, (int) 0);

        $myView = new View();
        $myView->redirect('chapter.html/chapterId/'.$chapterId.'#c-'.$commentId);
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

        if($chapter->isValid($chapter->getId()) AND $chapter->isValid($chapter->getAuthorId()) AND $chapter->isValid($chapter->getChapterNumber()) AND $chapter->isValid($chapter->getTitle()) AND $chapter->isValid($chapter->getContent()) AND $chapter->isValid($chapter->getPublished()))
        {
            $chapterManager = new ChapterManager();
            $chapterManager->updateChapter($chapter);

            $_SESSION['message'] = 'Le billet a bien été modifié';
        }

        $myView = new View();
        $myView->redirect('chapter.html/chapterId/'.$chapter->getId());
    }
}