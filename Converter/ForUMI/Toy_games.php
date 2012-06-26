<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:34
 * To change this template use File | Settings | File Templates.
 */
class Toy_games extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/igrushki/igry/", $name, $url, $descr, $price);
    }

}