<?php
function authenticate($user, $password) {
	if(empty($user) || empty($password)) return false;

	// Active Directory server
	$ldap_host = "DETNSW.WIN";

	// Active Directory DN
	$ldap_dn = "OU=Schools,DC=DETNSW,DC=WIN";

	// Active Directory user group
	$ldap_user_group = "Bowraville CS - School.NonTeacher";
 	$ldap_user_group1 = "Bowraville CS - School.Teacher";
	$ldap_user_group2 = "Bowraville CS - School.StaffOther";
	$ldap_user_group3 = "Year 7 1336";
	$ldap_user_group4 = "Year 8 1336";
	$ldap_user_group5 = "Year 9 1336";
	$ldap_user_group6 = "Year 10 1336";
	$ldap_user_group7 = "Year 11 1336";
	$ldap_user_group8 = "Year 12 1336";

	// Domain, for purposes of constructing $user
	$ldap_usr_dom = "@DETNSW";

	// connect to active directory
	$ldap = ldap_connect($ldap_host)
 	or die("Could not connect to LDAP server.");
	// verify user and password
	if($bind = @ldap_bind($ldap, $user . $ldap_usr_dom, $password)) {
		// valid

		// check presence in groups
		$filter = "(userPrincipalName=" . $user . $ldap_usr_dom .")";
		$attr = array("memberOf", "mail", "givenName", "sn");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		ldap_unbind($ldap);

		// check groups
		foreach($entries[0]['memberof'] as $grps) {
			// is user, break loop
			if (strpos($grps, $ldap_user_group1)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group))  { $access = 1; break; }
			if (strpos($grps, $ldap_user_group3)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group2)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group4)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group5)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group6)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group7)) { $access = 1; break; }
			if (strpos($grps, $ldap_user_group8)) { $access = 1; break; }
		}

		if(isset($access)) {
			//print_r($entries);
			$mail = $entries[0]["mail"][0];
			$firstname = $entries[0]["givenname"][0];
			$sn = $entries[0]["sn"][0];
?>
