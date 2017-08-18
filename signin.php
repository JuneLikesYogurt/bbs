<?php
SESSION_start();
$con =@mysqli_connect("localhost","root","123","bbs")or die("连接错误");
if(isset($_POST['submit'])){
	$_SESSION['id']=$_POST['id'];
	$id=$_POST['id'];
	$password=$_POST['password'];

	 //判断用户名密码不为空
	 if($id==''||$password==''){
	 	echo "<script>alert('用户名或密码不能为空');history.go(-1);</script>";
	 }
     
     else{
		$sql="select * from account where id='$id' and password='$password'";
		 //mysql_query() 函数执行一条 MySQL 查询
		$query=mysqli_query($con,$sql);
		$array=mysqli_fetch_array($query);//这一句里不能加$con
	   
		if(!empty($array)){
			if(isset($_SESSION['id'])&&!empty($_SESSION['id'])){
				echo "<script>alert('登录成功');location.href='list.php'</script>";
			}
		}
		else{
			echo"<script>alert('用户名或密码不正确');history.go(-1);</script>";
		}
     }
     
}
?>


<html>
<link rel="stylesheet" type="text/css" href="signin.css">
<h2>留言板</h2>
<title>登录</title>
<body>

<form action="signin.php" method="post">
<input type="text" name="id" placeholder="请输入ID"/>
<br><br>
<input type="password" name="password" placeholder="请输入密码"/>
<br><br>
<input type="submit" name="submit" value="登录"/>
<br><br>
<a href="register.php">注册</a>
</form>

</body>
</html>


