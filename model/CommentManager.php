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
    	$req = $this->db->prepare('INSERT INTO comment(chapterId, author, message, creationDate, authorIp, reported) VALUES(:chapterId, :author, :message, NOW(), :authorIp, :reported)');
        $req->bindValue(':chapterId', $comment->getChapterId(), PDO::PARAM_INT);
    	$req->bindValue(':author', $comment->getAuthorId());
    	$req->bindValue(':message', $comment->getMessage());
    	$req->bindValue(':authorIp', $comment->getAuthorIp());
    	$req->bindValue(':reported', $comment->getReported());

    	$req->execute();
    }

    public function deleteComment(Comment $comment)
    {
    	$this->db->exec('DELETE FROM comment WHERE id = '.$comment->getId());
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
    	$id = (int) $id;

    	$req = $this->db->query('SELECT id, chapterId, author, message, creationDate, authorIp, reported FROM comment WHERE id = '.$id);
    	$data = $req->fetch(PDO::FETCH_ASSOC);

    	return new Comment($data);
    }

    public function getAllComment()
    {
    	$req = $this->db->query('SELECT id, chapterId, author, message, creationDate, authorIp, reported FROM comment ORDER BY creationDateDate DESC');

    	while($data = $req->fetch(PDO::FETCH_ASSOC))
    	{
    		$comment[] = new Comment($data);
    	}

    	return $comment;
    }

    public function reportComment(Comment $comment)
    {
        $req = $this->db->prepare('UPDATE comment SET reported = :reported WHERE id = :id');
        $req->bindValue(':reported', $comment->getReported());
        $req->bindValue(':id', $comment->getId(), PDO::PARAM_INT);

        $req->execute();
    }
}