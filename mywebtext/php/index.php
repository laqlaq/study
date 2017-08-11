<?php 
	session_start();
	$_SESSION['name']=$_POST['name'];
	//$_session['name']=$_POST['name'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<?php 
	//取得登录界面的数据
	$name=$_POST['name'];
	$password=$_POST['password'];
	//连接数据库
	$con=mysql_connect("localhost","root","mysqlpasswd");
	if(!$con){
		die("Could not connect:".mysql_error());	
	}else{
		mysql_query("set names utf8");	
	}
	//选择数据库
	$database_name="info";
	mysql_select_db($database_name,$con);
	$sql="select * from name_pw 
		where name='".$name."'";
	$result=mysql_query($sql,$con);
	$rew=mysql_fetch_assoc($result);
	//关闭数据库
	mysql_close($con);
	if($rew["pw"]==$password){
		header("Location:../index2.html");
		//header("Location:../index.html");	
	}else{	
		echo "<script type='text/javascript'>";
		echo "alert('密码有误，请重新输入！');";
		echo "window.location.href='../index.html'";
		echo "</script>";
	}
	//关闭数据库
	//mysql_close($con);
?>
</body>
</html>
