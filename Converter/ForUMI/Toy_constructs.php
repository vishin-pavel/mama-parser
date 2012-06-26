<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:36
 * To change this template use File | Settings | File Templates.
 */
class Toy_constructs extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/igrushki/konstruktory/", $name, $url, $descr, $price);
    }

}