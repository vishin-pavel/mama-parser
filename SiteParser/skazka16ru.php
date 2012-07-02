<?php
class skazka16ruParser extends ParserAbstract
{
	/**
	 * Массив адресов.
	 */
	private $urlList;

	public function __construct()
	{
		parent::__construct();

		$this->domainName = 'skazka16.ru';

		// TODO: Составить список разделов.
		$this->urlList = array(
			0 => array( // Одежда
				0 => '/index.php?categoryID=89', // Наряды
				1 => '/index.php?categoryID=104', // Летняя
				2 => '/index.php?categoryID=154', // Песочники
				3 => '/index.php?categoryID=115', // Футболки
				4 => '/index.php?categoryID=102', // Белье, пижамки
				5 => '/index.php?categoryID=112', // Весна/Осень
				6 => '/index.php?categoryID=92', // Водолазки, толстовки
				7 => '/index.php?categoryID=149', // Болеро
				8 => '/index.php?categoryID=150', // Жакеты
				9 => '/index.php?categoryID=147', // Жилеты
				10 => '/index.php?categoryID=148', // Леггинсы, Рейтузы, Гетры к платьям, пинетки
				11 => '/index.php?categoryID=145', // Платья и туники
				12 => '/index.php?categoryID=146', // Шапочки и шарфы
				13 => '/index.php?categoryID=127', // Джинсы
				14 => '/index.php?categoryID=114', // Для деток от 1 года
				15 => '/index.php?categoryID=151', // Вязанные комбинезоны, комплекты
				16 => '/index.php?categoryID=152', // Комбинезоны, боди
				17 => '/index.php?categoryID=153', // Комплекты, Кофточки, распашонки, ползунки, чепчики
				18 => '/index.php?categoryID=113', // Зимняя
				19 => '/index.php?categoryID=116', // Коллекции Лео
				20 => '/index.php?categoryID=117', // Комплекты на выписку
				21 => '/index.php?categoryID=93', // Лео-спорт
				22 => '/index.php?categoryID=91', // Спортивные костюмы
				23 => '/index.php?categoryID=105', // Халаты, полотенца, изделия из махры
				24 => '/index.php?categoryID=128' // Швейный трикотаж
			),
			1 => array( // Мамины помошники
				0 => '/index.php?categoryID=85', // Мамины помошники
				1 => '/index.php?categoryID=107' // Уборка дома
			),
			2 => array( // Мягкий пол, коврики-пазлы, конструкторы, мягкая разборная мебель, игры
				0 => '/index.php?categoryID=161', // Детская мягкая сборная мебель
				1 => '/index.php?categoryID=158', // Игры
				2 => '/index.php?categoryID=160', // Мягкие конструкторы
				3 => '/index.php?categoryID=156', // Мягкий пол для детских, игровых комнат
				4 => '/index.php?categoryID=157' // Напольные игровые зоны (коврики-пазлы)
			),
			3 => '/index.php?categoryID=119', // Пледы, одеяла, конверты, подушки
			4 => array( // Подгузники и пеленки для малышей
				0 => '/index.php?categoryID=87', // Подгузники и пеленки для малышей
				1 => '/index.php?categoryID=88', // Prokids Magic Tape
				2 => '/index.php?categoryID=164', // SEALER
				3 => '/index.php?categoryID=140' // Пеленки
			),
			5 => '/index.php?categoryID=159', // Постельное белье
			6 => '/index.php?categoryID=118', // СЛИНГИ, подушки для кормления
			7 => '/index.php?categoryID=109' // Средства гигиены
		);
		$this->countUrl($this->urlList);

		$arr = $this->getParsedUrlList($this->urlList);

		ob_start();
		var_export($arr);
		$arr1 = ob_get_contents();
		ob_clean();
		$logFile = fopen(dirname(__FILE__).'/skazka16.array', 'w');
		fwrite($logFile, $arr1);
		fclose($logFile);
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

			$logFile = fopen(dirname(__FILE__).'/skazka16.log', 'w');
			fwrite($logFile, ++$this->currentRecord .' of '. $this->recordCount ."\n".'category>>> '.$url."\n");
			fclose($logFile);

			$htmlDOM = $this->request($url);
			$i = 0;

			if($htmlDOM->find('.subcat'))
			{
				$a = $htmlDOM->find('.subcat');
				if($a[0]->find('a'))
				{
					$a = $a[0]->find('a');

					foreach($a as $a1){
						$link = $a1->href;
						$productList1 = $this->parsingPageList($link);
						foreach($productList1 as $product1){
							$productList[]=$product1;
						}
					}
				}
			}

			if($htmlDOM->find('.catlist')){

				$rc = new RollingCurl();
				$rc->window_size = 2;

				$tr = $htmlDOM->find('.catlist');

				foreach($tr as $section){
					$listcap = $section->find('.listcap');
					if($listcap){
						$a = $listcap[0]->find('a');
						$link = $a[0]->href;
						if($link{0} != '/'){
							$link = '/'.$link;
						}
						$rc->get($this->domainName.$link);
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

			if($htmlDOM->find('#content'))
			{
				$imageUrl = $htmlDOM->find('.productpic');
				if($imageUrl[0]->find('img')){
					$imageUrl = $imageUrl[0]->find('img');
					$imageUrl = $imageUrl[0]->src;
				}else{
					$imageUrl = '';
				}

				$h1 = $htmlDOM->find('h1');
				$h1 = $h1[0]->innertext;

				$price = $htmlDOM->find('.redprice');
				$price = trim($price[0]->innertext);


				$description = $htmlDOM->find('.productinfo');
				$description = $description[0]->innertext;

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