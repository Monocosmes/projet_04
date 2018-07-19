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
    		if(!empty($login))
    		{
    			if(strlen($login) < 4 OR strlen($login) > 30)
    			{
    				$this->error[] = 'Votre identifiant doit comporter entre 4 et 30 caractères.';
    			}
    			
    			$this->login = $login;
    		}
    		else
    		{
    			$this->error[] = 'Vous devez choisir un identifiant';
    		}
    	}
    }

    public function setEmail($email)
    {
    	if(is_string($email))
    	{
    		if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
    		{
    			$this->error[] = 'L\'email proposé n\'a pas une forme valide.';
    		}
    		else
    		{
    			$this->email = strtolower($email);
    		}
    	}
    }

    public function setPassword($password)
    {
    	if(is_string($password))
    	{
    		if(!empty($password))
    		{
    			if(strlen($password) < 4 OR strlen($password) > 255)
    			{
    				$this->error[] = 'Votre mot de passe doit comporter entre 4 et 50 caractères';
    			}   			
    			
    			$this->password = $password;
    			
    		}
    		else
    		{
    			$this->error[] = 'Vous devez choisir un mot de passe';
    		}    		
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


    public function isLoginValid()
    {
    	$userManager = new UserManager();

    	if($userManager->isUserExists($this->login))
    	{
    		return true;
    	}
    	else
    	{
    		$this->error[] = 'Login ou mot de passe incorrect';
    		return false;
    	}
    }

    public function isPasswordsMatch($passwordMatch)
    {
    	if(!empty($this->password) OR !empty($passwordMatch))
    	{
    		if($this->password === $passwordMatch)
    		{
    			return true;
    		}
    		else
    		{
    			$this->error[] = 'Les mots de passe ne correspondent pas';
    			return false;
    		}
    	}
    }

    public function isPasswordValid($password)
    {
    	if(password_verify($password, $this->password))
    	{
    		return true;
    	}
    	else
    	{
    		$this->error[] = 'Login ou mot de passe incorrect';
    		return false;
    	}
    }
}
