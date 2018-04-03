<?php
	$html=file_get_contents("http://127.0.0.1:9503/");
	$filename="../../index.html";
	if (is_writable($filename)) {
		file_put_contents($filename,$html);
		echo(1);
	}
	else
	{
		echo(0);
	}
	/*$fp=fopen("../../index.html","w");
	fwrite($fp,$html);
	fclose($fp);*/
?>