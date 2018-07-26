<?php

/**
 * summary
 */
class ModerationManager extends Manager
{
	public function addMessage(Moderation $moderation)
	{
		$req = $this->db->prepare('INSERT INTO moderation(moderationMessage) VALUES(:moderationMessage)');
		$req->bindValue(':moderationMessage', $moderation->getModerationMessage());
		$req->execute();
	}

	public function getMessages()
	{
		$moderationMessages = null;

		$req = $this->db->query('SELECT id, moderationMessage FROM moderation');

		while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $moderationMessages[] = new Moderation($data);
        }

        return $moderationMessages;
	}
}