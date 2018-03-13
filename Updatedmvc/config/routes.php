<?php

/*
 * Возвращаем ассоциативный массив где в качастве ключей выступает строка запроса
 * а значения - то где обрабатывается запрос
 */
return [
//    'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',
//    'news/77' => 'news/view',
//    'news/15' => 'news/view',
    'news/([0-9]+)' => 'news/view/$1',
    'news' => 'news/index',
//    'people/([0-9]+)' => 'people/view/$1',
    'people' => 'people/index',


//    'news' => 'news/index', // actionIndex в NewsController
//    'products' => 'product/list', // actionList в ProductController
];