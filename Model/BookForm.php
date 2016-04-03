<?php

/**
 * Created by PhpStorm.
 * User: henry
 * Date: 28.03.16
 * Time: 21:13
 */
class BookForm
{
    public $title;
    public $description;
    public $price;
    public $status;
    public $style;
    public $style_id;


    public function __construct(Request $request)
    {
        $this->title = $request->post('title');
        $this->description = $request->post('description');
        $this->price = $request->post('price');
        $this->style = $request->post('style');
        $this->style_id = $request->post('style_id');
        $this->status = $this->checkboxToInt($request->post('status'));
    }

    public function isValid()
    {
        return $this->description !== '' && $this->price !== '' && $this->title !== '' && is_numeric($this->price);
    }

    private function checkboxToInt($checkboxValue)
    {
        if ($checkboxValue == 'on') {
            return 1;
        }

        return 0;
    }

    public function setFromArray(array $book)
    {
        $this->title = $book['title'];
        $this->description = $book['description'];
        $this->price = $book['price'];
        $this->status = $book['status'];
        $this->style = $book['style'];
        $this->style_id = $book['style_id'];
    }

    public function setNullArray()
    {
        $this->title = null;
        $this->description = null;
        $this->price = null;
        $this->status = null;
    }
}