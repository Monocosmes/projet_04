<?php

/**
 * summary
 */
abstract class Entity
{
    /**
     * summary
     */
    public function __construct(array $data = [])
    {
        if(!empty($data))
        {
        	$this->hydrate($data);
        }
    }

    public function hydrate(array $data)
    {
    	foreach($data as $key => $value)
    	{
    		$method = 'set'.ucfirst($key);

    		if(is_callable([$this, $method]))
    		{
    			$this->$method($value);
    		}
    	}
    }

    public function isAuthorValid($author)
    {
    	return !empty($author);
    }

    public function isTitleValid($title)
    {
    	return !empty($title);
    }

    public function isContentValid($content)
    {
    	return !empty($content);
    }
}