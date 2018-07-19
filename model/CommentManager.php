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
    	$req = $this->db->prepare('INSERT INTO comment(chapterId, authorId, message, creationDate) VALUES(:chapterId, :authorId, :message, NOW())');
        $req->bindValue(':chapterId', $comment->getChapterId(), PDO::PARAM_INT);
    	$req->bindValue(':authorId', $comment->getAuthorId());
    	$req->bindValue(':message', $comment->getMessage());

    	$req->execute();

        return $this->db->lastInsertId();
    }

    public function deleteComment($chapterId)
    {
    	$req = $this->db->prepare('DELETE FROM comment WHERE chapterId = :id');
        $req->bindValue(':id', $chapterId, PDO::PARAM_INT);
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

    /*public function getComment($id)
    {
    	$req = $this->db->prepare('SELECT id, chapterId, authorId, message, DATE_FORMAT(creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, reported FROM comment WHERE id = :id');
        $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $req->execute();
    	$data = $req->fetch(PDO::FETCH_ASSOC);

    	return new Comment($data);
    }*/

    public function getAllComments($chapterId)
    {
    	$comments = null;

        $req = $this->db->prepare('
            SELECT comment.id, chapterId, authorId, message, DATE_FORMAT(comment.creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, reported, login as authorName
            FROM comment
            LEFT JOIN user ON authorId = user.id
            WHERE chapterId = :chapterId
            ORDER BY comment.creationDate
            DESC');
        $req->bindValue(':chapterId', $chapterId, PDO::PARAM_INT);
        $req->execute();

    	while($data = $req->fetch(PDO::FETCH_ASSOC))
    	{
    		$comments[] = new Comment($data);
    	}

    	return $comments;
    }

    public function getReportedComments()
    {
        $comments = null;

        $req = $this->db->query('SELECT id, chapterId, authorId, message, DATE_FORMAT(creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, reported FROM comment WHERE reported = 1');
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $comments[] = new Comment($data);
        }

        return $comments;
    }

    public function reportComment($id)
    {
        $req = $this->db->prepare('UPDATE comment SET reported = 1 WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }
}