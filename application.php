<?php

require __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Console\Application as ConsoleApplication;
use app\Application;

new Application(new ConsoleApplication("PluginGenerator", "1.0.0"));