<?php

namespace ServiceUptime\API;

/**
 * Class for work with ServiceUptime API
 */
class API
{
	// default wsdl url
    protected $_url = 'https://www.serviceuptime.com/api/';
	
	// Current authentication key. May be restored.
    protected $_apikey;
	protected $_lasterror;

	/**
	 */
	public function __construct($apikey)
	{
	    $this->_apikey = $apikey;
	}

	/**
	 * Magic method
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call($name, $arguments)
    {
        $name = strtolower(preg_replace("/([A-Z])/", '-$1', $name));
		return $this->execute($name, $arguments);
    }

	/**
	 * Returns last error message
	 *
	 * @return string
	 */
	public function GetErrorMsg()
	{
        return $this->_lasterror;
	}
	
	/**
	 * Execute function
	 *
	 * @param $method string
	 * @param $params array of mixed
	 * @return mixed
	 */
	protected function execute($method, $params = array())
	{
        $this->_lasterror = null;
		$result = null;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_url . $this->_apikey . '/' . $method);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = json_decode(curl_exec($ch), true);
        if (!$response){
            $this->_lasterror = 'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch);
        }
        elseif ($response['status'] == 'success'){
            $result = $response['data'];
        }
        else {
            $this->_lasterror = 'Error: "' . $response['err_code'] . '" - Code: ' . $response['err_msg'];
        }
        curl_close($ch);

		return $result;
	}

}

// EoF