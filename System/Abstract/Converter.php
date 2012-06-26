<?php
class ConverterAbstract
{
	protected $parser;

	public function __construct()
	{

	}

	protected function changeParser($parserName)
	{
		$parserClassName = $parserName.'Parser';
		$this->parser = new $parserClassName();
	}
}
?>
