<?php
class ConverterAbstract implements ConverterInterface
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
