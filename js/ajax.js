function ajax(ch1, ch2)
{
	var getter;
	var param;
	var xmlhttp;
	if(ch2=='1')
	{
		getter="getcourse";
		param="course";
	}
	else if(ch2=='2')
	{
		getter="getprof";
		param="prof"
	}
	else
	{
		return;
	}
	if (window.XMLHttpRequest)
  	{
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			document.getElementById(""+param).innerHTML=xmlhttp.responseText;
    		}
  	}
xmlhttp.open("GET",getter+".php?q="+ch1,true);
xmlhttp.send();
}
function insProf(element, course)
{
	var xmlhttp;
	alert(element.value);
	alert(course);
	if(element.value == 0)
	{
		return false;
	}
	if (window.XMLHttpRequest)
  	{
  		xmlhttp=new XMLHttpRequest();
  	}
	else
  	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
    			alert(""+xmlhttp.responseText);
    		}
  	}
xmlhttp.open("POST","profregister.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("profId="+element.value+"&courseId="+course);
}
