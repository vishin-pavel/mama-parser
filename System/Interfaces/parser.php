<?php
interface ParserInterface
{
	/**
	 * Возвращает массив данных:
	 * array(
	 *		key => array( <- Раздел продукта
	 *			key => array( <- Подраздел продукта
	 *				'productName' => string,
	 *				'productImage' => string example: http://www.example.com/images/example.jpeg,
	 *				'productDescription' => string,
	 *				'productPrice' => integer
	 *			)
	 *		)
	 * );
	 */
	public function getData();
}
?>