<?php

namespace ObjectivePHP\String;

class String implements \arrayaccess
{

	/**
	* @var string
	* This will be the string we are printing out to the user
	*/

	protected $string;

	/**
	* __construct()  
	* The declaration has an optional paramater
	* @param 1 -> optional string
	*/
	public function __construct($string = null)
	{
		if ( ! is_null($string)) {
			$this->string = $string;
		}
	}

	public function __get($val)
	{
		if (!isset($this->$val)) {
			return $this->$val();
		} else {
			return $this->$val;
		}
	}

	public function __tostring()
	{
		if ( ! is_null($this->string)) {
			return $this->string;
		} else {
			return '';
		}
	}

	public function insertCharacters($offset, $value)
	{
		$string = str_split($this->string);

		$string[$offset] = $value;

		$this->string = implode('', $string);
	}
	/**
	* arrayaccess methods
	* Tehse are the methods that the implementation requires
	*
	*/

	public function offsetSet($offset, $value)
	{
		$this->insertCharacters($offset, $value);
	}

	public function offsetExists($offset) {
		$string = str_split($this->string);

		return isset($string[$offset]);
	}

	public function offsetUnset($offset) {

		$string = str_split($this->string);

		unset($string[$offset]);

		$this->string = implode('', $string);
	}

	public function offsetGet($offset) {

		$string = str_split($this->string);

		return isset($string[$offset]) ? $string[$offset] : null;
	}

	/**
	* lower()
	* This method will convert the string to all lower case
	* @return $this
	*/ 

	public function lower()
	{
		$this->string = strtolower($this->string);

		return $this;
	}

	/**
	* upper() 
	* This method converts the string to upper case
	* @return $this
	*/

	public function upper()
	{
		$this->string = strtoupper($this->string);

		return $this;
	}
	/**
	* append()
	* This method allows you to append a string upon the current string
	* @param 1 -> string to append
	*/

	public function append($string)
	{
		$this->string = $this->string.$string;

		return $this;
	}

	/** 
	* crypt()
	* This method sets a one way hash on the string using the crypt() method
	* @return $this
	*/

	public function crypt()
	{
		$this->string = crypt($this->string);

		return $this;
	}

	/**
	* replace() 
	* this method will replae the first parameter with the second parameter
	* @param 1 -> string to find
	* @param 2 -> string to replace
	* @return $this
	*/

	public function replace($find, $replace)
	{
		$this->string = str_replace($find, $replace, $this->string);

		return $this;
	}

	/**
	* html()
	* This method will convert all applicable charaters to HTML entities
	* @return $this
	*/

	public function html()
	{
		$this->string = htmlentities($this->string);

		return $this;
	}

	/**
	* explode() 
	* This method will explode the string into an array
	* @param 1 -> character to split the array
	* @return $this
	*/

	public function explode($character)
	{
		return new \ObjectivePHP\Collection\Collection(explode($character, $this->string));
	}

	/**
	* dump()
	* This method will var_dump the current string.  
	* @return $this for daisy chain compatibility
	*/

	public function dump()
	{
		var_dump($this->string);

		return $this;
	}

	public function clear()
	{ 
		$this->string = '';
		
		return $this;
	}
}