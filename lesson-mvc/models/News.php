<?php

class News
{
    /**
     * Возвращает новость по уникальному ID
     * @param $id
     * @return array
     */
    public static function getNewsItemById($id)
    {
        $id = intval($id);
        if ($id) {
            $connect = Db::getConnection();
//            print_r($connect->errorInfo());

            $result = $connect->query('SELECT * FROM news WHERE id=' . $id);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $newsItem = $result->fetch();

            return $newsItem;
        }
    }

    /**
     * Возвращает массив новостей
     */
    public static function getNewsList()
    {
        $connect = Db::getConnection();
        $newsList = [];
        $result = $connect->query('SELECT * FROM news ORDER BY date DESC LIMIT 5');

        $i = 0;
        while ($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['h1'] = $row['h1'];
            $newsList[$i]['date'] = $row['date'];
            $newsList[$i]['short_content'] = $row['short_content'];
            $newsList[$i]['preview'] = $row['preview'];
            $i++;
        }
        return $newsList;
    }
}