<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Web_Service.php';

class AuthService extends MY_Web_Service
{
	private $userSession;

	public function __construct()
	{
		parent::__construct('authentications');
	}

	/**
	 * User login
	 * 
	 * @param string $username
	 * @param string $password
	 * @return array
	 */
	public function login(string $username, string $password)
	{
		$payload = [
			'username' => $username,
			'password' => $password,
		];

		return $this->post($this->userSession, $payload);
	}

	/**
	 * User logout
	 * 
	 * @return array
	 */
	public function logout()
	{
		return $this->delete($this->userSession);
	}


	public function setUserSession($userSession)
	{
		$this->userSession = $userSession;
	}
}
