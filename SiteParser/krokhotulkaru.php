<?php
class krokhotulkaruParser extends ParserAbstract
{
	public function __construct()
	{
		parent::__construct();

		$this->domainName = 'krokhotulka.ru';

		$this->urlList = array(
			11 => '/eshop/bytovaya_himiya_dlya_vsej_semi/' // Бытовая химия для всей семьи
		);
			//9 => '/eshop/vse_dlya_mam_i_beremennyh/', // Все для мам и беременных
			//10 => '/eshop/gigiena_i_kosmetika_dlya_mam_i_pap/' // Гигиена и косметика для мам и пап
			//0 => '/eshop/podguzniki/', // Подгузники
			//1 => '/eshop/odezhda1/', // Одежда
			//2 => '/eshop/konverty/', // Конверты
			//3 => '/eshop/aksessuary_dlya_kormleniya/', // Все для кормления
			//4 => '/eshop/predmety_po_uhodu_za_malyshom/', // Уход и здоровье
			//5 => '/eshop/detskaya_komnata/', // Детская комната
			//6 => '/eshop/kupanie_i_gigiena/', // Купание и гигиена
			//7 => '/eshop/detskaya_bytovaya_himiya_i_kosmetika/' // Детская бытовая химия
			//8 => '/eshop/igrushki/' // Играй и развивайся

		//$this->countUrl($this->urlList);

		//$arr = $this->getParsedUrlList($this->urlList);

		//ob_start();
		//var_export($arr);
		//$arr1 = ob_get_contents();
		//ob_clean();
		//$logFile = fopen(dirname(__FILE__).'/krokhotulka.array', 'w');
		//fwrite($logFile, $arr1);
		//fclose($logFile);

		$logFile = file_get_contents(dirname(__FILE__).'/krokhotulka.array');
		$this->products = eval($logFile);
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

			$htmlDOM = $this->request($url.'?p=all');
			$i = 0;
			if($htmlDOM->find('.objects')){
				$rc = new RollingCurl();
				$rc->window_size = 2;
				foreach($htmlDOM->find('.object') as $section){
					$a = $section->find('a');
					if($a){
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
						$product = $this->parsingPage($productHtmlType['page']);
						$productList[]=$product;
					}
				}
			}else{
				throw new Exception('Парсер не может найти элемент .objects на странице '.$url);
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

			if($htmlDOM->find('#view_item'))
			{
				$imageUrlf = $htmlDOM->find('#bigPhotoDiv');
				$imageUrlf = $imageUrlf[0]->find('img');
				$imageUrl = $imageUrlf[0]->src;


				$h1f = $htmlDOM->find('h1');
				if(count($h1f)){
					$h1 = strip_tags($h1f[0]->innertext);
				}else{
					$h1 = 'Без заголовка';
				}

				$pricef = $htmlDOM->find('.info');
				$pricef = $pricef[0]->find('span');
				$price = trim(strip_tags($pricef[0]->innertext));

				$descriptionf = $htmlDOM->find('.note');
				$descriptionf = $descriptionf[0]->find('div');
				$description = $descriptionf[0]->innertext;

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