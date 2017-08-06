<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<meta http-equiv="refresh" content="0;url=../index.html">-->
<?php
    //header("Location:http://127.0.0.1");
	//header("Location:../index.html");
	$value=$_POST['text_area']."\n";
		date_default_timezone_set("PRC");
		$newtime=date("Y-m-d H:i:s")."\n";
		$myfile=fopen("../text/leave_message.txt","a") or die("Unable to open file!");
		fwrite($myfile,$value);
		fwrite($myfile,$newtime);
		if(fclose($myfile)){
			echo "<script type='text/javascript'>alert('留言成功,欢迎下次再来！');</script>";
			echo "<script type='text/javascript'>";
			echo "window.location.href='../index.html'";
			echo "</script>";
		}

?>
</head>
<body>
</body>
</html>