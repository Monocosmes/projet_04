<?php

/**
 * summary
 */
class Comment extends Entity
{
    protected $id;
    protected $chapterId;
    protected $author;
    protected $message;
    protected $creationDateFr;
    protected $authorIp;
    protected $reported;

    //Initializing getters
    public function getId() {return $this->id;}
    public function getChapterId() {return $this->chapterId;}
    public function getAuthor() {return $this->author;}    
    public function getMessage() {return $this->message;}
    public function getCreationDateFr() {return $this->creationDateFr;}
    public function getAuthorIp() {return $this->authorIp;}
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

    public function setAuthor($author)
    {
    	if(is_string($author))
    	{
    		$this->author = $author;
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

    public function setAuthorIp($authorIp)
    {
    	if(is_string($authorIp))
    	{
    		$this->authorIp = $authorIp;
    	}
    }

    public function setReported($reported)
    {
    	$reported = (int) $reported;
    	
    	$this->reported = $reported;
    }
}