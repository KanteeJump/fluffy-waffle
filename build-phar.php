<?php

$pharFile = 'PluginGenerator.phar';

if (file_exists(__DIR__ . "/{$pharFile}")) {
    unlink(__DIR__ . "/{$pharFile}");
    echo "Generating new PHAR file...\n";
}

$phar = new Phar($pharFile);
$phar->buildFromDirectory(__DIR__);
$phar->setStub($phar->createDefaultStub('application.php'));
$phar->stopBuffering();

echo "PHAR file generated successfully.\n";