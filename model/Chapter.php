<?php

/**
 * summary
 */
class Chapter extends Entity
{
    protected $id;
    protected $authorId;
    protected $authorName;
    protected $chapterNumber;
    protected $title;
    protected $content;
    protected $creationDateFr;
    protected $editDate;
    protected $published;
    protected $commentNumber;
    protected $previousChapterId;
    protected $nextChapterId;
    
    //Initializing getters
    public function getId() {return $this->id;}
    public function getAuthorId() {return $this->authorId;}
    public function getAuthorName() {return $this->authorName;}
    public function getChapterNumber() {return $this->chapterNumber;}
    public function getTitle() {return $this->title;}
    public function getContent() {return $this->content;}
    public function getCreationDateFr() {return $this->creationDateFr;}
    public function getEditDate() {return $this->editDate;}
    public function getPublished() {return $this->published;}
    public function getCommentNumber() {return $this->commentNumber;}
    public function getPreviousChapterId() {return $this->previousChapterId;}
    public function getNextChapterId() {return $this->nextChapterId;}

    //Initializing setters
    public function setId($id)
    {
    	$id = (int) $id;

    	$this->id = $id;
    }

    public function setAuthorId($authorId)
    {
    	$authorId = (int) $authorId;        
    	
    	$this->authorId = $authorId;    	
    }

    public function setAuthorName($authorName)
    {
        if(is_string($authorName))
        {
            $this->authorName = $authorName;
        }
    }

    public function setChapterNumber($chapterNumber)
    {
        $chapterNumber = (int) $chapterNumber;

        if($chapterNumber <= 0)
        {
            $_SESSION['errors'][] = 'Le numéro d\'un chapitre doit obligatoirement être une valeur numérique positive';
        }
        else
        {                
            $this->chapterNumber = $chapterNumber;
        }
    }

    public function setTitle($title)
    {
    	if(is_string($title))
    	{
    		$this->title = $title;
    	}
    }

    public function setContent($content)
    {
    	if(is_string($content))
    	{
            $this->content = $content;            
    	}
    }

    public function setCreationDateFr($creationDateFr)
    {
    	if(is_string($creationDateFr))
    	{
    		$this->creationDateFr = $creationDateFr;
    	}
    }

    public function setEditDate($editDate)
    {
    	if(is_string($editDate))
    	{
    		$this->editDate = $editDate;
    	}
    }

    public function setPublished($published)
    {
    	$published = (int) $published;
    	
    	$this->published = $published;
    }

    public function setCommentNumber($commentNumber)
    {
        $commentNumber = (int) $commentNumber;
        
        $this->commentNumber = $commentNumber;
    }

    public function setPreviousChapterId()
    {
        $chapterManager = new ChapterManager();
        $chapterId = $chapterManager->getPreviousChapter($this->id);

        $this->previousChapterId = ($chapterId['id'])?$chapterId['id']:$this->id;
    }

    public function setNextChapterId()
    {
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->getNextChapter($this->id);
        
        $this->nextChapterId = ($chapter['id'])?$chapter['id']:$this->id;
    }
}
