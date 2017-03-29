<?php
// Version : 1.0
$config['db']['hostname'] = "localhost";
$config['db']['username'] = "root";
$config['db']['password'] = "1977";

$config['path']['htdocs_root'] = $_SERVER['DOCUMENT_ROOT'] . '/';
$config['path']['apache_root'] = substr($config['path']['htdocs_root'] , 0, strrpos($config['path']['htdocs_root'], '/' ) + 1) . 'apache/';
$config['path']['mysql_root'] = substr($config['path']['htdocs_root'] , 0, strrpos($config['path']['htdocs_root'], '/' ) + 1) . 'mysql/';


$config['path']['apache_conf'] = $config['path']['apache_root'] . 'conf/confd/';
$config['path']['apache_logs'] = $config['path']['apache_root'] . 'logs/';

$config['loader']['root'] = $config['path']['htdocs_root'] . 'ebaseloader/';
$config['loader']['logs'] = $config['loader']['root'] . 'logs';
$config['loader']['projects_local'] = $config['loader']['root'] . 'projects/';		// LOCAL PROJECTS
$config['loader']['projects_remote'] =  'M:/ebase_projects/';  						// MAPPED NETWORK DRIVE or UNC PATH

$config['loader_files'] = array(
	'index.php' => 'Loader Interface',
	'core/loader.php' => 'Main PHP Class for actions',
	'core/config.php' => 'Config of the Loader Program',
	'core/templates/project_name.json' => 'This is the project file. It contains the information to build a local environment',
	'core/templates/project_name_virtualhost.json' => 'This is will contain config and data pertaining to the local virtual host.'
);