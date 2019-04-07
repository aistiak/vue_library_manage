<?php

include ("../connect.php"); 


if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$token = $_GET['token'];
	// get book
	// name author copy edition
	
	$name = $_GET['name'];
	$author = $_GET['author'];
	$copy   = $_GET['copy'];
	$edition = $_GET['edition'];

	if(is_null($token) || is_null($name) || is_null($author) || is_null($copy) || is_null($edition)){

		$myObj = new stdClass();
		$myObj->error = 'not enough info.';
		$myObj->code  = '401';
		echo json_encode($myObj);
		return;
	}


	$sql = "select token from token_holder";
    $result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {

		if($token === $row['token']){
			// add book ;
			$sql = sprintf("insert into book (name,edition,author,copy) values('%s',%s,'%s',%s)",$name,$edition,$author,$copy);
			$result = $conn->query($sql);
            $myObj = new stdClass();
            $myObj->success = 'book added';
            $myObj->code    = '200';
            echo json_encode($myObj);
			return ;

		}
	}

	$myObj = new stdClass();
	$myObj->error = 'unauthoized';
	$myObj->code  = '401';

	echo json_encode($myObj);
	return;

}