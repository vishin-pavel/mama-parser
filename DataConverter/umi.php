<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 18:26
 * To change this template use File | Settings | File Templates.
 */
class UmiConverter extends ConverterAbstract
{
	public function __construct($parserNameList)
	{
		parent::__construct($parserNameList);
	}


    private function convert($productList, $section, $parserName)
	{
		// @param Url каталога любого сайта
		// @param Url каталога сайта mamakupi
		// @param Имя парсера


        //Получаем иерархический тип страници
        $hierarchyTypes = umiHierarchyTypesCollection::getInstance();
        $hierarchyType = $hierarchyTypes->getTypeByName("catalog", "object");
        $hierarchyTypeId = $hierarchyType->getId();

		$parsedProductList = $this->parser[$parserName]->parsingPageList($productList);

		foreach($parsedProductList as $product){
			if(count($product)>0){
				$hierarchy = umiHierarchy::getInstance();
				$parentId = $hierarchy->getIdByPath($section);
                $name = $product['productName'];
                $image = $product['productImage'];
                $descr = $product['productDescription'];
                $price = $product['productPrice'];

//Update......................................................................................
                //Создаем и подготавливаем выборку
                $sel = new umiSelection;
                $sel->addElementType($hierarchyTypeId); //Добавляет поиск по иерархическому типу
                $sel->addHierarchyFilter($parentId); //Устанавливаем поиск по разделу
                $sel->addPermissions(); //Говорим, что обязательно нужно учитывать права доступа

                //Получаем результаты
                $result = umiSelectionsParser::runSelection($sel); //Массив id объектов
                //$total = umiSelectionsParser::runSelectionCounts($sel); //Количество записей
                $allRight=true;



                foreach($result as $prodId){
                    $prod = $hierarchy->getElement($prodId);
                    if($name==$prod->getValue("h1")){
                        echo "Продукт {$name} уже существует, ";
                        if($descr!=$prod->getValue("description")){
                            echo "Описание продукта {$name} обнавлено, ";
                            $prod->setValue("description", $descr);

                        }
                        if($price!=$prod->getValue("price")){
                            echo "Цена продукта {$name} обнавлена. ";
                            $prod->setValue("price", $price);

                        }
                        $allRight=false;
                    }
                }
//Update......................................................................................

                if($allRight){
                    // Добавляем новый элемент
                    $newElementId = $hierarchy->addElement($parentId, $hierarchyTypeId, $name, $name);
                    if($newElementId === false)
                    {
                        echo "Не удалось создать новую страницу";
                    }

                    //Установим права на страницу в состояние "по умолчанию"
                    $permissions = permissionsCollection::getInstance();
                    $permissions->setDefaultPermissions($newElementId);

                    //Получим экземпляр страницы
                    $newElement = $hierarchy->getElement($newElementId);
                    if($newElement instanceof umiHierarchyElement)
                    {
                        //Заполним новую страницу свойствами
                        $newElement->setValue("title", $name);
                        $newElement->setValue("h1", $name);
                        $newElement->setValue("photo", $image);
                        $newElement->setValue("description", $descr);
                        $newElement->setValue("price", $price);

                        //Укажем, что страница является активной
                        $newElement->setIsActive(true);

                        //Подтвердим внесенные изменения
                        $newElement->commit();

                        //Покажем адрес новой страницы
                        echo "Успешно создана страница с адресом: \"", $hierarchy->getPathById($newElementId), "\"";
                    } else
                    {
                        echo "Не удалось получить экземпляр страницы #{$newElementId}.";
                    }
                }
			}
		}
	}

	private function converting($changeProductList, $section)
	{
			foreach($changeProductList as $parserName => $url)
			{
				if(is_string($url)){
					$this->convert($url, $section, $parserName);
				}else if(is_array($url)){
					$this->converting($url, $section[$parserName]);
				}
			}
	}

	public function setProducts()
	{
        $sectionList = array(
            0 => array(
                0 => '/shop/odezhda/dlya_samyh_malenkih/',
                1 => '/shop/odezhda/dlya_malchikov/',
                2 => '/shop/odezhda/dlya_devochek/',
            ),
            1 => array(
                0 => '/shop/igrushki/sbornaya_mebel/',
                1 => '/shop/igrushki/igry/',
                2 => '/shop/igrushki/konstruktory/',
                3 => '/shop/igrushki/myagkij_pol_dlya_detskih_komnat/',
                4 => '/shop/igrushki/kovriki_pazly/'
            ),
            2 => array(
                0 => '/shop/knigi/audio_i_video_knigi/',
                1 => '/shop/knigi/na_bumazhnom_nositele/'
            ),
            3 => '/shop/detskaya_bytovaya_himiya/',
            4 => '/shop/kupanie_i_gigiena/',
            5 => '/shop/tovary_dlya_mam_i_pap/'
        );

        $annabellshopruData = $this->parser['annabellshopru']->getUrlList();
        $skazka16ruData = $this->parser['skazka16ru']->getUrlList();
        $krokhotulkaru = $this->parser['krokhotulkaru']->getUrlList();

		// Таблица соответсвий разделов.
        $changeProductList = array(
            0 => array( // Одежда
                0 => array( // Одежда для самых маленьких.
                    'annabellshopru' => $annabellshopruData[1][0],     // Пеленки / клеёнки
                    'annabellshopru' => $annabellshopruData[1][1][0], // Трусики MERRIES
                    'annabellshopru' => $annabellshopruData[1][1][1], // Трусики GOON
                    'annabellshopru' => $annabellshopruData[1][1][2], // Трусики Huggies Хаггис
                    'annabellshopru' => $annabellshopruData[1][1][3], // Трусики Libero Либеро
                    'annabellshopru' => $annabellshopruData[1][1][4], // Трусики Pampers Памперс
                    'annabellshopru' => $annabellshopruData[1][1][5], // Трусики непромокаемые
                    'annabellshopru' => $annabellshopruData[1][2][0], // Подгузники Huggies Хаггис
                    'annabellshopru' => $annabellshopruData[1][2][1], // Подгузники Royal Pups Роял Пупс
                    'annabellshopru' => $annabellshopruData[1][2][2], // Подгузники Libero Либеро
                    'annabellshopru' => $annabellshopruData[1][2][3], // Подгузники Pampers Памперс
                    'annabellshopru' => $annabellshopruData[1][2][4], // Подгузники Prokids
                    'annabellshopru' => $annabellshopruData[1][2][5], // Фито - подгузники Sun-Herbal Сан Хербал
                    'annabellshopru' => $annabellshopruData[1][2][6], // Японские подгузники GOON Гун
                    'annabellshopru' => $annabellshopruData[1][2][7], // Японские подгузники MERRIES Мериес
                    'annabellshopru' => $annabellshopruData[1][2][8], // Японские подгузники MOONY Муни
                    'annabellshopru' => $annabellshopruData[8][0],    // Трикотаж Lucky child (Лаки Чайлд)
                    'annabellshopru' => $annabellshopruData[8][1],    // Трикотаж Лео
                    'annabellshopru' => $annabellshopruData[8][2],    // Трикотаж Наша Мама
                    'skazka16ru' => $skazka16ruData[4][0],            // Подгузники и пеленки для малышей
                    'skazka16ru' => $skazka16ruData[4][1],            // Prokids Magic Tape
                    'skazka16ru' => $skazka16ruData[4][2],            // SEALER
                    'skazka16ru' => $skazka16ruData[4][3],             // Пеленки
                    'skazka16ru' => $skazka16ruData[0][2],            // Песочники
                    'skazka16ru' => $skazka16ruData[0][14],           // Для деток от 1 года
                    'skazka16ru' => $skazka16ruData[0][15],           // Вязанные комбинезоны, комплекты
                    'skazka16ru' => $skazka16ruData[0][16],           // Комбинезоны, боди
                    'skazka16ru' => $skazka16ruData[0][17],           // Комплекты, Кофточки, распашонки, ползунки, чепчики
                    'skazka16ru' => $skazka16ruData[0][20],           // Комплекты на выписку
                    'skazka16ru' => $skazka16ruData[0][21],           // Лео-спорт
                    'skazka16ru' => $skazka16ruData[0][24],           // Швейный трикотаж
                    'skazka16ru' => $skazka16ruData[0][23],           // Халаты, полотенца, изделия из махры
                    'skazka16ru' => $skazka16ruData[0][19],           // Коллекции Лео
                    'skazka16ru' => $skazka16ruData[0][18],           // Зимняя
                    'skazka16ru' => $skazka16ruData[0][12],           // Шапочки и шарфы
                    'skazka16ru' => $skazka16ruData[0][5],            // Весна/Осень
                    'skazka16ru' => $skazka16ruData[0][4],            // Белье, пижамки
                    'skazka16ru' => $skazka16ruData[0][1],            // Летняя
                    'krokhotulkaru' => $krokhotulkaru[0],             // Подгузники
                    'krokhotulkaru' => $krokhotulkaru[1],             // Одежда
                    'krokhotulkaru' => $krokhotulkaru[2]             // Конверты
                ),
                1 => array(
                    'skazka16ru' => $skazka16ruData[0][3],            // Футболки
                    'skazka16ru' => $skazka16ruData[0][6],            // Водолазки, толстовки
                    'skazka16ru' => $skazka16ruData[0][13],           // Джинсы
                    'skazka16ru' => $skazka16ruData[0][22],           // Спортивные костюмы
                ),
                2 => array(
                    'skazka16ru' => $skazka16ruData[0][0],            // Наряды
                    'skazka16ru' => $skazka16ruData[0][7],            // Болеро
                    'skazka16ru' => $skazka16ruData[0][8],            // Жакеты
                    'skazka16ru' => $skazka16ruData[0][10],           // Леггинсы, Рейтузы, Гетры к платьям, пинетки
                    'skazka16ru' => $skazka16ruData[0][11]            // Платья и туники

                )
            ),
            1 => array(
                0 => array(
                    'annabellshopru' => $annabellshopruData[5][4],     // Мобиле / Подвески / Дуги
                    'annabellshopru' => $annabellshopruData[5][12],    // Развивающие коврики и центры
                    'skazka16ru' => $skazka16ruData[2][0],               // Детская мягкая сборная мебель
                    'krokhotulkaru' => $krokhotulkaru[5],                 // Детская комната
                ),
                1 => array(
                    'annabellshopru' => $annabellshopruData[5][0],     // ВЕЛОСИПЕДЫ
                    'annabellshopru' => $annabellshopruData[5][1],     // Игрушки - сортеры
                    'annabellshopru' => $annabellshopruData[5][2],     // Игрушки для ванной
                    'annabellshopru' => $annabellshopruData[5][3],     // Мир кукол RUBENS BARN
                    'annabellshopru' => $annabellshopruData[5][5],     // Мягкие игрушки
                    'annabellshopru' => $annabellshopruData[5][6],     // Мягкие игрушки ZOOBIES
                    'annabellshopru' => $annabellshopruData[5][8],     // Песочные наборы / Машинки
                    'annabellshopru' => $annabellshopruData[5][9],     // Погремушки и прорезыватели
                    'annabellshopru' => $annabellshopruData[5][13],     // ЭЛЕКТРОМОБИЛИ
                    'skazka16ru' => $skazka16ruData[2][1],               // Игры
                    'krokhotulkaru' => $krokhotulkaru[8]                 // Играй и развивайся
                ),
                2 => array(
                    'annabellshopru' => $annabellshopruData[5][10],    // Развивающие игрушки
                    'annabellshopru' => $annabellshopruData[5][11],    // Развивающие игрушки МЯКИШИ
                    'skazka16ru' => $skazka16ruData[2][2]              // Мягкие конструкторы
                ),
                3 => array(
                    'skazka16ru' => $skazka16ruData[2][3]              // Мягкий пол для детских, игровых комнат
                ),
                4 => array(
                    'annabellshopru' => $annabellshopruData[5][7],      // Пазлы, книжки, настольные игры, лото, панно
                    'skazka16ru' => $skazka16ruData[2][4]               // Напольные игровые зоны (коврики-пазлы)
                )
            ),
            2 => array(),
            3 => array(
                'annabellshopru' => $annabellshopruData[7][0],    // Для мытья посуды/игрушек/пола
                'annabellshopru' => $annabellshopruData[7][1],    // Кондиционер для белья
                'annabellshopru' => $annabellshopruData[7][2],    // Отбеливатели
                'annabellshopru' => $annabellshopruData[7][3],    // Стиральные порошки
                'krokhotulkaru' => $krokhotulkaru[7],             // Детская бытовая химия
                'krokhotulkaru' => $krokhotulkaru[11]             // Бытовая химия для всей семьи
            ),
            4 => array(
                'annabellshopru' => $annabellshopruData[0][0],   // Крем
                'annabellshopru' => $annabellshopruData[0][1],   // Молочко/Масло/Лосьон
                'annabellshopru' => $annabellshopruData[0][2],   // Мыло
                'annabellshopru' => $annabellshopruData[0][3],   // Купание детей
                'annabellshopru' => $annabellshopruData[0][4],   // Присыпка
                'annabellshopru' => $annabellshopruData[0][5][0], // Детская влажная туалетная бумага
                'annabellshopru' => $annabellshopruData[0][5][1], // Салфетки бумажные
                'annabellshopru' => $annabellshopruData[0][5][2], // Салфетки влажные
                'annabellshopru' => $annabellshopruData[0][6],    // Защита от солнца и комаров
                'annabellshopru' => $annabellshopruData[0][7],    // Гигиенические помады
                'annabellshopru' => $annabellshopruData[6][0],    // Детские ванночки
                'annabellshopru' => $annabellshopruData[6][1],    // Детские полотенца
                'annabellshopru' => $annabellshopruData[6][2],    // Принадлежности для купания
                'skazka16ru' => $skazka16ruData[7],                // Средства гигиены
                'krokhotulkaru' => $krokhotulkaru[6]               // Купание и гигиена
            ),
            5 => array(
                'annabellshopru' => $annabellshopruData[4][0],   // Аксессуары для мам
                'annabellshopru' => $annabellshopruData[4][1],   // Бандажи
                'annabellshopru' => $annabellshopruData[4][2],   // Белье
                'annabellshopru' => $annabellshopruData[4][3],   // Гигиена груди
                'annabellshopru' => $annabellshopruData[4][4],   // Гигиена тела
                'annabellshopru' => $annabellshopruData[4][5],   // Косметика для мам
                'annabellshopru' => $annabellshopruData[4][6],   // Медицина - товары для здоровья
                'annabellshopru' => $annabellshopruData[4][7],   // Молокоотсосы
                'annabellshopru' => $annabellshopruData[4][8][0],   // Вода для здоровья
                'annabellshopru' => $annabellshopruData[4][8][1],   // Чаи и коктейли
                'annabellshopru' => $annabellshopruData[4][9],   // Сбор и хранение грудного молока
                'annabellshopru' => $annabellshopruData[4][10],   // Сумки - переноски
                'skazka16ru' => $skazka16ruData[1][0],            // Мамины помошники
                'skazka16ru' => $skazka16ruData[1][1],             // Уборка дома
                'skazka16ru' => $skazka16ruData[6],                 // СЛИНГИ, подушки для кормления
                'skazka16ru' => $skazka16ruData[5],                  // Постельное белье
                'skazka16ru' => $skazka16ruData[3],                   // Пледы, одеяла, конверты, подушки
                'krokhotulkaru' => $krokhotulkaru[3],                 // Все для кормления
                'krokhotulkaru' => $krokhotulkaru[9],                 // Все для мам и беременных
                'krokhotulkaru' => $krokhotulkaru[10],                // Гигиена и косметика для мам и пап
                'krokhotulkaru' => $krokhotulkaru[4]                  // Уход и здоровье
            )
        );
        $this->converting($changeProductList, $sectionList);
    }
}
