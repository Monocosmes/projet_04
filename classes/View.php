<?php

/**
 * summary
 */
class View
{
    /**
     * summary
     */
    private $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function render($chapter = [], $chapters = [], $comments = [])
    {
    	$page = $this->page;

    	ob_start();
    	
		require_once VIEW.$page.'.php';

		$content = ob_get_clean();

		require_once VIEW.'_template.php';
    }
}