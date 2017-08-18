<?php
include_once("conn.php");
if (isset($_GET['id']))
{
	mysql_query('DELETE FROM `contents` WHERE `id` = \'' . $_GET['id'] . '\'');
	echo"<script>alert('删除成功');location.href='list.php'</script>";
}
?>