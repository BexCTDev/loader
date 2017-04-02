<?php
class Loader
{
    public function __construct()
    {

    }

    public function dd()
    {
        $args = func_get_args();

        foreach ($args as $arg) {
            echo '<pre>';
            var_dump($arg);
            echo '</pre>';
        }
    }

    public function get_files($path)
    {
        $files = array();
        $configFiles = array_diff(scandir($path), array('..', '.'));
        foreach ($configFiles as $file) {
             $files[] = $path.$file;
        }
        return $files;
    }

    public function get_apache_data($files)
    {
        foreach ($files as $file) {
            $filebase = substr($file, strrpos($file, '/')+1);
            $handle = fopen($file, "r");
            if ($handle) {
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
                        $Data[$filebase]['Database'] = $this->get_database_name($ServerRoot.'ebase/config/development/database.php');
                    }

                }
                fclose($handle);
            } else {
                return 'Cannot open file';
            }
        }
        return $Data;
    }

    private function get_database_name($file)
    {
        if (file_exists($file)) {
            $handle = fopen($file, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    if (strpos($line, "['database']") !== false) {
                        $Data = str_replace(array("'", ";"), '', substr($line, strrpos($line, "'", strrpos($line, "'") - strlen($line) - 1)));
                        return $Data;
                    }
                }
            }
        }
        return 'No Database';
    }

    private function verifydb($dbname)
    {

    }

    private function check_server($url, $port)
    {
        if ($socket =@ fsockopen($url, $port, $errno, $errstr, 30)) {
            return 1;
            fclose($socket);
        } else {
            return 0;
        }
    }

    public function get_hosts_file($file)
    {
        $handle = fopen($file, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $data[] = $line;
            }
        }
        fclose($handle);
        return $data;
    }


    public function clear_cache()
    {
        die('CLEAR CACHE');
    }

    public function clear_logs()
    {
        die('CLEAR LOGS');
    }

    public function apache_start()
    {
        die('APACHE START');
    }

    public function apache_stop()
    {
        die('APACHE STOP');
    }

    public function mysql_start()
    {
        die('MYSQL START');
    }

    public function mysql_stop()
    {
        die('MYSQL STOP');
    }

    private function db_connect($db)
    {
        // Create connection
        $conn = mysqli_connect($db['default']['hostname'], $db['default']['username'], $db['default']['password']);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    public function update_database($vh_name, $database){
        die('UPDATE_DATABSE'. $vh_name .' |' .$database);
    }

    public function create_database($db_name)
    {
        $conn = $this->db_connect();
        $sql = "CREATE DATABASE ".$db_name;
        if (!$conn->query($sql)) {
            $result = array('danger' => mysql_error());
            return $result;
        }
        $result = array('success' => 'Table Created : '. $db_name);
        return $result;
    }

    public function drop_database($db_name)
    {
        $conn = $this->db_connect();
        $sql = "DROP DATABASE ".$db_name;
        if (!$conn->query($sql)) {
            $result = array('danger' => mysql_error());
            return $result;
        }
        $result = array('success' => 'Table Created : '. $db_name);
        return $result;
    }

    public function get_databases($db)
    {
        $conn = $this->db_connect($db);
        $sql = "SHOW DATABASES";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if (!in_array($row['Database'], array('performance_schema', 'information_schema', 'mysql'))) {
                    $data[] = $row['Database'].'<br>';
                }
           }
        } else {
            echo "0 results";
        }
        $conn->close();
        return $data;
    }
}