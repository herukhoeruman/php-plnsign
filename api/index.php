<?php



$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'plnr6871_callback';

// $username = "plnr6871_callback";
// $password = "]0YFMu8]}IV,";
// $dbname = "plnr6871_callback";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

header('Content-Type: application/json');


$curl = curl_init();


$file           = $_FILES['document']['tmp_name'];
$file_name      = $_FILES['document']['name'];
$mime_type      = mime_content_type($file);
$signature      = $_POST['signature'];
$materai        = isset($_POST['ematerai']) ? $_POST['ematerai'] : '';
$stempel        = isset($_POST['estamp']) ? $_POST['estamp'] : '';
$is_in_order    = isset($_POST['is_in_order']) ? $_POST['is_in_order'] : '';

$cfile          = new CURLFile($file, $mime_type, $file_name);

$data = array(
    "document"    => $cfile
);
if ($signature) {
    $data['signature'] = $signature;
}
if ($materai) {
    $data['ematerai'] = $materai;
}
if ($stempel) {
    $data['estamp'] = $stempel;
}
if ($is_in_order == "on") {
    $data['is_in_order'] = 1;
}


if (isset(getallheaders()['apikey'])) {
    $client_id = getallheaders()['apikey'];

    //apikey app smar
    if ($client_id != "amj6Oqx234ON0kxFoFGt8wQeIRIapIby") {
        $response = array(
            'status'      => 'ERROR',
            'message'    => 'Invalid API Key',
        );
        echo json_encode($response);
        exit;
    }
} else {
    $response = array(
        'status'      => 'ERROR',
        'message'    => 'No API key found in request',
    );
    echo json_encode($response);
    exit;
}



$crn            = $_POST['crn'];
$ceksum         = $_POST['ceksum'];
$timestamp      = $_POST['timestamp'];
$key            = "RAHASIA";
$requestBody    = '{
        "document"      : "' . $file_name . '",
        "signature"     : "' . $signature . '",
        "timestamp"     : "' . $timestamp . '"
    }';
$payload        = $requestBody . $timestamp;
$hash            = hash_hmac('sha256', $payload, $key);
$ceksum     = hash_hmac('sha256', $payload, $key);
// echo $requestBody;

if ($ceksum !== $hash) {
    http_response_code(401);
    $response = array(
        'status'    => 'ERROR',
        'message'    => 'Unauthorized',
    );
    echo json_encode($response);
    exit;
}

// echo json_encode($data);
logProcess("Request : " . json_encode($data));

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://apix.sandbox-111094.com:443/v2/document/upload',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        "apikey: " . $client_id . "",
        // 'apikey: amj6Oqx234ON0kxFoFGt8wQeIRIapIby' //pa dadang
        // 'apikey: w11r7AHgSwzAFm1EYLv17fLdmr9lRnfO' // heru
        // 'apikey: TkhRZ7XmPVEOTNtY3XWq7htqWoGpJntl' //pak sugih
    ),
));

$response = curl_exec($curl);

curl_close($curl);

echo $response;
logProcess("Response : " . $response);

/* ============ upload direktori ============ */
$upload_dir = 'dokumen/';
$generate_file_name = uniqid() . '_' . $file_name;
$target_file = $upload_dir . basename($generate_file_name);
move_uploaded_file($file, $target_file);

$genUUID = generateUUID();
$trx_id = $genUUID;
$id = $genUUID;

/* ============ insert db ============ */
$insertRequest = "INSERT INTO req_teken (
        kode,
        file_name, 
        file_path, 
        signature,
        ematerai,
        estamp,
        client_id,
        client_ref_num,
        timestamp,
        trx_id
    ) 
    VALUES (
        '00',
        '$generate_file_name', 
        '$target_file',
        '$signature',
        '$materai',
        '$stempel',
        '$client_id',
        '$crn',
        '$timestamp',
        '$trx_id'
    )";
$resultRequest = mysqli_query($conn, $insertRequest);

$json_response = json_decode($response, true);
$status = $json_response['status'];
$code = $json_response['code'];

if ($status == "ERROR") {
    $insertResponse = "INSERT INTO res_teken (
        kode,
        json,
        trx_id    
    ) VALUES (
        '10',
        '$response',
        '$trx_id'
    )";
} else if ($status == "OK") {
    $document_id = $json_response['data']['id'];
    $insertResponse = "INSERT INTO res_teken (
        kode,
        json,
        document_id,
        trx_id    
    ) VALUES (
        '10',
        '$response',
        '$document_id',
        '$trx_id'
    )";
}
$resultResponse = mysqli_query($conn, $insertResponse);

if ($insertRequest && $insertResponse) {
    $message = array(
        'message' => 'New record was created successfully',
    );
    echo json_encode($message);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


// $response = '{"status":"OK","ref_id":"98a744cc-bf9a-4b3d-b635-ecab424a11cc","code":null,"timestamp":"2023-03-10T16:50:12+07:00","message":null,"data":{"id":"98a744cc-f4be-4000-8233-469fc07ed957","stamp":[],"sign":[{"teken_id":"HH283D00","email":"heru@gsp.co.id","url":"https://ttd.sandbox-111094.com/ye56dERDtUNLSSh6"},{"teken_id":"HH283D01","email":"heru@gsp.co.id","url":"https://ttd.sandbox-111094.com/df98hGTmKIOP23d4"}]}}';

// $json_response = json_decode($response, true);
//response update to table 

// $json_response = json_decode($response, true);
/*   $file_url = $json_response['data']['sign'][0]['url'];
  $file_data = file_get_contents($file_url);

  // menyimpan file ke dalam direktori tujuan
  file_put_contents($generate_file_name, $file_data);

  // memperbarui path file di database
  $conn = mysqli_connect('localhost', 'username', 'password', 'database');
  $sql = "UPDATE trx_files SET file_path='$file_path' WHERE file_name='$generate_file_name'";
  mysqli_query($conn, $sql);
  mysqli_close($conn); */

// if ($json_response['status'] == "OK") {
//     // echo "<script>
//     //   Swal.fire({
//     //     title: 'Success!',
//     //     text: 'Request was successful.',
//     //     icon: 'success',
//     //     button: 'OK',
//     //     allowOutsideClick: false,
//     //   });
//     // </script>";
//     // /* ============ link url sign ============ */
//     // $sign = $json_response['data']['sign'];
//     // foreach ($sign as $idx => $value) {
//     //     echo "url sign-" . ($idx + 1) . " " . "<a href='" . $value["url"] . "'>" . $value["url"] . "</a></br>";
//     //     //print_r($value);
//     // }
//     /* ============ open url sign ============ */
//     // $urls = $json_response['data']['sign'];
//     // foreach ($urls as $url) {
//     //   echo "<script>window.open('" . $url['url'] . "', '_blank')</script>";
//     // }
//     //redirect($url,'refresh');
// } else {
//     $code = $json_response['code'];
//     if ($code == "INVALID_PARAMETER") {
//         $message = $json_response['message']['document'][0];
//     } else if ($code == "SIGNATURE_INVALID_FORMAT") {
//         $message = $json_response['message'];
//     } else if ($code == "SIGNATURE_INVALID_PAGE") {
//         $message = $json_response['message'];
//     } else if ($code == "USER_UNREGISTER") {
//         $message = $json_response['message'][0];
//     } else if ($code == "USER_UNVERIFY_EMAIL") {
//         $message = $json_response['message'][0];
//     } else if ($code == "USER_INACTIVE") {
//         $message = $json_response['message'][0];
//     } else if ($code == "DUPLICATE_SIGNER") {
//         $message = $json_response['message'];
//     } else if ($code == "SYSTEM_FAILURE") {
//         $message = $json_response['message'];
//     } else if ($code == "CERTIFICATE_FAILED") {
//         $message = $json_response['message'][0];
//     } else if ($code == "QR_CODE_LIMIT_EXCEED") {
//         $message = $json_response['message'];
//     } else if ($code == "ESTAMP_NOT_FOUND") {
//         $message = $json_response['message'][0];
//     } else if ($code == "ESTAMP_INVALID_FORMAT") {
//         $message = $json_response['message'];
//     } else if ($code == "DUPLICATE_STAMPER") {
//         $message = $json_response['message'];
//     } else if ($code == "ESTAMP_INVALID_PAGE") {
//         $message = $json_response['message'];
//     } else if ($code == "DOCUMENT_TYPE_EMATERAI_INVALID") {
//         $message = $json_response['message'];
//     } else if ($code == "DOCUMENT_VERSION_EMATERAI") {
//         $message = $json_response['message'];
//     } else if ($code == "EMATERAI_INVALID_PAGE") {
//         $message = $json_response['message'];
//     } else if ($code == "DOCUMENT_ENCRYPTED") {
//         $message = $json_response['message'];
//     } else if ($code == "WRONG_PASSWORD_DOCUMENT") {
//         $message = $json_response['message'];
//     } else {
//         $message = $json_response['message'];
//     }


//     if (is_array($message)) {
//         $error_message = $message[0];
//     } else {
//         $error_message = $message;
//     }
//     // echo "<script>
//     //     Swal.fire({
//     //       title: 'Error!',
//     //       text: 'Message : $error_message',
//     //       icon: 'error',
//     //       button: 'OK',
//     //       allowOutsideClick: false,
//     //     });
//     //   </script>";
// }

function logProcess($message)
{
    date_default_timezone_set('Asia/Jakarta');
    $logFile = './log/' . date('Y-m-d') . '.log';
    $handle = fopen($logFile, 'a') or die('Cannot open file: ' . $logFile);
    $time = date('Y-m-d H:i:s');
    $log = "$time - $message\n";
    fwrite($handle, $log);

    fclose($handle);
}

function generate_kode_unik($length = 8)
{
    $char_set = '0123456789abcdef';
    $kode_unik = '';

    // Generate kode unik dengan panjang $length
    for ($i = 0; $i < $length; $i++) {
        $kode_unik .= $char_set[rand(0, strlen($char_set) - 1)];
    }

    return $kode_unik;
}

function randomNum()
{
    $length          = (int) 3;
    $token           = "";
    $codeAlphabet = "0123456789";
    $max = strlen($codeAlphabet);
    for ($i = 0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max - 1)];
    }
    return $token;
}

function generateUUID()
{
    $data = openssl_random_pseudo_bytes(32);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
