<?php
class EmbeddedVideo {

	protected $_source;
	
	public $type;
	public $width;
	public $height;
	
	public function __construct($source, $width, $height) {
		$extension = pathinfo($source, PATHINFO_EXTENSION);
		
		// http://www.iana.org/assignments/media-types/video/index.html
		switch (strtolower($extension)) {
			case 'mpg':
				$type = 'video/mpeg';
				break;
			default:
				$type = "video/$extension";
		}
		
		$this->_source = $source;
		$this->type = $type;
		$this->width = $width;
		$this->height = $height;
	}
	
	public function __toString() {
		$text = "" .
"<video width=\"{$this->width}\" height=\"{$this->height}\" controls>\n" .
"	<source src=\"{$this->_source}\" type=\"{$this->type}\">\n" .
"	<object data=\"{$this->_source}\" width=\"{$this->width}\" height=\"{$this->height}\">\n" .
"		<embed\n" .
"			src=\"{$this->_source}\"\n" .
"			width=\"{$this->width}\"\n" .
"			height=\"{$this->height}\">\n" .
"	</object>\n" .
"</video>\n";
		return $text;
	}
	
}
