<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Web_Service.php';

class RoleService extends MY_Web_Service
{
	private $userSession;

	public function __construct()
	{
		parent::__construct('roles');
	}

	/**
	 * Get all user roles list
	 */
	public function getAllRole()
	{
		return $this->get($this->userSession);
	}

	public function setUserSession($userSession)
	{
		$this->userSession = $userSession;
	}
}
