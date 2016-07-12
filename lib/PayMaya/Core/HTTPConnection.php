<?php

namespace PayMaya\Core;
use Exception;

class HTTPConnection
{
	private $httpConfig;

	public function __construct($httpConfig)
	{
		if (!function_exists("curl_init")) {
			throw new Exception("curl module is not available in this machine");
		}
		$this->httpConfig = $httpConfig;
	}

	public function execute($data)
	{
		$session = curl_init($this->httpConfig->getUrl());
		curl_setopt_array($session, $this->httpConfig->getCurlOptions());
		curl_setopt($session, CURLOPT_URL, $this->httpConfig->getUrl());
		curl_setopt($session, CURLOPT_HEADER, true);
		curl_setopt($session, CURLINFO_HEADER_OUT, true);
		curl_setopt($session, CURLOPT_HTTPHEADER, $this->httpConfig->getHttpHeaders());

		switch ($this->httpConfig->getMethod()) {
			case "POST":
				curl_setopt($session, CURLOPT_POST, true);
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				break;
			case "DELETE":
				curl_setopt($session, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				break;
		}

		if ($this->httpConfig->getMethod() != NULL) {
			curl_setopt($session, CURLOPT_CUSTOMREQUEST, $this->httpConfig->getMethod());
		}

		$response = curl_exec($session);
		$httpStatus = curl_getinfo($session, CURLINFO_HTTP_CODE);

		if (curl_errno($session)) {
			$exception = new Exception("Error API call");
			curl_close($session);
			throw $exception;
		}
		
		$responseHeaderSize = strlen($response) - curl_getinfo($session, CURLINFO_SIZE_DOWNLOAD);
		$result = substr($response, $responseHeaderSize);
		curl_close($session);
		return $result;
	}
}
