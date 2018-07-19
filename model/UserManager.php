<?php

/**
 * summary
 */
class UserManager extends Manager
{
    public function addUser(User $user)
    {
    	$req = $this->db->prepare('INSERT INTO user(login, email, password, creationDate, biography) VALUES(:login, :email, :password, NOW(), :biography)');
    	$req->bindValue(':login', $user->getLogin());
    	$req->bindValue(':email', $user->getEmail());
    	$req->bindValue(':password', $user->getCryptedPassword());
        $req->bindValue(':biography', $user->getBiography());

    	$req->execute();

        return $this->db->lastInsertId();
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
            $req = $this->db->prepare('SELECT id, login, email, password, rank, DATE_FORMAT(creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, biography FROM user WHERE id = :id');
            $req->bindValue(':id', $info, PDO::PARAM_INT);
        }
        else
        {
            $req = $this->db->prepare('SELECT id, login, email, password, rank, DATE_FORMAT(creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, biography FROM user WHERE login = :login OR email = :login');
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

    public function updateUser(User $user)
    {
    	$req = $this->db->prepare('UPDATE user SET title = :title, content = :content, editDate = NOW(), published = :published WHERE id = :id');
    	$req->bindValue(':title', $user->getTitle());
    	$req->bindValue(':content', $user->getTitle());
    	$req->bindValue(':published', $user->getPublished());
    	$req->bindValue(':id', $user->getId(), PDO::PARAM_INT);

    	$req->execute();
    }

    
}