<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 26.06.12
 * Time: 10:42
 * To change this template use File | Settings | File Templates.
 */
class Book_audio_video extends Product
{
    //Конструктор
    function __construct($name, $url, $descr, $price)
    {
        parent::__construct("/shop/knigi/audio_i_video_knigi/", $name, $url, $descr, $price);
    }

}
