<?php
	$url = "http://temsms.vinachg.vn/tao-ma-pin.php";
	for($i = 0; $i < 100; $i++){
		$data = file_get_contents($url);
		echo $data . "<br />";
	}
?>