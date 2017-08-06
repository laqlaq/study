<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档666</title>
<?php 
	$a=$_GET['name'];
	echo "你好sb,888888888888888,,,".$a;
	$con=mysql_connect("localhost","root","123456");
	if(!$con){
			die("Cuold not connect:".mysql_error());
		}
	else{
			echo "0";
		}
	mysql_query("set names utf8");
	if(mysql_select_db("info",$con)){
			echo "1";
		}
	$sql="SELECT * FROM info_table";
	echo "2";
	if($result=mysql_query("$sql",$con)){
			echo "3";
		}
	if($rew = mysql_fetch_assoc($result)){
			echo "4";
		}
	echo "<br />";
	print_r($rew['name']);echo "<br />";
	print_r($rew['job']);echo "<br />";

		
	mysql_close($con);
?>

</head>



<body>
</body>
</html>