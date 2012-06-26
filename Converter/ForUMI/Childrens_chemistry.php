<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:45
 * To change this template use File | Settings | File Templates.
 */
class Childrens_chemistry extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/detskaya_bytovaya_himiya/", $name, $url, $descr, $price);
    }

}
