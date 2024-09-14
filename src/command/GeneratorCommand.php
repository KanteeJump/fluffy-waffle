<?php

namespace app\command;

use app\validate\PluginInfoValidate;
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
            return Command::INVALID;
        }

        $author = $this->argumentWithPrompt($input, $io, "author", "What is the author of the plugin?");

        if (!PluginInfoValidate::validateAlphaNumeric($author)) {
            $io->error("The author of the plugin must be only letters and numbers");
            return Command::INVALID;
        }

        $apiVersion = $this->argumentWithPrompt($input, $io, "api-version", "What is the version of the plugin API?");
        if (!PluginInfoValidate::validateVersion($apiVersion)) {
            $io->error("The version of the plugin API must be in the format x.x.x");
            return Command::INVALID;
        }

        $pluginVersion = $this->argumentWithPrompt($input, $io, "plugin-version", "What is the version of the plugin?");
        if (!PluginInfoValidate::validateVersion($pluginVersion)) {
            $io->error("The version of the plugin must be in the format x.x.x");
            return Command::INVALID;
        }

        $io->success("Generating plugin skeleton for $name");
        return Command::SUCCESS;
    }

    public function argumentWithPrompt(InputInterface $input, SymfonyStyle $output, string $name, string $description): string {
        return $input->getArgument($name) ?: $output->ask($description);
    }

}
