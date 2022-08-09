<?php
session_start();
if (isset($_REQUEST['addBoard'])) {
  $baordName = $_REQUEST['boardName'];
  $token = $_SESSION['token'];
  $key = $_SESSION['key'];

  $url = "https://api.trello.com/1/boards/";

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  $headers = array(
    "Content-Type: application/json",
  );
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

  $query = array(
    'name' => $baordName,
    'key' => $key,
    'token' => $token
  );

  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($query));
  $response = curl_exec($curl);
  curl_close($curl);
  header("Location: ../dashboard/board.php");
}
