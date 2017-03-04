<?php
session_start();
function loggedin(){
	if(isset($_SESSION['username'])){
		$loggedin="TRUE";
		return $loggedin;
	}
}


?>