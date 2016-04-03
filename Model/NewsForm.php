<?php

class NewsForm
{
    public $title;
    public $text;
    /**
     * NewsForm constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->title = $request->post('title');
        $this->text = $request->post('text');
    }
    /**
     * @return bool
     */
    public function isValid()
    {
        $res = $this->title !== '' && $this->text !== '';
        return $res;
    }
}