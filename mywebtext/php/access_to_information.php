<?php
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
	//从leave_info中取数据,以json的格式传递
	$sql='select name,time,leaves from leave_info';
	$ca=mysql_query($sql,$con);
	//$row=mysql_fetch_assoc($ca);
	while($row=mysql_fetch_assoc($ca)){
		$json[]=$row;
	}
	echo json_encode($json);
	//关闭数据库
	mysql_close($con);
?>

