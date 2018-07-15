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
    protected $creationDate;
    protected $authorIp;
    protected $reported;

    //Initializing getters
    public function getId() {return $this->id;}
    public function getChapterId() {return $this->chapterId;}
    public function getAuthor() {return $this->author;}    
    public function getMessage() {return $this->message;}
    public function getCreationDate() {return $this->creationDate;}
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

    public function setCreationDate($creationDate)
    {
    	if(is_string($creationDate))
    	{
    		$this->creationDate = $creationDate;
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