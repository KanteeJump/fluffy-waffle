<?php

namespace app\handler;

use app\utils\PluginInfo;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;

class GeneratorHandler {

    private Filesystem $filesystem;

    public function __construct(public PluginInfo $pluginInfo){
        $this->filesystem = new Filesystem();
    }

    public function generate(): void {
        $this->filesystem->dumpFile($this->pluginInfo->getPluginPath() . "/plugin.yml", $this->parseTemplateInfo());
        $this->filesystem->dumpFile($this->pluginInfo->getPluginPath() . "/src/" . strtolower($this->pluginInfo->getAuthor()) . "/" . $this->pluginInfo->getName() . ".php", $this->parseMainClassPlugin());
    }

    public function parseTemplateInfo(): string {
        $plugin_yml = $this->filesystem->readFile(Path::canonicalize(__DIR__ . "/../template/plugin.yml.template"));

        $plugin_yml = str_replace([
            "plugin_name",
            "plugin_author",
            "plugin_main",
            "plugin_version",
            "plugin_api_version"
        ], [
            $this->pluginInfo->getName(),
            $this->pluginInfo->getAuthor(),
            $this->pluginInfo->getMain(),
            $this->pluginInfo->getPluginVersion(),
            $this->pluginInfo->getApiVersion()
        ], $plugin_yml);

        return $plugin_yml;
    }

    public function parseMainClassPlugin(): string {
        $main_class = $this->filesystem->readFile(Path::canonicalize(__DIR__ . "/../template/main.php.template"));

        $main_class = str_replace([
            "plugin_name",
            "plugin_author",
        ], [
            $this->pluginInfo->getName(),
            strtolower($this->pluginInfo->getAuthor())
        ], $main_class);

        return $main_class;
    }

}