<?php


class BookController extends Controller
{
    public function indexAction($request)
    {
        $books = array(
            'books' => array(
                'book1' => array(
                    'title' => 'Potter',
                    'author' => 'Royling',
                    'price' => 443
                ),
                'book2' => array(
                    'title' => 'Shining',
                    'author' => 'King',
                    'price' => 556
                ),
                'book3' => array(
                    'title' => 'Alchemist',
                    'author' => 'Koelio',
                    'price' => 696
                )
            )
        );

        return $this->render('index', $books);
    }
}

