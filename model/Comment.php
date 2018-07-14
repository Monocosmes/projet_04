<?php

/**
 * summary
 */
class Comment extends Entity
{
    private $_id;
    private $_chapterId;
    private $_author;
    private $_message;
    private $_creationDate;
    private $_authorIp;
    private $_reported;    

    //Initializing getters
    public function getId() {return $this->_id;}
    public function getChapterId() {return $this->_chapterId;}
    public function getAuthor() {return $this->_author;}    
    public function getMessage() {return $this->_message;}
    public function getCreationDate() {return $this->_creationDate;}
    public function getAuthorId() {return $this->_authorIp;}
    public function getReported() {return $this->_reported;}

    //Initializing setters
    public function setId($id)
    {
    	$id = (int) $id;

    	$this->_id = $id;
    }

    public function setChapterId($chapterId)
    {
    	$chapterId = (int) $chapterId;

    	$this->_chapterId = $chapterId;
    }

    public function setAuthor($author)
    {
    	if(is_string($author))
    	{
    		$this->_author = $author;
    	}
    }

    public function setMessage($message)
    {
    	if(is_string($message))
    	{
    		$this->_message = $message;
    	}
    }

    public function setCreationDate($creationDate)
    {
    	if(is_string($creationDate))
    	{
    		$this->_creationDate = $creationDate;
    	}
    }

    public function setAuthorIp($authorIp)
    {
    	if(is_string($authorIp))
    	{
    		$this->_authorIp = $authorIp;
    	}
    }

    public function setReported($reported)
    {
    	if(is_bool($reported))
    	{
    		$this->_reported = $reported;
    	}
    }
}