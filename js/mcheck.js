function check()
{
	var username = document.getElementById('username').value;
	var pass = document.getElementById('pass').value;
	if(username == null || username == '' || pass == null || pass == '')
	{
		document.getElementById('error').style.visibility='visible';
		if(username == null || username == '')
		{
			document.getElementById('username').focus();
		}
		else
		{
			document.getElementById('pass').focus();
		}
		return false;
	}
	return true;
}

function insertQCheck()
{
	var new_q = document.getElementById('new_q').value;
	var multiple_choice = document.getElementById('multiple_choice').value;
	if(new_q == null || new_q == '' || multiple_choice == null || multiple_choice == '')
	{
		alert("Για να εισάγετε ερώτηση πρέπει να συμπληρώσετε όλα τα πεδία!");
		return false;
	}
	return true;
}
function semesterSelected()
{
	var semester = document.getElementById('semester').value;
	document.getElementById('course').innerHTML="<option value='-1'></option>";
	document.getElementById('prof').innerHTML="<option value='-1'></option>";
	if(semester!=-1)
	{
		ajax(semester, 1);
	}	
}
function courseSelected()
{
	var course = document.getElementById('course').value;
	document.getElementById('prof').innerHTML="<option value='-1'></option>";
	if(course!=-1)
	{
		ajax(course, 2);
	}	
}
