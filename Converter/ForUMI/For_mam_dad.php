<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:47
 * To change this template use File | Settings | File Templates.
 */
class For_mam_dad extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/tovary_dlya_mam_i_pap/", $name, $url, $descr, $price);
    }

}
