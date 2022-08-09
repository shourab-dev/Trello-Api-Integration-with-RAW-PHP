<?php
session_start();

if (isset($_REQUEST['addList'])) {
    //*VARIABLES
    $token = $_SESSION['token'];
    $key = $_SESSION['key'];
    $listName = $_POST['listName'];
    $boardId = $_POST['boardId'];
    $boardName = $_POST['boardName'];

    $query = [
        'name' => $listName,
        'idBoard' => $boardId,
        'key' => $key,
        'token' => $token,
    ];
    $url = "https://api.trello.com/1/lists";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($query));
    $response = curl_exec($curl);
    var_dump($response);
    if ($response) {
        header("Location: ../dashboard/showBoard.php?id=$boardId&&board-name=$boardName");
    }
}
