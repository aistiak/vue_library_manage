<?php
include ("../connect.php"); 
if($_SERVER['REQUEST_METHOD'] === 'GET'){



	$token = $_GET['token'];

	if (is_null($token)){
		$myObj = new stdClass();
		$myObj->error = "not enoung info.";
		$myObj->code = "401";
		echo json_encode($myObj);
		return ;
	}


	$sql = "select token from token_holder";
    $result = $conn->query($sql);
	$myArray = [];
	while($row = $result->fetch_assoc()) {

		if($token === $row['token']){
			
			$sql = "select * from lend";
			$result = $conn->query($sql);

			while ($row = $result->fetch_assoc()) {
				# code...
				$id   = $row['id'];
				$name = $row['name'];
				$mobile = $row['mobile'];
				$address = $row['address'];
				$book_id = $row['book_id'];
				$book_name = '';
				$time_taken = '';

				$bookObj = new stdClass();
				$bookObj->id = $id;
				$bookObj->name = $name;
				$bookObj->mobile = $mobile;
				$bookObj->address = $address;
				$bookObj->book_id = $book_id;

				// get the book name from book id 
				$sql = sprintf("select * from book where id=%s",$book_id);
				$res = $conn->query($sql);
				while ($r = $res->fetch_assoc()) {
					# code...
					$book_name = $r['name'] ;
					$time_taken = $r['ts'];

					break ;
				}

				$bookObj->book_name = $book_name ;
                $bookObj->time_taken = $time_taken;
				array_push($myArray, $bookObj);

			}

			echo json_encode($myArray);
			return ;

		}
	}
}