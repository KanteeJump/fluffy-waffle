<?php

namespace app\utils;

class PluginInfo {

    public function __construct(
        public string $name,
        public string $author,
        public string $apiVersion,
        public string $pluginVersion
    ){}

    public function getName(): string {
        return $this->name;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getApiVersion(): string {
        return $this->apiVersion;
    }

    public function getPluginVersion(): string {
        return $this->pluginVersion;
    }

    public function getPluginPath(): string {
        return getcwd() . "/{$this->getName()}";
    }

    public function getMain(): string {
        return strtolower($this->getAuthor()) . "/" . $this->getName();
    }

}