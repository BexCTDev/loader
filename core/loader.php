<?php // Version : 1.0 ?>
<?php

// Loader Class
class Loader {
	
	function __construct() {
		require("db.php");
		$this->db = new DB();
		$this->log_file = LOADER_LOGS . '/loader.log';
	}

	function testmode($mode = 1) {
	// Only used with fn_test.php
	// MODES : 1 = Normal | 2 = Resets Test Files  | 3 = Runs test file modification
		if($mode > 3) { $mode =1; }
		if($mode == 1) {
			$data['file_tests'] = false;
			$data['reset_test'] = false;
		} elseif($mode == 2) {  // RESET FILES
			$data['file_tests'] = false;
			$data['reset_test'] = true;
		}elseif($mode == 3) { // FULL TEST WITH FILES
			$data['file_tests'] = true;
			$data['reset_test'] = false;
		}
		return $data;
	}

	// MESSAGE AND ERROR HANDLING
	// ---------------------------------------------------------------------------
	public function write_log($level = 'danger', $message, $file = false) {
	// Write to log and deliver a notification message
	// $level = danger, warning, success
		(!$file) ? $file = $this->log_file : '' ;
		$handle = fopen($file, "a");
		if ($handle) {
			$data = "\n". date("Y-m-d H:i:s") ." [". strtoupper($level) . "] - " . $message;
			fwrite($handle, $data);
			fclose($handle);
			$message = $this->build_message(array($level => $message));
			return $message;
		} else {
			$message = array('danger', 'Could not open file : '.$file);
			return $message;
		}
	}

	private function build_message($messages) {
		$html = '<div class="alert alert-{{LEVEL}} alert-dismissable fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>{{LEVELUP}} : </strong> {{BODY}}</div>';
		$msg = '';
		if(isset($messages[0])) {			
  			$body = '';
			foreach($messages as $level => $message) {
				$msg .= str_replace(array("{{LEVELUP}}", "{{LEVEL}}", "{{BODY}}"), array(strtoupper($level), $level, $message), $html);
			}
		} else {
			$msg .= str_replace(array("{{LEVELUP}}", "{{LEVEL}}", "{{BODY}}"), array(strtoupper(key($messages)), key($messages), $messages[key($messages)]), $html);
		}
		$_SESSION['message'] .= $msg;
		return false;
	}

	public function messages_handler($messages) {
	// DELETE ME
		
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

	// REMOVING FILES
	// ---------------------------------------------------------------------------
	public function clear_directory($dir, $rmdir = false) {
		if (is_dir($dir)  && strlen($dir) > 10) { //make sure that its not the root folder
			$opendir = opendir($dir);
			while(false !== ( $file = readdir($opendir)) ) {
				if (( $file != '.' ) && ( $file != '..' )) {
					$full = $dir . '/' . $file;
					if ( is_dir($full) ) {
						rmdir($full);
					}
					else {
						unlink($full);
					}
				}
			}
			closedir($opendir);
    		rmdir($dir);
			$rmtext = '';
			if (is_dir($rmdir)) {
				rmdir($dir);
				if (is_dir($dir)) {
					$message = $this->write_log('danger', 'Could not remove dir : '.$dir);
					return $message;
				}
				$rmtext = 'and removed ';
			} else {
				if($this->count_files($dir) > 0){
					$message = $this->write_log('danger', 'All files not removed ( File Count = ' .$this->count_files($dir) .' ) from dir : '.$dir);
					return $message;
				}
			}
			$message = $this->write_log('success', 'Directory has been cleared ' . $rmtext . ': '.$dir);
			return $message;
		} else {
			$message = $this->write_log('danger', 'Could not open dir : '.$dir);
			return $message;
		}
	}

	public function clear_file($file) {
		$handle = fopen($file, "w");
		if ($handle) {
			fwrite($handle, '');
			fclose($handle);
			if($this->get_filesize($file) == "0.00B") {
				$message = $this->write_log('success', 'File has been cleared : '.$file);
			} else {
				$message = $this->write_log('danger', 'File has NOT been cleared : '.$file);
			}
			return $message;
		} else {
			$message = $this->write_log('danger', 'Could not open file : '.$file);
			return $message;
		} 
	}

	// PROCESSING FILES
	// ---------------------------------------------------------------------------
 	public function get_files($path) {
        $files = array();
        $configFiles = array_diff(scandir($path), array('..', '.'));
        foreach ($configFiles as $file) {
             $files[] = $path.$file;
        }
        return $files;
    }

	public function count_files($dir) {
		if(file_exists($dir)) {
			return (count(scandir($dir)) - 2);
		} else {
			$message = $this->write_log('danger', 'Could not open dir : '.$dir);
			return $message;
		}
	}

	public function get_filesize($file) {
		if(file_exists($file)) {
			$bytes = filesize($file);
			$decimals = 2;
			$size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
		    $factor = floor((strlen($bytes) - 1) / 3);
		    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
		} else {
			$message = $this->write_log('danger', 'Could find file : '.$file);
			return $message;
		}
	}

	public function get_filetime($file) {
		if (file_exists($file)) {
			$date = date ("Y-m-d H:i:s.", filemtime($file));
			return $date;
		} else {
			$message = $this->write_log('danger', 'Could find file : '.$file);
			return $message;
		}
	}

	// MYSQL FUNCTIONS
	// ---------------------------------------------------------------------------
	public function mysql_test() {
		$q = $this->db->query('SHOW DATABASES;');
		if($q) {
			return $q;	
		}
	}

	public function create_db ($database) {
		$q = $this->db->query("CREATE DATABASE " . $database);
		if($q) {
			$message = $this->write_log('success', 'Database Created : ' . $database);
			return $message;	
		}
	}

	public function delete_db ($database) {
		$q = $this->db->query("DROP DATABASE " . $database);
		if($q) {
			$message = $this->write_log('success', 'Database Deleted : ' . $database);
			return $message;	
		}
	}

	public function load_database ($database, $sqlfile, $anonymise = true) {
		$q = $this->db->connect($database);
		if($q) {
			$handle = fopen($sqlfile, "r");
			if ($handle) {
				fclose($handle);
				$sqlSource = file_get_contents($sqlfile);
			} else {
				$message = $this->write_log('danger', 'Could not open file : '.$sqlfile);
				return $message;
			} 
			if(mysqli_multi_query($q,$sqlSource)) {
				if($anonymise == true) {
					if($this->anonymize($database)) {
						$message = $this->write_log('success', 'Database has been loaded : '.database.' with file : '. $sqlfile.' and database has been Anonymized.');
						return $message;		
					}
				}
				$message = $this->write_log('success', 'Database has been loaded : ' .$datbase.' with file : '. $sqlfile);
				return $message;
			} else {
				$message = $this->write_log('danger', 'Failed to load database : ' . $database .' with file : '. $sqlfile);
				return $message;
			} 
		}
	}

	public function anonymize ($database) {
	// Anonymize date.. copy ebase script
		if(true) {

			$message = $this->write_log('success', 'Database has been anonymized : ' . $database);
			return true;
		} else {
			$message = $this->write_log('danger', 'Failed to Anonymize database : ' . $database);
			return false;
		} 
	}

	public function check_anonymize ($database) {
	// Run test to ensure data is anonymized used as an informational check and warning marker on server screen
		if($success) {


			return true;
		} else {
			return false;
		} 
	}

	// HTML JSON AND DATA REQUESTS
	private function check_server($url, $port)
    {
        if ($socket =@ fsockopen($url, $port, $errno, $errstr, 30)) {
            return 1;
            fclose($socket);
        } else {
            return 0;
        }
    }

	// MODIFY CONFIG FILES 
	// ---------------------------------------------------------------------------
	public function get_apache_data($files)
	// GETS THE SERVER INFOMATION
    {	
        foreach ($files as $file) {
        	if(strpos($file, '05') > 0) {
	            $filebase = substr($file, strrpos($file, '/')+1);
	            $handle = fopen($file, "r");
	            if ($handle) {
	            	$db_checked = 0;
	                while (($line = fgets($handle)) !== false) {
	                    if (strpos($line, '<VirtualHost') !== false) {
	                        $port = substr($line, strpos($line, ':')+1, strpos($line, '>')-strpos($line, ':')-1);
	                    }
	                    if (strpos($line, 'ServerName') !== false) {
	                        $Data[$filebase]['Servers'][$port]['ServerName'] = trim(substr($line, strpos($line, 'ServerName')+11));
	                    }
	                    if (strpos($line, 'ServerAlias') !== false) {
	                        $Data[$filebase]['Servers'][$port]['ServerAlias'] = trim(substr($line, strpos($line, 'ServerAlias')+12));
	                        $Data[$filebase]['Ports'][$port] = $this->check_server($Data[$filebase]['Servers'][$port]['ServerAlias'], $port);
	                    }
	                    if (strpos($line, 'DocumentRoot') !== false) {
	                        $Data[$filebase]['DocumentRoot'] = str_replace('"', '', trim(substr($line, strpos($line, 'DocumentRoot')+13)));
	                        $Data[$filebase]['ServerRoot'] = str_replace('public', '', $Data[$filebase]['DocumentRoot']);
	                        $ServerRoot = $Data[$filebase]['ServerRoot'];
	                        $Data[$filebase]['Name'] = str_replace('/', '', substr($ServerRoot, strpos($ServerRoot, 'htdocs')+7));
	                        if($db_checked == 0) {
		                        $Data[$filebase]['Database'] = $this-> get_db_config($Data[$filebase]['Name']);
		                        $db_checked = 1;
							}
	                    }

	                }
	                fclose($handle);
	            } else {
	                $message = $this->write_log('danger', 'Could not open file' . $file);
					return $message;
	            }
            }
        }
        return $Data;
    }

	public function get_db_config($virtualhost) {
		$file = PATH_HTDOCS_ROOT . $virtualhost . '/ebase/development/config/database.php';
		$handle = @fopen($file, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				if(strpos($line, 'hostname') > 0) {
					$data['hostname'] = str_replace(array("'", ";", " ") , "",substr($line, strpos($line, "'",25) + 1));			
				} elseif (strpos($line, 'username') > 0) {
					$data['username'] = str_replace(array("'", ";", " ") , "",substr($line, strpos($line, "'",25) + 1));
				} elseif(strpos($line, 'password') > 0) {
					$data['password'] = str_replace(array("'", ";", " ") , "",substr($line, strpos($line, "'",25) + 1));
				} elseif(strpos($line, 'database') > 0) {
					$data['database'] = str_replace(array("'", ";", " ") , "",substr($line, strpos($line, "'",25) + 1));
				}
			}
			fclose($handle);
		} else {
			$message = $this->write_log('danger', 'Could not open file DB' . $file);
			return $message;
		}
		return $data;
	}

	public function update_config_db($file, $args) {
	// $args = array ('database' => $database, 'username' => $username, 'password' => $password);
		$handle = fopen($file, "r");
		if ($handle) {
			while (($line = fgets($handle)) !== false) {
				if (isset($args['username'])) {
					if(strpos($line, 'username') > 0) {
						$data[] = '$db[\'default\'][\'username\'] = \''.$username.'\';';
					}
				}
				elseif (isset($args['password'])) {
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
			$message = $this->write_log('danger', 'Could not open file');
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
			$message = $this->write_log('success', 'Config has been updated on : '. $file);
			return $message;
		} else {
			$message = $this->write_log('danger', 'Could not open file');
			return $message;
		} 
	}

	public function update_config_db_multi($args) {
	// $args[$file] = array ('database' => $database, 'username' => $username, 'password' => $password);
		foreach ($args as $file => $data) {
			$messages[] = $this->update_config_db($file, $data);
		}
		return $messages;
	}

	public function update_virtual_host(){
	// Regenerate virtual hosts file.

	}


}