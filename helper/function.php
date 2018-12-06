<?php
//打印原样数组
function p($var){
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}
//打印变量调试信息
function dd($var){
	echo "<pre>";
	var_dump($var);
	echo "</pre>";
	die;
}
//打印log文件

