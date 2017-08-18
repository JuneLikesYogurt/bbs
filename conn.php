<?php
$con = @mysql_connect("localhost","root","123","bbs");
mysql_select_db('bbs');
if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
else
	{
	//echo"连接成功";
	}
?>