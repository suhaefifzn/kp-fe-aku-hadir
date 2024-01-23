<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Settings extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('usersservice');
		$this->usersservice->setUserSession($this->usersession);
	}

	public function index()
	{
		$data['user'] = $this->usersservice->userInfo()['data']->user;
		$data['title'] = 'Pengaturan';
		$this->loadPageView('templates/settings/index', $data);
	}

	public function update_user()
	{
		$data = $this->input->post();
		$response = $this->usersservice->updateUser($data);
		$this->setOutputToJSON($response);
	}

	public function update_user_password()
	{
		$response = $this->usersservice->updateUserPassword(
			$this->input->post('newPassword'),
			$this->input->post('oldPassword')
		);
		$this->setOutputToJSON($response);
	}
}
