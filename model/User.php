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
    protected $isLocked;
    protected $commentPosted;

    //Initializing getters
    public function getId() {return $this->id;}
    public function getLogin() {return $this->login;}
    public function getEmail() {return $this->email;}
    public function getPassword() {return $this->password;}
    public function getRank() {return $this->rank;}
    public function getCreationDateFr() {return $this->creationDateFr;}
    public function getIsLocked() {return $this->isLocked;}
    public function getCommentPosted() {return $this->commentPosted;}

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
    				$_SESSION['errors'][] = 'Votre identifiant doit comporter entre 4 et 30 caractères.';
    			}
    			
    			$this->login = $login;
    		}
    		else
    		{
    			$_SESSION['errors'][] = 'Vous devez choisir un identifiant';
    		}
    	}
    }

    public function setEmail($email)
    {
    	if(is_string($email))
    	{
    		if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
    		{
    			$_SESSION['errors'][] = 'L\'email proposé n\'a pas une forme valide.';
    		}
    		else
    		{
    			$this->email = $email;
    		}
    	}
    }

    public function setPassword($password)
    {
    	if(is_string($password))
    	{
    		if(!empty($password))
    		{    			
    			$this->password = $password;
    		}
    		else
    		{
    			$_SESSION['errors'][] = 'Vous devez choisir un mot de passe';
    		}    		
    	}
    	else
    	{
    		$_SESSION['errors'][] = 'Votre mot de passe doit être une chaîne de caractères';
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

    public function setIsLocked($isLocked)
    {
    	$isLocked = (int) $isLocked;
    	
    	$this->isLocked = $isLocked;
    }

    public function setCommentPosted($commentPosted)
    {
    	$commentPosted = (int) $commentPosted;

    	$this->commentPosted = $commentPosted;
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
    		$_SESSION['errors'][] = 'Login ou mot de passe incorrect';
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
    			$_SESSION['errors'][] = 'Les mots de passe ne correspondent pas';
    			return false;
    		}
    	}
    }

    public function checkLoginLenght()
    {
    	if(strlen($this->login) > 3)
    	{
    		return true;
    	}
    	else
    	{
    		$_SESSION['errors'][] = 'Votre identifiant doit comporter au moins 4 caractères';
    		return false;
    	}
    }

    public function checkPasswordLenght()
    {
    	if(strlen($this->password) > 5)
    	{
    		return true;
    	}
    	else
    	{
    		$_SESSION['errors'][] = 'Votre mot de passe doit comporter au moins 6 caractères';
    		return false;
    	}
    }

    public function isEmailExists()
    {
    	$userManager = new UserManager();

    	if(!$userManager->isUserExists($this->email))
    	{
    		return true;
    	}
    	else
    	{
    		$_SESSION['errors'][] = 'Cet email est déjà pris. Veuillez en choisir un autre';
    		return false;
    	}
    }

    public function isLoginExists()
    {
    	$userManager = new UserManager();

    	if(!$userManager->isUserExists($this->login))
    	{
    		return true;
    	}
    	else
    	{
    		$_SESSION['errors'][] = 'Cet identifiant est déjà pris. Veuillez en choisir un autre';
    		return false;
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
    		$_SESSION['errors'][] = 'Login ou mot de passe incorrect';
    		return false;
    	}
    }
}
