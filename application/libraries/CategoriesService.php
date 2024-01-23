<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Web_Service.php';

class CategoriesService extends MY_Web_Service
{
	private $userSession;

	public function __construct()
	{
		parent::__construct('categories');
	}

	public function setUserSession($userSession)
	{
		$this->userSession = $userSession;
	}

	public function getAllCategories()
	{
		return $this->get($this->userSession);
	}
}
