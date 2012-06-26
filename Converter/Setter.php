<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:54
 * To change this template use File | Settings | File Templates.
 */
class Setter
{
    //Свойства
    protected $productsForSet;

    //SET Методы
    protected function SetProducts($productsForSet)
    {
        $this->productsForSet=$productsForSet;
    }

    //Конструктор
    function __construct($productsArray)
    {
        $this->SetProducts($productsArray);
    }
}
