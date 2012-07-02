<?php
class mdmarketruParser extends ParserAbstract
{
	/**
	 * Массив адресов.
	 */
	private $urlList;

	public function __construct()
	{
		parent::__construct();

		$this->domainName = 'md-market.ru';

		$this->urlList = array(
			0 => array( // Игрушки
				0 => '/toys/soft_bricks/', // Мягкие конструкторы
				1 => '/toys/avtive_games/', // Активные игры
				2 => '/toys/toy_zones/', // Коврики-пазлы
			),
			1 => array( // Для детской
				0 => '/nursery/furniture/', // Детская мебель
				1 => '/nursery/floor_zones/', // Коврики-пазлы
				2 => '/nursery/nursery_tiles/' // Мягкие плитки
			),
			2 => array( // Мягкие покрытия
				0 => '/soft_floor/tiles/', // Мягкие плитки
				1 => '/soft_floor/game_zones/', // Коврики-пазлы
				2 => '/soft_floor/sport_mat/' // Товары для спорта
			)
		);
		$this->countUrl($this->urlList);
/*
		$arr = $this->getParsedUrlList($this->urlList);

		ob_start();
		var_export($arr);
		$arr1 = ob_get_contents();
		ob_clean();
		$logFile = fopen(dirname(__FILE__).'/mdmarket.array', 'w');
		fwrite($logFile, $arr1);
		fclose($logFile);
 */
	}

	// TODO: execute after develop
	private function countUrl($urlList)
	{
		// Рассчитывается сколько урлов есть вообще.
		for($i = 0; $i < count($urlList); $i++)
		{
			$url = $urlList[$i];
			if(is_string($url))
			{
				$this->recordCount++;
			}
			else if(is_array($url))
			{
				$pageList[$i] = $this->countUrl($url);
			}
		}
	}

	private function getParsedUrlList($urlList)
	{
		$pageList = array(); //массив страниц

			foreach($urlList as $i => $url)
			{
				if(is_string($url))
				{
					$pageList[$i] = $this->parsingPageList($url);
				}
				else if(is_array($url))
				{
					$pageList[$i] = $this->getParsedUrlList($url);
				}
			}

		return $pageList;
	}

	private function parsingPageList($url)
	{
		// Метод реализующий парсинг страницы где список продуктов.
		// @param url параметры ссылки на веб страницу

		$productList = array(); // Список продуктов.

			$logFile = fopen(dirname(__FILE__).'/mdmarket.log', 'w');
			fwrite($logFile, ++$this->currentRecord .' of '. $this->recordCount ."\n".'category>>> '.$url."\n");
			fclose($logFile);

			$htmlDOM = $this->request($url);
			$i = 0;

			if($htmlDOM->find('.b-item')){

				$rc = new RollingCurl();
				$rc->window_size = 2;

				foreach($htmlDOM->find('.b-item') as $section){
					$name = $section->find('.name');
					if($name){
						$a = $name[0]->find('a');
						$rc->get($this->domainName.$a[0]->href);
						$i++;
					}
				}

				if(0 < $i){
					$productListHtmlType = $rc->execute();

					foreach($productListHtmlType as $productHtmlType){
						$product = $this->parsingPage($productHtmlType);
						$productList[]=$product;
					}
				}
			}else{
				throw new Exception('Парсер не может найти элемент .b-item на странице '.$url);
			}

		return $productList;
	}

	private function parsingPage($html)
	{
		// Метод реализующий парсинг страницы продукта.
		// @param html веб страница продукта
		// return массив распарсенных данных продукта.

		$product = array();

			$htmlDOM = new simple_html_dom();
			$htmlDOM->load($html);

			if($htmlDOM->find('.b-content'))
			{
				$imageUrl = $htmlDOM->find('.fancyshow');
				$imageUrl = $imageUrl[0]->href;

				$h1 = $htmlDOM->find('.text');
				$h1 = $h1[0]->find('h3');
				$h1 = strip_tags($h1[0]->innertext);

				$price = $htmlDOM->find('.b-incart');
				$price = $price[0]->find('.price');
				$price = trim($price[0]->innertext);


				$description = $htmlDOM->find('.text');
				$description = $description[0]->find('p');
				$description = $description[0]->outertext;

				$product = array(
					'productName' => $h1,
					'productImage' => $imageUrl,
					'productDescription' => $description,
					'productPrice' => $price
				);
			}

			unset($htmlDOM);

		return $product;
	}
}
?>