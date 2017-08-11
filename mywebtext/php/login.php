<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<?php
	//取得登录界面的数据
	$name=$_POST['name'];
	$password=$_POST['password'];
	//连接数据库
	$con=mysql_connect("localhost","root","mysqlpasswd");
	if(!$con){
			die("Cuold not connect:".mysql_error());
	}else{
		mysql_query("set names utf8");
	}
	//判断是否有info数据库，如果没有就创建一个
	$data_base_name="info";
	$result1=mysql_query("show databases");
	while($r1=mysql_fetch_assoc($result1)){
		$data1[]=$r1["Database"];
	}
	if(!in_array(strtolower($data_base_name),$data1)){
		$sql="create database info";
		mysql_query($sql,$con);
	}
	//选择指定数据库
	if(mysql_select_db("info",$con)){
		echo "<script type='text/javascript'>";
		echo "alert('选择数据库成功！');";
		echo "</script>";		
	}
	//判断指定表格是否存在，不存在就新建
	$table_name="name_pw";
	if(!mysql_query("show table like '".$table_name."'")){
		$sql="CREATE TABLE name_pw(
		name varchar(255) not null,
		pw int(30),
		primary key (name) 
		)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		if(mysql_query($sql,$con)){	
			echo "<script type='text/javascript'>";
			echo "alert('创建表格成功！');";
			echo "</script>";	
		}
	}
	$sql="SELECT * FROM name_pw
		where name='".$name."'";
	$result=mysql_query($sql,$con);
	$rew = mysql_fetch_assoc($result);
	if(empty($rew)){
		$sql="INSERT INTO name_pw(name,pw)
			VALUES('".$name."',".$password.")";
		$re=mysql_query($sql,$con);
		if($re){
			header("Location:../index.html");
		}
	}else{
		echo "<script type='text/javascript'>";
		echo "alert('用户名已被使用，请重新输入！');";
		echo "window.location.href='../html/login.html'";
		echo "</script>";	
	}
	//关闭数据库
	mysql_close($con);
?>
</body>
</html>
