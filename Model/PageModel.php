<?php

class PageModel
{
    public function findByAlias($alias)
    {


        // TODO DB query for this page...

        return array(
            'alias' => $alias,
            'title' => 'Welcome',
            'content' => 'This is our site'
        );
    }
}































