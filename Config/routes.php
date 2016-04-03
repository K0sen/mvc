<?php
return  array(
    // some default routes
    'default' => new Route('/', 'Index', 'index'),
    'index_php' => new Route('/index.php', 'Index', 'index'),
    // others
    'books_list' => new Route('/books', 'Book', 'index'),
    'book_page' => new Route('/book-{id}\.html', 'Book', 'show', array('id' => '[0-9]+') ),
    'contact_us' => new Route('/contact-us', 'Index', 'contact'),
    'cart_add' => new Route('/add/{id}', 'Cart', 'add', array('id' => '[0-9]+') ),
    'cart_delete' => new Route('/delete/{id}', 'Cart', 'delete', array('id' => '[0-9]+') ),
    'cart_remove' => new Route('/remove', 'Cart', 'remove'),
    'cart_list' => new Route('/cart', 'Cart', 'index'),
    'login' => new Route('/login', 'Security', 'login'),
    'logout' => new Route('/logout', 'Security', 'logout'),
    'admin_test' => new Route('/admin', 'Security', 'admin'),
    'news' => new Route('/news', 'News', 'index'),
    'news_details' => new Route('/news-{id}\.html', 'News', 'news', array('id' => '[0-9]+') ),
    'news_delete' => new Route('/news_delete/{id}', 'News', 'delete', array('id' => '[0-9]+') ),
    'news_add' => new Route('/admin/news_add', 'News', 'add'),
    'author' => new Route('/author', 'Author', 'author'),
    'author_list' => new Route('/author-{id}\.html', 'Author', 'aboutAuthor', array('id' => '[0-9]+') ),
    'register' => new Route('/register', 'Security', 'register'),
    'api_books_list' => new Route('/api/books', 'Book', 'apiBooksList'),
    // admin
    'admin_books_list' => new Route('/admin/books/?', 'AdminBook', 'index'),
    'admin_document_add' => new Route('/admin/docs/add', 'AdminDocument', 'add'),
    'admin_book_add' => new Route('/admin/book/add', 'AdminBook', 'add'),
    'admin_book_edit' => new Route('/admin/book/edit/{id}', 'AdminBook', 'edit', array('id' => '[0-9]+')),
    'admin_book_delete' => new Route('/admin/book/delete/{id}', 'AdminBook', 'delete', array('id' => '[0-9]+')),
    'admin_add_picture' => new Route('/admin/book/picture/{id}', 'AdminDocument', 'addBookPict', array('id' => '[0-9]+')),

    // 'devionity_style' => new Route('/{_controller}/{_action}/{id}')
);
