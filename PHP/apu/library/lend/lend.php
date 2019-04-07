<?php

include ("../connect.php"); 


if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$token = $_GET['token'];
	// get book
	// name author copy edition
	
	$name = $_GET['name'];
	$address = $_GET['address'];
	$mobile  = $_GET['mobile'];
	$book_id = $_GET['book_id'];

	if(is_null($token) || is_null($name) || is_null($address) || is_null($mobile) || is_null($book_id)){

		$myObj = new stdClass();
		$myObj->error = 'not enough info.';
		echo json_encode($myObj);
		return;
	}


	$sql = "select token from token_holder"	;
    $result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {

		if($token === $row['token']){
			// add book ;
			$sql = sprintf("insert into lend (name,mobile,address,book_id) values('%s',%s,'%s',%s)",$name,$mobile,$address,$book_id);
			$result = $conn->query($sql);
            $myObj = new stdClass();
            $myObj->success = 'done !';	
            echo json_encode($myObj);
			return ;

		}
	}

	$myObj = new stdClass();
	$myObj->error = 'unauthoized';

	echo json_encode($myObj);
	return;

}