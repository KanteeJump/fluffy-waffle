<?php

namespace app\utils;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class PluginInfoBuilder {

    public static function build(InputInterface $input, OutputInterface $output): ?PluginInfo {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument("name") ?: $io->ask("What is the name of the plugin? ex: MyPlugin");
        if (!PluginInfoValidate::validatePluginName($name)) {
            $io->error("The name of the plugin must be only letters and numbers");
            die();
        }

        $author = $input->getArgument("author") ?: $io->ask("What is the author of the plugin? ex: JohnDoe");
        if (!PluginInfoValidate::validateAlphaNumeric($author)) {
            $io->error("The author of the plugin must be only letters and numbers");
            die();
        }

        $apiVersion = $input->getArgument("api-version") ?: $io->ask("What is the version of the plugin API? ex: 5.0.0");
        if (!PluginInfoValidate::validateVersion($apiVersion)) {
            $io->error("The version of the plugin API must be in the format x.x.x");
            die();
        }

        $pluginVersion = $input->getArgument("plugin-version") ?: $io->ask("What is the version of the plugin? ex: 1.0.0");
        if (!PluginInfoValidate::validateVersion($pluginVersion)) {
            $io->error("The version of the plugin must be in the format x.x.x");
            die();
        }

        return new PluginInfo($name, $author, $apiVersion, $pluginVersion);
    }

}