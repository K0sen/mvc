<?php

class AuthorModel
{
    public function allAuthors()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->query('SELECT a.id AS id, a.name AS author, GROUP_CONCAT(ifnull(b.title, \'none\') SEPARATOR \', \') AS book
                            FROM book b
                            JOIN book_author ba ON ba.book_id = b.id
                            RIGHT JOIN author a ON ba.author_id = a.id
                            GROUP BY a.name
                            ORDER BY a.name
                            ');
        $sth->execute();

        $a = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (!$a) {
            throw new NotFoundException('Authors not found');
        }

        return $a;
    }

    public function oneAuthor($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('SELECT a.id AS id, a.name AS author, GROUP_CONCAT(ifnull(b.title, \'none\') SEPARATOR \', \') AS book
                            FROM book b
                            JOIN book_author ba ON ba.book_id = b.id
                            RIGHT JOIN author a ON ba.author_id = a.id
                            WHERE a.id = :author_id
                            ');
        $params = (array(
           'author_id' => $id
        ));
        $sth->execute($params);

        $a = $sth->fetch(PDO::FETCH_ASSOC);

        if (!$a) {
            throw new NotFoundException('Author not found');
        }

        return $a;
    }

}