<?php
require_once('recaptchalib.php');

/**
 * reCAPTCHA helper class.
 */
class Recaptcha {
	
	private $_recaptchaResponse;
	
	public $privateKey;
	public $publicKey;
	
	public function __construct($publicKey, $privateKey) {
		$this->publicKey = $publicKey;
		$this->privateKey = $privateKey;
	}
	
	public function check() {
		$this->_recaptchaResponse = recaptcha_check_answer(
			$this->privateKey,
			$_SERVER['REMOTE_ADDR'],
			$_REQUEST['recaptcha_challenge_field'],
			$_REQUEST['recaptcha_response_field']
		);
		
		return $this->_recaptchaResponse;
	}
	
	public function html() {
		if ($this->_recaptchaResponse && !$this->_recaptchaResponse->is_valid) {
			$error = $this->_recaptchaResponse->error;
		} else {
			$error = null;
		}
		
		return recaptcha_get_html($this->publicKey, $error);
	}
	
	public function __toString() {
		return $this->html();
	}
	
}
