<?php

/**
 * summary
 */
class UserManager extends Manager
{
    public function addUser(User $user)
    {
    	$req = $this->db->prepare('INSERT INTO user(login, email, password, creationDate) VALUES(:login, :email, :password, NOW())');
    	$req->bindValue(':login', $user->getLogin());
    	$req->bindValue(':email', $user->getEmail());
    	$req->bindValue(':password', $user->getCryptedPassword());

    	$req->execute();

        return $this->db->lastInsertId();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM user')->fetchColumn();
    }

    public function deleteUser(User $user)
    {
    	$req = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function getUser($info)
    {
        $this->db->query('SET lc_time_names = \'fr_FR\'');

        if(is_int($info))
        {
            $req = $this->db->prepare('SELECT id, login, email, password, rank, DATE_FORMAT(creationDate, \'%a %d %M %Y\') AS creationDateFr, isLocked, commentPosted FROM user WHERE id = :id');
            $req->bindValue(':id', $info, PDO::PARAM_INT);
        }
        else
        {
            $req = $this->db->prepare('SELECT id, login, email, password, rank, DATE_FORMAT(creationDate, \'%a %d %M %Y\') AS creationDateFr, isLocked, commentPosted FROM user WHERE login = :login OR email = :login');
            $req->bindValue(':login', $info);
        }
        
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\model\User');

        if($data = $req->fetch())
        {
            return new User($data);
        }

        return null;        
    }

    public function isUserExists($info)
    {
        if(is_int($info))
        {
            $req = $this->db->query('SELECT COUNT(*) FROM user WHERE id = :id');
            $req->bindValue(':id', $info, PDO::PARAM_INT);
            $req->execute();
        }
        else
        {
            $req = $this->db->prepare('SELECT COUNT(*) FROM user WHERE login = :login OR email = :login');
            $req->bindValue(':login', $info);
            $req->execute();
        }
        
        return (bool) $req->fetchColumn();
    }

    public function lockAccount($id, $lockAccount)
    {
        $req = $this->db->prepare('UPDATE user SET isLocked = :isLocked WHERE id = :id');
        $req->bindValue(':isLocked', (int) $lockAccount, PDO::PARAM_INT);
        $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $req->execute();
    }    

    public function updateCommentPosted($id, $commentPosted)
    {
        $req = $this->db->prepare('UPDATE user SET commentPosted = commentPosted + :commentPosted WHERE id = :id');
        $req->bindValue(':commentPosted', $commentPosted, PDO::PARAM_INT);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }

    public function updateProfile(User $user, $addPass)
    {
        $req = $this->db->prepare('UPDATE user SET login = :login, email = :email'.$addPass.'WHERE id = :id');
        $req->bindValue(':login', $user->getLogin());
        $req->bindValue(':email', $user->getEmail());
        if($addPass) $req->bindValue(':password', $user->getCryptedPassword());
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $req->execute();
    }
}