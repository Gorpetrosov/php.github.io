<?php
include_once ROOT."/models/People.php";

class PeopleController
{
public function actionIndex()
{
    $new_people = People::getPeopleList();

    require_once ROOT.'/views/people/index.php';
    return true;
}
public function actionView($id)
{
    if($id) {
        $peopleName = People::getPeopleItemById($id);
        require_once ROOT.'views/people/view.php';
    }
    return true;
}
}