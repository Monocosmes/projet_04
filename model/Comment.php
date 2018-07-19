<?php

/**
 * summary
 */
class Comment extends Entity
{
    protected $id;
    protected $chapterId;
    protected $authorId;
    protected $message;
    protected $creationDateFr;
    protected $reported;

    //Initializing getters
    public function getId() {return $this->id;}
    public function getChapterId() {return $this->chapterId;}
    public function getAuthorId() {return $this->authorId;}
    public function getAuthorName() {return $this->authorName;}
    public function getMessage() {return $this->message;}
    public function getCreationDateFr() {return $this->creationDateFr;}
    public function getReported() {return $this->reported;}

    //Initializing setters
    public function setId($id)
    {
    	$id = (int) $id;

    	$this->id = $id;
    }

    public function setChapterId($chapterId)
    {
    	$chapterId = (int) $chapterId;

    	$this->chapterId = $chapterId;
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

    public function setMessage($message)
    {
    	if(is_string($message))
    	{
    		$this->message = $message;
    	}
    }

    public function setCreationDateFr($creationDateFr)
    {
    	if(is_string($creationDateFr))
    	{
    		$this->creationDateFr = $creationDateFr;
    	}
    }

    public function setReported($reported)
    {
    	$reported = (int) $reported;
    	
    	$this->reported = $reported;
    }
}