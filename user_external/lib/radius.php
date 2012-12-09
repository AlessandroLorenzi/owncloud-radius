<?php
/**
 * Copyright (c) 2012 Alessandro "alorenzi" Lorenzi <alessandro.lorenzi@gmail.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */

class OC_User_RADIUS extends OC_User_Backend{
	private $host;
	private $realm;
	private $secret;

	const loginError='NT_STATUS_LOGON_FAILURE';
	
	public function __construct($host, $realm, $secret) {
		$this->host=$host;
		$this->realm=$realm;
		$this->secret=$secret;
	}
	
	/**
	 * @brief Check if the password is correct
	 * @param $uid The username
	 * @param $password The password
	 * @returns true/false
	 *
	 * Check if the password is correct without logging in the user
	 */
	public function checkPassword($uid, $password) {
		$uidEscaped=escapeshellarg($uid)."@".$this->realm;
		$password=escapeshellarg($password);
		$result=array();

		$radius = radius_auth_open(); 


		if (! radius_add_server($radius,$this->host,0,$this->secret,5,3)) 
		{
			die('Radius Error: ' . radius_strerror($radius)); 
			//return false;
		}
		
		if (! radius_create_request($radius,RADIUS_ACCESS_REQUEST))
		{
			//die('Radius Error: ' . radius_strerror($radius));
		die(" XX ");
			//return false;
		} 	
		
		radius_put_attr($radius,RADIUS_USER_NAME,$uidEscaped);
		radius_put_attr($radius,RADIUS_USER_PASSWORD,$password); 
		
		if(radius_send_request($radius) == RADIUS_ACCESS_ACCEPT) {
			print "CANNATO";
			return false;
		}else{
			return $uid;
		}
	}
	
	public function userExists($uid) {
		return true;
	}
}
