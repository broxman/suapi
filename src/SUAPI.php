<?php
/**
 * Class for work with ServiceUptime API
 */
class SUAPI
{
	// default wsdl url
    protected $_url = 'https://www.serviceuptime.com/api/';
	
	// Current authentication key. May be restored.
    protected $_apikey;
	protected $_lasterror;

	/**
	 */
	protected function __construct($apikey)
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
        $result = curl_exec($ch);
        if (!$result){
            $this->_lasterror = 'Error: "' . curl_error($ch) . '" - Code: ' . curl_errno($ch);
        }
        curl_close($ch);

		return $result;
	}

}

// EoF