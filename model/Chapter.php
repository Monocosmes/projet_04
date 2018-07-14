<?php

/**
 * summary
 */
class Chapter extends Entity
{
    protected $id;
    protected $authorId;
    protected $title;
    protected $content;
    protected $creationDate;
    protected $editDate;
    protected $published;
    
    //Initializing getters
    public function getId() {return $this->id;}
    public function getAuthorId() {return $this->authorId;}
    public function getTitle() {return $this->title;}
    public function getContent() {return $this->content;}
    public function getCreationDate() {return $this->creationDate;}
    public function getEditDate() {return $this->editDate;}
    public function getPublished() {return $this->published;}

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

    public function setCreationDate($creationDate)
    {
    	if(is_string($creationDate))
    	{
    		$this->creationDate = $creationDate;
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

}