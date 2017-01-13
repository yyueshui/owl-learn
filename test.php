<?php
/**
 * Created by PhpStorm.
 * User: Felix
 * Date: 2017/1/13
 * Time: 下午4:19
 */


class A
{
	private $a = 1;
}

$obj = new A();
$a = Closure::bind(function(){
	return $this->a;
}, $obj, 'A');
$b = $a();
var_dump($b);
//echo $obj->a;