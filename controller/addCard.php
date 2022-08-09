<?php
session_start();
if (isset($_REQUEST['addCard'])) {
    $key = $_SESSION['key'];
    $token = $_SESSION['token'];
    $cardName = $_POST['cardName'];
    $cardDesc = $_POST['cardDesc'];
    $listId = $_POST['listId'];

    $query = array(
        'idList' => $listId,
        'name' => $cardName,
        'desc' => $cardDesc,
        'key' => $key,
        'token' => $token,
    );
    $url = "https://api.trello.com/1/cards";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($query));

    $response = curl_exec($curl);
    curl_close($curl);
    if ($response) {
        header("Location: ../dashboard/showCards.php?list-id=$listId");
    }
}
