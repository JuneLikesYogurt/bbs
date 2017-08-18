<?php
//include("conn.php");
error_reporting(E_ALL&~E_NOTICE); 
$con = @mysqli_connect("localhost","root","123","bbs")or die("连接错误");

//添加图片
if (is_uploaded_file($_FILES['upfile']['tmp_name'])){
    $upfile=$_FILES["upfile"];
    //var_dump($upfile);
}
$upfile=$_FILES["upfile"];
$name = $upfile["name"];
$type = $upfile["type"];
$size = $upfile["size"];
$tmp_name = $upfile["tmp_name"];
$error = $upfile["error"];
$absolute = 'upfile/'.$name.'';

switch ($type) {
	case 'image/pjpeg' :
		break;
	case 'image/jpeg' : 
		break;
	case 'image/gif' :
		break;
	case 'image/png' :
		break;
}

if(move_uploaded_file($tmp_name,'upfile/'.$name)){
    //echo "上传图片成功！";
}

if(isset($_POST['submit'])){
    $sql="insert into contents (title,id,content,picture) values ('$_POST[title]','$_POST[id]','$_POST[content]','$absolute')" ;
    //echo $sql;
	mysqli_query($con,$sql);
	$result = mysqli_query($con,"SELECT * FROM contents");
	echo "<script>alert('发表成功');location.href='list.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>添加留言</title>
</head>
<link rel="stylesheet" type="text/css" href="list.css">
<body>

<form action="add.php" method="post" enctype="multipart/form-data">
标题:<input type="text" name="title"/><br>
用户:<input type="text" name="id"><br>
内容:<textarea rows="5" cols="50" name="content"></textarea><br>
<input name="upfile" type="file"/>
<br><br>

<input type="submit" name="submit" value="发表留言"/><br><br>

</form> 
</body>
</html>
