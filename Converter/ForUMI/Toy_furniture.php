<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:33
 * To change this template use File | Settings | File Templates.
 */
class Toy_furniture extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/igrushki/sbornaya_mebel/", $name, $url, $descr, $price);
    }

}

