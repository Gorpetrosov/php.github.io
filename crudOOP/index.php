<?php

require_once "crud.php";

$connect = new crud('Localhost', 'php_courses', 'root', '');



//$rows = ['name', 'description', 'sort_order', 'status'];
//$info = ['Gor-category', 'Cor category description', '10', '0'];
//$connect->create('news_category', $rows, $info);




//$rows2 = ['name', 'description', 'sort_order', 'status'];
//$info2 = ['Gor-category5', 'Cor category description5', '55', '5'];
//$connect->create('news_category', $rows2, $info2);



//$str = "SELECT * FROM news_category";
//$str = "SELECT name, description FROM news_category";

//
//$args_array = ['*'];
//
//$result = $connect->read('news_category', $args_array);
//print_r($result);

$connect->update('news_category',['name'=>'Gor'],['id'=>20]);