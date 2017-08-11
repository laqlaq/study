<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>create database</title>
</head>

<body>
<?php
	$con=mysql_connect("localhost","root","mysqlpasswd");
	if(!$con){
		die('Could not connect:'.mysql_error());
		}
		if(mysql_query("CREATE DATABASE info",$con)){
			echo "Database created!";
			}
		else {
			echo "Error creating Database:".mysql_error();
			}
		mysql_select_db("info",$con);
		$sql="CREATE TABLE personal_information
		(
			infoID int not null auto_increment,
			primary key(infoID),
			name varchar(15),
			sex varchar(15),
			age int(15),
			birthday date(15),
			job varchar(15),
			school varchar(15).
		)";
		mysql_query("$sql",$con);
		$sql="insert into personal_information(name,sex,age,birthday,job,school)
		     value('刘阿强','男',22,'1995-11-17','学生','合肥师范学院')";
		if(mysql_query("$sql",$con)){
				echo "insert success.";
			}
	mysql_close($con);
?>
</body>
</html>











