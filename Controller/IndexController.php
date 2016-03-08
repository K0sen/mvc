<?php

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        $args = array(
            'var1' => 256,
            'var2' => 'Hello'
        );

        return $this->render('index', $args);

        //return '<b>This is index action of index controller</b>';
    }

    public function contactAction(Request $request)
    {
        return $this->render('contact');
    }
}