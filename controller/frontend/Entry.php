<?php

/**
 * summary
 */
class Entry
{
    public function showSigninPage($params)
    {
        $success = ($params)?$params:[];

        $myView = new View('entry/signin');
        $myView->render($success);
    }

    public function showSignupPage($params)
    {
    	$myView = new View('entry/signup');
        $myView->render();
    }

    public function signin($params)
    {
        $userManager = new UserManager();
        $user = new User(['login' => $_POST['login']]);

        $elements = ['user' => $user];

        if($user->isLoginValid())
        {
        	$user = $userManager->getUser($_POST['login']);

        	$elements = ['user' => $user];

        	if($user->isPasswordValid($_POST['password']))
        	{
        	    session_start();
	
        	    $_SESSION['id'] = $user->getId();
        	    $_SESSION['login'] = $user->getLogin();
        	    $_SESSION['email'] = $user->getEmail();
        	    $_SESSION['rank'] = $user->getRank();
        	    $_SESSION['creationDate'] = $user->getCreationDateFr();
        	    $_SESSION['biography'] = $user->getBiography();
        	    $_SESSION['isLogged'] = true;
	
        	    $myView = new View();
        	    $myView->redirect('home.html');
        	}
        	else
        	{
        		$myView = new View('entry/signin');
        		$myView->render($elements);
        	}
        }
        else
        {
        	$myView = new View('entry/signin');
        	$myView->render($elements);
        }
    }

    public function signup($params)
    {        
        $user = new User
        ([
            'login' => $_POST['login'],
            'email' => strtolower($_POST['email']),
            'password' => $_POST['password'],
        ]);

        $isLoginAvailable = $user->isLoginExists();
        $isMailAvailable =	$user->isEmailExists();
        $loginLenght = $user->checkLoginLenght();
        $passwordLenght = $user->checkPasswordLenght();
        $passwordsMatch = $user->isPasswordsMatch($_POST['passwordMatch']);

        if($isLoginAvailable AND $isMailAvailable AND $loginLenght AND $passwordLenght AND $passwordsMatch)
        {
        	$userManager = new UserManager();
        	$userId = $userManager->addUser($user);

        	$myView = new View();
        	$myView->redirect('signin.html/success/1');
        }
        else
        {
        	$elements = ['user' => $user];

        	$myView = new View('entry/signup');
        	$myView->render($elements);
        }        
    }

    public function signoff($params)
    {
        session_destroy();

        $myView = new View();
        $myView->redirect('home.html');
    }
}