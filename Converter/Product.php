<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 25.06.12
 * Time: 14:28
 * To change this template use File | Settings | File Templates.
 */
class Product
{
    //Свойства
    protected $parentCatalog;         //Родительский раздел
    protected $productName;           //Название продукта
    protected $productImage;          //URL изображения продукта
    protected $productDescription;    //Описание продукта
    protected $productPrice;          //Цена продукта

    //SET Методы
    protected  function SetParentCatalog($id)
        {
            $this->parentCatalog=$id;
        }
    protected function SetProductName($name)
        {
            $this->productName=$name;
        }
    protected function SetProductImage($url)
        {
            $this->productImage=$url;
        }
    protected function SetProductDescription($descr)
        {
            $this->productDescription=$descr;
        }
    protected function SetProductPrice($price)
        {
            $this->productPrice=$price;
        }

    //GET Методы
    public function GetParentCatalog()
        {
            return $this->parentCatalog;
        }
    public function GetProductName()
    {
        return $this->productName;
    }
    public function GetProductImage()
    {
        return $this->productImage;
    }
    public function GetProductDescr()
    {
        return $this->productDescription;
    }
    public function GetProductPrice()
    {
        return $this->productPrice;
    }


    //Конструктор
    function __construct($id, $name, $url, $descr, $price)
    {
        $this->SetParentCatalog($id);
        $this->SetProductName($name);
        $this->SetProductImage($url);
        $this->SetProductDescription($descr);
        $this->SetProductPrice($price);
    }

}
