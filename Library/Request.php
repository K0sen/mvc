<?php


/**
 * Class Request
 */
class Request
{
    private $get;
    private $post;
    private $server;
    private $files;


    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->files = $_FILES;
    }

    private function getByKey($key, $method)
    {
        if ($method == 'get') {
            if (isset($this->get[$key])) {
                return $this->get[$key];
            }
        }
        if ($method == 'post') {
            if (isset($this->post[$key])) {
                return $this->post[$key];
            }
        }
        if ($method == 'server') {
            if (isset($this->server[$key])) {
                return $this->server[$key];
            }
        }
        if ($method == 'files') {
            if (isset($this->files[$key])) {
                return $this->files[$key];
            }
        }
        return null;
    }

    public function get($key)
    {
        return $this->getByKey($key, 'get');
    }

    public function post($key)
    {
        return $this->getByKey($key, 'post');
    }

    public function server($key)
    {
        return $this->getByKey($key, 'server');
    }

    public function files($key)
    {
        return $this->getByKey($key, 'files');
    }

    public function isPost()
    {
        return strtolower($this->server('REQUEST_METHOD')) == 'post';
    }

    public function getIpAddress()
    {
        return $this->server('REMOTE_ADDR');
    }

    public function getURI()
    {
        $uri = $this->server('REQUEST_URI');
        $uri = explode('?', $uri);
        return $uri[0];
    }
    public function mergeGet(array $params)
    {
        $this->get += $params;
        $_GET += $params;
    }

}






















