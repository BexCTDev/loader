<?php // Version : 1.0 ?>
<?php
define("DB_HOSTNAME", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "1977");

define("PATH_LOADER_ROOT", $_SERVER['DOCUMENT_ROOT'] . '/');
define("PATH_APACHE_ROOT", substr(PATH_LOADER_ROOT , 0, strrpos(PATH_LOADER_ROOT, '/htdocs' ) + 1) . 'apache/');
define("PATH_MYSQL_ROOT", substr(PATH_LOADER_ROOT , 0, strrpos(PATH_LOADER_ROOT, '/htdocs' ) + 1) . 'mysql/');
define("PATH_HTDOCS_ROOT", substr(PATH_LOADER_ROOT , 0, strrpos(PATH_LOADER_ROOT, '/ebaseloader' ) + 1));


define("PATH_APACHE_CONF", PATH_APACHE_ROOT . 'conf/conf.d/');
define("PATH_APACHE_LOGS", PATH_APACHE_ROOT . 'logs/');

define("LOADER_ROOT", substr(PATH_LOADER_ROOT , 0, strrpos(PATH_LOADER_ROOT, '/public' ) + 1));
define("LOADER_LOGS", LOADER_ROOT . 'logs');
define("LOADER_PROJECTS_LOCAL", LOADER_ROOT . 'projects/');				// LOCAL PROJECTS
define("LOADER_PROJECTS_REMOTE",  'M:/ebase_projects/');  				// MAPPED NETWORK DRIVE or UNC PATH

define ("ACTION_URL", PATH_LOADER_ROOT . 'action.php');

$config["LOADER_FILES"] = array(
	'public/index.php' => 'Loader Interface',
	'public/actions.php' => 'Router for all pag actions',

	'public/src/css/' => '',
	'public/src/css/' => '',

	'core/loader.php' => 'Main PHP Class',
	'core/loader.php' => 'Database class to run query',
	'core/config.php' => 'Config of the Loader Program',
	
	'core/templates/project_name.json' => 'The project file, it contains the information to build a local environment',
	'core/templates/project_name_virtualhost.json' => 'Contains config and data pertaining to the local virtual host.',
	'core/templates/template.sql' => 'Used for testing database loading queries',
	'core/templates/05-projectname.conf' => 'Template : Used to load the Apache Virtual Host config file',
	'core/templates/database.php' => 'Template : Used to load the project database information',

	'logs/loader.log' => 'All messages that are delivered to the screen are logged',
	'logs/messages.log' => 'Retains the 20 leatest messages since cleared',

	'projects/' => 'Local Projects directory : <br>Structure | projects/projectname/projectname_project.json <br>projects/projectname/projectname_hostname.json <br>projects/projectname/projectname.sql',

	);