<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:46
 * To change this template use File | Settings | File Templates.
 */
class Bathing_hygiene extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/kupanie_i_gigiena/", $name, $url, $descr, $price);
    }

}

