<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tekencallback";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//$jsondata = file_get_contents('empdetails.json');
//
////convert json object to php associative array
//$data = json_decode($jsondata, true);

$entityBody = file_get_contents('php://input');

// print_r($entityBody);
// die;
// echo gettype($json_response);
// die;

$json_response = json_decode($entityBody, true);
$status = $json_response['status'];
$code = $json_response['code'];
if ($status) {
	if ($code == 'REGISTRATION_COMPLETE') {
		$email = $json_response['data']['email'];
		$sql = "INSERT INTO callback (json, status, code, document_id, signer_email, email, url ) VALUES ('$entityBody', '$status', '$code', '', '', '$email', '')";
	} else if ($code == 'DOCUMENT_SIGNED') {
		$document_id = $json_response['data']['document_id'];
		$signer_email = $json_response['data']['signer_email'];
		// $email = $json_response['data']['sign'][0]['email'];
		// $url = $json_response['data']['sign'][0]['url'];

		$signArray = $json_response['data']['sign'];
		foreach ($signArray as $sign) {
			$email_doc = $sign['email'];
			$url_doc = $sign['url'];

			$sql = "INSERT INTO callback (json, status, code, document_id, signer_email, email, url) VALUES ('$entityBody', '$status', '$code', '$document_id', '$signer_email', '$email_doc', '$url_doc' )";
		}
	} else if ($code == 'DOCUMENT_METERAI_STAMPED') {
		$document_id = $json_response['data']['document_id'];
		$sql = "INSERT INTO callback (json, status, code, document_id, signer_email, email, url) VALUES ('$entityBody', '$status', '$code', '$document_id', '', '', '' )";
	} else if ($code == 'DOCUMENT_SIGN_COMPLETE') {
		$document_id = $json_response['data']['document_id'];
		$document_file_name = $json_response['data']['document_file_name'];
		$document_owner_name = $json_response['data']['document_owner_name'];
		$document_owner_email = $json_response['data']['document_owner_email'];
		$download_url = $json_response['data']['download_url'];
		$signer_email = $json_response['data']['signers'][0]['email'];
		$signer_name = $json_response['data']['signers'][0]['name'];
		$sql = "INSERT INTO callback (
			json, 
			status, 
			code, 
			document_id, 
			signer_email, 
			email, 
			url, 
			document_file_name, 
			document_owner_name, 
			document_owner_email, 
			download_url, 
			signer_name
		) 
		VALUES 
		(
			'$entityBody', 
			'$status', 
			'$code', 
			'$document_id', 
			'$signer_email', 
			'', 
			'', 
			'$document_file_name', 
			'$document_owner_name', 
			'$document_owner_email', 
			'$download_url', 
			'$signer_name')";
	}
} else {
	if ($code == 'DOCUMENT_SIGN_FAILED') {
		$document_id = $json_response['data']['document_id'];
		$sql = "INSERT INTO callback (json, status, code, document_id, signer_email, email, url) VALUES ('$entityBody', '$status', '$code', '$document_id', '', '', '' )";
	}
}

if (mysqli_query($conn, $sql)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



die;

$sql = "INSERT INTO callback (id, json)
	VALUES ('',  '" . $entityBody . "')";

if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
