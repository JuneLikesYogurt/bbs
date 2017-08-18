<html>
<link rel="stylesheet" type="text/css" href="list.css">
<body>

<?php
    error_reporting(E_ALL&~E_NOTICE);
    $link=mysqli_connect("localhost","root","123","bbs");
	  $url=$_SERVER["REQUEST_URI"];//取得地址
	  $url=parse_url($url); //分析地址，重新指向URL
	  $url=$url['path'];
	  $result=@mysqli_query($link,"SELECT * FROM `contents`");
    $num=mysqli_num_rows($result);//查询有多少条信息	
?>



<a href="add.php">添加留言</a>
<br>
<table>

<?php
    $pagesize=5;//每页的条数
    $pageval=1;
    $page = 1;
    //$nowpage=1;//当前页数，默认值为1
	if(isset($_GET[page])){
		$pageval=$_GET[page];
    $pages = ceil($num/$pagesize);//总的页数
        //$page.=',';/*完整的  sql语句是 SELECT * FROM `test` limit $page,$pagesize 这个地方 改成了  limit $page$pagesize也就缺少一个 “,”所以 $page.=',';  添加上这个“,”*/
	}//写出公式


	if($num>$pagesize && $pageval <= $pages && $pageval > 1){//查询出的条数>每页的条数 && 当前页<=总页数 && 当前页>1
		if($pageval<=1) $pageval=1;//排除pageval小于1的情况
		echo "第 $pageval 页".
		"<a href=$url?page=".($pageval-1).">上一页</a>";
    if ($pages != $pageval) {//当前页不等于总页数，则输出“下一页”
    echo "<a href=$url?page=".($pageval+1).">下一页</a>";
    } 
	} 
  if($num<=$pagesize){
    echo"仅一页";
  }
  else {//当前页数为1
    echo "第 1 页"."
    <a href=$url?page=".($pageval+1).">下一页</a>";
  }
$pagenum=($pageval-1)*$pagesize;//limit 新的一页，从第$pagenum条开始选

  $sql="SELECT * FROM contents limit $pagenum,$pagesize";
  $query=mysqli_query($link,$sql);//or die(mysql_error());
 /* if(!query){
  	printf("Error:%s\n",mysqli_error("link"));
  }
 查错 */
  while($row=@mysqli_fetch_array($query,MYSQLI_ASSOC)){ //关联数组
?>

<tr>
  <td>title: <?php echo $row['title'] ?> | ID :<?php echo $row['id'] ?> | picture：<img src="<?php echo $row['picture'] ?>" alt="" width="48.9" height="32.6"/>
  </td>
</tr>
<tr>
  <td class="content">content:<?php echo $row['content']; ?></td>
</tr>
<tr>
  <td><a href="del.php?id=<?php echo $row['id'];?>">删除</a>
      <a href="edit.php?id=<?php echo $row['id'];?>">修改</a>
  </td>
</tr>
<?php
  }
?>

</table>

</body>
</html>