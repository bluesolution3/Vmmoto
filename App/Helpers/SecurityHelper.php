<?php

class SecurityHelper {

    private static $key = "VEMOTTO_SECRET_KEY_2026";

    public static function encrypt($data) {
        return openssl_encrypt($data, "AES-128-ECB", self::$key);
    }

    public static function decrypt($data) {
        return openssl_decrypt($data, "AES-128-ECB", self::$key);
    }
}
