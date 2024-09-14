<?php

namespace app\command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: "app:generate", description: "Generate a new skeleton plugin")]
class GeneratorCommand extends Command {

    protected function configure(): void {
        $this->addArgument("name", InputArgument::REQUIRED, "The name of the plugin");
        $this->addArgument("author", InputArgument::OPTIONAL, "The author of the plugin");
        $this->addArgument("api-version", InputArgument::OPTIONAL, "The version of the plugin API");
        $this->addArgument("plugin-version", InputArgument::OPTIONAL, "The version of the plugin");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument("name");
        if (!preg_match("/^[a-zA-Z]+$/", $name)) {
            $io->error("The name of the plugin must be only letters");
            return Command::FAILURE;
        }

        $author = $input->getArgument("author") ?: $io->ask("What is the author of the plugin?");
        if (!preg_match("/^[a-zA-Z0-9]+$/", $author)) {
            $io->error("The author of the plugin must be only letters and numbers");
            return Command::FAILURE;
        }

        $regexVersion = "/^[0-9]+\.[0-9]+\.[0-9]+$/";

        $apiVersion = $input->getArgument("api-version") ?: $io->ask("What is the version of the plugin API?");
        if (!preg_match($regexVersion, $apiVersion)) {
            $io->error("The version of the plugin API must be in the format x.x.x");
            return Command::FAILURE;
        }

        $pluginVersion = $input->getArgument("plugin-version") ?: $io->ask("What is the version of the plugin?");
        if (!preg_match($regexVersion, $pluginVersion)) {
            $io->error("The version of the plugin must be in the format x.x.x");
            return Command::FAILURE;
        }

        $io->success("Generating plugin skeleton for $name");
        return Command::SUCCESS;
    }

}
