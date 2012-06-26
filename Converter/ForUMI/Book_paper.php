<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:43
 * To change this template use File | Settings | File Templates.
 */
class Book_paper extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/knigi/na_bumazhnom_nositele/", $name, $url, $descr, $price);
    }

}

