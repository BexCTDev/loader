<?php

$webroot = 'c:/webserver/htdocs/ebase/'
$log_path = $webroot.'logs';
$cache_path =  $webroot.'cache';
$conf_path = 'c:/webserver/apache/conf/conf.d/server.conf';

// CHANGE DB in CI config file
// CLEAR CACHE AND LOGS
// LOAD DB

function clear_directory($dir, $rmdir = false) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir."/".$object) == "dir") {
					rrmdir($dir."/".$object); 
				} else {
					unlink ($dir."/".$object);
				}
			}
		}
		reset($objects);
		$rmtext = '';
		if ($rmdir) {
			rmdir($dir);
			if (is_dir($dir)) {
				$message['message'] = array('danger' => 'Could not remove dir : '.$dir);
	    		return $message;
			}
			$rmtext = 'and removed ';
		} else {
			if(count_files($dir) > 0){
				$message['message'] = array('danger' => 'All files not removed ( File Count = ' .count_files($dir) .' ) from dir : '.$dir);
		    	return $message;
			}
		}
		$message['message'] = array('success' => 'Directory has been cleared ' . $rmtext . ': '.$dir);
	    return $message;
	} else {
		$message['message'] = array('danger' => 'Could not open dir : '.$dir);
	    return $message;
	}
}

function count_files($dir) {
	if(file_exists($dir)) {
		return (count(scandir($dir)) - 2);
	} else {
		$message['message'] = array('danger' => 'Could not open dir : '.$dir);
	    return $message;
	}
}

function get_filesize($file) {
	if(file_exists($file)) {
		$bytes = filesize($file);
		$decimals = 2;
		$sz = 'BKMGTP';
	  	$factor = floor((strlen($bytes) - 1) / 3);
	  	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
  	} else {
		$message['message'] = array('danger' => 'Could find file : '.$file);
	    return $message;
	}
}

function get_filetime($file) {
	if (file_exists($file)) {
    	$date = date ("M d Y H:i:s.", filemtime($file));
    	return $date;
    } else {
		$message['message'] = array('danger' => 'Could find file : '.$file);
	    return $message;
	}
}

function clear_file($file) {
	$handle = fopen($file, "w");
	if ($handle) {
		fwrite($file, '');
		fclose($handle);
		$message = array('success' => 'File has been cleared : '.$file;)
		return $message;
	} else {
	    $message['message'] = array('danger' => 'Could not open file : '.$file);
	    return $message;
	} 
}

function create_db ($datbase) {
	$sql = 'CREATE DATABSE '.$datbase;
	$message = array('success' => 'Datbase has been created : '.$datbase;)
	return $message;
}

function delete_db ($datbase) {
	$sql = 'DROP DATABASE '.$datbase;
	$message = array('success' => 'Datbase has been deleted : '.$datbase;)
	return $message;
}

function load_database ($database, $file, $anonymise = true) {
	$conn = mysqli_connect("localhost", "my_user", "my_password", $database);
	
	$handle = fopen($file, "r");
	if ($handle) {
		fclose($handle);
		$sqlSource = file_get_contents($file);
	} else {
	    $message['message'] = array('danger' => 'Could not open file : '.$file);
	    return $message;
	} 
	if(mysqli_multi_query($sql,$sqlSource)) {
		if($anonymise == true) {
			$result = $this->anonymize($database);
			if(isset($result['message']['success']) {
				$message = array('success' => 'Database has been loaded : '.datbase.' with file : '. $file.' and database has been Anonymized.');
				return $message;		
			}
		}
		$message = array('success' => 'Database has been loaded : '.datbase.' with file : '. $file);
		return $message;
	} else {
	    $message['message'] = array('danger' => 'Failed to load database : '.datbase .' with file : '. $file);
	    return $message;
	} 
}

function anonymize ($datbase) {
	// Connect
	// Anonymize date.. copy ebase script
	if($success) {

		$message = array('success' => 'Database has been anonymized : '.datbase);
		return $message;
	} else {
	    $message['message'] = array('danger' => 'Failed to Anonymize database : '.datbase);
	    return $message;
	} 
}

function check_anonymize ($datbase) {
	// Run test to ensure data is anonymized used as an informational check and warning marker on server screen
	if($success) {

		
		return true;
	} else {
	    return false;
	} 
}

function update_config_db_multi($args) {
	// $args[$file] = array ('database' => $database, 'username' => $username, 'password' => $password);
	foreach ($args as $file => $data) {
		$messages[] = $this->update_config_db($file, $data);
	}
	return $messages;
}

function update_config_db($file, $args) {
	// $args = array ('database' => $database, 'username' => $username, 'password' => $password);
	$handle = fopen($file, "r");
	if ($handle) {
	    while (($line = fgets($handle)) !== false) {
	        if (isset($args['username'])) {
	        	if(strpos($line, 'username') > 0) {
					$data[] = '$db[\'default\'][\'username\'] = \''.$username.'\';';
	        	}
	        }
	        elseif (isset($args['username'])) {
	        	if(strpos($line, 'password') > 0) {
	        		$data[] = '$db[\'default\'][\'password\'] = \''.$password.'\';';
	        	}
	        }
	        elseif (isset($args['database'])) {
		        if(strpos($line, 'database') > 0) {
		        	$data[] = '$db[\'default\'][\'database\'] = \''.$database.'\';';
	        	}
	        } else {
	        	$data[] = $line;
	        }
	    }
	    fclose($handle);
	} else {
	    $message['message'] = array('danger' => 'Could not open file');
	    return $message;
	} 
	$handle = fopen($file, "w");
	if ($handle) {
		if (count($data) > 0) {
			foreach ($data as $line) {
				fwrite($file, $line);
			}	
		}
		fclose($handle);
		$message['message'] = array('success' => 'Config has been updated on : '. $file);
	    return $message;
	} else {
	    $message['message'] = array('danger' => 'Could not open file');
	    return $message;
	} 
}

function messages_handler($messages) {
	$message = '';
	if(count($messages > 0)) {
		foreach ($messages as $message){
			$message .= '<div class="' . key($message) .'">' . current($message) .'</div>';
		}
	} else {
		$message .= '<div class="' . key($message) .'">' . current($message) .'</div>';
	}
	return $message;
}

?>