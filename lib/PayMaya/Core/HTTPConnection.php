<?php

namespace PayMaya\Core;

class HTTPConnection
{
	private $httpConfig;

	public function __construct($httpConfig)
	{
		if (!function_exists("curl_init")) {
			throw new Exception("Curl module is not available on this system");
		}
		$this->httpConfig = $httpConfig;
	}

	private function getHttpHeaders()
	{

		$ret = array();
		foreach ($this->httpConfig->getHeaders() as $k => $v) {
			$ret[] = "$k: $v";
		}
		return $ret;
	}

	public function execute($data)
	{
		$ch = curl_init($this->httpConfig->getUrl());
		$options = $this->httpConfig->getCurlOptions();
		if(empty($options[CURLOPT_HTTPHEADER])) {
			unset ($options[CURLOPT_HTTPHEADER]);
		}
		curl_setopt_array($ch, $options);
		curl_setopt($ch, CURLOPT_URL, $this->httpConfig->getUrl());
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHttpHeaders());

		switch ($this->httpConfig->getMethod()) {
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
			case 'PUT':
			case 'PATCH':
			case 'DELETE':
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
		}

		if ($this->httpConfig->getMethod() != NULL) {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->httpConfig->getMethod());
		}

		$result = curl_exec($ch);
		$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		if (curl_errno($ch)) {
			$ex = new Exception("Error API call");
			curl_close($ch);
			throw $ex;
		}

		$requestHeaders = curl_getinfo($ch, CURLINFO_HEADER_OUT);
		$responseHeaderSize = strlen($result) - curl_getinfo($ch, CURLINFO_SIZE_DOWNLOAD);
		$responseHeaders = substr($result, 0, $responseHeaderSize);
		$result = substr($result, $responseHeaderSize);

		curl_close($ch);

		return $result;
	}
}
