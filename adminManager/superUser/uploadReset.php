<?php
	if(unlink("../..".$_GET['img']))
		echo(1);
	else
		echo(0);
?>