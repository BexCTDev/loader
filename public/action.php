<?php // Version : 1.0 ?>
<?php 
// ROUTER
// URL SAMPLE : action.php?action=clear_logs&args=

if(isset($_GET['action']) && isset($_GET['args'])) {
	switch ($_GET['action']) {
	    $args = explode('~', $_GET['args']);
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
	    case 'add_db':
	        add_server($args);
	        break;
	    case 'delete_database':
	        add_server($args);
	        break;
	    case 'delete_database':
	        add_server($args);
	        break;
	    case 'delete_database':
	        add_server($args);
	        break;

	    // PROJECT MANAGEMENT
	   	case 'install_project':
	        install_project($args);
	        break;
	   	case 'update_project':
	        install_project($args);
	        break;
	   	case 'delete_project':
	        delete_project($args);
	        break;
	    default :
	    	no_project($args);
	    	break;
	}
}
?>


<?php

public function clear_logs($args) 
// $args [0] = project name : the root folder name of the project
// $args [1] = type : all | apache | project
{
	

}

public function clear_logs($args) 
// $args [0] = project name : the root folder name of the project
// $args [1] = type : all | apache | project
{
	

}

public function clear_cache($args)
// $args [0] = project name : the root folder name of the project
// $args [1] = type : all | apache | project
{
	

}