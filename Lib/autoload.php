<?php
spl_autoload_register("musinsaAutoload");

function musinsaAutoload($class)
{
	$class_file = str_replace("\\", DS, $class);
	$file = HOME . DS . $class_file . ".class.php";
	include $file;
}