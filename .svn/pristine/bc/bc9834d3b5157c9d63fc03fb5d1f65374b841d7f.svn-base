<?php // Version : 1.0 ?>
<?php 
include("core.php");
include("config.php");

$apacheconf     = 'c:/webserver/apache/conf/conf.d/';
$htdocs            = 'c:/webserver/htdocs';
$hostsPath         = 'c:/Windows/System32/drivers/etc/hosts';
$sql_path         = 'c:/webserver/htdocs/ebaseloader/db';


if (! function_exists('ddump')) {
    function ddump()
    {
        $args = func_get_args();

        foreach ($args as $arg) {
            echo '<pre>';
            var_dump($arg);
            echo '</pre>';
        }
    }
}

function Write($hostsPath)
{
    $file = $hostsPath;
    $fp = fopen($file, "w");
    $data = $_POST["hosts_content"];
    fwrite($fp, $data);
    fclose($fp);
}

$loader = new Loader;
$apacheFiles    = $loader->get_files($path['apache_confd']);
$apacheData     = $loader->get_apache_data($apacheFiles);
$hostsFile      = $loader->get_hosts_file($path['windows_hosts']);
$databases      = $loader->get_databases($db);
$sql_files      = $loader->get_files($path['sql_files']);
$dd = 1;

if (!empty($_POST['hosts_content'])) {
    Write($hostsPath);
    $message = array('success' => 'Hosts file Updated');
}

if (!empty($_POST['update_database'])) {
    $message = $loader->update_database($_POST['vh_name'], $_POST['sql_file']);
}

if (!empty($_POST['clear_logs'])) {
    $message = $loader->clear_logs($_POST['vh_name']);
}

if (!empty($_POST['clear_cache'])) {
    $message = $loader->clear_cache($_POST['vh_name']);
}

if (!empty($_POST['delete_db'])) {
    $message = $loader->drop_database($_POST['delete_db']);
}

if (!empty($_POST['create_db'])) {
    $message = $loader->create_database($_POST['create_db']);
}
/*
FEATURES :
- Check for Apache Online
- Check for Mysql Running
- Show Mysql Databases
- Verify hosts file has correct informaiton if it is offline

Create Env
- hosts append
    $sub_domain = "   foo.bar.com";
    $append = file_put_contents('C:\Windows\System32\drivers\etc\hosts', $sub_domain.PHP_EOL , FILE_APPEND | LOCK_EX);
- create directory structure
- composer install

*/
//echo '<pre>';
//print_r($path);
//echo '</pre>';
?>
<?php ddump($_POST); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>eBase Loader v1.0</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            .online {
                background-color:#00cc00;
                color:#fff;
            }
            .offline {
                background-color:#cc0000;
                color:#fff;
            }
            .todo {
                line-height: .65em;
            }
            .nav-tabs>li {
                text-align: center;
            }
            textarea.form-control.hosts-edit {
                height:500px;
            }
            .nav-tabs>li.active>a,
            .nav-tabs>li.active>a:focus,
            .nav-tabs>li.active>a:hover {
                height:65px;
            }
            .tab-pane> div.container {
                border-right: 1px solid #ddd;
                border-left: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
            }
            .row {
                    margin:5px;
                    border-bottom:1px solid #ddd;
                    line-height: 2.5em;
                }
        </style>
    </head>
    <body>

    <?php if ($dd != 1){ echo $loader->dd($sql_files); }?>

    <div class="container" style="padding:0px;">
    <?php if(isset($message)): ?>
        <div class="row label-<?php echo key($message);?>"><?php echo current($message);?></div>
    <?php endif; ?>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#main">Main 1</a></li>
            <?php foreach ($apacheData as $config) : ?>
                <li>
                    <a data-toggle="tab" href="#<?php echo $config['Name']; ?>">
                        <?php echo ucwords($config['Name']); ?><br>
                        <?php foreach ($config['Ports'] as $port => $status) : ?>
                            <?php ($status == 1) ? $label = 'success' : $label = 'danger'; ?>
                            <span class="label label-<?php echo $label; ?>"><?php echo $port; ?></span>
                        <?php endforeach; ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li ><a data-toggle="tab" href="#todo">To Do</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div id="main" class="tab-pane fade in active">
            <div class="container">
                <h3>HOME</h3>
                <p>
                    <hr>
                    <h2>Create Local Env.</h2>
                    <div class="row">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="col-xs-3">
                                Environment Name :
                            </div>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" name="env[name]" placeholder="Environment Name"></input>
                            </div>
                            <div class="col-xs-3">
                                Datbase Name :
                            </div>
                            <div class="col-xs-9">
                                <input class="form-control" type="text" name="env[database_name]" placeholder="Database Name"></input>
                            </div>
                            <div class="col-xs-3">
                                SQL File :
                            </div>
                            <div class="col-xs-9">
                                <select name="env[sql_file]" class="form-control">
                                    <?php foreach($sql_files as $file): ?>
                                      <option value="<?php echo$file;?>"><?php echo substr($file, strrpos($file, '/') + 1) ;?></option>
                                      <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-xs-12">
                                <input class="btn btn-primary" style="margin-top:10px;float:right;" type="submit" name="submit" value="Create">
                            </div>
                        </form>
                    </div>
                <p>
                    <hr>
                    <h2>MySQL Databases</h2>
                    <div class="row">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="col-xs-10">
                                <input class="form-control" type="text" name="new_database" placeholder="Enter DB Name"></input>
                            </div>
                            <div class="col-xs-2">
                                <input class="btn btn-primary" style="float:right;" type="submit" name="submit" value="Create DB">
                            </div>
                        </form>
                    </div>
                </p>
                <p>
                    <?php foreach ($databases as $database) : ?>
                    <div class="row" style="margin-top:5px;margin-bottom:5px">
                        <div class="col-xs-10"><?php echo $database; ?></div>
                        <div class="col-xs-2"><a href="#" class="btn btn-danger" style="float:right;">Delete</a></div>
                    </div>
                    <?php endforeach; ?>
                </p>
                <p>
                    <hr>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h2>Windows Hosts File<input class="btn btn-primary" style="float:right;" type="submit" name="submit" value="Save Hosts"></h2>
                        <textarea class="form-control hosts-edit" name="hosts_content"><?php foreach ($hostsFile as $line) : ?><?php echo $line; ?><?php endforeach;?></textarea>
                    </form>
                </p>
            </div>
        </div>
        <?php foreach ($apacheData as $config) : ?>
        <div id="<?php echo $config['Name']; ?>" class="tab-pane fade">
            <div class="container" style="padding:20px;">
                <h3><?php echo ucwords($config['Name']); ?></h3>
                    <div class="row">
                        <div class="col-sm-3">Application Name</div>
                        <div class="col-sm-9"><?php echo $config['Name'] ;?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">Document Root</div>
                        <div class="col-sm-9"><?php echo $config['DocumentRoot'] ;?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">Server Root</div>
                        <div class="col-sm-9"><?php echo $config['ServerRoot'] ;?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">Database</div>
                        <div class="col-sm-3"><?php echo $config['Database'] ;?></div>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="col-sm-3">
                                <input type="hidden" name="vh_name" value="<?php echo $config['Name'];?>">
                                <input type="hidden" name="update_database" value="1">
                                <select name="sql_file" class="form-control input-sm" style="max-width:200px;">
                                    <?php foreach($databases as $file) : ?>
                                    <option value="<?php echo$file;?>"><?php echo $file ;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <input class="btn btn-warning" style="float:right;" type="submit" name="submit" value="Change DB">
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">Cache</div>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="vh_name" value="<?php echo $config['Name'];?>">
                            <input type="hidden" name="clear_cache" value="1">
                            <div class="col-sm-6"><?php echo $config['ServerRoot'] ;?></div>
                            <input class="btn btn-warning" style="float:right;" type="submit" name="submit" value="Clear Cache">
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">Logs</div>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="vh_name" value="<?php echo $config['Name'];?>">
                            <input type="hidden" name="clear_logs" value="1">
                            <div class="col-sm-6"><?php echo $config['ServerRoot'] ;?></div>
                            <input class="btn btn-warning" style="float:right;" type="submit" name="submit" value="Clear logs">
                        </form>
                    </div>

                    <?php foreach ($config['Servers'] as $port => $server) : ?>
                    <div class="row">
                    <?php ($config['Ports'][$port]  == 1) ? $online_status ='alert-success' : $online_status = 'alert-danger';?>
                        <div class="col-sm-1 <?php echo $online_status;?>">
                            <?php echo $port; ?>
                        </div>
                        <div class="col-sm-11">
                            <?php foreach ($server as $key => $value) : ?>
                                <div class="col-sm-2"><?php echo $key; ?></div>
                                <div class="col-sm-9"><?php echo $value; ?></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
        </div>
        <div id="todo" class="tab-pane fade">
            <div class="container">
                <h3>Todo</h3>
                <p>
                    <pre class="todo">
                        <ul>
                            <li>Clear Cache</li>
                            <li>Clear Logs</li>
                            <li>Edit Hosts</li>
                            <li>New Project</li>
                            <li>Stop and Start Apache</li>
                            <li>Stop and Start Mysql</li>
                            <li>New Database</li>
                            <li>Show Databases</li>
                        </ul>
                    </pre>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    </body>

</html>