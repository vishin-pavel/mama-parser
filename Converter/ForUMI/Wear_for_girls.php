<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:29
 * To change this template use File | Settings | File Templates.
 */
class Wear_for_girls extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/odezhda/dlya_devochek/", $name, $url, $descr, $price);
    }

}
