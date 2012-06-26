<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:38
 * To change this template use File | Settings | File Templates.
 */
class Toy_soft_floor extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/igrushki/myagkij_pol_dlya_detskih_komnat/", $name, $url, $descr, $price);
    }

}
