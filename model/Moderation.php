<?php

/**
 * summary
 */
class Moderation extends Entity
{
    protected $moderationMessage;

    public function getModerationMessage()
    {
    	return $this->moderationMessage;
    }

    public function setModerationMessage($moderationMessage)
    {
    	if(is_string($moderationMessage))
    	{
    		$this->moderationMessage = $moderationMessage;
    	}
    }
}