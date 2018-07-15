<?php

/**
 * summary
 */
class CommentManager extends Manager
{
    /**
     * summary
     */
    public function addComment(Comment $comment)
    {
    	$req = $this->db->prepare('INSERT INTO comment(chapterId, author, message, creationDate, authorIp) VALUES(:chapterId, :author, :message, NOW(), :authorIp)');
        $req->bindValue(':chapterId', $comment->getChapterId(), PDO::PARAM_INT);
    	$req->bindValue(':author', $comment->getAuthor());
    	$req->bindValue(':message', $comment->getMessage());
    	$req->bindValue(':authorIp', $comment->getAuthorIp());

    	$req->execute();

        return $this->db->lastInsertId();
    }

    public function deleteComment(Comment $comment)
    {
    	$req = $this->db->prepare('DELETE FROM comment WHERE id = :id');
        $req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function updateComment(Comment $comment)
    {
    	$req = $this->db->prepare('UPDATE comment SET message = :message, reported = :reported WHERE id = :id');
    	$req->bindValue(':message', $comment->getMessage());
    	$req->bindValue(':content', $comment->getTitle());
    	$req->bindValue(':reported', $comment->getReported());
    	$req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);

    	$req->execute();
    }

    public function getComment($id)
    {
    	$req = $this->db->prepare('SELECT id, chapterId, author, message, creationDate, authorIp, reported FROM comment WHERE id = :id');
        $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $req->execute();
    	$data = $req->fetch(PDO::FETCH_ASSOC);

    	return new Comment($data);
    }

    public function getAllComments($chapterId)
    {
    	$comments = null;

        $req = $this->db->prepare('SELECT id, chapterId, author, message, creationDate, authorIp, reported FROM comment WHERE chapterId = :chapterId ORDER BY creationDate DESC');
        $req->bindValue(':chapterId', $chapterId, PDO::PARAM_INT);
        $req->execute();

    	while($data = $req->fetch(PDO::FETCH_ASSOC))
    	{
    		$comments[] = new Comment($data);
    	}

    	return $comments;
    }

    public function reportComment(Comment $comment)
    {
        $req = $this->db->prepare('UPDATE comment SET reported = :reported WHERE id = :id');
        $req->bindValue(':reported', $comment->getReported());
        $req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);

        $req->execute();
    }
}