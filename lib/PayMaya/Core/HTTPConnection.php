<?php

namespace PayMaya\Core;

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
			case 'POST':
				curl_setopt($session, CURLOPT_POST, true);
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				break;
			case 'PUT':
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				break;
			case 'DELETE':
				curl_setopt($session, CURLOPT_POSTFIELDS, $data);
				break;
		}

		if ($this->httpConfig->getMethod() != NULL) {
			curl_setopt($session, CURLOPT_CUSTOMREQUEST, $this->httpConfig->getMethod());
		}

		$result = curl_exec($session);
		$httpStatus = curl_getinfo($session, CURLINFO_HTTP_CODE);

		if (curl_errno($session)) {
			$exception = new Exception("Error API call");
			curl_close($session);
			throw $exception;
		}

		$requestHeaders = curl_getinfo($session, CURLINFO_HEADER_OUT);
		$responseHeaderSize = strlen($result) - curl_getinfo($session, CURLINFO_SIZE_DOWNLOAD);
		$responseHeaders = substr($result, 0, $responseHeaderSize);
		$result = substr($result, $responseHeaderSize);

		curl_close($session);

		return $result;
	}
}
