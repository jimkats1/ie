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