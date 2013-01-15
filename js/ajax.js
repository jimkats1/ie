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
			response = xmlhttp.responseText;
			response = trim(response);
			str = response.substr(0,1);
			if(str == '1')
			{
				alert(response.substr(1,response.length));
			}
			else
			{
				numProf = document.getElementById(course).innerHTML;
				numProf = parseInt(numProf);
				numProf++;
				document.getElementById(course).innerHTML = numProf;
				alert(response);
			}
		}
	}
	xmlhttp.open("POST","profregister.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("profId="+element.value+"&courseId="+course);
}
