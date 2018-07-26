<?php

/**
 * The Entry class handle everything about connexion and register.
 */
class Entry
{
    public function deleteAccount($params)
    {
    	extract($params);

    	if($userId == $_SESSION['id'] OR $_SESSION['rank'] > 3)
    	{
    		$userManager = new UserManager();
    		$user = $userManager->getUser((int)$userId);

    		if($user->getLogin() === 'Admin')
    		{
    			$_SESSION['errors'][] = 'Vous ne pouvez pas effacer le compte administrateur principal';

    			$myView = new View();
        		$myView->redirect('home.html');
    		}
    		else
    		{
    			$commentManager = new CommentManager();
    			$commentManager->updateCommentAuthorId($userId, 4);

    			$userManager->deleteUser($user);
    			$myView = new View();
        		$myView->redirect('signoff');
    		}    		
    	}
    	else
    	{
    		$myView = new View();
        	$myView->redirect('home.html');
    	}
    }

    public function showSigninPage($params)
    {
        $footer = new Footer();

        $elements = ['footer' => $footer, 'params' => $params];

        $myView = new View('entry/signin');
        $myView->render($elements);
    }

    public function showSignupPage($params)
    {
    	$footer = new Footer();

        $elements = ['footer' => $footer];

    	$myView = new View('entry/signup');
        $myView->render($elements);
    }

    public function signin($params)
    {
        $footer = new Footer();

        $userManager = new UserManager();
        $user = new User(['login' => $_POST['login']]);

        $elements = ['user' => $user, 'footer' => $footer];

        if($user->isLoginValid())
        {
        	$user = $userManager->getUser($_POST['login']);

        	$elements = ['user' => $user, 'footer' => $footer];

        	if(!$user->getIsLocked())
        	{
        		if($user->isPasswordValid($_POST['password']))
        		{	
        		    $_SESSION['id'] = $user->getId();
        		    $_SESSION['login'] = $user->getLogin();
        		    $_SESSION['email'] = $user->getEmail();
        		    $_SESSION['rank'] = $user->getRank();
        		    $_SESSION['creationDate'] = $user->getCreationDateFr();
        		    $_SESSION['isLocked'] = $user->getIsLocked();
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
        		$_SESSION['errors'][] = "Ce compte est bloqué";

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

        	$_SESSION['message'] = 'Bienvenue parmis nous. Connectez-vous sans plus attendre !';

        	$myView = new View();
        	$myView->redirect('signin.html');
        }
        else
        {
        	$footer = new Footer();

        	$elements = ['user' => $user, 'footer' => $footer];

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