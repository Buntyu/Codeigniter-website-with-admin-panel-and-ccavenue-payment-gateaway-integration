<?php
class geolocation
{
	
	/*Get user ip address*/
	public $ip_address;
	/*Get user ip address details with geoplugin.net*/
	public $geopluginURL='http://www.geoplugin.net/php.gp?ip=';
	function __construct()
	{		
	}
	function getlocation($obj)
	{
		$this->ip_address = $_SERVER['REMOTE_ADDR'];
		$this->geopluginURL .= $this->ip_address;
		$post_data = array ( 
		);
		$output = $obj->curl->_simple_call("get",$this->geopluginURL);
		
		$addrDetailsArr = unserialize($output); 
		$retdata = array();
		/*Get City name by return array*/
		$retdata['city'] = $addrDetailsArr['geoplugin_city']; 

		/*Get Country name by return array*/
		$retdata['country'] = $addrDetailsArr['geoplugin_countryName'];

		/*Get Region Code by return array*/
		$retdata['regionCode'] = $addrDetailsArr['geoplugin_regionCode'];

		/*Get 2 Digit country Code by return array*/
		$retdata['countryCode'] = $addrDetailsArr['geoplugin_countryCode'];

		/*Get Country currency Code by return array*/
		$retdata['currencyCode'] = $addrDetailsArr['geoplugin_currencyCode'];
		 return $retdata;
	}
}
?>