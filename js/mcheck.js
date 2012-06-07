// JavaScript main check
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
