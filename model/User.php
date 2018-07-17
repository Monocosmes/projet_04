<?php

/**
 * summary
 */
class User extends Entity
{
    protected $id;
    protected $login;
    protected $email;
    protected $password;
    protected $rank;
    protected $creationDateFr;
    protected $biography;

    //Initializing getters
    public function getId() {return $this->id;}
    public function getLogin() {return $this->login;}
    public function getEmail() {return $this->email;}
    public function getPassword() {return $this->password;}
    public function getRank() {return $this->rank;}
    public function getCreationDateFr() {return $this->creationDate;}
    public function getBiography() {return $this->biography;}

    //Initializing setters
    public function setId($id)
    {
    	$id = (int) $id;

    	$this->id = $id;
    }

    public function setLogin($login)
    {
    	if(is_string($login))
    	{
    		$this->login = $login;
    	}
    }

    public function setEmail($email)
    {
    	if(is_string($email))
    	{
    		$this->email = $email;
    	}
    }

    public function setPassword($password)
    {
    	if(is_string($password))
    	{
    		$this->password = $password;
    	}
    }

    public function setRank($rank)
    {
    	$rank = (int) $rank;
    	
    	$this->rank = $rank;
    }

    public function setCreationDateFr($creationDateFr)
    {
    	if(is_string($creationDateFr))
    	{
    		$this->creationDateFr = $creationDateFr;
    	}
    }

    public function setBiography($biography)
    {
    	if(is_string($biography))
    	{
    		$this->biography = $biography;
    	}
    }

    public function getCryptedPassword()
    {
    	return password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function isLoginValid($login)
    {
    	
    }

    public function isPasswordValid($password)
    {
    	return password_verify($password, $this->password);
    }
}