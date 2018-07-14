<?php

abstract class Manager
{
    protected $db;
    private $_password = '';
    private $_login = 'root';
    private $_dbname = 'projet_04';
    private $_dbhost = 'localhost';

    public function __construct()
  	{
  		$this->db = new PDO('mysql:host='.$this->_dbhost.';dbname='.$this->_dbname.';charset=utf8', $this->_login, $this->_password);
  	}
}