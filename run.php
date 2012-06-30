<?php
header("Content-type: text/html; charset=utf-8");
function autoload ($classname) {
	$possibilities = array(
		'/^\w+Parser$/' => dirname(__FILE__).'/SiteParser/'.strtolower(str_replace('Parser', '', $classname)).'.php',
		'/^\w+Converter$/' => dirname(__FILE__).'/DataConverter/'.strtolower(str_replace('Converter', '', $classname)).'.php',
		'/^\w+Interface$/' => dirname(__FILE__).'/System/Interfaces/'.strtolower(str_replace('Interface', '', $classname)).'.php',
		'/^\w+Abstract$/' => dirname(__FILE__).'/System/Abstract/'.strtolower(str_replace('Abstract', '', $classname)).'.php'
	);
	foreach ($possibilities as $regexp => $path){
		if (preg_match($regexp, $classname) == 1) {
			if (is_file($path)) {
				include($path);
				return;
			}
		}
	}
}
spl_autoload_register('autoload');

require_once dirname(__FILE__).'/Libs/simple_html_dom.php';
require_once dirname(__FILE__).'/Libs/RollingCurl.php';
//include "standalone.php";

$Update1 = new UmiConverter(array('annabellshopru'));
$Update1->setProducts();
?>