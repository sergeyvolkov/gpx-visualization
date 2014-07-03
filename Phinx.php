<?php
/**
 * User: makarova
 * Date: 6/2/14
 * Time: 10:14 AM
 */
const PRODUCTION_CONFIG = 'application.php';

$configPath = 'application' . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR;
$applicationConfigFile = $configPath . PRODUCTION_CONFIG;

if (!is_file($applicationConfigFile) or !is_readable($applicationConfigFile)) {
    return 'Configuration file is not found';
}

/**
 * It's used to avoid warnings like some_constant not defined
 */
require 'application' . DIRECTORY_SEPARATOR . '_loader.php';
$applicationConfig = require $applicationConfigFile;

if (!isset($applicationConfig["db"]["connect"])) {
    return 'DB configuration is not set';
}
$environmentsConfigs = ['production' => $applicationConfig["db"]["connect"]];

$fileNames = scandir($configPath);

foreach ($fileNames as $fileName) {
    if (strpos($fileName, 'php')
        && !strpos($fileName, 'sample')
        && $fileName != PRODUCTION_CONFIG) {

        $configFile = $configPath . $fileName;

        if (!is_file($configFile) or !is_readable($configFile)) {
            continue;
        }
        $customConfig = require $configFile;
        if (!isset($customConfig["db"]["connect"])) {
            continue;
        }
        $environment = preg_filter(['/app./', '/.php/'], '', $fileName);
        $environmentsConfigs[$environment] = $customConfig["db"]["connect"];
    }
}
$dbSettings = [
    "default_migration_table" => "phinxlog",
    "default_database" => 'dev'
];
foreach ($environmentsConfigs as $env => $config) {
    $dbSettings[$env]= $config;
    $dbSettings[$env]['adapter'] = $config['type'];
}

return array(
    "paths" => ['migrations' => '%%PHINX_CONFIG_DIR%%/migrations'],
    "environments" => $dbSettings
);