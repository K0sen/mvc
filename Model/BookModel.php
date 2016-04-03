<?php

class BookModel
{
    public function findById($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("SELECT b.id AS id, b.title AS title, b.description AS description, b.price AS price,
                                b.status AS status, b.style_id AS style_id,
                                s.name AS style,
                                GROUP_CONCAT(ifnull(a.name, 'unknown')  SEPARATOR ', ' ) AS author
                                FROM author a
                                JOIN book_author ba ON ba.author_id = a.id
                                RIGHT JOIN book b ON ba.book_id = b.id
                                JOIN style s ON b.style_id = s.id
                                WHERE b.id = :book_id
                                ");
        $params = array (
            'book_id' => $id
        );
        $sth->execute($params);

        $book = $sth->fetch(PDO::FETCH_ASSOC);

        if (!$book) {
            throw new NotFoundException("book #{$id} not found");
        }
        return $book;

    }

    public function findAll()
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->query('SELECT b.id AS id, b.title AS title, b.description AS description,
                            b.price AS price, b.status AS status, b.style_id AS style_id,
                            s.name AS style,
                            GROUP_CONCAT(ifnull(a.name, \'unknown\')  SEPARATOR \', \' ) AS author
                            FROM author a
                            JOIN book_author ba ON ba.author_id = a.id
                            RIGHT JOIN book b ON ba.book_id = b.id
                            JOIN style s ON b.style_id = s.id
                            GROUP BY b.id
                            ORDER BY b.status DESC
                            ');
        $sth->execute();

        $data = $sth->fetchAll(PDO::FETCH_ASSOC);

        if (!$data){
            throw new NotFoundException('Books not found');
        }

        return $data;
    }


    public function findByIdArray(array $ids)
    {
        if (!$ids) {
            return array();
        }
        $params = array();
        foreach ($ids as $v) {
            $params[] = '?';
        }
        $ids = array_values($ids);
        $params = implode(',', $params);
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare("SELECT * FROM book WHERE id IN ({$params}) ORDER BY price");
        $sth->execute($ids);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(array $book)
    {
        // TODO: проверить, чтобы в массиве $message были ключи как поля в таблице. Иначе - исключение
        // TODO: использовать этот же метод для добавления книг. Проверка на is_null(id) => формируем соответсвующую строку с запросом
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('UPDATE book SET title = :title, description = :description, price = :price, status = :status, style_id = :style where id = :id');
        $sth->execute($book);
    }

    public function add(array $book)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('INSERT INTO book VALUES (NULL, :title, :description, :price, :style, :status)');
        $sth->execute($book);
    }

    public function delete($id)
    {
        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('DELETE FROM `book` WHERE `id` = :id');
        $params = array(
          'id' => $id
        );
        $sth->execute($params);
    }
}
