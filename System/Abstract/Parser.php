<?php
class ParserAbstract implements ParserInterface
{
	/**
	* field products type array
	* Структура массива (
	*	'Name' => string,
	*	'Description' => string,
	*	'Image' => string,
	*   'Price' => float
	* )
	*/
	protected $products = array();
	protected $domainName;

	protected function request($urlParams)
	{
		/**
		 * Метод реализующий запрос с параметрами на сервер.
		 * Возвращает результат file_get_html. т.е. Объект simple_html_dom.
		 */
		$url = 'http://'.$this->domainName.$urlParams;
		return file_get_html($url);
	}

	public function getData()
	{
		return $this->products;
	}
}
?>