<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Web_Service.php';

class UsersService extends MY_Web_Service
{
	private $userSession;

	public function __construct()
	{
		parent::__construct('users');
	}

	/**
	 * Get user account information
	 */
	public function userInfo()
	{
		return $this->get($this->userSession);
	}

	/**
	 * Update user data
	 * 
	 * @param array $newUserData
	 * @return array
	 */
	public function updateUser(array $newUserData)
	{
		$payload = [
			'newUsername' => $newUserData['username'],
			'newFullname' => $newUserData['fullname'],
			'newEmail' => $newUserData['email'],
			'newPhone' => $newUserData['phone'],
			'password' => $newUserData['password']
		];

		return $this->put($this->userSession, $payload);
	}

	/**
	 * Update user password
	 * 
	 * @param string $newPassword
	 * @param string $oldPassword
	 * @return array
	 */
	public function updateUserPassword(string $newPassword, string $oldPassword)
	{
		$payload = [
			'newPassword' => $newPassword,
			'oldPassword' => $oldPassword
		];

		$query = '?change=password';

		return $this->put($this->userSession, $payload, $query);
	}

	/**
	 * Get all users
	 * 
	 * @return array
	 */
	public function getAllUsers()
	{
		$query = '?get=all';
		return $this->get($this->userSession, null, $query);
	}

	/**
	 * Add new user
	 * 
	 * @param array $payload
	 * @return array
	 */
	public function addNewUser(array $payload)
	{
		return $this->post($this->userSession, $payload);
	}

	public function setUserSession($userSession)
	{
		$this->userSession = $userSession;
	}
}
