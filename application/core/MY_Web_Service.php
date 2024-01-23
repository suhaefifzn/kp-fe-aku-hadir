<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

class MY_Web_Service
{
	private $client;
	private $fullURL;
	private $endpoint;
	private $baseURL = 'https://api-aku-hadir.cyclic.app/';

	/**
	 * @param string $uri
	 */
	public function __construct(string $uri)
	{
		$this->endpoint = $uri;
		$this->fullURL = $this->baseURL . $this->endpoint;
		$this->client = new Client();
	}

	/**
	 * POST request to API
	 * 
	 * @param object $userSession
	 * @param array $payload
	 * @return array
	 */
	public function post(object $userSession, array $payload)
	{
		$accessToken = $userSession->getAccessToken();

		try {
			$response = $this->client->post($this->fullURL, [
				RequestOptions::HEADERS => $this->setHeaders($this->endpoint, $accessToken),
				RequestOptions::JSON => $payload,
			]);

			return $this->setSuccessResponse($response);
		} catch (ClientException $e) {
			if ($this->refreshUserToken($e, $userSession)) {
				return $this->post($userSession, $payload);
			}

			return $this->setBadResponse($e);
		} catch (RequestException $e) {
			return $this->setBadResponse($e);
		}
	}

	/**
	 * PUT request to API
	 * 
	 * @param object $userSession
	 * @param array $payload
	 * @return array
	 */
	public function put(object $userSession, array $payload, string $query = null)
	{
		$accessToken = $userSession->getAccessToken();
		$url = $this->fullURL . ($query ? $query : '');

		try {
			$response = $this->client->put(
				$url,
				[
					RequestOptions::HEADERS => $this->setHeaders($this->endpoint, $accessToken),
					RequestOptions::JSON => $payload,
				]
			);

			return $this->setSuccessResponse($response);
		} catch (ClientException $e) {
			if ($this->refreshUserToken($e, $userSession)) {
				return $this->get($userSession, $payload);
			}

			return $this->setBadResponse($e);
		} catch (RequestException $e) {
			return $this->setBadResponse($e);
		}
	}

	/**
	 * GET request to API
	 * 
	 * @param object $userSession
	 * @param array|null $payload 
	 * @param string|null $query
	 * @return array
	 */
	public function get(object $userSession, array $payload = null, string $query = null)
	{
		$accessToken = $userSession->getAccessToken();
		$url = $this->fullURL . ($query ? $query : '');

		try {
			$response = $this->client->get(
				$url,
				[
					RequestOptions::HEADERS => $this->setHeaders($this->endpoint, $accessToken),
				]
			);

			return $this->setSuccessResponse($response);
		} catch (ClientException $e) {
			if ($this->refreshUserToken($e, $userSession)) {
				return $this->get($userSession, $payload, null);
			}

			return $this->setBadResponse($e);
		} catch (RequestException $e) {
			return $this->setBadResponse($e);
		}
	}

	/**
	 * DELETE request to API
	 * 
	 * @param object $userSession
	 * @param array|null $payload
	 * @return array
	 */
	public function delete(object $userSession, array $payload = null)
	{
		$accessToken = $userSession->getAccessToken();
		$refreshToken = $userSession->getRefreshToken();

		if ($this->endpoint === 'authentications') {
			$payload = [
				'refreshToken' => $refreshToken
			];
		}

		try {
			$response = $this->client->delete($this->fullURL, [
				RequestOptions::HEADERS => $this->setHeaders($this->endpoint, $accessToken),
				RequestOptions::JSON => $payload,
			]);

			return $this->setSuccessResponse($response);
		} catch (ClientException $e) {
			if ($this->refreshUserToken($e, $userSession)) {
				return $this->delete($userSession, $payload);
			}

			return $this->setBadResponse($e);
		} catch (RequestException $e) {
			return $this->setBadResponse($e);
		}
	}

	/**
	 * Get new accessToken
	 * 
	 * @param object $response
	 * @param object $userSession
	 * @return boolean|array
	 */
	private function refreshUserToken(object $response, object $userSession)
	{
		$error = isset(json_decode($response->getResponse()->getBody())->error)
			? (json_decode($response->getResponse()->getBody())->error === 'Unauthorized'
				? json_decode($response->getResponse()->getBody())->error
				: json_decode($response->getResponse()->getBody())->error
			) : null;

		if (
			$response->getResponse()->getStatusCode() === 401
			and ($error === 'Unauthorized')
		) {
			$refreshToken = $userSession->getRefreshToken();

			try {
				$newResponse = $this->client->put(
					$this->baseURL . 'authentications',
					[
						RequestOptions::HEADERS => $this->setHeaders('authentications'),
						RequestOptions::JSON => [
							'refreshToken' => $refreshToken,
						],
					]
				);

				$accessToken = json_decode($newResponse->getBody())->data->accessToken;
				$userSession->setUserSession($accessToken, $refreshToken);

				return true;
			} catch (ClientException $e) {
				return $this->setBadResponse($e);
			} catch (RequestException $e) {
				return $this->setBadResponse($e);
			}
		} else {
			return false;
		}
	}

	/**
	 * Manage bad response from API
	 * 
	 * @param object $response
	 * @return array
	 */
	private function setBadResponse($response)
	{
		$decodedResponse = json_decode($response->getResponse()->getBody());
		$statusCode = $response->getResponse()->getStatusCode();
		$message = isset($decodedResponse->message) ? $decodedResponse->message : null;

		$data = [
			'status' => $statusCode,
			'message' => $message,
			'success' => false,
		];

		return $data;
	}

	/**
	 * Manage success response from API
	 * 
	 * @param object $reponse
	 * @return array
	 */
	private function setSuccessResponse($response)
	{
		$statusCode = $response->getStatusCode();
		$getBody = isset(json_decode($response->getBody())->data)
			? json_decode($response->getBody())->data
			: null;
		$message = isset(json_decode($response->getBody())->message)
			? json_decode($response->getBody())->message
			: null;

		$data = [
			'status' => $statusCode,
			'data' => $getBody,
			'message' => $message,
			'success' => true,
		];

		return $data;
	}

	/**
	 * Set headers
	 * 
	 * @param string $endpoint
	 * @param string|null $accessToken
	 * @return array
	 */
	private function setHeaders(string $endpoint, string $accessToken = null)
	{
		if ($endpoint === 'authentications') {
			return [
				'Content-Type' => 'application/json'
			];
		} else {
			return [
				'Content-Type' => 'application/json',
				'Authorization' => 'Bearer ' . $accessToken
			];
		}
	}
}
