<?php 
	session_start();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<meta http-equiv="refresh" content="3;url=../index.html">-->
<?php
    //header("Location:http://127.0.0.1");
	//header("Location:../index.html");
	//$value=$_POST['text_area']."\n";
//	$vv=preg_replace('/^\s*/',"",$value);
//	date_default_timezone_set("PRC");
//	$newtime=date("Y-m-d H:i:s")."\t".$_SESSION['name']."\n";
//	$myfile=fopen("../text/leave_message.txt","a") or die("Unable to open file!");
//	if(fwrite($myfile,$vv)){
//		echo "<script type='text/javascript'>";
//		echo "alert('留言成功！');";
//		echo "window.location.href='../index2.html'";
//		echo "</script >";
//	}
//	fwrite($myfile,$newtime);
//	fclose($myfile);
?>

<?php 
	//获得留言区的内容
	$text_value=$_POST['text_area'];
	//去掉文字前面的空格
	$vv=preg_replace('/^\s*/','',$text_value);
	//获得当前时间
	date_default_timezone_set('PRC');
	$newtime=date('Y-m-d H:i:s');
	//连接数据库
	$con=mysql_connect('localhost','root','mysqlpasswd');
	if(!$con){
		die('Could not connect:'.mysql_error());	
	}else{
		mysql_query('set names utf8');	
	}
	//判断是否有info数据库，如果没有，就创建一个
	$database_name='info';
	$result=mysql_query('show databases');
	while($r=mysql_fetch_assoc($result)){
		$data[]=$r['Database'];	
	}
	if(!in_array(strtolower($database_name),$data)){
		$sql='create database info';
		mysql_query($sql,$con);	
	}
	//选择info数据库
	mysql_select_db($database_name,$con);
	//判断leave_info表格是否存在,不存在就新建一个
	$table_name='leave_info';
	if(!mysql_query('show table like "'.$table_name.'"')){
		$sql='create table leave_info(
			id int(10) not null auto_increment,
			name varchar(255),
			time varchar(255),
			leaves varchar(255),
			primary key (id)
		)default charset=utf8';	
		mysql_query($sql,$con);
	}
	//将留言插入leave_info表格中
	$sql="insert into leave_info(name,time,leaves)
		value('".$_SESSION['name']."','".$newtime."','".$vv."')";
	$leave_success=mysql_query($sql,$con);
	if($leave_success){
		echo "<script type='text/javascript'>";
		echo "alert('留言成功！');";
		echo "window.location.href='../index2.html'";
		echo "</script >";	
	}
	//关闭数据库
	mysql_close($con);
?>
</head>
<body>

</body>
</html>
