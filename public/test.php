<?php	
	$data	= file_get_contents('index.php');
	
	foreach($data as $key => $value){
		echo $value['name'] . '<br />';
	}
}else{
	die('File not found');
