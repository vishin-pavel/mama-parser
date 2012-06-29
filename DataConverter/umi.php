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


    private function convert($changeProductList, $sectionList)
	{
        //Получаем иерархический тип страници
        $hierarchyTypes = umiHierarchyTypesCollection::getInstance();
        $hierarchyType = $hierarchyTypes->getTypeByName("catalog", "object");
        $hierarchyTypeId = $hierarchyType->getId();

        for($i=0;$i<count($changeProductList);$i++){
            for($j=0;$j<count($changeProductList[$i]);$j++){
                 for($k=0;$k<count($changeProductList[$i][$j]);$k++){
                     foreach($changeProductList[$i][$j][$k] as $product){

                         if(count($product)>0){

                             $hierarchy = umiHierarchy::getInstance();
                             $parentId = $hierarchy->getIdByPath($sectionList[$i][$j]);
                             $name = $product['productName'];
                             $image = $product['productImage'];
                             $descr = $product['productDescription'];
                             $price = $product['productPrice'];

                             // Добавляем новый элемент
                             $newElementId = $hierarchy->addElement($parentId, $hierarchyTypeId, $name, $name);
                             if($newElementId === false)
                             {
                                 //echo "Не удалось создать новую страницу";
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
                                 //echo "Успешно создана страница с адресом: \"", $hierarchy->getPathById($newElementId), "\"";
                             } else
                             {
                                 //echo "Не удалось получить экземпляр страницы #{$newElementId}.";
                             }
                         }

                     }
                 }
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

        $annabellshopruData = $this->parser['annabellshopru']->getData();

		// Таблица соответсвий разделов.
        $changeProductList = array(
            0 => array( // Одежда
                0 => array( // Одежда для самых маленьких.
                    $annabellshopruData[1][0],     // Пеленки / клеёнки
                    $annabellshopruData[1][1][0], // Трусики MERRIES
                    $annabellshopruData[1][1][1], // Трусики GOON
                    $annabellshopruData[1][1][2], // Трусики Huggies Хаггис
                    $annabellshopruData[1][1][3], // Трусики Libero Либеро
                    $annabellshopruData[1][1][4], // Трусики Pampers Памперс
                    $annabellshopruData[1][1][5], // Трусики непромокаемые
                    $annabellshopruData[1][2][0], // Подгузники Huggies Хаггис
                    $annabellshopruData[1][2][1], // Подгузники Royal Pups Роял Пупс
                    $annabellshopruData[1][2][2], // Подгузники Libero Либеро
                    $annabellshopruData[1][2][3], // Подгузники Pampers Памперс
                    $annabellshopruData[1][2][4], // Подгузники Prokids
                    $annabellshopruData[1][2][5], // Фито - подгузники Sun-Herbal Сан Хербал
                    $annabellshopruData[1][2][6], // Японские подгузники GOON Гун
                    $annabellshopruData[1][2][7], // Японские подгузники MERRIES Мериес
                    $annabellshopruData[1][2][8] // Японские подгузники MOONY Муни
                    //$annabellshopruData[8][0],    // Трикотаж Lucky child (Лаки Чайлд)
                    //$annabellshopruData[8][1],    // Трикотаж Лео
                    //$annabellshopruData[8][2]    // Трикотаж Наша Мама
                ),
                1 => array(),
                2 => array()
            ));/*,
            1 => array(
                0 => array(
                    $annabellshopruData[5][4],     // Мобиле / Подвески / Дуги
                    $annabellshopruData[5][12]    // Развивающие коврики и центры
                ),
                1 => array(
                    $annabellshopruData[5][0],     // ВЕЛОСИПЕДЫ
                    $annabellshopruData[5][1],     // Игрушки - сортеры
                    $annabellshopruData[5][2],     // Игрушки для ванной
                    $annabellshopruData[5][3],     // Мир кукол RUBENS BARN
                    $annabellshopruData[5][5],     // Мягкие игрушки
                    $annabellshopruData[5][6],     // Мягкие игрушки ZOOBIES
                    $annabellshopruData[5][8],     // Песочные наборы / Машинки
                    $annabellshopruData[5][9],     // Погремушки и прорезыватели
                    $annabellshopruData[5][13]     // ЭЛЕКТРОМОБИЛИ

                ),
                2 => array(
                    $annabellshopruData[5][10],    // Развивающие игрушки
                    $annabellshopruData[5][11]    // Развивающие игрушки МЯКИШИ
                ),
                3 => array(),
                4 => array(
                    $annabellshopruData[5][7]      // Пазлы, книжки, настольные игры, лото, панно
                )
            ),
            2 => array(),
            3 => array(
                $annabellshopruData[7][0],    // Для мытья посуды/игрушек/пола
                $annabellshopruData[7][1],    // Кондиционер для белья
                $annabellshopruData[7][2],    // Отбеливатели
                $annabellshopruData[7][3]    // Стиральные порошки
            ),
            4 => array(
                $annabellshopruData[0][0],   // Крем
                $annabellshopruData[0][1],   // Молочко/Масло/Лосьон
                $annabellshopruData[0][2],   // Мыло
                $annabellshopruData[0][3],   // Купание детей
                $annabellshopruData[0][4],   // Присыпка
                $annabellshopruData[0][5][0], // Детская влажная туалетная бумага
                $annabellshopruData[0][5][1], // Салфетки бумажные
                $annabellshopruData[0][5][2], // Салфетки влажные
                $annabellshopruData[0][6],    // Защита от солнца и комаров
                $annabellshopruData[0][7],    // Гигиенические помады
                $annabellshopruData[6][0],    // Детские ванночки
                $annabellshopruData[6][1],    // Детские полотенца
                $annabellshopruData[6][2]    // Принадлежности для купания
            ),
            5 => array(
                $annabellshopruData[4][0],   // Аксессуары для мам
                $annabellshopruData[4][1],   // Бандажи
                $annabellshopruData[4][2],   // Белье
                $annabellshopruData[4][3],   // Гигиена груди
                $annabellshopruData[4][4],   // Гигиена тела
                $annabellshopruData[4][5],   // Косметика для мам
                $annabellshopruData[4][6],   // Медицина - товары для здоровья
                $annabellshopruData[4][7],   // Молокоотсосы
                $annabellshopruData[4][8][0],   // Вода для здоровья
                $annabellshopruData[4][8][1],   // Чаи и коктейли
                $annabellshopruData[4][9],   // Сбор и хранение грудного молока
                $annabellshopruData[4][10]   // Сумки - переноски

            )
        );*/
        $this->convert($changeProductList, $sectionList);
    }
}
