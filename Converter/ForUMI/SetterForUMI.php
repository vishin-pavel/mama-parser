<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 25.06.12
 * Time: 15:33
 * To change this template use File | Settings | File Templates.
 */
class SetterForUMI
{
    //Свойства
    protected $productsForSet;

    //SET Методы
    protected function Set($productsForSet)
    {
        $this->productsForSet=$productsForSet;
    }

    //Конструктор
    function __construct($productsArray)
    {
        $this->Set($productsArray);
    }

    //Методы
    public function SetProducts()
        {
            //Получаем иерархический тип страници
            $hierarchyTypes = umiHierarchyTypesCollection::getInstance();
            $hierarchyType = $hierarchyTypes->getTypeByName("catalog", "object");
            $hierarchyTypeId = $hierarchyType->getId();

            foreach($this->productsForSet as $product)
                {
                    $hierarchy = umiHierarchy::getInstance();
                    $parentId = $hierarchy->getIdByPath($product->GetParentCatalog());

                    //Создаем и подготавливаем выборку
                    $sel = new umiSelection;
                    $sel->addElementType($hierarchyTypeId); //Добавляет поиск по иерархическому типу
                    $sel->addHierarchyFilter($parentId); //Устанавливаем поиск по разделу
                    $sel->addPermissions(); //Говорим, что обязательно нужно учитывать права доступа

                    //Получаем результаты
                    $result = umiSelectionsParser::runSelection($sel); //Массив id объектов
                    $total = umiSelectionsParser::runSelectionCounts($sel); //Количество записей
                    $name = $product->GetProductName();
                    $image = $product->GetProductImage();
                    $descr = $product->GetProductDescr();
                    $price = $product->GetProductPrice();
                    $allRight=true;

                    foreach($result as $prodId){
                        $prod = $hierarchy->getElement($prodId);
                        if($name==$prod->getValue("h1")){
                           echo "Такой продукт уже существует, ";
                           if($descr!=$prod->getValue("description")){
                               echo "описание обнавлено, ";
                               $prod->setValue("description", $descr);

                           }
                           if($price!=$prod->getValue("price")){
                               echo "цена обнавлена. ";
                               $prod->setValue("price", $price);

                           }
                           $allRight=false;
                        }
                    }
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

                };
        }
}
