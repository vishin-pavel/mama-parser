<?php
    function __autoload($classname) {
		$possibilities = array(
			'/^\w+Parser$/' => 'SiteParser/'.strtolower(str_replace('Parser', '', $classname)).'.php',
			'/^\w+Converter$/' => 'DataConverter/'.strtolower(str_replace('Converter', '', $classname)).'.php',
			'/^\w+Interface$/' => 'System/Interfaces/'.strtolower(str_replace('Interface', '', $classname)).'.php',
			'/^\w+Abstract$/' => 'System/Abstract/'.strtolower(str_replace('Abstract', '', $classname)).'.php'
		);
		foreach ($possibilities as $regexp => $path) {
			if (preg_match($regexp, $classname) == 1) {
				if (is_file($path)) {
					include($path);
					return;
				}
			}
		}
	}

	require_once 'Libs/simple_html_dom.php';
    $Update1 = new MyUMI('annabellshopru');
    $Update1->setProducts();
    $Update2 = new MyUMI('mdmarketru');
    $Update2->setProducts();
?>