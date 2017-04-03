<?php 	// Version : 1.0 ?>
<?php
include('../core/config.php');
include('../core/loader.php');
session_start();
(!isset($_SESSION['message'])) ? $_SESSION['message'] 	= '' : '';

class Action extends Loader {
	function __construct() {
		require("../core/db.php");
		$this->db = new DB();
		$this->log_file = LOADER_LOGS . '/loader.log';
	}

	// COMMON FUNCTIONS 
	//--------------------------------------------------------------
	function no_project($action, $args) 
	{
		$this->gohome(array('danger', 'Undefined function call : ' . $action . ' | arguments : ' . print_r($args)));
	}

	function debug($args, $on = 0, $sleep = 5) {
		if($on == 1) {
			// DEBUG AND DIE
			echo '<pre>';
			var_dump($args);
			echo '</pre>';
			die();
		} elseif($on == 2) {   
			// DEBUG WRITE TO LOG
			$this->write_log('debug', implode("~", $args));
		} else {
			// NO DEBUGGING
			return;	
		}
	}

	function gohome($msg)
	{
		if(is_array($msg)) {
			$this->write_log($msg[0], $msg[1]);
		}
		header("Location: " . '/', true);
		return;
	}


	// FILE MANAGMENT
	//--------------------------------------------------------------
	function clear_logs($args) 
	{
	// $args [0] = virtualhost : the root folder name of the project
	// $args [1] = path : Can be a file or folder 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )));
		
		if(is_file($args['path'])) {
			$result = $this->clear_file($args['path']);
		} elseif(is_dir($args['path'])) {
			$result = $this->clear_directory($args['path']);
		} else {
			$msg = array('danger', 'File or Directory does not exist : ' . $args['path']);
		}

		$this->gohome($msg);
	}

	function clear_cache($args)
	{
	// $args [0] = virtualhost : the root folder name of the project
	// $args [1] = type : all | apache | project
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )));

		$dir = PATH_HTDOCS_ROOT . $args['virtualhost'] . '/cache';
		$result = $this->clear_directory($dir);
	
		$this->gohome($msg);
	}

	// SERVER MANAGMENT
	//--------------------------------------------------------------
	function add_server($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function update_server($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function delete_server($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	// DATABASE MANAGMENT
	//--------------------------------------------------------------
	function add_database($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function update_database($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function load_database($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function new_load_database($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	// PROJECT MANAGMENT
	//--------------------------------------------------------------
	function change_database($args)
	{
	// $args [0] = virtualhost
	// $args [1] = database
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )));

		$file = PATH_HTDOCS_ROOT . $args['virtualhost'] . '/ebase/config/development/database.php';
		if(strpos($args['database'], "No Database") === false) {
			$result = $this->update_config_db($file, $args);
		} else {
			$args['database'] = '';
			$result = $this->update_config_db($file, $args);
		}
		$this->gohome($msg);
	}

	function load_project($args)
	{
	// $args [0] = virtualhost
	// $args [1] = database
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);

		$file = PATH_APACHE_CONF.'05-' . $args['virtualhost'] . '.conf';
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function update_projec($args)
	{
	// $args [0] = virtualhost
	// $args [1] = database
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	function delete_projec($args)
	{
	// $args [0] = virtualhost
	// $args [1] = database
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}

	// TEMPLATE FUNCTION
	//--------------------------------------------------------------
	function fn($args) 
	{
	// $args [0] = 
	// $args [1] = 
		$this->debug(array_merge($args, array("actions" => __FUNCTION__ )), true);
		if(true) {
			$msg = array('success', 'MSG');
		} else {
			$msg = array('danger', 'MSG');
		}
		$this->gohome($msg);
	}
}

$Action = new Action;
/* POST and GET into $action*/
if(isset($_POST)) {
	if(isset($_POST['action']) && isset($_POST['args'])) 
	{
		$Action->$_POST['action']($_POST['args']);
	}
} elseif(isset($_GET)) {
	if(isset($_GET['action']) && isset($_GET['args'])) 
	{
		$Action->$_GET['action']($_GET['args']);
	}
} else {
	$loader->write_log('warning', 'Direct access to actions.php is not allowed');
	header("Location: ".$_SERVER['SERVER_NAME'], true);
	die();
}
