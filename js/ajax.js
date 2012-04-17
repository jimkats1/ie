function ajax(ch1, ch2)
{
	var getter;
	var param;
	var xmlhttp;
	if(ch2=='1')
	{
		getter="getCourse";
		param="course";
	}
	else if(ch2=='2')
	{
		getter="getProf";
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
