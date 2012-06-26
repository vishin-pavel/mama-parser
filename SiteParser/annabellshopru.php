<?php
class annabellshopruParser extends ParserAbstract
{
	/**
	 * Массив адресов.
	 */
	private $urlList;

	public function __construct()
	{
		parent::__construct();

		$this->domainName = 'annabellshop.ru';

		$this->urlList = array(
			0 => array( // ДЕТСКАЯ КОСМЕТИКА
					0 => '/our-shop.html?page=shop.browse&amp;category_id=96', // Крем
					1 => '/our-shop.html?page=shop.browse&amp;category_id=97', // Молочко/Масло/Лосьон
					2 => '/our-shop.html?page=shop.browse&amp;category_id=94', // Мыло
					3 => '/our-shop.html?page=shop.browse&amp;category_id=95', // Купание детей
					4 => '/our-shop.html?page=shop.browse&amp;category_id=98', // Присыпка
					5 => array( // Салфетки
						0 => '/our-shop.html?page=shop.browse&amp;category_id=273', // Детская влажная туалетная бумага
						1 => '/our-shop.html?page=shop.browse&amp;category_id=243', // Салфетки бумажные
						2 => '/our-shop.html?page=shop.browse&amp;category_id=244' // Салфетки влажные
					),
					6 => '/our-shop.html?page=shop.browse&amp;category_id=99', // Защита от солнца и комаров
					7 => '/our-shop.html?page=shop.browse&amp;category_id=364', // Гигиенические помады
			),
			1 => array( // ДЕТСКИЕ ПОДГУЗНИКИ, ТРУСИКИ, ПЕЛЁНКИ/КЛЕЁНКИ
				0 => '/our-shop.html?page=shop.browse&amp;category_id=92', // Пеленки / клеёнки
				1 => array( // Трусики
					0 => '/our-shop.html?page=shop.browse&amp;category_id=222', // Трусики MERRIES
					1 => '/our-shop.html?page=shop.browse&amp;category_id=223', // Трусики GOON
					2 => '/our-shop.html?page=shop.browse&amp;category_id=218', // Трусики Huggies Хаггис
					3 => '/our-shop.html?page=shop.browse&amp;category_id=217', // Трусики Libero Либеро
					4 => '/our-shop.html?page=shop.browse&amp;category_id=219', // Трусики Pampers Памперс
					5 => '/our-shop.html?page=shop.browse&amp;category_id=330' // Трусики непромокаемые
				),
				2 => array( // Подгузники
					0 => '/our-shop.html?page=shop.browse&amp;category_id=89', // Подгузники Huggies Хаггис
					1 => '/our-shop.html?page=shop.browse&amp;category_id=340', // Подгузники Royal Pups Роял Пупс
					2 => '/our-shop.html?page=shop.browse&amp;category_id=83', // Подгузники Libero Либеро
					3 => '/our-shop.html?page=shop.browse&amp;category_id=88', // Подгузники Pampers Памперс
					4 => '/our-shop.html?page=shop.browse&amp;category_id=386', // Подгузники Prokids
					5 => '/our-shop.html?page=shop.browse&amp;category_id=321', // Фито - подгузники Sun-Herbal Сан Хербал
					6 => '/our-shop.html?page=shop.browse&amp;category_id=214', // Японские подгузники GOON Гун
					7 => '/our-shop.html?page=shop.browse&amp;category_id=213', // Японские подгузники MERRIES Мериес
					8 => '/our-shop.html?page=shop.browse&amp;category_id=212' // Японские подгузники MOONY Муни
				)
			),
			2 => array( // ДЕТСКОЕ ПИТАНИЕ
				0 => '/our-shop.html?page=shop.browse&amp;category_id=81', // Детская вода
				1 => array( // Детские каши
					0 => '/our-shop.html?page=shop.browse&amp;category_id=157', // Каши Беби
					1 => '/our-shop.html?page=shop.browse&category_id=159', // Каши Нутрилон
					2 => '/our-shop.html?page=shop.browse&category_id=196', // Каши Хипп
					3 => '/our-shop.html?page=shop.browse&category_id=210', // Каши Семпер
					4 => '/our-shop.html?page=shop.browse&category_id=211', // Каши Хайнц
					5 => '/our-shop.html?page=shop.browse&category_id=250', // Каши Нестле
					6 => '/our-shop.html?page=shop.browse&category_id=280', // Каши Хумана Humana
					7 => '/our-shop.html?page=shop.browse&category_id=302', // Каши Фрисо
					8 => '/our-shop.html?page=shop.browse&category_id=304', // Каши БелЛакт
					9 => '/our-shop.html?page=shop.browse&category_id=327', // Каши Фруто Няня
					10 => '/our-shop.html?page=shop.browse&category_id=344' // Каши Малютка
				),
				2 => '/our-shop.html?page=shop.browse&amp;category_id=334', // Детские макароны
				3 => array( // Детские смеси
					0 => '/our-shop.html?page=shop.browse&category_id=283', // Смеси (ФРИСО) Фрисланд Friesland
					1 => '/our-shop.html?page=shop.browse&category_id=384', // Смеси Агуша
					2 => '/our-shop.html?page=shop.browse&category_id=165', // Смеси Бабушкино лукошко
					3 => '/our-shop.html?page=shop.browse&category_id=226', // Смеси Бэби Bebi
					4 => '/our-shop.html?page=shop.browse&category_id=166', // Смеси Малютка
					5 => '/our-shop.html?page=shop.browse&category_id=123', // Смеси Нестле Nestle
					6 => '/our-shop.html?page=shop.browse&category_id=126', // Смеси Нутрилак
					7 => '/our-shop.html?page=shop.browse&category_id=124', // Смеси Нутриция Nutricia
					8 => '/our-shop.html?page=shop.browse&category_id=125', // Смеси Нэнни Nanny
					9 => '/our-shop.html?page=shop.browse&category_id=208', // Смеси Семпер Semper
					10 => '/our-shop.html?page=shop.browse&category_id=303', // Смеси Симилак Similac
					11 => '/our-shop.html?page=shop.browse&category_id=133', // Смеси Хипп Hipp
					12 => '/our-shop.html?page=shop.browse&category_id=281' // Смеси Хумана Humana
				),
				4 => array( // Детские соки
					0 => '/our-shop.html?page=shop.browse&category_id=373', // Соки Агуша
					1 => '/our-shop.html?page=shop.browse&category_id=162', // Соки Бабушкино лукошко
					2 => '/our-shop.html?page=shop.browse&category_id=227', // Соки Беби
					3 => '/our-shop.html?page=shop.browse&category_id=351', // Соки Бебивита Bebivita
					4 => '/our-shop.html?page=shop.browse&category_id=160', // Соки Гербер
					5 => '/our-shop.html?page=shop.browse&category_id=308', // Соки Нутриция
					6 => '/our-shop.html?page=shop.browse&category_id=309', // Соки Сады Придонья
					7 => '/our-shop.html?page=shop.browse&category_id=209', // Соки Семпер
					8 => '/our-shop.html?page=shop.browse&category_id=310', // Соки Спеленок
					9 => '/our-shop.html?page=shop.browse&category_id=325', // Соки Фруто Няня
					10 => '/our-shop.html?page=shop.browse&category_id=161' // Соки Хипп
				),
				5 => '/our-shop.html?page=shop.browse&amp;category_id=80', // Детский чай
				6 => '/our-shop.html?page=shop.browse&amp;category_id=79', // Детское печенье
				7 => array( // Детское пюре
					0 => array( // Мясное пюре
						0 => '/our-shop.html?page=shop.browse&category_id=155', // Мясное пюре Бабушкино лукошко
						1 => '/our-shop.html?page=shop.browse&category_id=354', // Мясное пюре Бебивита
						2 => '/our-shop.html?page=shop.browse&category_id=163', // Мясное пюре Бэби
						3 => '/our-shop.html?page=shop.browse&category_id=150', // Мясное пюре Гербер
						4 => '/our-shop.html?page=shop.browse&category_id=251', // Мясное пюре Нестле
						5 => '/our-shop.html?page=shop.browse&category_id=305', // Мясное пюре Нутриция
						6 => '/our-shop.html?page=shop.browse&category_id=151', // Мясное пюре Семпер
						7 => '/our-shop.html?page=shop.browse&category_id=371', // Мясное пюре ФрутоНяня
						8 => '/our-shop.html?page=shop.browse&category_id=148' // Мясное пюре Хипп
					),
					1 => array( // Овощное пюре
						0 => '/our-shop.html?page=shop.browse&category_id=341', // Овощное пюре Beech Nut Бич Нат
						1 => '/our-shop.html?page=shop.browse&category_id=154', // Овощное пюре Бабушкино лукошко
						2 => '/our-shop.html?page=shop.browse&category_id=335', // Овощное пюре Бебивита
						3 => '/our-shop.html?page=shop.browse&category_id=145', // Овощное пюре Гербер
						4 => '/our-shop.html?page=shop.browse&category_id=306', // Овощное пюре Нутриция
						5 => '/our-shop.html?page=shop.browse&category_id=147', // Овощное пюре Семпер
						6 => '/our-shop.html?page=shop.browse&category_id=326', // Овощное пюре Фруто Няня
						7 => '/our-shop.html?page=shop.browse&category_id=143' // Овощное пюре Хипп
					),
					2 => array( // Рыбное пюре
						0 => '/our-shop.html?page=shop.browse&category_id=156', // Рыбное пюре Бабушкино лукошко
						1 => '/our-shop.html?page=shop.browse&category_id=164', // Рыбное пюре Бэби
						2 => '/our-shop.html?page=shop.browse&category_id=152', // Рыбное пюре Семпер
						3 => '/our-shop.html?page=shop.browse&category_id=149' // Рыбное пюре Хипп
					),
					3 => array( // Фруктовое пюре
						0 => '/our-shop.html?page=shop.browse&category_id=383', // Фруктовое пюре Bebi Беби
						1 => '/our-shop.html?page=shop.browse&category_id=342', // Фруктовое пюре Beech Nut Бич Нат
						2 => '/our-shop.html?page=shop.browse&category_id=350', // Фруктовое пюре Humana Хумана
						3 => '/our-shop.html?page=shop.browse&category_id=153', // Фруктовое пюре Бабушкино лукошко
						4 => '/our-shop.html?page=shop.browse&category_id=336', // Фруктовое пюре Бебивита
						5 => '/our-shop.html?page=shop.browse&category_id=144', // Фруктовое пюре Гербер
						6 => '/our-shop.html?page=shop.browse&category_id=307', // Фруктовое пюре Нутриция
						7 => '/our-shop.html?page=shop.browse&category_id=363', // Фруктовое пюре Сады Придонья и Спеленок
						8 => '/our-shop.html?page=shop.browse&category_id=146', // Фруктовое пюре Семпер
						9 => '/our-shop.html?page=shop.browse&category_id=324', // Фруктовое пюре Фруто Няня
						10 => '/our-shop.html?page=shop.browse&category_id=142' // Фруктовое пюре Хипп
					)
				),
				8 => '/our-shop.html?page=shop.browse&amp;category_id=279' // Супчики
			),
			3 => array( // ДЛЯ КОРМЛЕНИЯ ДЕТЕЙ
				0 => '/our-shop.html?page=shop.browse&amp;category_id=115', // Аксессуары для кормления
				1 => array( // Бутылочки/Поильники
					0 => '/our-shop.html?page=shop.browse&category_id=276', // Бутылочки / Поильники Canpol
					1 => '/our-shop.html?page=shop.browse&category_id=271', // Бутылочки / Поильники NUK
					2 => '/our-shop.html?page=shop.browse&category_id=369', // Бутылочки / Поильники Baby Wee
					3 => '/our-shop.html?page=shop.browse&category_id=380', // Бутылочки / Поильники Happy Baby Хэппи Беби
					4 => '/our-shop.html?page=shop.browse&category_id=332', // Бутылочки / Поильники Бусика
					5 => '/our-shop.html?page=shop.browse&category_id=263', // Бутылочки MEDELA
					6 => '/our-shop.html?page=shop.browse&category_id=348', // Бутылочки NUBY Нуби
					7 => '/our-shop.html?page=shop.browse&category_id=379', // Бутылочки для молочной кухни
					8 => '/our-shop.html?page=shop.browse&category_id=203', // Бутылочки/ Поильники AVENT
					9 => '/our-shop.html?page=shop.browse&category_id=204', // Бутылочки/ Поильники MAMASENSE
					10 => '/our-shop.html?page=shop.browse&category_id=268', // Бутылочки/ Поильники PIGEON
					11 => '/our-shop.html?page=shop.browse&category_id=205', // Бутылочки/ Поильники МИР ДЕТСТВА и КУРНОСИКИ
					12 => '/our-shop.html?page=shop.browse&category_id=356', // Бутылочки/Поильники Tommee Tippee Томми Типпи
					13 => '/our-shop.html?page=shop.browse&category_id=360', // Бутылочки/Поильники ПОМА
				),
				2 => '/our-shop.html?page=shop.browse&amp;category_id=110', // Подогреватели/ Стерилизаторы / Блендеры
				3 => '/our-shop.html?page=shop.browse&amp;category_id=113', // Посуда
				4 => array( // Пустышки
					0 => '/our-shop.html?page=shop.browse&category_id=197', // Прищепки для пустышек
					1 => '/our-shop.html?page=shop.browse&category_id=198', // Пустышки AVENT
					2 => '/our-shop.html?page=shop.browse&category_id=370', // Пустышки BABY WEE
					3 => '/our-shop.html?page=shop.browse&category_id=277', // Пустышки CANPOL
					4 => '/our-shop.html?page=shop.browse&category_id=382', // Пустышки Happy Baby Хэппи Беби
					5 => '/our-shop.html?page=shop.browse&category_id=199', // Пустышки MAMASENSE
					6 => '/our-shop.html?page=shop.browse&category_id=347', // Пустышки NUBY Нуби
					7 => '/our-shop.html?page=shop.browse&category_id=275', // Пустышки NUK
					8 => '/our-shop.html?page=shop.browse&category_id=267', // Пустышки PIGEON
					9 => '/our-shop.html?page=shop.browse&category_id=358', // Пустышки Tommee Tippee Томми Типпи
					10 => '/our-shop.html?page=shop.browse&category_id=270', // Пустышки из латекса
					11 => '/our-shop.html?page=shop.browse&category_id=353', // Пустышки Мир Детства и Курносики
					12 => '/our-shop.html?page=shop.browse&category_id=361', // Пустышки ПОМА
				),
				5 => '/our-shop.html?page=shop.browse&amp;category_id=114', // Слюнявчики
				6 => array( // Соски
					0 => '/our-shop.html?page=shop.browse&category_id=201', // Соски MAMASENSE
					1 => '/our-shop.html?page=shop.browse&category_id=202', // Соски Mир детства и Курносики
					2 => '/our-shop.html?page=shop.browse&category_id=200', // Соски AVENT
					3 => '/our-shop.html?page=shop.browse&category_id=278', // Соски CANPOL
					4 => '/our-shop.html?page=shop.browse&category_id=381', // Соски Happy Baby Хэппи Бэби
					5 => '/our-shop.html?page=shop.browse&category_id=262', // Соски MEDELA
					6 => '/our-shop.html?page=shop.browse&category_id=272', // Соски NUK
					7 => '/our-shop.html?page=shop.browse&category_id=269', // Соски PIGEON
					8 => '/our-shop.html?page=shop.browse&category_id=359', // Соски Tommee Тippee Томми Типпи
					9 => '/our-shop.html?page=shop.browse&category_id=299', // Соски молочные латексные
					10 => '/our-shop.html?page=shop.browse&category_id=362', // Соски ПОМА
				),
				7 => '/our-shop.html?page=shop.browse&amp;category_id=245' // Специальные приспособления для кормления ребенка
			),
			4 => array( // ДЛЯ МАМ
				0 => '/our-shop.html?page=shop.browse&category_id=260', // Аксессуары для мам
				1 => '/our-shop.html?page=shop.browse&category_id=185', // Бандажи
				2 => '/our-shop.html?page=shop.browse&category_id=104', // Белье
				3 => '/our-shop.html?page=shop.browse&category_id=105', // Гигиена груди
				4 => '/our-shop.html?page=shop.browse&category_id=106', // Гигиена тела
				5 => '/our-shop.html?page=shop.browse&category_id=137', // Косметика для мам
				6 => '/our-shop.html?page=shop.browse&category_id=258', // Медицина - товары для здоровья
				7 => '/our-shop.html?page=shop.browse&category_id=103', // Молокоотсосы
				8 => array( // Питание
					0 => '/our-shop.html?page=shop.browse&category_id=311', // Вода для здоровья
					1 => '/our-shop.html?page=shop.browse&category_id=312' // Чаи и коктейли
				),
				9 => '/our-shop.html?page=shop.browse&category_id=261', // Сбор и хранение грудного молока
				10 => '/our-shop.html?page=shop.browse&category_id=108' // Сумки - переноски
			),
			5 => array( // ИГРУШКИ
				0 => '/our-shop.html?page=shop.browse&category_id=323', // ВЕЛОСИПЕДЫ
				1 => '/our-shop.html?page=shop.browse&category_id=183', // Игрушки - сортеры
				2 => '/our-shop.html?page=shop.browse&category_id=175', // Игрушки для ванной
				3 => '/our-shop.html?page=shop.browse&category_id=343', // Мир кукол RUBENS BARN
				4 => '/our-shop.html?page=shop.browse&category_id=174', // Мобиле / Подвески / Дуги
				5 => '/our-shop.html?page=shop.browse&category_id=179', // Мягкие игрушки
				6 => '/our-shop.html?page=shop.browse&category_id=297', // Мягкие игрушки ZOOBIES
				7 => '/our-shop.html?page=shop.browse&category_id=355', // Пазлы, книжки, настольные игры, лото, панно
				8 => '/our-shop.html?page=shop.browse&category_id=257', // Песочные наборы / Машинки
				9 => '/our-shop.html?page=shop.browse&category_id=173', // Погремушки и прорезыватели
				10 => '/our-shop.html?page=shop.browse&category_id=176', // Развивающие игрушки
				11 => '/our-shop.html?page=shop.browse&category_id=378', // Развивающие игрушки МЯКИШИ
				12 => '/our-shop.html?page=shop.browse&category_id=178', // Развивающие коврики и центры
				13 => '/our-shop.html?page=shop.browse&category_id=377' // ЭЛЕКТРОМОБИЛИ
			),
			6 => array( // КУПАНИЕ МЛАДЕНЦЕВ
				0 => '/our-shop.html?page=shop.browse&category_id=366', // Детские ванночки
				1 => '/our-shop.html?page=shop.browse&category_id=365', // Детские полотенца
				2 => '/our-shop.html?page=shop.browse&category_id=367', // Принадлежности для купания
			),
			7 => array( // МОЮЩИЕ СРЕДСТВА
				0 => '/our-shop.html?page=shop.browse&category_id=119', // Для мытья посуды/игрушек/пола
				1 => '/our-shop.html?page=shop.browse&category_id=118', // Кондиционер для белья
				2 => '/our-shop.html?page=shop.browse&category_id=247', // Отбеливатели
				3 => '/our-shop.html?page=shop.browse&category_id=117', // Стиральные порошки
			),
			8 => array( // ЯСЕЛЬНЫЙ ТРИКОТАЖ
				0 => '/our-shop.html?page=shop.browse&category_id=338', // Трикотаж Lucky child (Лаки Чайлд)
				1 => '/our-shop.html?page=shop.browse&category_id=274', // Трикотаж Лео
				2 => '/our-shop.html?page=shop.browse&category_id=235', // Трикотаж Наша Мама
			)
		);

		$this->products = $this->getParsedUrlList($this->urlList);
	}

	private function getParsedUrlList($urlList)
	{
		$pageList = array(); //массив страниц

			for($i = 0; $i < count($urlList); $i++)
			{
				$url = $urlList[$i];
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

			$htmlDOM = $this->request($url);
			$vmMainPage = $htmlDOM->find('#vmMainPage');
			$div = $vmMainPage[0]->find('div'); $div = $div[2];
			if($div->find('ul')){ $ul = $div->find('ul'); $ul[0]->outertext = '';}
			if($div->find('br')){ $br = $div->find('br'); $br[0]->outertext = ''; if(count($br)>1){$br[1]->outertext = '';}}
			if($div->find('form')){ $form = $div->find('form'); $form[0]->outertext = '';}
			$pageCount = trim($div->innertext); $pageCount = explode(' ', $pageCount); $pageCount = $pageCount[5] + 20;

			$htmlDOM = $this->request($url.'&limitstart=0&limit='.$pageCount);

			if($htmlDOM->find('.sectiontableheader')){
				foreach($htmlDOM->find('.sectiontableentry1,.sectiontableentry1') as $section){
					$td = $section->find('td');
					if($td){
						$a = $td[0]->find('a');
						$product = $this->parsingPage($a[0]->href);
						array_push($productList, $product);
					}
				}
			}else{
				// Ошибка, парсер не может найти элемент .sectiontableheader
			}

		return $productList;
	}

	private function parsingPage($url)
	{
		// Метод реализующий парсинг страницы продукта.
		// @param url параметры ссылки на веб страницу

			$htmlDOM = $this->request($url);

			if($htmlDOM->find('.pathway'))
			{
				$vmMainPage = $htmlDOM->find('#vmMainPage');
				$table = $vmMainPage[0]->find('table');
				$tr = $table[0]->find('tr');
				$td = $tr[0]->find('td');
				$imageUrl = $td[0]->find('.s5_vm_img'); $imageUrl = $imageUrl[0]->find('a'); $imageUrl = $imageUrl[0]->href;
				$h1 = $htmlDOM->find('h1'); $h1 = $h1[0]->innertext;
				$price = $tr[1]->find('.productPrice'); $price = $price->innertext; $price = floatval($price);
				$description = $tr[3]->find('td'); $hr = $description[0]->find('hr'); $hr[0]->outertext = ''; $description = $description[0]->innertext;

				$product = array(
					'productName' => $h1,
					'productImage' => $imageUrl,
					'productDescription' => $description,
					'productPrice' => $price
				);
			}else{
				return;
			}

		return $product;
	}
}
?>