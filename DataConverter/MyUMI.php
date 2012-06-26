<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 18:26
 * To change this template use File | Settings | File Templates.
 */
class MyUMI extends ConverterAbstract
{
   function __construct($parserName){
       $this->changeParser($parserName);
   }
    private function convert($changeProductList, $sectionList){
        //Получаем иерархический тип страници
        $hierarchyTypes = umiHierarchyTypesCollection::getInstance();
        $hierarchyType = $hierarchyTypes->getTypeByName("catalog", "object");
        $hierarchyTypeId = $hierarchyType->getId();

        for($i=0;$i<count($changeProductList);$i++){
            for($j=0;$j<count($changeProductList[$i]);$j++){
                 for($k=0;$k<count($changeProductList[$i][$j]);){
                     foreach($changeProductList[$i][$j][$k] as $product){
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
    public function setProducts(){
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
        $parsedData = $this->parser->getData();
        // Таблица соответсвий разделов.
        $changeProductList = array(
            0 => array( // Одежда
                0 => array( // Одежда для самых маленьких.
                    $parsedData[1][0],     // Пеленки / клеёнки
                    $parsedData[1][1][0], // Трусики MERRIES
                    $parsedData[1][1][1], // Трусики GOON
                    $parsedData[1][1][2], // Трусики Huggies Хаггис
                    $parsedData[1][1][3], // Трусики Libero Либеро
                    $parsedData[1][1][4], // Трусики Pampers Памперс
                    $parsedData[1][1][5], // Трусики непромокаемые
                    $parsedData[1][2][0], // Подгузники Huggies Хаггис
                    $parsedData[1][2][1], // Подгузники Royal Pups Роял Пупс
                    $parsedData[1][2][2], // Подгузники Libero Либеро
                    $parsedData[1][2][3], // Подгузники Pampers Памперс
                    $parsedData[1][2][4], // Подгузники Prokids
                    $parsedData[1][2][5], // Фито - подгузники Sun-Herbal Сан Хербал
                    $parsedData[1][2][6], // Японские подгузники GOON Гун
                    $parsedData[1][2][7], // Японские подгузники MERRIES Мериес
                    $parsedData[1][2][8], // Японские подгузники MOONY Муни
                    $parsedData[8][0],    // Трикотаж Lucky child (Лаки Чайлд)
                    $parsedData[8][1],    // Трикотаж Лео
                    $parsedData[8][2]    // Трикотаж Наша Мама
                ),
                1 => array(),
                2 => array()
            ),
            1 => array(
                0 => array(
                    $parsedData[5][4],     // Мобиле / Подвески / Дуги
                    $parsedData[5][12]    // Развивающие коврики и центры
                ),
                1 => array(
                    $parsedData[5][0],     // ВЕЛОСИПЕДЫ
                    $parsedData[5][1],     // Игрушки - сортеры
                    $parsedData[5][2],     // Игрушки для ванной
                    $parsedData[5][3],     // Мир кукол RUBENS BARN
                    $parsedData[5][5],     // Мягкие игрушки
                    $parsedData[5][6],     // Мягкие игрушки ZOOBIES
                    $parsedData[5][8],     // Песочные наборы / Машинки
                    $parsedData[5][9],     // Погремушки и прорезыватели
                    $parsedData[5][13]     // ЭЛЕКТРОМОБИЛИ

                ),
                2 => array(
                    $parsedData[5][10],    // Развивающие игрушки
                    $parsedData[5][11]    // Развивающие игрушки МЯКИШИ
                ),
                3 => array(),
                4 => array(
                    $parsedData[5][7]      // Пазлы, книжки, настольные игры, лото, панно
                )
            ),
            2 => array(),
            3 => array(
                $parsedData[7][0],    // Для мытья посуды/игрушек/пола
                $parsedData[7][1],    // Кондиционер для белья
                $parsedData[7][2],    // Отбеливатели
                $parsedData[7][3]    // Стиральные порошки
            ),
            4 => array(
                $parsedData[0][0],   // Крем
                $parsedData[0][1],   // Молочко/Масло/Лосьон
                $parsedData[0][2],   // Мыло
                $parsedData[0][3],   // Купание детей
                $parsedData[0][4],   // Присыпка
                $parsedData[0][5][0], // Детская влажная туалетная бумага
                $parsedData[0][5][1], // Салфетки бумажные
                $parsedData[0][5][2], // Салфетки влажные
                $parsedData[0][6],    // Защита от солнца и комаров
                $parsedData[0][7],    // Гигиенические помады
                $parsedData[6][0],    // Детские ванночки
                $parsedData[6][1],    // Детские полотенца
                $parsedData[6][2]    // Принадлежности для купания
            ),
            5 => array(
                $parsedData[4][0],   // Аксессуары для мам
                $parsedData[4][1],   // Бандажи
                $parsedData[4][2],   // Белье
                $parsedData[4][3],   // Гигиена груди
                $parsedData[4][4],   // Гигиена тела
                $parsedData[4][5],   // Косметика для мам
                $parsedData[4][6],   // Медицина - товары для здоровья
                $parsedData[4][7],   // Молокоотсосы
                $parsedData[4][8][0],   // Вода для здоровья
                $parsedData[4][8][1],   // Чаи и коктейли
                $parsedData[4][9],   // Сбор и хранение грудного молока
                $parsedData[4][10]   // Сумки - переноски

            )
        );
        $this->convert($changeProductList, $sectionList);
    }
}
