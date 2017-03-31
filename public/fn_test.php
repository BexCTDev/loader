<?php // Version : 1.0 ?>
<?php include('../core/config.php'); ?>
<?php include('../core/loader.php'); ?>

<?php
$loader = new Loader();


echo '<pre>';
print_r($config);
print_r(array_slice(get_defined_constants(), -15, 15, true));
echo '</pre>';

$test = LOADER_ROOT . 'testing/test';
$tests = array(1, 2, 3);

$testmode = $loader->testmode(1);
//echo phpinfo();
if($testmode['reset_test']){
	foreach($tests as $number) {
		$src = $test . '/';
		$dst = $test . $number . '/';
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					recurse_copy($src . '/' . $file,$dst . '/' . $file);
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
		if(is_dir($test . $number)){
			echo 'Created : '. $test . $number . '<br>';
		} else {
			echo 'Failed to create : '. $test . $number . '<br>';
		}
	}
} else {
	print_r("FN : write_log() | " . $loader->write_log('success', 'TEST FOR WRITE LOGS') . '<br>');
	print_r("FN : count_files() | " . $loader->count_files($test . '1') . '<br>');

	print_r("FN : get_filesize() | " . $loader->get_filesize($test . '/test0001.txt') . '<br>');
	print_r("FN : get_filetime() | " . $loader->get_filetime($test . '/test0001.txt') . '<br>');
	print_r("FN : get_filesize() | " . $loader->get_filesize($test . '1/test0003.txt') . '<br>');
	print_r("FN : get_filetime() | " . $loader->get_filetime($test . '1/test0003.txt') . '<br>');
	print_r("FN : get_filesize() | " . $loader->get_filesize($test . '2/test0008.txt') . '<br>');
	print_r("FN : get_filetime() | " . $loader->get_filetime($test . '2/test0008.txt') . '<br>');

	echo("<br>FN : mysql_test() | ");
	print_r($loader->mysql_test());

	echo("<br>FN : create_db() | ");
	print_r($loader->create_db('abc'));

	echo("<br>FN : create_db() | ");
	print_r($loader->create_db('a123'));

	echo("<br>FN : delete_db() | ");
	print_r($loader->delete_db('a123'));

	echo("<br>FN : load_database() | ");
	print_r($loader->load_database('acb', LOADER_ROOT . 'core/templates/template.sql'));	

	echo("<br>FN : delete_db() | ");
	print_r($loader->delete_db('a123'));



	if($testmode['file_tests']) {
		print_r("FN : clear_directory() | " . $loader->clear_directory($test . '1') . '<br>');
		print_r("FN : clear_directory(and root) | " . $loader->clear_directory($test . '2', true) . '<br>');
		print_r("FN : clear_file() | " . $loader->clear_file($test . '3' . '/test0003.txt') . '<br>');
	}
}
die();


?>