<?php

namespace PayMaya\Core;

use PayMaya\Core\Constants;

class HTTPConfig
{
	public static $defaultCurlOptions = array(
		CURLOPT_SSLVERSION => 6,
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => TRUE,
		CURLOPT_TIMEOUT => 60,	// maximum number of seconds to allow cURL functions to execute
		CURLOPT_USERAGENT => Constants::SDK_NAME, // add version
		CURLOPT_HTTPHEADER => array(),
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_SSL_VERIFYPEER => 1,
		CURLOPT_SSL_CIPHER_LIST => "TLSv1"
		//Allowing TLSv1 cipher list.
		//Adding it like this for backward compatibility with older versions of curl
	);

	const HEADER_SEPARATOR = ";";
	const HTTP_GET = "GET";
	const HTTP_POST = "POST";

	private $headers = array();

	private $curlOptions;

	private $url;

	private $method;

	private $retryCount = 0;

	public function __construct($url = null, $method = self::HTTP_POST)
	{
		$this->url = $url;
		$this->method = $method;
		$this->curlOptions = self::$defaultCurlOptions;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getHeaders()
	{
		return $this->headers;
	}

	public function getHeader($name)
	{
		if (array_key_exists($name, $this->headers)) {
			return $this->headers[$name];
		}
		return null;
	}

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function setHeaders(array $headers = array())
	{
		$this->headers = $headers;
	}

	public function addHeader($name, $value, $overWrite = true)
	{
		if (!array_key_exists($name, $this->headers) || $overWrite) {
			$this->headers[$name] = $value;
		} else {
			$this->headers[$name] = $this->headers[$name] . self::HEADER_SEPARATOR . $value;
		}
	}

	public function removeHeader($name)
	{
		unset($this->headers[$name]);
	}

	public function getCurlOptions()
	{
		return $this->curlOptions;
	}

	public function addCurlOption($name, $value)
	{
		$this->curlOptions[$name] = $value;
	}

	public function removeCurlOption($name)
	{
		unset($this->curlOptions[$name]);
	}

	public function setCurlOptions($options)
	{
		$this->curlOptions = $options;
	}

	public function setHttpTimeout($timeout)
	{
		$this->curlOptions[CURLOPT_CONNECTTIMEOUT] = $timeout;
	}

	public function setHttpRetryCount($retryCount)
	{
		$this->retryCount = $retryCount;
	}

	public function setUserAgent($userAgentString)
	{
		$this->curlOptions[CURLOPT_USERAGENT] = $userAgentString;
	}
}
