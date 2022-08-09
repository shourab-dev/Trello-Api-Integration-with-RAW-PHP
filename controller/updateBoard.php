<?php
session_start();
if (isset($_POST['updateBoard'])) {
  $token = $_SESSION['token'];
  $key = $_SESSION['key'];
  $id = $_POST['id'];
  $boardName = $_POST['boardName'];

  $query = array(
    'name' => $boardName,
    'key' => $key,
    'token' => $token
  );
  $url = "https://api.trello.com/1/boards/$id";

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);

  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

  $headers = array(
    "Content-Type: application/json",
  );
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($query));

  $response =   curl_exec($curl);
  curl_close($curl);

  if ($response) {
    header("Location: ../dashboard/board.php");
  }
}
