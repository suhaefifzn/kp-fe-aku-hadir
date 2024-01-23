<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'core/MY_Web_Service.php';

class ReportsService extends MY_Web_Service
{
	private $userSession;

	public function __construct()
	{
		parent::__construct('reports');
	}

	public function setUserSession($userSession)
	{
		$this->userSession = $userSession;
	}

	/**
	 * Get last user report
	 * 
	 * @return array
	 */
	public function getLastReport()
	{
		$query = '?lastReport=true';
		return $this->get(
			$this->userSession,
			null,
			$query,
		);
	}

	/**
	 * Get all reports or some reports betweend two dates
	 * 
	 * @param string|null $firstDate
	 * @param string|null $lastDate
	 * @return array
	 */
	public function getAllReports(string $firstDate = null, string $lastDate = null)
	{
		$query = null;

		if (($firstDate) and ($lastDate)) {
			$query = "?fromDate=$firstDate&toDate=$lastDate";
		}

		return $this->get(
			$this->userSession,
			null,
			$query,
		);
	}

	/**
	 * Record time presence and report category
	 * 
	 * @param string $categoryId
	 * @param string $time
	 * @return array
	 */
	public function postPresence(string $categoryId, string $time)
	{
		$payload = [
			'category_id' => $categoryId,
			'time_start' => $time,
		];

		return $this->post($this->userSession, $payload);
	}

	/**
	 * Send a report from user a.k.a check out
	 * 
	 * @param string|null $categoryId
	 * @param string $time_end
	 * @param string $report
	 * @return array
	 */
	public function postReport(
		string $categoryId = null,
		string $time,
		string $report
	) {
		$payload = null;

		if ($categoryId) {
			$payload = [
				'category_id' => $categoryId,
				'time_start' => $time,
				'report' => $report
			];

			return $this->post($this->userSession, $payload);
		} else {
			$payload = [
				'time_end' => $time,
				'report' => $report,
			];

			return $this->put($this->userSession, $payload);
		}
	}

	/**
	 * Get user reports by leader
	 * 
	 * @param string $userId
	 * @param string $startDate
	 * @param string $endDate
	 * @return array
	 */
	public function getUserReports(string $userId, string $startDate, string $endDate)
	{
		$query = "?userId=$userId&fromDate=$startDate&toDate=$endDate";
		return $this->get($this->userSession, null, $query);
	}
}
