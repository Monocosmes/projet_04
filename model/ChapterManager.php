<?php

/**
 * summary
 */
class ChapterManager extends Manager
{
    /**
     * summary
     */
    public function addChapter(Chapter $chapter)
    {
    	$req = $this->db->prepare('INSERT INTO chapter(authorId, title, content, creationDate, editDate, published) VALUES(:authorId, :title, :content, NOW(), NOW(), :published)');
    	$req->bindValue(':authorId', $chapter->getAuthorId(), PDO::PARAM_INT);
    	$req->bindValue(':title', $chapter->getTitle());
    	$req->bindValue(':content', $chapter->getContent());
    	$req->bindValue(':published', $chapter->getPublished());

    	$req->execute();

        return $this->db->lastInsertId();
    }

    public function deleteChapter(Chapter $chapter)
    {
    	$req = $this->db->prepare('DELETE FROM chapter WHERE id = :id');
        $req->bindValue(':id', $chapter->getId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function updateChapter(Chapter $chapter)
    {
    	$req = $this->db->prepare('UPDATE chapter SET title = :title, content = :content, editDate = NOW(), published = :published WHERE id = :id');
    	$req->bindValue(':title', $chapter->getTitle());
    	$req->bindValue(':content', $chapter->getTitle());
    	$req->bindValue(':published', $chapter->getPublished());
    	$req->bindValue(':id', $chapter->getId(), PDO::PARAM_INT);

    	$req->execute();
    }

    public function getChapter($id)
    {
    	$req = $this->db->prepare('SELECT id, authorId, title, content, creationDate, editDate, published FROM chapter WHERE id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    	$data = $req->fetch(PDO::FETCH_ASSOC);

    	return new Chapter($data);
    }

    public function getLastChapter()
    {
        $req = $this->db->query('SELECT id, authorId, title, content, creationDate, editDate, published FROM chapter ORDER BY creationDate DESC LIMIT 0, 1');
        $data = $req->fetch(PDO::FETCH_ASSOC);

        return new Chapter($data);
    }

    public function getAllChapters()
    {
    	$req = $this->db->query('SELECT id, authorId, title, content, creationDate, editDate, published FROM chapter ORDER BY creationDate DESC');

    	while($data = $req->fetch(PDO::FETCH_ASSOC))
    	{
    		$chapters[] = new Chapter($data);
    	}

    	return $chapters;
    }
}