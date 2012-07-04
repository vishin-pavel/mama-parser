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
	protected $recordCount = 0;
	protected $urlList;

	public function __construct()
	{

	}

	protected function request($urlParams)
	{
		/**
		 * Метод реализующий запрос с параметрами на сервер.
		 * Возвращает результат file_get_html. т.е. Объект simple_html_dom.
		 */
		$url = $urlParams;
		if($urlParams{0} != '/'){
			$url = '/'.$urlParams;
		}
		$url = 'http://'.$this->domainName.$url;
		return file_get_html($url);
	}

	public function getData()
	{
		return $this->products;
	}

	protected function countUrl($urlList)
	{
		// Рассчитывается сколько урлов есть вообще.
		foreach($urlList as $url)
		{
			if(is_string($url))
			{
				$this->recordCount++;
			}
			else if(is_array($url))
			{
				$this->countUrl($url);
			}
		}
	}

	public function getUrlList()
	{
		return $this->urlList;
	}
}
?>