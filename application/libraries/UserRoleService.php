<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Web_Service.php';

class UserRoleService extends MY_Web_Service
{
	private $userSession;

	public function __construct()
	{
		parent::__construct('user-roles');
	}

	/**
	 * Get all user roles list
	 */
	public function addUserRole(string $userId, string $roleId)
	{
		$payload = [
			'user_id' => $userId,
			'role_id' => $roleId,
		];

		return $this->post($this->userSession, $payload);
	}

	public function setUserSession($userSession)
	{
		$this->userSession = $userSession;
	}
}
