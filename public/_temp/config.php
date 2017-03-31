<?php
$db['default']['hostname']    = 'localhost';
$db['default']['username']    = 'root';
$db['default']['password']    = '1977';
$db['default']['db_debug']    = true;

$path['document_root']      = $_SERVER["DOCUMENT_ROOT"];
$path['base']               = substr($path['document_root'], 0, strrpos($path['document_root'], '/htdocs'));
$path['sql_files']          = $path['base'] . '/ebaseloader';
$path['sql_files']          = $path['base'] . '/htdocs/ebaseloader/projects';
$path['apache']             = $path['base'] . '/apache';
$path['apache_confd']       = $path['apache']  . '/conf/conf.d/' ;
$path['windows_hosts']      = substr($path['document_root'], 0, strpos($path['document_root'], '/')) . '/Windows/System32/drivers/etc/hosts';

echo "<pre>";
print_r($path);
echo "</pre>";
