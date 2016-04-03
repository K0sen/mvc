<?php

abstract class Session
{
    /**
     * @param $key
     * @param $value
     */
    private static function set($key, $value) // todo ??
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param $key
     */
    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    /**
     * destroy
     */
    public static function destroy()
    {
        session_destroy();
    }

    public static function start()
    {
        session_start();
    }

    public static function setFlash($message)
    {
        self::set('flash', $message);
    }

    public static function setUser($type, $email)
    {
        self::set($type, $email);
    }

    public static function getFlash()
    {
        $message = self::get('flash');
        self::remove('flash');

        return $message;
    }
}






































