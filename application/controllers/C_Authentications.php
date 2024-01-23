<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Authentications extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('authservice');
		$this->authservice->setUserSession($this->usersession);
	}

	public function login()
	{
		$data['title'] = 'Login';
		$this->loadPageView('templates/login', $data);
	}

	public function authenticate()
	{
		$payload = $this->input->post();
		$userToken = $this->authservice
			->login($payload['username'], $payload['password']);

		if ($userToken['success']) {
			$this->usersession->setUserSession(
				$userToken['data']->accessToken,
				$userToken['data']->refreshToken,
			);

			$this->load->library('usersservice');
			$this->usersservice->setUserSession($this->usersession);
			$userInfo = $this->usersservice->userInfo()['data']->user;

			$this->usersession->setUserInfoSession(
				$userInfo->fullname,
				$userInfo->role,
			);
		}

		$this->setOutputToJSON($userToken);
	}

	public function logout()
	{
		$data = $this->authservice->logout();

		if ($data['success']) {
			redirect('login');
		}
	}
}
