<?php

/**
 * summary
 */
class Moderation extends Entity
{
    protected $id;
    protected $moderationMessage;

    public function getId() {return $this->id;}
    public function getModerationMessage() {return $this->moderationMessage;}

    public function setId($id)
    {
        $id = (int) $id;

        $this->id = $id;
    }

    public function setModerationMessage($moderationMessage)
    {
    	if(is_string($moderationMessage))
    	{
    		$this->moderationMessage = $moderationMessage;
    	}
    }
}