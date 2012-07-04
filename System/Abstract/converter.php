<?php
class ConverterAbstract implements ConverterInterface
{
	protected $parser;

	public function __construct($parserNameList)
	{
		foreach($parserNameList as $parserName){
			$parserClassName = $parserName.'Parser';
			$this->parser[$parserName] = new $parserClassName();
		}
	}

	public function setProducts($ParsOrNot)
	{

	}
}