<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$_POST['province'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 606f38eed4e4aa09cfd94aca5a272656"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$response = json_decode($response, true);
//get results
$regencies = $response['rajaongkir']['results'];
//close connection
curl_close($curl);

echo json_encode($regencies);