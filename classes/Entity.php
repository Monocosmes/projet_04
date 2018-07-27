<?php

/**
 * summary
 */
abstract class Entity
{
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

    public function isValid($data)
    {
    	if(!empty($data))
    	{
    		return true;
    	}
    	else
    	{
    		$_SESSION['errors'][] = 'Un ou plusieurs champs sont vides';
    		return false;
    	}
    }
}