<?php
class UmiConverter extends ConverterAbstract
{
	public function __construct($parserName)
	{
		$this->changeParser($parserName);

		$parsedData = $this->parser->getData();

		$sectionList = array(
			0 => array(
				0 => '/shop/odezhda/dlya_samyh_malenkih/',
				1 => '',
				2 => '',
			),
			1 => array(
				0 => '',
				1 => '',
				2 => '',
				3 => '',
				4 => ''
			),
			2 => array(
				0 => '',
				1 => ''
			),
			3 => '',
			4 => '',
			5 => ''
		);

		// Таблица соответсвий разделов.
		$changeProductList = array(
			0 => array( // Одежда
				0 => array( // Одежда для самых маленьких.
					$parsedData[1][1][0], // Трусики MERRIES
					$parsedData[1][1][1], // Трусики GOON
					$parsedData[1][1][2], // Трусики Huggies Хаггис
					$parsedData[1][1][3], // Трусики Libero Либеро
					$parsedData[1][1][4], // Трусики Pampers Памперс
					$parsedData[1][1][5] // Трусики непромокаемые
				),
				1 => '',
				2 => '',
			),
			1 => array(
				0 => '',
				1 => '',
				2 => '',
				3 => '',
				4 => ''
			),
			2 => array(
				0 => '',
				1 => ''
			),
			3 => '',
			4 => '',
			5 => ''
		);
	}
}
?>