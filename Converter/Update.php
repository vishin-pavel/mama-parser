<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 30.06.12
 * Time: 10:47
 * To change this template use File | Settings | File Templates.
 */
header("Content-type: text/html; charset=utf-8");
include "standalone.php";

/*
 Документация: работа с выборками. Поиск страниц.
*/

//Получаем id иерархического типа
$hierarchyTypes = umiHierarchyTypesCollection::getInstance();
$hierarchyType = $hierarchyTypes->getTypeByName("catalog", "object");
$hierarchyTypeId = $hierarchyType->getId();

//Получаем id раздела, в котором будем искать
$hierarchy = umiHierarchy::getInstance();
$parentElementId = $hierarchy->getIdByPath('/shop/odezhda/dlya_samyh_malenkih/');

//Создаем и подготавливаем выборку
$sel = new umiSelection;
$sel->addElementType($hierarchyTypeId); //Добавляет поиск по иерархическому типу
$sel->addHierarchyFilter($parentElementId); //Устанавливаем поиск по разделу
$sel->addPermissions(); //Говорим, что обязательно нужно учитывать права доступа

//Получаем результаты
$result = umiSelectionsParser::runSelection($sel); //Массив id объектов
$total = umiSelectionsParser::runSelectionCounts($sel); //Количество записей

//Выводим список
foreach($result as $userId) {
    $element = $hierarchy->getElement($userId);
    echo "Найден товар \"", $element->getValue("h1"), "\"<br />\n";
}
echo "<hr />Всего найдено ", $total, " товаров";
