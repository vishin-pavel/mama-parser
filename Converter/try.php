<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Roma
 * Date: 25.06.12
 * Time: 16:17
 * To change this template use File | Settings | File Templates.
 */
header("Content-type: text/html; charset=utf-8");
include "Product.php";
include "SetterForUMI.php";
include "standalone.php";


$productsForSet = array
                    (
                        new Product("/shop/igrushki/sbornaya_mebel/", "Мой продукт.1.2", "./images/cms/data/photo1.png", "Охрененный мой продукт", 2200),
                        new Product("/shop/igrushki/igry/", "Мой продукт", "./images/cms/data/photo1.png", "Охрененный товар мой", 3200),
                        new Product("/shop/igrushki/konstruktory/", "Мой продукт", "./images/cms/data/photo1.png", " мой Охрененный продукт", 1100),
                        new Product("/shop/odezhda/dlya_devochek/", "Мой продукт", "./images/cms/data/photo1.png", "Охрененный продукт", 200)
                    );
/*echo $productsForSet[2]->GetParentId();
echo $productsForSet[2]->GetProductName();
echo $productsForSet[2]->GetProductImage();
echo $productsForSet[2]->GetProductDescr();
echo $productsForSet[2]->GetProductPrice();*/


$Setter = new SetterForUMI($productsForSet);
$Setter->SetProducts();