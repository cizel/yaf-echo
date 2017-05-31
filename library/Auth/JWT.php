<?php
namespace Auth;

use Config;
class JWT
{
    public static function auth()
    {
        $secretKey = base64_decode(Config::get('secret_key'));
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            throw new InvalidValueException('Not Found Header Aug'); 
        }
        list($jwt) = sscanf($_SERVER['HTTP_AUTHORIZATION'], 'Bearer %s');
        $token = \Firebase\JWT\JWT::decode($jwt, $secretKey, ['HS512']);
    }
}
