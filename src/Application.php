<?php

namespace app;

use app\command\GeneratorCommand;
use Symfony\Component\Console\Application as ConsoleApplication;

class Application {

    public function __construct(public ConsoleApplication $consoleApplication) {
        $this->consoleApplication->add(new GeneratorCommand());
        $this->consoleApplication->run();
    }

}