<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserSession
{
	protected $CI;

	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->library('session');
	}

	/**
	 * Set usertToken Session Value
	 * 
	 * @param string $accessToken
	 * @param string $refreshToken
	 */
	public function setUserSession(string $accessToken, string $refreshToken)
	{
		$userToken = [
			'accessToken' => $accessToken,
			'refreshToken' => $refreshToken,
		];

		$this->CI->session->set_userdata('userToken', $userToken);
	}

	public function setUserInfoSession(string $userName, string $userRole)
	{
		$userInfo = [
			'name' => $userName,
			'role' => $userRole,
		];

		$this->CI->session->set_userdata('userInfo', $userInfo);
	}

	public function getUserSession()
	{
		return $this->CI->session->userdata();
	}

	/**
	 * Get Status userToken Session
	 * 
	 * @return boolean
	 */
	public function statusUserSession()
	{
		return $this->CI->session->userdata('userToken') !== null;
	}

	/**
	 * Destroy Session
	 */
	public function destroyUserSession()
	{
		return $this->CI->session->sess_destroy();
	}

	/**
	 * Get accessToken from User Session
	 */
	public function getAccessToken()
	{
		return isset($this->CI->session->userdata('userToken')['accessToken'])
			? $this->CI->session->userdata('userToken')['accessToken'] : null;
	}

	/**
	 * Get refreshToken from userSession
	 */
	public function getRefreshToken()
	{
		return isset($this->CI->session->userdata('userToken')['refreshToken'])
			? $this->CI->session->userdata('userToken')['refreshToken'] : null;
	}

	/**
	 * Redirect to page depends on statusUserSession
	 * and first uri segment
	 * 
	 * @param string $uri
	 */
	public function checkSession(string $uri = null)
	{
		if ($uri === 'authenticate') {
			if ($this->statusUserSession()) {
				redirect('/');
			}
		} else {
			if ($this->statusUserSession()) {
				if ($uri === 'logout') {
					$this->destroyUserSession();
				} else if ($uri === 'login') {
					redirect('/');
				}
			} else {
				if ($uri !== 'login') {
					redirect('login');
				}
			}
		}
	}
}
