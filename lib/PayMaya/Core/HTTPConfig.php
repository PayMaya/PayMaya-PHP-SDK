<?php

namespace PayMaya\Core;

use PayMaya\Core\Constants;

class HTTPConfig
{
	const HEADER_SEPARATOR = ";";
	const HTTP_GET = "GET";
	const HTTP_POST = "POST";

	private $defaultCurlOptions = array(
		CURLOPT_SSLVERSION => 6,
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_TIMEOUT => 60,
		CURLOPT_USERAGENT => Constants::SDK_SIGNATURE,
		CURLOPT_HTTPHEADER => array(),
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_SSL_VERIFYPEER => 1,
		CURLOPT_SSL_CIPHER_LIST => "TLSv1"
	);

	private $curlOptions;
	private $url;
	private $headers = array();
	private $method;

	public function __construct($url = null, $method = self::HTTP_POST, $headers = array())
	{
		$this->url = $url;
		$this->method = $method;
		$this->headers = $headers;
		$this->curlOptions = $this->defaultCurlOptions;
	}

	public function getHttpHeaders()
	{
		$httpHeaders = array();
		foreach ($this->headers as $key => $value) {
			$httpHeaders[] = "$key: $value";
		}
		return $httpHeaders;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getCurlOptions()
	{
		return $this->curlOptions;
	}
}
