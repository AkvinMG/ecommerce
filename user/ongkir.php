<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=226&destination=".$_POST['city']."&weight=1000&courier=pos",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 606f38eed4e4aa09cfd94aca5a272656"
    ),
));

$response = curl_exec($curl);

$err = curl_error($curl);

$response = json_decode($response, true);
curl_close($curl);
//get results
$costs = $response['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
//close connection
echo json_encode($costs);