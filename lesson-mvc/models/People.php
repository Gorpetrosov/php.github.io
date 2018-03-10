<?php
/**
 * Created by PhpStorm.
 * User: USER 3
 * Date: 09.03.2018
 * Time: 12:28
 */

class People
{
 public  static function getPeopleItemById($id)
 {
     $id = intval($id);
     if ($id) {
         $connect = Db::getConnection();
         $result = $connect->query('SELECT * FROM peoples WHERE id= ' . $id);
         $result->setFetchMode(PDO::FETCH_ASSOC);
         $PeopleItem = $result->fetch();
         return $PeopleItem;
     }
 }

     public static function getPeopleList()
     {
         $connect = Db::getConnection();
         $peopleList= [];
         $result = $connect->query('SELECT * FROM Peoples ORDER BY id DESC ');
         $i  = 0 ;
         while ($row = $result->fetch()){
             $peopleList[$i]['id']= $row['id'];
             $peopleList[$i]['name']= $row['name'];
             $peopleList[$i]['position']= $row['position'];
             $peopleList[$i]['images']= $row['images'];
             $peopleList[$i]['text']= $row['text'];
             $peopleList[$i]['created_at']= $row['created_at'];
             $i++;

         }
         return$peopleList;
 }
}