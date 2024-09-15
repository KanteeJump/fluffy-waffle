<?php

namespace app\utils;

class PluginInfoValidate {

    const ALPHANUMERIC_REGEX = "/^[a-zA-Z0-9]+$/";
    const VERSION_REGEX = "/^[0-9]+\.[0-9]+\.[0-9]+$/";
    const PLUGIN_NAME_REGEX = "/^[a-zA-Z]+$/";

    public static function validateAlphaNumeric(string $name): bool {
        return preg_match(self::ALPHANUMERIC_REGEX, $name);
    }

    public static function validateVersion(string $version): bool {
        return preg_match(self::VERSION_REGEX, $version);
    }

    public static function validatePluginName(string $name): bool {
        return preg_match(self::PLUGIN_NAME_REGEX, $name);
    }

}