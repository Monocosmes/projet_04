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
    	$req = $this->db->prepare('INSERT INTO chapter(authorId, chapterNumber, title, content, creationDate, editDate, published, commentNumber) VALUES(:authorId, :chapterNumber, :title, :content, NOW(), NOW(), :published, 0)');
        $req->bindValue(':chapterNumber', $chapter->getChapterNumber(), PDO::PARAM_INT);
    	$req->bindValue(':authorId', $chapter->getAuthorId(), PDO::PARAM_INT);
    	$req->bindValue(':title', $chapter->getTitle());
    	$req->bindValue(':content', $chapter->getContent());
    	$req->bindValue(':published', $chapter->getPublished());

    	$req->execute();

        return $this->db->lastInsertId();
    }

    public function count()
    {
        return $this->db->query('SELECT COUNT(*) FROM chapter')->fetchColumn();
    }

    public function deleteChapter($chapterId)
    {
    	$req = $this->db->prepare('DELETE FROM chapter WHERE id = :id');
        $req->bindValue(':id', $chapterId, PDO::PARAM_INT);
        $req->execute();
    }

    public function publishChapter($chapterId, $isPublished)
    {
        $req = $this->db->prepare('UPDATE chapter SET published = :isPublished WHERE id = :id');
        $req->bindValue(':id', $chapterId, PDO::PARAM_INT);
        $req->bindValue(':isPublished', (int) $isPublished, PDO::PARAM_INT);
        $req->execute();
    }

    public function updateChapter(Chapter $chapter)
    {
    	$req = $this->db->prepare('UPDATE chapter SET chapterNumber = :chapterNumber, title = :title, content = :content, editDate = NOW(), published = :published WHERE id = :id');
        $req->bindValue(':chapterNumber', $chapter->getChapterNumber(), PDO::PARAM_INT);
    	$req->bindValue(':title', $chapter->getTitle());
    	$req->bindValue(':content', $chapter->getContent());
    	$req->bindValue(':published', $chapter->getPublished());
    	$req->bindValue(':id', $chapter->getId(), PDO::PARAM_INT);

    	$req->execute();
    }

    public function getChapter($id)
    {        
        $this->db->query('SET lc_time_names = \'fr_FR\'');
        $req = $this->db->prepare('
            SELECT chapter.id, authorId, chapterNumber, title, content, DATE_FORMAT(chapter.creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, editDate, published, commentNumber, user.login AS authorName
            FROM chapter
            LEFT JOIN user ON authorId = user.id
            WHERE chapter.id = :id');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
      
    	$data = $req->fetch(PDO::FETCH_ASSOC);

    	return ($data)?new Chapter($data):'';
    }

    public function getLastChapter($start = 0)
    {
        $this->db->query('SET lc_time_names = \'fr_FR\'');
        $req = $this->db->prepare('
            SELECT chapter.id, authorId, chapterNumber, title, content, DATE_FORMAT(chapter.creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, editDate, published, commentNumber, user.login AS authorName
            FROM chapter
            LEFT JOIN user ON authorId = user.id
            WHERE published = 1
            ORDER BY chapter.creationDate
            DESC LIMIT :start, 1');
        $req->bindValue(':start', $start, PDO::PARAM_INT);
        $req->execute();

        $data = $req->fetch(PDO::FETCH_ASSOC);

        return ($data)?new Chapter($data):'';
    }

    public function getPreviousChapter($id)
    {
        $req = $this->db->prepare('SELECT id FROM chapter WHERE id < :id AND published = 1 ORDER BY id DESC LIMIT 0, 1');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
      
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getNextChapter($id)
    {
        $req = $this->db->prepare('SELECT id FROM chapter WHERE id > :id AND published = 1 LIMIT 0, 1');
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
      
        return $req->fetch(PDO::FETCH_ASSOC);        
    }

    public function getAllChapters()
    {
    	$chapters = [];

        $this->db->query('SET lc_time_names = \'fr_FR\'');
        $req = $this->db->query('
            SELECT chapter.id, authorId, chapterNumber, title, content, DATE_FORMAT(chapter.creationDate, \'%a %d %M %Y à %H:%i:%s\') AS creationDateFr, editDate, published, commentNumber, user.login AS authorName
            FROM chapter
            LEFT JOIN user ON authorId = user.id
            ORDER BY chapterNumber');

    	while($data = $req->fetch(PDO::FETCH_ASSOC))
    	{
    		$chapters[] = new Chapter($data);
    	}

    	return $chapters;
    }

    public function changeCommentNumber($id, $num)
    {
        $req = $this->db->prepare('UPDATE chapter SET commentNumber = commentNumber + :num WHERE id = :id');
        $req->bindValue(':num', $num, PDO::PARAM_INT);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}