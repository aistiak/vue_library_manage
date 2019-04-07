<?php

include ("../connect.php"); 


if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$token = $_GET['token'];
	// get book
	// name author copy edition
	
	$id = $_GET['id'];


	if(is_null($token) || is_null($id) ){

		$myObj = new stdClass();
		$myObj->error = 'not enough info.';
		$myObj->code  = "401";
		echo json_encode($myObj);
		return;
	}


    $sql = sprintf("delete from book where id=%s",$id);
    $result = $conn->query($sql);

	$myObj = new stdClass();
	$myObj->success = 'book deleted';
	$myObj->code = "200";

	echo json_encode($myObj);
	return;

}