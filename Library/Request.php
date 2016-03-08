<?php


class Request
{
    private $get;
    private $post;


    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function get($key)
    {
        if (isset($this->get[$key])){
            return $this->get[$key];
        }
        return null;
    }

    public function post($key)
    {
        if (isset($this->post[$key])){
            return $this->post[$key];
        }
        return null;
    }

    public function isPost()
    {
        return (bool)$_POST;
    }
}