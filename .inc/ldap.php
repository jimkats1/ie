<?php

function ldapAuth($user,$pass)
{
	$host = ''; //Your LDAP host
	$dn = ""; //LDAP Parameters
	$con = ldap_connect($host);
	if(!$con)
	{
		$_SESSION['ldapError'] = "Δεν ήταν δυνατή η σύνδεση στο LDAP!";
		return false;
	}
	elseif(!ldap_bind($con, $dn, $pass))
	{
		$_SESSION['ldapError'] = "O λογαριασμός που δώσατε δεν υπάρχει στο σύστημα!";
		return false;
	}
	$filter = "(uid=$user)";
	$attrs = array('');//Select attributes
	$search = ldap_search($con, $dn, $filter, $attrs);
	$info = ldap_get_entries($con, $search);
	if()//statement for checking if the student is from tesyd 
	{
		$_SESSION['ldapSuccess'] = 1;
		return true;
	}
	else
	{
		$_SESSION['ldapError'] = "Πρέπει να είστε σπουδαστής του ΤΕΣΥΔ για να συνδεθείτε!";
		return false;
	}
}
?>
