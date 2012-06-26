<?php
class UmiConverter extends ConverterAbstract
{
	public function __construct($parserName)
	{
		$this->changeParser($parserName);
		$DataArray = $this->parser->getData();
	}
}
?>