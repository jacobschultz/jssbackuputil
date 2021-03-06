<?php
/*
	Written by Jake Schultz on 23/7/15
	This file checks for inputted DB information.
*/
require 'db.php';

$username = $_POST['username'];

//Select all of the information to check if we should prompt to enter DB info.
$getInfo = $db->prepare("SELECT * FROM accounts WHERE username = :username;");
$getInfo ->execute(array(':username' => $username));
$data = $getInfo->Fetch();

$converter = new Encryption;

if ($data['ssh_username'] != NULL && $data['ssh_host'] != NULL && $data['mysql_database_name'] != NULL){
	//We have all of the information we need!
	if ($data['schedule_backup_path'] != ""){
		echo  $data['type']."||".  $converter -> decode($data['schedule_backup_path']);
	} else {
		echo  $data['type']."||". $data['schedule_backup_path'];
	}

} else {
	//Prompt the user to enter more info.
	echo 0;
}

?>