<?php
class ConverterAbstract
{
	protected $parser;

	public function __construct()
	{
		foreach($parserNameList as $i => $parserName){
			$parserClassName = $parserName.'Parser';
			$this->parser[$parserName] = new $parserClassName();
		}
	}
}
?>
