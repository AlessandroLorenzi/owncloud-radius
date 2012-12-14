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

		require_once('radius.class.php');

		$radius = new Radius($this->host, $this->secret);
		
		return ( $radius->AccessRequest($uidEscaped, $password)  )

	}
	
	public function userExists($uid) {
		return true;
	}
}
