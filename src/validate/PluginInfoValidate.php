<?php

namespace app\validate;

class PluginInfoValidate {

    const ALPHANUMERIC_REGEX = "/^[a-zA-Z0-9]+$/";
    const VERSION_REGEX = "/^[0-9]+\.[0-9]+\.[0-9]+$/"; 

    public static function validateAlphaNumeric(string $name): bool {
        return preg_match(self::ALPHANUMERIC_REGEX, $name);
    }

    public static function validateVersion(string $version): bool {
        return preg_match(self::VERSION_REGEX, $version);
    }

}