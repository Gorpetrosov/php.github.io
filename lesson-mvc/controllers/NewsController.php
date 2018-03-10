<?php
include_once ROOT . "/models/News.php";


class NewsController
{
    public function actionIndex()
    {
        $news_list = News::getNewsList();
//        echo '<pre>';
//        print_r($news_list);
//        echo '</pre>';
        require_once ROOT . '/views/news/index.php';

        return true;
    }

    public function actionView($id)
    {
        if ($id) {
            $newsItem = News::getNewsItemById($id);
//            echo '<pre>';
//            print_r($newsItem);
//            echo '<pre>';
            require_once ROOT . '/views/news/view.php';
        }
        return true;
    }
}