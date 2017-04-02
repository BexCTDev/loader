<?php // Version : 1.0 ?>
<?php
include('../core/config.php');
include('../core/loader.php');
session_start();
(!isset($_SESSION['message'])) ? $_SESSION['message'] 	= '' : '';

echo '<pre>';
	var_dump($_POST);
echo '</pre>';

// POST and GET into $action
if(isset($_POST)) {
	$action = $_POST;
} elseif(isset($_GET)) {
	$action = $_GET;
} else {
	$loader->write_log('warning', 'Direct access to actions.php is not allowed');
	header("Location: ".$_SERVER['SERVER_NAME'], true);
	die();
}

// ROUTER
if(isset($action['action']) && isset($action['args']))
{
	$args = $action['args'];
	switch ($action['action'])
	{
	    //FILE MANAGMENT
	    case 'clear_logs':
	        clear_logs($args);
	        break;
	    case 'clear_cache':
	        clear_cache($args);
	        break;

	    //SERVER MANAGEMENT
	    case 'add_server':
	        add_server($args);
	        break;
	    case 'update_server':
	        update_server($args);
	        break;
	    case 'delete_server':
	        delete_server($args);
	        break;

	    // DATABASE MANAEMENT
	    case 'add_database':
	        add_server($args);
	        break;
	    case 'delete_database':
	        add_server($args);
	        break;
	    case 'load_database':
	        load_database($args);
	        break;
	    case 'new_load_database':
	        new_load_database($args);
	        break;

	    // PROJECT MANAGEMENT
	    case 'change_database':
	        change_database($args);
	        break; 
	   	case 'install_project':
	        install_project($args);
	        break;
	   	case 'update_project':
	        update_project($args);
	        break;
	   	case 'delete_project':
	        delete_project($args);
	        break;
	    default :
	    	no_project($action['action'], $args);
	    	break;
	}
}
//-----------------------------------------------------------------------------------
// FUNCTIONS 
//-----------------------------------------------------------------------------------
function no_project($action, $args) 
{
	$loader->write_log('warning', 'Function (' . $action . ') is not defined in Router.<br/> Args : ' . print-r($args) );
	gohome();
}

function debug($args, $on = false, $sleep = 5) {
	if($on){
		echo '<pre>';
			var_dump($args);
		echo '</pre>';
		die();
	}
	return;
}
function gohome($msg)
{
	$loader = new Loader();
	if(is_array($msg)) {
		$loader->write_log($msg[0], $msg[1]);
	}
	header("Location: " . '/', true);
	return;
}


// FILE MANAGMENT
//-----------------------------------------------------------------------------------

function clear_logs($args) 
{
// $args [0] = project name : the root folder name of the project
// $args [1] = type : all | apache | project
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function clear_cache($args)
{
// $args [0] = project name : the root folder name of the project
// $args [1] = type : all | apache | project
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

// SERVER MANAGMENT
//-----------------------------------------------------------------------------------
function add_server($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function update_server($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function delete_server($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

// DATABASE MANAGMENT
//-----------------------------------------------------------------------------------
function add_database($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function update_database($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function load_database($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function new_load_database($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

// PROJECT MANAGMENT
//-----------------------------------------------------------------------------------
function change_database($args)
{
// $args [0] = virtualhost
// $args [1] = database
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function install_project($args)
{
// $args [0] = virtualhost
// $args [1] = database
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function update_projec($args)
{
// $args [0] = virtualhost
// $args [1] = database
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

function delete_projec($args)
{
// $args [0] = virtualhost
// $args [1] = database
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

// TEMPLATE FUNCTION
//-----------------------------------------------------------------------------------
function fn($args) 
{
// $args [0] = 
// $args [1] = 
	debug($args);
	if(true) {
		$msg = array('success', 'MSG');
	} else {
		$msg = array('danger', 'MSG');
	}
	gohome($msg);
}

