<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:40
 * To change this template use File | Settings | File Templates.
 */
class Toy_puzzles extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/igrushki/kovriki_pazly/", $name, $url, $descr, $price);
    }

}
