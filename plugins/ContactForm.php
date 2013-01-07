<?php
class ContactForm {

	public $fromFirstName;
	public $fromLastName;
	public $fromEmail;
	public $subject;
	public $body;
	
	public function setFromName($first, $last) {
		$this->fromFirstName = $first;
		$this->fromLastName = $last;
	}
	
	public function setFromEmail($email) {
		$this->fromEmail = $email;
	}
	
	public function setSubject($subject) {
		$this->subject = $subject;
	}
	
	public function setBody($body) {
		$this->body = $body;
	}
	
	public function isFromFirstNameValid() {
		return !empty($this->fromFirstName);
	}
	
	public function isFromLastNameValid() {
		return !empty($this->fromLastName);
	}
	
	public function isFromEmailValid() {
		if (empty($this->fromEmail)) return false;
		return filter_var($this->fromEmail, FILTER_VALIDATE_EMAIL);
	}
	
	public function isValid() {
		return ($this->isFromFirstNameValid() &&
			$this->isFromLastNameValid() &&
			$this->isFromEmailValid());
	}
	
	public function send($to) {
		return mail($to, $this->subject, $this->body, $this->headers());
	}
	
	public function headers() {
		$headers = 'From: ' . $this->from() . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		return $headers;
	}
	
	public function from() {
		return $this->fromFirstName . ' ' . $this->fromLastName . ' <' . $this->fromEmail . '>';
	}
	
	public function __toString() {
		return $this->headers() . "\r\n" .
			'Subject: ' . $this->subject . "\r\n" .
			"\r\n" .
			$this->body;
	}
	
}
