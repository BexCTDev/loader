<?php include('core/config.php'); ?>
<?php include('core/loader.php'); ?>
<?php
$loader = new Loader;


echo '<pre>';
print_r($config);
echo '</pre>';

$test = $_SERVER['DOCUMENT_ROOT'] . '/ebaseloader/test';
$tests = array(1, 2, 3);
$file_tests = false;
$reset_test = false;


if($reset_test){
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
	print_r($loader->write_log('success', 'TEST FOR WRITE LOGS') . '<br>');
	print_r($loader->count_files($test . '1') . '<br>');

	print_r($loader->get_filesize($test . '/test0001.txt') . '<br>');
	print_r($loader->get_filetime($test . '/test0001.txt') . '<br>');
	print_r($loader->get_filesize($test . '1/test0003.txt') . '<br>');
	print_r($loader->get_filetime($test . '1/test0003.txt') . '<br>');
	print_r($loader->get_filesize($test . '2/test0008.txt') . '<br>');
	print_r($loader->get_filetime($test . '2/test0008.txt') . '<br>');



	if($file_tests) {
		print_r($loader->clear_directory($test . '1') . '<br>');
		print_r($loader->clear_directory($test . '2', true) . '<br>');
		print_r($loader->clear_file($test . '3' . '/test0003.txt') . '<br>');
	}
}
die();


?>