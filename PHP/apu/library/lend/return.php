<?php

include ("../connect.php"); 


if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$token = $_GET['token'];
	// get book
	// name author copy edition
	
	$lend_id = $_GET['id'];
/*	$address = $_GET['address'];
	$mobile  = $_GET['mobile'];
	$book_id = $_GET['book_id'];*/

	if( is_null($token) || is_null($lend_id) ){

		$myObj = new stdClass();
		$myObj->error = 'not enough info.';
		$myObj->code = "401";
		echo json_encode($myObj);
		return;
	}


	$sql = "select token from token_holder";
    $result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {

		if($token === $row['token']){
			// add book ;
			$sql = sprintf("delete from lend where id = %s",$lend_id);
			$result = $conn->query($sql);
            $myObj = new stdClass();
            $myObj->success = 'done !';
            $myObj->code = "200";
            echo json_encode($myObj);
			return ;

		}
	}

	$myObj = new stdClass();
	$myObj->error = 'unauthoized';
	$myObj->code = "401";
	echo json_encode($myObj);
	return;

}