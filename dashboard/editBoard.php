<?php
include_once './inc/header.php';
$id = $_GET['id'];

$query = array(
    'key' => $key,
    'token' => $token
);
$url = "https://api.trello.com/1/boards/$id?" . http_build_query($query);
$curl = curl_init($url);
$headers = array(
    'Accept' => 'application/json'
);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$board = json_decode($response);

?>


<div class="card col-lg-5 shadow mt-5 mx-auto ">
    <div class="card-header bg-dark text-light">
        <h4>Edit Board </h4>
    </div>
    <div class="card-body">
        <form action="../controller/updateBoard.php" method="POST">
            <input type="hidden" name="id" value="<?= $board->id ?>">
            <input type="text" class="form-control my-3" placeholder="Board Name" name="boardName" value="<?= $board->name ?>">
            <button type="submit" name="updateBoard" class="btn btn-dark">Update Board</button>
        </form>
    </div>

</div>

<?php
include_once './inc/footer.php'

?>