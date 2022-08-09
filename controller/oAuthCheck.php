<?php
session_start();
if (isset($_REQUEST['checkAuth'])) {
    // APP KEY AND CLIENT SECRET
    $apiKey = $_REQUEST['apiKey'];
    $clientSecret = $_REQUEST['clientSecret'];

    //*AUTH CHECK
    $url = "https://api.trello.com/1/members/me/?key=$apiKey&token=$clientSecret";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $auth = json_decode($response);
    curl_close($curl);

    //*CHECK IF AUTH USER OR NOT
    if ($auth->id != '' || $auth->id != null) {
        $ch = curl_init();
        $headers = array(
            'Accept' => 'application/json'
        );

        $query = array(
            'key' => $apiKey,
            'token' => $clientSecret
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $organization = 'https://api.trello.com/1/members/' . $auth->id . '/organizations?' . http_build_query($query);

        curl_setopt($ch, CURLOPT_URL, $organization);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseOrganizationData = curl_exec($ch);

        $organizationData = json_decode($responseOrganizationData);
        $organizationId = $organizationData[0]->id;
        print_r($organizationId);


        curl_close($ch);
    } else {
        header("Location: ../index.php");
    }
}
