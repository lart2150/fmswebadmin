<?php
class App_Fmrest_Auth_Adapter implements Zend_Auth_Adapter_Interface 
{
	protected $_identity;
	protected $_credential;
	protected $_server = 'http://localhost:16000';
	
	/**
	 * Performs an authentication attempt
	 *
	 * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
	 * @return Zend_Auth_Result
	 */
	public function authenticate() {
		$decoded = App_Fmrest_Abstractrequest::basicRequest('/rest/server-status/login-valid', array('username' => $this->_identity, 'password' => $this->_credential, 'server' =>$this->_server));
		if (isset($decoded->valid) && $decoded->valid) {
			return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, $this->_identity);
		} elseif (isset($decoded->valid)) {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, $this->_identity);
		} else {
			return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_UNCATEGORIZED, $this->_identity, array("Error Talking to server"));
		}
	}
	

	/**
	 * setIdentity() - set the value to be used as the identity
	 *
	 * @param  string $value
	 * @return Zend_Auth_Adapter_DbTable Provides a fluent interface
	 */
	public function setIdentity($value)
	{
		$this->_identity = $value;
		return $this;
	}
	
	/**
	 * setCredential() - set the credential value to be used, optionally can specify a treatment
	 * to be used, should be supplied in parameterized form, such as 'MD5(?)' or 'PASSWORD(?)'
	 *
	 * @param  string $credential
	 * @return Zend_Auth_Adapter_DbTable Provides a fluent interface
	 */
	public function setCredential($credential)
	{
		$this->_credential = $credential;
		return $this;
	}
	
	public function setServer($server)
	{
		$this->_server = $server;
		return $this;
	}
}