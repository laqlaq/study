<?php 
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
</head>

<body>
<?php
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
	mysql_select_db("info",$con);
	//判断指定表格是否存在，不存在就新建
	$table_name="info_table";
	if(!mysql_query("show table like '".$table_name."'")){
		$sql="CREATE TABLE info_table(
		name varchar(255) not null,
		sex varchar(255),
		age int(11),
		birthday varchar(255),
		job varchar(255),
		school varchar(255),
		primary key (name) 
		)ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		mysql_query($sql,$con);	
	}
	//查询数据
	$sql="SELECT * FROM info_table";
	$result=mysql_query($sql,$con);
	$rew = mysql_fetch_assoc($result);
	if(empty($rew)){
		$sql="INSERT INTO info_table(name,sex,age,birthday,job,school)
			VALUES('刘阿强','男',22,'1995-11-17','学生','合肥师范学院')";
		$re=mysql_query($sql,$con);
		if($re){
			header("Location:introduction.php");
		}
	}
	echo "<table class='table'>
                <tr>
                    <td><strong>详细资料</strong></td>
                    <td></td>
                </tr>
				 <tr>
                    <td>姓名：</td>";
				    echo "<td><input type='text' value=". $rew['name']."></td>";    
                echo "</tr>
                <tr>
                    <td>性别：</td>";
					echo "<td><input type='text' value=". $rew['sex']."></td>";    
                echo "</tr>
                <tr>
                    <td>年龄：</td>";
					echo " <td><input type='text' value=". $rew['age']."></td>";
                echo "</tr>
                <tr>
                    <td>出生年月：</td>";
					echo "<td><input type='date' value=". $rew['birthday']."></td>";
                echo "</tr>
                <tr>
                    <td>职业：</td>";
					echo " <td><input type='text' value=". $rew['job']."></td>";
                echo "</tr>
                <tr>
                    <td>学校：</td>";
					echo "<td><input type='text' value=". $rew['school']."></td>";
                echo "</tr>
            </table>";
	//关闭数据库
	mysql_close($con);
//	echo "欢迎".$_SESSION['name'];
?>

</body>
</html>
