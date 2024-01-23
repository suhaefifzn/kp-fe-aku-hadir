<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Reports extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('reportsservice');
		$this->load->library('usersservice');
		$this->load->library('categoriesservice');
		$this->reportsservice->setUserSession($this->usersession);
		$this->usersservice->setUserSession($this->usersession);
		$this->categoriesservice->setUserSession($this->usersession);
	}

	public function index()
	{
		$data['title'] = 'Beranda';
		$data['user'] = $this->usersession->getUserSession()['userInfo'];

		$lastReport = $this->reportsservice->getLastReport()['data'];
		$data['lastReport'] = isset($lastReport->reports)
			? (!empty($lastReport->reports[0]) ? $lastReport->reports[0] : null)
			: null;

		$categories = $this->categoriesservice->getAllCategories()['data']->categories;
		$data['checkIn'] = array_filter($categories, function ($category) {
			return $category->name === 'Kerja';
		})[0];

		$this->loadPageView('templates/reports/index', $data);
	}

	public function checkin()
	{
		$categoryId = $this->input->post('category_id');
		$timeStart = $this->input->post('time_start');

		$response = $this->reportsservice->postPresence($categoryId, $timeStart);

		$this->setOutputToJSON($response);
	}

	public function rekap()
	{
		$data['title'] = 'Rekap';
		$this->loadPageView('templates/reports/rekap', $data);
	}

	public function load_data_table_reports($firstDate = null, $lastDate = null)
	{
		$reports = $this->reportsservice->getAllReports($firstDate, $lastDate);
		$data['reports'] = isset($reports['data']->reports)
			? $reports['data']->reports : [];

		$this->load->view('templates/reports/table_reports', $data);
	}

	public function presensi()
	{
		$data['title'] = 'Presensi';
		$categories = $this->categoriesservice->getAllCategories()['data']->categories;
		$data['checkIn'] = array_filter($categories, function ($category) {
			return $category->name === 'Kerja';
		})[0];
		$this->loadPageView('templates/reports/presensi', $data);
	}

	public function presensi_kerja()
	{
		$data['title'] = 'Presensi';
		$data['secondary_title'] = 'Laporan Kerja';

		$this->loadPageView('templates/reports/presensi_laporan', $data);
	}

	public function presensi_izin()
	{
		$this->load->library('categoriesservice');
		$this->categoriesservice->setUserSession($this->usersession);
		$categories = $this->categoriesservice->getAllCategories()['data']->categories;

		$data['categories'] = array_filter($categories, function ($item) {
			return $item->name !== 'Kerja';
		});

		$data['title'] = 'Presensi';
		$data['secondary_title'] = 'Laporan Izin';
		$this->loadPageView('templates/reports/presensi_laporan', $data);
	}

	public function checkout()
	{
		$categoryId = $this->input->post('category_id');
		$time_end = $this->input->post('time_end');
		$report = $this->input->post('report');
		$response = $this->reportsservice->postReport(
			$categoryId,
			$time_end,
			$report,
		);

		$this->setOutputToJSON($response);
	}

	public function rekap_presensi_pegawai()
	{
		$user = $this->usersession->getUserSession()['userInfo'];

		if ($user['role'] !== 'Pimpinan') {
			redirect(base_url());
		}

		$data['title'] = 'Rekap Presensi Pegawai';
		$users = $this->usersservice->getAllUsers()['data']->users;
		$data['users'] = $users;

		$this->loadPageView('templates/reports/rekap_presensi_pegawai', $data);
	}

	public function load_data_table_presensi_pegawai($idPegawai, $startDate, $endDate)
	{
		$user = $this->usersession->getUserSession()['userInfo'];

		if ($user['role'] !== 'Pimpinan') {
			redirect(base_url());
		}

		$data['reports'] = $this->reportsservice->getUserReports(
			$idPegawai,
			$startDate,
			$endDate
		)['data']->reports;

		$this->load->view('templates/reports/table_reports_pegawai_by_pimpinan.php', $data);
	}
}
