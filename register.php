<?php
error_reporting(E_ALL&~E_NOTICE); 
$con =@mysqli_connect("localhost","root","123","bbs")or die("连接错误");
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$password=$_POST['password'];

	if($id == "" || $password == ""){
			echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
	}

    else{
    	$sql = "select id from account where id = '$id'";	//SQL语句
		$result = mysqli_query($con,$sql);	//执行SQL语句
		$num = mysqli_num_rows($result);	//统计执行结果影响的行数
		if($num==1)	//如果已经存在该用户
		{
			echo "<script>alert('用户名已存在'); history.go(-1);</script>";
		}
	    else{
	    	$sql2="insert into account (id,password) values ('$_POST[id]','$_POST[password]')" ;
		    mysqli_query($con,$sql2);
			echo"<script>alert('注册成功');location.href='signin.php'</script>";
	    }
    	
    }
    
}
?>

<html>
<link rel="stylesheet" type="text/css" href="signin.css">
<title>注册</title>
<h2>注册</h2>
<body>


<form action="register.php" method="post">
<input type="text" name="id"  placeholder="请输入ID"/>
<br><br>
<input type="password" name="password"  placeholder="请输入密码"/>
<br><br>
<input type="submit" name="submit" value="注册"/>
<br><br>
<a href="signin.php">回到登录界面</a>
</form>
</form>

</body>
</html>