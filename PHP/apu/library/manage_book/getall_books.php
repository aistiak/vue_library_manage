<?php

include ("../connect.php"); 


if($_SERVER['REQUEST_METHOD'] === 'GET'){

	$token = $_GET['token'];
	$sql = "select token from token_holder";
    $result = $conn->query($sql);
	$myArray = [];
	while($row = $result->fetch_assoc()) {

		if($token === $row['token']){
			
			$sql = "select * from book";
			$result = $conn->query($sql);

			while ($row = $result->fetch_assoc()) {
				# code...
				$id   = $row['id'];
				$name = $row['name'];
				$author = $row['author'];
				$edition = $row['edition'];
				$copy = $row['copy'];

				$bookObj = new stdClass();
				$bookObj->id = $id;
				$bookObj->name = $name;
				$bookObj->author = $author;
				$bookObj->edition = $edition;
				$bookObj->copy = $copy;

				array_push($myArray, $bookObj);

			}

			echo json_encode($myArray);
			return ;

		}
	}

	$myObj = new stdClass();
	$myObj->error = 'unauthoized';

	echo json_encode($myObj);
	return;

}