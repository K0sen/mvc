<?php

class FeedbackModel
{
    public function save(array $message)
    {
        // TODO проверить, чтобы в массиве $message были ключи как поля в таблице, иначе - исключение
        $array = array(
            'username' => 1,
            'email' => 2,
            'message' => 3,
            'created' => 4,
            'ip' => 5
        );


        $db = DbConnection::getInstance()->getPdo();
        $sth = $db->prepare('INSERT INTO feedback VALUES (NULL, :username, :email, :message, :created, :ip)');

        $sth->execute($message);
    }
}





































