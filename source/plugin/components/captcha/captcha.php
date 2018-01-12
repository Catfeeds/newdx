<?php

class Captcha
{
	const SESSION_VAR_PREFIX = 'captcha_';
	
	public $id;
    public $width = 70;
    public $height = 30;
    public $padding = 2;
    public $backColor = 0xFFFFFF;
	public $foreColor = 0x2040A0;
    public $minLength = 4;
	public $maxLength = 4;
	public $transparent = false;
	public $offset = -2;
	public $fontFile;
	public $fixedVerifyCode;
    
    public function __construct($id)
    {
		$this->id = $id;
    }
	
	public function getVerifyCode()
	{
		@session_start();
		return $_SESSION[$this->getSessionKey()];
	}
	public function validate($input, $caseSensitive=false)
	{
		$code = $this->getVerifyCode();
		return $caseSensitive ? ($input === $code) : !strcasecmp($input,$code);
	}
	
	public function end()
	{
		@session_start();
		unset($_SESSION[$this->getSessionKey()]);
	}
	
	protected function getSessionKey()
	{
		return self::SESSION_VAR_PREFIX.$this->id;
	}
	
	public function render()
	{
		@session_start();
        $code = $_SESSION[$this->getSessionKey()] = $this->generateVerifyCode();
		$this->renderImage($code);
	}
    
    protected function generateVerifyCode()
	{
		if($this->minLength < 3)
			$this->minLength = 3;
		if($this->maxLength > 20)
			$this->maxLength = 20;
		if($this->minLength > $this->maxLength)
			$this->maxLength = $this->minLength;
		$length = mt_rand($this->minLength,$this->maxLength);

		$letters = 'bcdfghjklmnpqrstvwxyz';
		$vowels = 'aeiou';
		$code = '';
		for($i = 0; $i < $length; ++$i)
		{
			if($i % 2 && mt_rand(0,10) > 2 || !($i % 2) && mt_rand(0,10) > 9)
				$code.=$vowels[mt_rand(0,4)];
			else
				$code.=$letters[mt_rand(0,20)];
		}

		return $code;
	}
    
    protected function renderImage($code)
	{
		$image = imagecreatetruecolor($this->width,$this->height);

		$backColor = imagecolorallocate($image,
				(int)($this->backColor % 0x1000000 / 0x10000),
				(int)($this->backColor % 0x10000 / 0x100),
				$this->backColor % 0x100);
		imagefilledrectangle($image,0,0,$this->width,$this->height,$backColor);
		imagecolordeallocate($image,$backColor);

		if($this->transparent)
			imagecolortransparent($image,$backColor);

		$foreColor = imagecolorallocate($image,
				(int)($this->foreColor % 0x1000000 / 0x10000),
				(int)($this->foreColor % 0x10000 / 0x100),
				$this->foreColor % 0x100);

		if($this->fontFile === null)
			$this->fontFile = dirname(__FILE__) . '/Duality.ttf';

		$length = strlen($code);
		$box = imagettfbbox(30,0,$this->fontFile,$code);
		$w = $box[4] - $box[0] + $this->offset * ($length - 1);
		$h = $box[1] - $box[5];
		$scale = min(($this->width - $this->padding * 2) / $w,($this->height - $this->padding * 2) / $h);
		$x = 10;
		$y = round($this->height * 27 / 40);
		for($i = 0; $i < $length; ++$i)
		{
			$fontSize = (int)(rand(26,32) * $scale * 0.8);
			$angle = rand(-10,10);
			$letter = $code[$i];
			$box = imagettftext($image,$fontSize,$angle,$x,$y,$foreColor,$this->fontFile,$letter);
			$x = $box[2] + $this->offset;
		}

		imagecolordeallocate($image,$foreColor);

		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Transfer-Encoding: binary');
		header("Content-type: image/png");
		imagepng($image);
		imagedestroy($image);
	}
}