<?php
class App_Fmrest_Abstractrequest
{
	public static function basicRequest($uri, $settings) {
		//$url = 'http://localhost:16000'.$uri.'?username='.urlencode($username).'&password='.urlencode($password);
		$url = $settings['server'].$uri.'?username='.urlencode($settings['username']).'&password='.urlencode($settings['password']);
		//var_dump($url );die();
		$client = new Zend_Http_Client($url );
		$response = $client->request();
		
		return json_decode($response->getBody());
	}
}