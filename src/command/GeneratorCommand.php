<?php

namespace app\command;

use app\handler\GeneratorHandler;
use app\utils\PluginInfoBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: "app:generate", description: "Generate a new skeleton plugin")]
class GeneratorCommand extends Command {

    protected function configure(): void {
        $this->addArgument("name", InputArgument::REQUIRED, "The name of the plugin");
        $this->addArgument("author", InputArgument::OPTIONAL, "The author of the plugin");
        $this->addArgument("api-version", InputArgument::OPTIONAL, "The version of the plugin API");
        $this->addArgument("plugin-version", InputArgument::OPTIONAL, "The version of the plugin");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $pluginInfo = PluginInfoBuilder::build($input, $output);
        
        $generatorHandler = new GeneratorHandler($pluginInfo);

        $output->writeln("Generating plugin skeleton " . $pluginInfo->getName());

        $generatorHandler->generate();

        return Command::SUCCESS;
    }

}
