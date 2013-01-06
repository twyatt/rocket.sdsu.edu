<?php
class ContactForm {
	
	public $subject;
	
	public $firstNameField;
	public $lastNameField;
	public $emailField;
	public $otherFields;
	
	public function send($to) {
		return mail($to, $this->subject, $this->body(), $this->headers());
	}
	
	public function headers() {
		$headers = 'From: ' . $this->from() . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		return $headers;
	}
	
	public function from() {
		return $_REQUEST[$this->firstNameField] . ' ' . $_REQUEST[$this->lastNameField] . ' <' . $_REQUEST[$this->emailField] . '>';
	}
	
	public function body() {
		$content = '';
		foreach ($this->otherFields as $key => $value) {
			$content .= $value . ': ' . (is_string($key) ? $_REQUEST[$key] : $_REQUEST[$value]) . "\r\n";
		}
		return $content;
	}
	
	public function __toString() {
		return $this->headers() . "\r\n" .
			'Subject: ' . $this->subject . "\r\n" .
			"\r\n" .
			$this->body();
	}
	
}
