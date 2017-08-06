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
				document.getElementById("show").innerHTML=xmlHttp.responseText;
			}
	}
	
function show(){
		xmlHttp=getXmlHttpObject();
		if(xmlHttp==null){
				alert("Browser does not support HTTP Request.");
			}
		var url="../php/introduction.php";
		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET",url,false);
		xmlHttp.send(null);
	}

	
	
	
	
	