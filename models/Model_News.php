<?php


class Model_News extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

//public function getNewsById($id) {
//    $result = $this->connection->query(
//        "SELECT *
//            FROM news
//            WHERE news_id = $id
//            ORDER BY news_date DESC LIMIT 10"
//    );
//    return $result->fetch(PDO::FETCH_ASSOC);
//}

    public function getNewsList()
    {
        $result = $this->connection->query("SELECT * FROM news ORDER BY news_date DESC");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastNews($count = 3)
    {
        $sth = $this->connection->prepare("SELECT * FROM news LIMIT :count");
        $sth->bindParam(':count', $count, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopNews()
    {
        $result = $this->connection->prepare("SELECT news.news_title, category.cat_name 
                                                        FROM news 
                                                        INNER JOIN category 
                                                        ON news.news_cat_id = category.cat_id 
                                                        WHERE news_day = 1");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryName()
    {
        $result = $this->connection->prepare("SELECT cat_name FROM category");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

//    public function updateNuberOfViews()
//    {
//        $result = $this->connection->prepare("UPDATE news SET number_of_views = number_of_views + 1");
//        $result->execute();
//        return $result->fetchAll(PDO::FETCH_ASSOC);
//
//    }
}