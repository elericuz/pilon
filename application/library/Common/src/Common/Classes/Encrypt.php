<?php
namespace Common\Classes;

class Encrypt
{
    static public function encrypt($password, $user)
    {
        $key = self::getKey($user);

        $hash = md5(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $password, MCRYPT_MODE_ECB, mcrypt_create_iv(32))));

        return $hash;
    }

    static private function getKey($string)
    {
        $key = 0;

        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {
            $string = substr($string, 0, strpos($string, "@"));
        }
        $string = md5($string);
        $key = substr($string, 10, 20);

        return $key;
    }
}

?>