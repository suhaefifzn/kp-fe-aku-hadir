<?php
defined('BASEPATH') or exit('No direct access script allowed');

class C_Users extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('usersservice');
		$this->load->library('roleservice');
		$this->load->library('userroleservice');
		$this->usersservice->setUserSession($this->usersession);
		$this->roleservice->setUserSession($this->usersession);
		$this->userroleservice->setUserSession($this->usersession);

		$userInfo = $this->usersession->getUserSession()['userInfo'];

		if ($userInfo['role'] !== 'Admin') {
			redirect(base_url());
		}
	}

	public function daftar_pengguna()
	{
		$data['title'] = 'Daftar Pengguna';
		$data['roles'] = $this->roleservice->getAllRole()['data']->roles;
		$this->loadPageView('templates/users/daftar_pengguna.php', $data);
	}

	public function load_data_table_daftar_pengguna()
	{
		$data['users'] = $this->usersservice->getAllUsers()['data']->users;
		$this->load->view('templates/users/tabel_daftar_pengguna.php', $data);
	}

	public function add_new_user()
	{
		$newUser = [
			'username' => $this->input->post('username'),
			'fullname' => $this->input->post('fullname'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email'),
			'phone' => $this->input->post('phone'),
		];

		$response = $this->usersservice->addNewUser($newUser);
		$this->setOutputToJSON($response);
	}

	public function add_role_user()
	{
		$response = $this->userroleservice->addUserRole(
			$this->input->post('userId'),
			$this->input->post('roleId')
		);

		$this->setOutputToJSON($response);
	}
}
