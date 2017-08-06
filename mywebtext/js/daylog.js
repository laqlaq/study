// JavaScript Document
var xmlHttp=NULL;
function getXmlHttpObject(){
		var xmlHttp=null;
		try{
				xmlHttp=new XMLHttpRequest();
			}
		catch(e){
				try{
						xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
					}
				catch(e){
						xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
					}
			}
		return xmlHttp;
	}

function stateChanged(){
		if(xmlHttp.readyState==4||xmlHttp.readyState=="complete"){
				document.getElementById("hello").innerHTML=xmlHttp.responseText;
				alert(xmlHttp.responseText);
				document.getElementById("texss").innerHTML=document.getElementById("hello").innerHTML;
				document.getElementById("texss1").innerHTML=document.getElementById("texss").innerHTML;
				document.getElementById("texss2").innerHTML=document.getElementById("texss1").innerHTML;
				document.getElementById("tex").innerHTML=document.getElementById("texss2").innerHTML;
			}
	}
	
function show(){
		xmlHttp=getXmlHttpObject();
		if(xmlHttp==null){
				alert("Browser does not support HTTP Request.");
			}
		var url="../php/hello.php?name=liuaqing";	
		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET",url,false);
		xmlHttp.send();
	}
	
	function postshow(){
		xmlHttp=getXmlHttpObject();
		if(xmlHttp==null){
				alert("Browser does not support HTTP Request.");
			}
		//var obj="value="+obj_text;
		var url="../php/hh.php";
		//xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlHttp.onreadystatechange=poststateChanged;
		xmlHttp.open("post",url,false);
		xmlHttp.send();
	}
	
	function poststateChanged(){
		if(xmlHttp.readyState==4||xmlHttp.readyState=="complete"){
				/*if(navigator.appName.indexOf("Explorer") > -1){
						var text = document.getElementById("change").innerText;
					}         
				else{
						var text = document.getElementById("change").textContent;
					}*/
					//var text = document.getElementById("change").textContent;
					var text = document.getElementById("change").innerHTML;
					alert(text);
				//var doc =document.getElementById("change");
				//var val =doc.innerHTML;
				//doc =xmlHttp.responseText;
				document.getElementById("change").innerHTML=xmlHttp.responseText+text;
				//alert(document.getElementById("change").innerHTML);
				//alert(document.getElementById("change").textContent);
			}
	}

	
	
	
	
