<?php

$key = "RAHASIA";
$client_id = $_POST['client_id'];
$timestamp = $_POST['timestamp'];
$sig = $_POST['sig'];
$data = $_POST['data']; // Nilai data yang akan diakses

$date = date("Y-m-d H:i:s", $timestamp);
$payload = $data . "" . $client_id . "" . $date;
$expected_sig = hash_hmac('sha256', $payload, $key);

if ($sig == $expected_sig) {
    // Autentikasi valid
    // Lakukan aksi yang diizinkan
} else {
    // Autentikasi tidak valid
    // Batalkan aksi dan tampilkan pesan kesalahan
}


$key = "RAHASIA";
$client_id = "amj6Oqx234ON0kxFoFGt8wQeIRIapIby";
$timestamp = time();
$date = date("Y-m-d H:i:s", $timestamp);
$data = "data tambahan"; // bisa diisi dengan data tambahan, atau dihapus jika tidak diperlukan
$payload = $data . $client_id . $date;
$sig = hash_hmac('sha256', $payload, $key);

// set header Authorization dengan signature yang dihasilkan
$header = array(
    "Authorization: " . $sig
);

// kirim permintaan dengan menggunakan header Authorization
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.contoh.com/api");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
$response = curl_exec($ch);
curl_close($ch);

// proses response
echo $response;


$apiKeys = [
    'amj6Oqx234ON0kxFoFGt8wQeIRIapIby'   => 'pln',
    '12345'     => 'gsp',
];

$authHeader = getallheaders()['Authorization'];
$apiKey = str_replace('Bearer ', '', $authHeader);

if (in_array($apiKey, array_keys($apiKeys))) {
    http_response_code(200);
    $response = array(
        'code'      => '200',
        'status'    => 'OK',
        'message' => 'secret key valid',
        'data' => null
    );
    echo json_encode($response);
} else {
    http_response_code(401);
    $response = array(
        'code'      => '401',
        'status'    => 'Unauthorized',
        'message' => 'Unauthorized access. Please provide valid credentials',
        'data' => null
    );
    echo json_encode($response);
    exit;
}

die();
