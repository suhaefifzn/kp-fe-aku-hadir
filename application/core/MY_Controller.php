<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('usersession');
		$this->usersession->checkSession($this->uri->segment(1));
	}

	public function loadPageView($targetView, $data = null)
	{
		$this->load->view('templates/header', $data);

		if ($targetView !== 'templates/login') {
			$this->load->view('templates/sidebar');
			$this->load->view($targetView, $data);
		} else {
			$this->load->view($targetView, $data);
		}

		$this->load->view('templates/footer');
	}

	public function setOutputToJSON($output)
	{
		return $this->output
			->set_content_type('application/json')
			->set_output(json_encode($output));
	}
}
