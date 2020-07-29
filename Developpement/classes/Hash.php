<?php
class Hash{
    public static function make($string , $salt = '')
    {
        return hash('sha256', $string . $salt);

    }
    public static function salt($length)
    {
        return random_bytes($length); //insted of mcrypt_create_iv( ) because it was removed from the newest php versions

    }
    public static function unique()
    {
        return self::make(uniqid());

    }
}

?>