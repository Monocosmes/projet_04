<?php

/**
 * summary
 */
class Comment extends Entity
{
    protected $id;
    protected $chapterId;
    protected $authorId;
    protected $authorName;
    protected $message;
    protected $creationDateFr;
    protected $reported;
    protected $moderated;
    protected $moderationId;
    protected $moderationMessage;

    //Initializing getters
    public function getId() {return $this->id;}
    public function getChapterId() {return $this->chapterId;}
    public function getAuthorId() {return $this->authorId;}
    public function getAuthorName() {return $this->authorName;}
    public function getMessage() {return $this->message;}
    public function getCreationDateFr() {return $this->creationDateFr;}
    public function getReported() {return $this->reported;}
    public function getModerated() {return $this->moderated;}
    public function getModerationId() {return $this->moderationId;}
    public function getModerationMessage() {return $this->moderationMessage;}

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

    public function setModerated($moderated)
    {
    	$moderated = (int) $moderated;

    	$this->moderated = $moderated;
    }

    public function setModerationId($moderationId)
    {
    	$moderationId = (int) $moderationId;

    	$this->moderationId = $moderationId;
    }

    public function setModerationMessage($moderationMessage)
    {
    	if(is_string($moderationMessage))
    	{
    		$this->moderationMessage = $moderationMessage;
    	}
    }
}