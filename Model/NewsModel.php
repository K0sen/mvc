<?php

class NewsModel
{

    public function allNews()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->query('SELECT * FROM news');
        $sth->execute();
        $news = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $news;
    }

    public function oneNews($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT * FROM news WHERE `id` = :id');
        $params = array(
            'id' => $id
        );

        $sth->execute($params);
        $news = $sth->fetch(PDO::FETCH_ASSOC);


        return $news;
    }

    public function addNews($message)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('INSERT INTO news VALUES (NULL, :title, :text)');

        $sth->execute($message);
    }

    public function deleteNews($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('DELETE FROM `news` WHERE `news`.`id` = :id');
        $params = array(
            'id' => $id
        );
        $sth->execute($params);
    }
}