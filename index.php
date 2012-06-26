<?php
    function __autoload($classname) {
		$possibilities = array(
			'/^\w+Parser$/' => DIR_ROOT.'SiteParser/'.strtolower(str_replace('Parser', '', $classname)).'.php',
			'/^\w+Converter$/' => DIR_ROOT.'DataConverter/'.strtolower(str_replace('Converter', '', $classname)).'.php',
			'/^\w+Interface$/' => DIR_ROOT.'System/Interfaces/'.strtolower(str_replace('Interface', '', $classname)).'.php',
			'/^\w+Abstract$/' => DIR_ROOT.'System/Abstract/'.strtolower(str_replace('Abstract', '', $classname)).'.php'
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
?>